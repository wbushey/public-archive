#!/usr/bin/perl

# This script runs though all the policies currently in the database, retrieves the current version, compares the current version
# to the most recently stored version, and stores the current version if any changes are noted. This script is meant to be run
# as a cron job.

# Script options:
#	-v : Verbose, prints out status messages as the script works.

use constant DB_DB => 'termswatch';
use constant DB_USERNAME => 'termswatch';
use constant DB_PASSWORD => 'termswatch';

use constant LOG_SCRAPE_ERROR => -2;
use constant LOG_CONNECTION_ERROR => -1;
use constant LOG_NOTHING => 0;			# No errors or updates occured, so nothing interesting happened.
use constant LOG_NEW => 1;
use constant LOG_UPDATE => 2;

use strict;
use warnings;
use lib '/home/bill/Development/workspace/TermsWatch/lib/vendor/Berkman';
use TermswatchLWP;
use Scraper;
use Error qw(:try);
use DBI;

my $verbose = (($ARGV[0] && $ARGV[0] eq '-v') ? 1: 0);

my $tlwp = new TermswatchLWP;
my $scraper = new Scraper;

if ($verbose){
	print "Accessing Database.\n";
}

# Open and access DB
my $dbh = DBI->connect("dbi:mysql:" . DB_DB, DB_USERNAME, DB_PASSWORD)
                or die "Couldn't connect to DB\n";
my $sth = $dbh->prepare("select pid from policy")
		or die "Couldn't create statement\n";
$sth->execute or die "Couldn't execute statment\n";

# This statement does not do what is desired, ordering occurs after grouping, so we end up with the first version of every policy
#my $sth = $dbh->prepare("select p.*, v.* from policy p left join version v on v.pid = p.pid group by p.pid order by v.retrievedAt desc")
#                or die "Couldn't create statment\n";

# Prepare some SQL statements
my $latest_sth = $dbh->prepare("select p.pid, p.url, p.scrapeMethod, p.scrapeData, p.spoof, v.content, v.retrievedAt from policy p left join version v on p.pid = v.pid where p.pid = ? order by v.retrievedAt desc limit 1");
my $insert_sth = $dbh->prepare("insert into version (pid, retrievedAt, flags, content) values (?, NOW(), ?, ?)");
my $log_sth = $dbh->prepare("insert into log (pid, timestamp, outcome, message) values (?, NOW(), ?, ?)");

# Go through results
my ($pid, $url, $method, $scrape_data, $spoof, $db_text, $live_text, $flags);
my $addedVersions = 0;
while(my $policy_rowref = $sth->fetchrow_arrayref()){
	# Get latest version stored in DB
	$latest_sth->bind_param(1, $$policy_rowref[0], 	DBI::SQL_INTEGER);
	$latest_sth->execute or die "Could not execute latest version retrieval for $$policy_rowref[0]\n";
	my $latest_rowref = $latest_sth->fetchrow_arrayref();
	
	$pid = $$latest_rowref[0];
	$url = $$latest_rowref[1];
	$method = $$latest_rowref[2];
	$scrape_data = $$latest_rowref[3];
	$spoof = $$latest_rowref[4];
	$db_text = $$latest_rowref[5];

	my $flags = 0;
	my $outcome = LOG_NOTHING;
	my $message = undef;

	# Get what is currently online
	if ($verbose){
		print "Retrieving from $url\n";
	}
	$tlwp->setAgentString($spoof);
	my $response = $tlwp->retrievePage($url);

	if (!$response->is_success){
		# Log the failure
		$outcome = LOG_CONNECTION_ERROR;
		$message = "Could not connect to $url: " . $response->status_line . "\n";		
		if ($verbose){
			print "Could not connect to $url\n";	
			print "\t" . $response->status_line . "\n";
		}
	} else {
		# Scrape and compare
		try{
			$scraper->clearDocumentAndResult;
			$scraper->document($response->content);
			$scraper->scrape($method, $scrape_data);
			my $live_text = $scraper->result;

			chomp($live_text);
		
			if ($scraper->remove_html_tags($live_text) ne $scraper->remove_html_tags($db_text)){
				if (!$db_text){
					$flags = $flags | Scraper::VF_FIRST;
				}

				$insert_sth->bind_param(1, $pid, DBI::SQL_INTEGER);
				$insert_sth->bind_param(2, $flags, DBI::SQL_INTEGER);
				$insert_sth->bind_param(3, $live_text, DBI::SQL_LONGVARCHAR);
				$insert_sth->execute
					or die "Couldn't execute statement: " . $insert_sth->errstr;

				# Set log 
				if (!$db_text){
					#Log first version
					$outcome = LOG_NEW;
					if ($verbose) {
						print "First Version of $url.\n";
					}
				} else {
					# Log Updaet
					$outcome = LOG_UPDATE;
					if ($verbose){
						print "Added Version for $pid\n";
					}
				}

				$addedVersions++;
			}
		} catch Error with{
			my $ex = shift;
			# Log the error
			$outcome = LOG_SCRAPE_ERROR;
			$message = $ex->stringify;
			if ($verbose){
				print "$ex\n";
			}
		};
	}

	# Write the log
	$log_sth->bind_param(1, $pid, DBI::SQL_INTEGER);
	$log_sth->bind_param(2, $outcome, DBI::SQL_INTEGER);
	$log_sth->bind_param(3, $message, DBI::SQL_LONGVARCHAR);
	$log_sth->execute; 
}

#Close DB
$log_sth->finish;
$insert_sth->finish;
$latest_sth->finish;
$sth->finish;
$dbh->disconnect;

if ($verbose){
	print "Added $addedVersions versions\n";
	print "Finished.\n";
}
