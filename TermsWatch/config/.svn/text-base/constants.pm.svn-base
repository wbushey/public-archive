package BTW_Constants;

use strict;
use warnings;
use constant CONSTANTS_FILE => '/home/bill/Development/workspace/TermsWatch/config/constants.txt';
my %constants;

open CONTS, '<' . CONSTANTS_FILE or die "Could open file: $!\n";
while (<CONTS>){
	$_ =~ s/#.*//;		# Ignore comments
	$_ =~ m/([^=\s]*)\s*=\s*(.*?)\s*$/;
	if (defined $1 && defined $2){
		$2 =~ s/\$([^\s])/$BTW_Constants::constants{$1}/ge;	# Replace referenced constants with their values
		$2 =~ s/(.*?)\s*\.\s*(.*?)/$1 . $2/ge;			# Do string concatination
		$BTW_Constants::constants{$1} = $2;
	}
}

sub get($){
	return $BTW_Constants::constants{$_[0]};
}
