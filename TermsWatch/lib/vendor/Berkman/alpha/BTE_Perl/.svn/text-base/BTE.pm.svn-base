package BTE;

use strict;
use warnings;
use HTML::TokeParser;

use vars qw($VERSION);
$VERSION = "0.10";
sub Version { $VERSION; }

#Constructor
sub new{
	my $class = shift;
	my $self = {
		tokens => [],		# All tokens
		binary_tokens => [],	# Binary values for each token
		encoded => [0],		# Number of consecutive Text or Non-Text tags
		total_tokens_before => [0],
		lookup0N => [0],
		lookupN0 => [0],
		body_txt => ""		# Text of the body
	};

	bless $self, $class;
	return $self;
}

## Calls TokeParser::parse to do the parsing magic, then does the work
## of assigning a binary weight to each token and initalizing the encoded array
sub parse{
	my $self = shift;
	my $page_str = $_[0];
	my $tp = HTML::TokeParser->new($page_str);

	## Put in weights and encodings
	my $w, my $i = 0;
	push(@{$self->{total_tokens_before}}, 0);
	my $text_tokens = 0;
	while (my $token = $tp->get_token){
		push(@{$self->{tokens}}, $token);
		if ($token->[0] eq "T"){
			$w = -1;
			$text_tokens++;
		} else {
			$w = 1;
		}
		push(@{$self->{binary_tokens}}, $w);

		## Encoding from _encode_binary_tokens
		if (abs($w + $self->{encoded}[$i]) < abs($self->{encoded}[$i])){
			push(@{$self->{encoded}}, 0);
			push(@{$self->{total_tokens_before}}, $self->{total_tokens_before}[$i + 1]);
			$i++;
		}
		$self->{encoded}[$i] = $self->{encoded}[$i] + $w;
		$self->{total_tokens_before}[$i + 1] = $self->{total_tokens_before}[$i + 1] + 1;
	}
	print "Total Text Tokens: $text_tokens\n";
=head
	print "Total_tokens_before:\n";
	for(my $i = 0; $i < @{$self->{total_tokens_before}}; $i++){
		print "$i:\t" . $self->{total_tokens_before}[$i] . "\n";
	}
=cut
	$self->__initialise_lookups;

}


## Creates the lookup arrays that are used later during scoring
sub __initialise_lookups{
	my $self = shift;
	my $t = 0;

	foreach (@{$self->{encoded}}){
		if ($_ > 0){
			$t += $_;
		}
		push(@{$self->{lookup0N}}, $t);
	}

	my @reversed = reverse(@{$self->{encoded}});
	$t = 0;
	foreach(@reversed){
		if($_ > 0){
			$t += $_;
		}
		push(@{$self->{lookupN0}}, $t);
	}
	@{$self->{lookupN0}} = reverse(@{$self->{lookupN0}});
	
	shift(@{$self->{lookupN0}});
	pop(@{$self->{lookup0N}});

	# DEBUGGING
	open LOOKUP, ">lookup0N.txt";
	foreach(@{$self->{lookup0N}}){
		print LOOKUP "lookup0N t: $_\n";
	}
	close LOOKUP;

	open LOOKUP, ">lookupN0.txt";
	foreach (@{$self->{lookupN0}}){
		print LOOKUP "lookupN0 t:  $_\n";
	}
	close LOOKUP;
}

## Produces a score for the tokens between token # $i and token # $j
## A higher score indicates a stronger likelyhood that the body of the page
## is between $i and $j
sub __objective_fcn{
	my $self = shift;
	my ($i, $j) = @_;
	my $tags_to_i = $self->{lookup0N}[$i];
	my $tags_after_j = $self->{lookupN0}[$j];
	
#	print "Total tokens before j: " . $self->{total_tokens_before}[$j] . "\n";
#	print "Tags before j: " . $self->{lookup0N}[$j] . "\n";
	my $text_to_i = $self->{total_tokens_before}[$i] - $tags_to_i;
	my $text_to_j = $self->{total_tokens_before}[$j] - $self->{lookup0N}[$j];

#	print "Tags to i: $tags_to_i\nTags after j: $tags_after_j\nText to i: $text_to_i\nText to j: $text_to_j\n\n";
	my $text_between_i_j = $text_to_j - $text_to_i;
	my $return_val = $tags_to_i + $tags_after_j + $text_between_i_j;
	return $return_val;
}

## Returns the text of the body
sub body_text{
	my $self = shift;
	my $obj_max = 0;	# The maximum score any region has received
	my $i_max = 0;		# Beginning of the region receiving the max score
	my $j_max = @{$self->{encoded}} -1;		# End of the region receiving the max score	

	my $obj;
	my $len = @{$self->{encoded}};
	my $i, my $j;
	print "Length of encoded: $len \n";
	for ($i = 0; $i < ($len -1); ++$i){
		if ($self->{encoded}[$i] > 0){
			next;
		}
		for($j = $i; $j < $len; ++$j){
			if ($self->{encoded}[$j] > 0){
				next;
			}
			$obj = $self->__objective_fcn($i, $j);
			print "obj for $i, $j: $obj\n";
			if ($obj > $obj_max){
				$obj_max = $obj;
				$i_max = $i;
				$j_max = $j;
			}	
		}
	}

	print "Max found: $obj_max at i:$i_max j:$j_max\n";

	my $start = 0;
	my $end = 0;
	$start = $self->{total_tokens_before}[$i_max];
	$end = $self->{total_tokens_before}[$j_max];
	print "Start: $start, End: $end\n";
	for ($start .. $end){
		if (@{@{$self->{tokens}}[$_]}[0] eq "T"){
			$self->{body_txt} .= @{@{$self->{tokens}}[$_]}[1] . " ";
		}
	}

	return $self->{body_txt};
}

1;
__END__
