package TermswatchLWP;

use constant DEFAULT_AGENT_STRING => 'TermsWatch';

use strict;
use warnings;
use LWP;
use HTTP::Response;

use vars qw($VERSION);
$VERSION = "0.02";
sub Version{ $VERSION;}

sub new{
        my $class = shift;
        my $self = {
                www_client => new LWP::UserAgent,
		agent_string => DEFAULT_AGENT_STRING,
		debug_refresh => 0
        };

        bless $self, $class;
        return $self;
}

sub setAgentString{
	my $self = shift;
	my $agent_string = $_[0];

	$self->{agent_string} = ((defined $agent_string) ? $agent_string : DEFAULT_AGENT_STRING );
}

sub debug_refresh{
	my $self = shift;
	
	$self->{debug_refresh} = ((defined $_[0]) ? $_[0] : 1);
}

sub retrievePage($){
        my $self = shift;
        my $url = $_[0];
        $self->{www_client}->agent($self->{agent_string});

	# If the user did not provide an absolute URL then prepend http://
	$url =~ m/^(.*?:\/\/)?(.*)/;
	if ($1){
		$url = $1;
	} else {
		$url = "http://";
	}
	$url .= $2;

	# Get the page.
	# LWP does not appear to handle the 'refresh' response header in its request method
	# so the for loop/if statment takes care of it
        my $response;
	REDIRECT: for my $redirect (0..4){
		$response = $self->{www_client}->get($url);
		if ($response->header('refresh')) {
			($url) = $response->header('refresh') =~ /[^;]*;\s*URL=(.*)$/i;
			if ($self->{'debug_refresh'}){
				print "\n";
				print "Header Refresh<br/>\n";
				print "URL = $url<br/>\n";
				print "\n";
			}
		} else {
			# No redirect, w00t
			last REDIRECT;
		}
	}
        return $response;
}

1;
__END__

=head1 NAME

TermswatchLWP - LWP for TermsWatch

=head1 SYNOPSIS

use TermswatchLWP;

my $url = "http://cyber.law.harvard.edu";
my $tlwp = new TermswatchLWP;
my $response = $tlwp->retrievePage($url);
print $response->content;

=head1 DESCRIPTION

TermswatchLWP is a simple wrapper for Perl's LWP. An instance of TermswatchLWP contains an instance of LWP::UserAgent, along with the user
agent string (which defaults to DEFAULT_AGENT_STRING) that the LWP agent will use to retrieve pages.

=head1 METHODS

=over 4

=item new()

Creates a new instance of TermswatchLWP.

=item retrievePage($url)

Retrieves the web page found at $url. This method is an enhancement of LWP's get() method: in addition to performing an LWP get it will 
also handle 'refresh' response headers and will prepend http:// to $url if no protocal portion is included in $url. When finished the method
returns an HTTP::Response instance.

=item setAgentString
=item setAgentString($agent_string)

Sets the agent string that is used while retrieving a web page. If no $agent_string is provided then the agent string will be set to
TermswatchLWP's default agent string.

=item debug_refresh
=item debug_refresh(0|1)

Tells TermswatchLWP to enable/disable debugging of refresh headers. If debugging is enabled then TermswatchLWP will print out a message 
when a refresh header is encountered indicating where the refresh is sending TermswatchLWP to.

An argument of 0 disables debugging. An argument of 1 enables debugging, as does no argument.

=back

=head1 HISTORY

v0.01: Initial module.
v0.02: setAgentString and debug_refresh methods added.

=head1 AUTHOR

Bill Bushey - wbushey@acm.org

=head1 SEE ALSO

HTTP::Response 

=cut
