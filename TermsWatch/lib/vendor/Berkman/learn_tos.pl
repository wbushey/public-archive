#!/usr/bin/perl
use lib '/home/bill/Development/workspace/TermsWatch/lib/vendor/Berkman';
use strict;

use constant DB_DB => 'termswatch';
use constant DB_USERNAME => 'termswatch';
use constant DB_PASSWORD => 'termswatch';

use TermswatchLWP;
use Scraper;
use Error qw(:try);
use DBI;

my $dbh = DBI->connect("dbi:mysql:" . DB_DB, DB_USERNAME, DB_PASSWORD)
                or die "Couldn't connect to DB\n";

if ($ARGV[0] eq '-submitTOS' || $ARGV[0] eq '-submitNONTOS'){
	if (!($ARGV[1] && $ARGV[2] && $ARGV[3] && $ARGV[4])){
		die "-submitTOS/-submitNONTOS method data url spoof\n";
	}	

	print "Retrieving<br/>\n";
	my $tlwp = new TermswatchLWP;
	my $response = $tlwp->retrievePage($ARGV[3]);
	my $page = $response->decoded_content || $response->content;

	print "Scraping<br/>\n";
	my $scraper = new Scraper;
	$scraper->debug_element_to_file;
	my $content;
	try{
		$scraper->document($page);
		$scraper->scrape($ARGV[1], $ARGV[2]);
		$content = $scraper->remove_html_tags($scraper->result);
	} catch Error with {
		my $ex = shift;
		print $ex;
		die;
	};

	print "Checking for duplicate<br/>\n";
	my $check_sth = $dbh->prepare("select * from TOS where url = '" . $ARGV[3] . "'");
	$check_sth->execute;
	if ($check_sth->rows > 0){
		print $ARGV[3] . " is already in the TOS/NONTOS database.<br/>\n";
		die;
	}

	print "Adding to DB<br/>\n";
	my $sth = $dbh->prepare("insert into TOS (url, content, tos) values (?, ?, ?)")
		or die "Could not create statement\n";
	$sth->bind_param(1, $ARGV[3]);
	$sth->bind_param(2, $content);
	if ($ARGV[0] eq '-submitTOS'){
		print "Submitting TOS<br/>\n";
		$sth->bind_param(3, 1);
	} elsif($ARGV[0] eq '-submitNONTOS') {
		print "Submitting NONTOS<br/>\n";
		$sth->bind_param(3, 0);
	}

	$sth->execute;
	if ($sth->err){
		print "Error Submitting.<br/>\n";
		print $sth->err . "\n";
		die;
	}
	$sth->finish;

} elsif($ARGV[0] eq '-pullDBtoTOS'){
	my $scraper = Scraper->new;
	my $select_sth = $dbh->prepare("select p.url, v.content, p.pid from policy p left join version v on p.pid = v.pid group by p.pid order by v.retrievedAt")
		or die "Could not create statement\n";
	my $insert_sth = $dbh->prepare("insert into TOS (url, content, tos) values (?, ?, 1)");
	$select_sth->execute
		or die "Could not execute select statment.";
	my $row_ref;
	my $i = 0;
	while ($row_ref = $select_sth->fetchrow_arrayref){
		if ($$row_ref[1]){
			print "Adding $$row_ref[0]\n";
			$insert_sth->bind_param(1, $$row_ref[0]);
			$insert_sth->bind_param(2, $scraper->filter_all_tags($$row_ref[1]));
			$insert_sth->execute 
				or die "Could not execute insert statment.";
			++$i;
		}
	}	
	$insert_sth->finish;
	print "$i TOS Added\n";
} elsif($ARGV[0] eq '-learn') {
	print "Learning\n";
} else {
	die "Enter either -submitTOS, -submitNONTOS, -pullDBtoTOS, or -learn\n";
}

$dbh->disconnect;

print "Done<br/>.\n";
