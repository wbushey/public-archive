#!/usr/bin/perl
use lib '/home/bill/Development/workspace/TermsWatch/lib/vendor/Berkman';
use Scraper;
use TermswatchLWP;
use Error qw(:try);

my ($url, $spoof, $method, $data) = @ARGV;
my $tlwp = new TermswatchLWP;
my $scraper = new Scraper;

try{
	if ($spoof){
		$tlwp->setAgentString($spoof);
	}
	my $response = $tlwp->retrievePage($url);
	$scraper->document($response->decoded_content || $response->content);

	$scraper->scrape($method, $data);
	my $scrap = $scraper->result;
	$scrap = $scraper->remove_bad_styling($scrap);
	print $scrap;
	print "\n\n";
} catch Error with {
	my $ex = shift;
	print "Error Scraping $url\n\t";
	print $ex;
};


