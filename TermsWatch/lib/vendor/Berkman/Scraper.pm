package Scraper;


# Define the flags used in the Version table
use constant VF_DELETED => 1;
use constant VF_FIRST => 2;
use constant VF_PSEUDO_FIRST => 4;
use constant VF_WAYBACK => 8;

$VERSION = "0.10";
sub Version{ $VERSION;}

use strict;
use warnings;
use Switch;
use HTML::TreeBuilder::XPath;
use HTML::Parse;
use HTML::FormatText;
use Error;

#Constructor
sub new{
	my $class = shift;
	my $self = {
		debug_element_to_file => 0,
		result => ''
	};

	bless $self, $class;
	return $self;
}

# Returns the nodes from document that are associated with the Xpath queies of @elementStrings 
sub getElements(@){
	my $self = shift;
	my @elementStrings = $_[0];

	my $tree = HTML::TreeBuilder::XPath->new;

	$tree->p_strict(1);
	$tree->parse_content($self->{document});
	
	if ($self->{'debug_element_to_file'}){
		print "Debugging Element Scraping.\n";
		open DEBUG, '>element_debug.txt';
		binmode(DEBUG, ':utf8');
		print DEBUG "Provided String-------------------------------\n";
		print DEBUG $self->{document} . "\n";
		print DEBUG "\n";
		print DEBUG "Tree Dump-------------------------------------\n";
		$tree->dump(*DEBUG);
		print DEBUG "\n\n";
		print DEBUG "Elements Searched For-------------------------\n";
		foreach(@elementStrings){
			print DEBUG "\t$_\n";
		}
		close DEBUG;
	}

	my @nodes, my @buffer;

	foreach (@elementStrings){
		$_ =~ s/\\"/"/g;
		@buffer = $tree->findnodes("$_");
		throw Error::Simple "Element Scraper: No Nodes found for $_" unless @buffer > 0;
		push(@nodes, $buffer[0]);
	}

	return @nodes;
}


sub document{
	my $self = shift;

	if (defined $_[0]){
		$self->{document} = $_[0];
	}
	return $self->{document};
}

sub scrape($$){
	my $self = shift;
	my ($method, $data) = @_;

	throw Error::Simple "Scraper: scrape can not be called before document has been set." if (!defined $self->{document});

	switch($method){
		case 0 {
			my ($regex, $options) = ($data =~ /{(.*?)}(.*)/);
			$regex =~ s"/"\\/"g;

			my @captures =  $self->{document} =~ m/$regex/si;
			throw Error::Simple "Regex Scraper: $regex did not match.\n" unless @captures > 0;
			foreach (@captures){
				$self->{scraping} .= $_;
			}
		}
		case 1 {
			my @elementStrings = split(/,/, $data);
			my @nodes = $self->getElements(@elementStrings);
			foreach (@nodes){
				$self->{scraping} .= $_->as_HTML;
			}
		}
		case 2 {
			my $fn = "/home/bill/Development/workspace/TermsWatch/tmp/";
			#my $fn = "";
			$fn .= time;
			open FILE, ">$fn" or die "Could not open file: $!.\n";
			binmode(FILE, ":utf8");
			print FILE $self->{document};
			close FILE;
			$self->{scraping} = `../lib/vendor/Berkman/BodyTextExtractor.py $fn`;
			$self->{scraping} =~ s/<\\p>|<\\div>/\n/ig;
			$self->{scraping} =~ s/<p>|<div>//ig;
			unlink($fn);
		}
	}
}

sub result{
	my $self = shift;

	return $self->{scraping};
}

sub clearDocumentAndResult(){
	my $self = shift;
	
	$self->{document} = '';
	$self->{scraping} = '';
}

sub remove_html_tags($){
	my $self = shift;
	my $text = $_[0];
	return "" if not defined $text;

	$text =~ s/<script(.*?)<\/script>//si;
	return HTML::FormatText->new->format(parse_html($text));
}

sub remove_bad_styling($){
	my $self = shift;
	my $content = $_[0];
	$content =~ s/(<.*?style.*?)position:\s*absolute.*?;(.*?>)/$1$2/ig;
	return $content;
}

sub debug_element_to_file{
	my $self = shift;
	$self->{'debug_element_to_file'} = ((defined $_[0]) ? $_[0] : 1);
}

1;
__END__

=head1 NAME

Scraper

=head1 SYNOPSIS

use Scraper;
use Error qw(:try);

my $scraper = new Scraper;
try{
	$scraper->document($html);
        $scraper->scrape($scrapeMethod, $scrapeData);
	my $content = $scraper->result;
        print $content;
} catch Error with {
        my $ex = shift;
        print $ex;
};

=head1 DESCRIPTION

Provides a means for extracting portions of a web page. Scraper includes several ways to extract information from a web page as well
as a few helper functions for cleaning and removing portions of the extracted page.

=head1 METHODS

=over 4

=item new

Creates a new Scraper and returns it.

=item document
=item document($string)

Provides access to the document that the Scraper is working on. If called with an argument then the document that the Scraper is working
with will be set to the provided argument. In all cases document returns the value of the document that Scraper is working on.

=item scrape($scrapeMethod, $scrapeData)

Performs scraping on the previously set document. Scrape provides multiple ways to perform scraping and will use the method that is
specified by $scrapeMethod. If the specified method requires additional data, such as specific options or queries, they are to be
included in $scrapeData.

The available methods for scraping are:

=over 4

=item 0 - Regular Expression

$scrapeData will be used as a regular expression that will be execute on the document.

=item 1 - DOM Element Retrieval

$scrapeData will be used as an array of XPath queries that will be searched for. 

=item 2 - Body Text Extractor

$scrapeData is not used for this method. This method attempts to identify the main portion of a web page by finding the area of the page
with the highest instance of text nodes. This method is based on the BTE method found at http://www.aidanf.net/software/bte-body-text-extraction
and currently runs a modified version of the Python script.

=back

Exceptions: This method throws Error::Simple if it is called before the Scraper's document has been set. It will also throw exceptions related
to any errors that may occur during scraping.

Once complete the string that is the result of scraping will be available via the result method.

=item result

Provides access to the string that is the result of scraping the document.
If this method is called before scrape then a blank string will be returned.

=item clearDocumentAndResult

Clears the values of document and result; calling either of these methods after a call to clearDocumentAndResult will return a blank string.

=item remove_html_tags($string)

Returns the contents of $string with html tags, including the contents of script tags, removed.

=item remove_bad_styling($string)

Returns the contents of $string with certain types of CSS styling removed. Currently the method removes styling that results in absolute
positioning.

=item debug_element_to_file
=item debug_element_to_file(0|1)

When enabled the DOM Element Retrieval method of scraping will create a file named element_debug.txt, which will contain a print out of
the document, a dump of the parse tree created, and a print out of all the XPath strings that are to be searched for.

Enabled with called with no argument, or with an argument of 1. Disabled when called with an argument of 0.

=back

=head1 HISTORY

 v0.01:	Initial Version
	Able to scrape some sites via DOM Element
 v0.02:	Converted to Class
 v0.03:	Added ability to scrape by regular expression
	Improved DOM Element Scraping
 v0.04:	Added remove_bad_styling method
 v0.05:	Exceptions now thrown where appropriate 
 v0.06:	Added debug_element_to_file method
 v0.10: Moved web page retrieval to TermswatchLWP
	$url and $spoof arguments removed from scrape method
	Added document and result methods
	strip_all_tags renamed remove_html_tags
	Added remove_bad_styling method
 v0.11: Added BTE scraping

=head1 AUTHOR

Bill Bushey - wbushey@acm.org

=cut
