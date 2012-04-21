#!/usr/bin/perl

use constant DB_USERNAME => "termswatch";
use constant DB_PASSWORD => "termswatch";
use constant DB_DB => "termswatch";
my  $filename = "result.txt";
my $common_words = "a|an|and|any|are|as|at|be|by|for|if|in|is|it|its|not|nbsp|of|on|or|our|s|t|that|the|this|to|we|with|you|your";

use DBI;

my %dictionary = {};
my $policyCount = 0;

print "Opening DB.\n";

# Open and access DB
my $dbh = DBI->connect("dbi:mysql:" . DB_DB, DB_USERNAME, DB_PASSWORD)
		or die "Couldn't connect to DB\n";
my $sth = $dbh->prepare("select pid, content from version group by pid")
		or die "Couldn't create statment\n";
$sth->execute or die "Couldn't execute statment\n";

# Get list of common words


# Go through results
while(my $row = $sth->fetchrow_arrayref()){
	++$policyCount;
	my $content = $$row[1];


	# Strip tags
	$content =~ s/<(.*?)>//gs;
	
	# Strip common words
	$content =~ s/\b($common_words)\b//ig;
	
	# Add to dictionary
	while ($content =~ /\b(\w+)\b/g){
		$dictionary{lc($1)}++;
	}
}

#Close DB
$sth->finish;
$dbh->disconnect;

print "DB Closed\n";

open RESULTS, ">$filename";

print RESULTS "Results:\n";
print RESULTS "Policies Scanned: $policyCount\n";
foreach $word (sort {$dictionary{$b} <=> $dictionary{$a}} keys %dictionary){
	print RESULTS "$dictionary{$word}\t| \"$word\"\n";
}
close RESULTS;

print "File Written and Closed.\n";
print "All Done.\n";
