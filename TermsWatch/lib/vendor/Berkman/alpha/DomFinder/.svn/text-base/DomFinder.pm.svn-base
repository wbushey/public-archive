package DomFinder;

use constant DEBUG_BS => 1;	# Print Debug messages in the binary search
use constant DEBUG_FIC => 0;	# Print Debug message in the findInChild method

use strict;
use vars qw(@ISA @EXPORT $VERSION);

require 5.004;
require Exporter;
@ISA = qw(Exporter);

@EXPORT = qw(findContainingElements);

$VERSION = "0.10";
sub Version { $VERSION; }

# Takes a string representation of an HTML page and a string of text to search for
# and returns the DOM elements that contain the text.
#
# param 1: String representation of HTML page
# param 2: String of text to search for
# return: Array of DOM elements. If next is not found than an empty array.
sub findContainingElements($$){
	use integer;
	use HTML::TreeBuilder;
	
	shift @_;						# Don't care about the callee reference
	my($page_str, $search_text) = @_;			# Getting arguments that I do care about

  	my $tree = HTML::TreeBuilder->new;
	my $pg_start = 0;					# Represents the start position in page_str, this will advance over time
	my $st_start = 0;					# Represents the start position in search_text, this will advance over time
	my $st_end = length($search_text);			# End of $search_text
	my $min;						# Left end of the range to search in
	my $max;						# Right end of the range to search in
	my $X;							# Length of substring
	my $nodeHolder;						# Temporary holder for a node that contains text of interest
	my @containingElements;					# Array of containing elements
	

	# Build the tree
	$tree->parse_content($page_str);
	
	while($st_start < $st_end ){
		# Find the longest substring at the beginning of $search_text that can be found in the tree
		#
		# This is done by doing a binary search for a value X, where X is the length
		# of the longest substring of $search_text that can be found in the HTML
		$min = 0;
		$max = $st_end - $st_start;
		$nodeHolder = undef;
		$X = 1;
		while ($min <= $max && $nodeHolder == undef && ($X != 0)){			
			$X = ($min + $max) / 2;

			#DEBUG
			if (DEBUG_BS){
				print "st_start:\t" . $st_start . "\n";
				print "st_end:\t" . $st_end . "\n";
				print "X:\t\t" . $X . "\n";
				print "min:\t " . $min . "\n";
				print "max:\t  " . $max . "\n";
				print "substr:\t " . substr($search_text, $st_start, $st_start + $X) . "\n";
			}

			# Treat a negative result from index to mean the real value of X is less than
			# the current value of X
			if (findInChild(substr($search_text, $st_start, $st_start + $X), $tree) == undef){
				$max = $X;
			} else {
				$min = $X+1;
			}
		} continue {
			$nodeHolder = isLongestString($search_text, $st_start, $st_end, $X, $tree);
		}

		if ($nodeHoler == undef){
			# We are looking for a string that doesn't exist, so give up and move on.
			$st_start += 1;
		} else {
			# Now find the element that contains the longest string
			print "Final: \t" . substr($search_text, $st_start, $st_start + $X) . "\n";
		
			push @containingElements, $nodeHolder;
		
			$pg_start = index($page_str, 
						substr($search_text, $st_start, $st_start + $X),
						$pg_start);
			$st_start += $X;
		}
	}
	
	return @containingElements;
}

sub findInChild{
	my ($text, $node) = @_;
	my @children = $node->content_list;
	my $favorite_child;

	for (@children){
		if (ref($_)){
			$favorite_child = findInChild($text, $_);
			if ($favorite_child){
				return $favorite_child;
			}
		}
	}

	if (DEBUG_FIC){
		print "Node Text:\t " . $node->as_text . "\n";
		print "Search Text:\t " . $text . "\n";
	}

	return $node if ((index $node->as_text, $text) != -1);

	return undef;
}

# Indicates if $X is is the longest string between $st_start and $st_end that can be found in the tree
# If $X is the longest then the node containing the string is returned.
# Otherwise undef is returned.
sub isLongestString{
	my($search_text, $st_start, $st_end, $X, $tree) = @_;
	my $node_holder;
	if($node_holder = findInChild(substr($search_text, $st_start, $st_start + $X), $tree)){
		if ($X == $st_end || (findInChild(substr($search_text, $st_start, $st_start + $X + 1), $tree) == undef)){
			return ($node_holder);
		} else {
			return (undef);
		}
	} else {
		return (undef);
	}
}

1;
__END__
