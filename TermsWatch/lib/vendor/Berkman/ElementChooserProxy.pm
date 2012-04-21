package ElementChooserProxy;
use strict;
use warnings;

use TermswatchLWP;
use HTTP::Response;

use constant DEBUG_DUMP_SRC_REGEX => 0;		# Print out the capturing groups for the src/href rewrite regex

use constant HOST => "http://localhost/";		# URL to the root of the host of ElementChooserProxy
use constant ECP_DIR => "elementChooserProxy/";		# The directory that contains files needed by ElementChooserProxy, found at HOST
use constant JQUERY_URL => HOST . ECP_DIR . "jquery-1.3.2.min.js";		# URL to the jQuery library
use constant JQUERY_HIGHLIGHT_URL => HOST . ECP_DIR . "jquery.highlight.js";	# URL to the highlight plugin
use constant SELECTOR_JS_URL => HOST . ECP_DIR . "selector.js";			# URL to the selector javascript
use constant SELECTOR_CSS_URL => HOST . ECP_DIR . "selector.css";		# Path to the css used by the modified page
use constant SPOOF_LINK => "http://localhost/frontend_dev.php/addTerms/spoof";		# URL of the link that a user clicks to spoof the user agent
use constant SUBMIT_CONTAINER_PATH => "/home/bill/Development/workspace/TermsWatch/lib/vendor/Berkman/elementChooserProxy/submitContainer.html";	# Path to the html used to insert the submittion div

use vars qw($VERSION);
$VERSION = "0.05";
sub Version{ $VERSION;}

# Runs though the page and rewrites all resource paths (i.e. css, img, js, etc...) to be absolute paths
# 
# $base is the base url that will be used to rewrite paths. This should be the base url of the retrieved page.
sub rewritePaths($$){
	my $self = shift;
        my $base = $_[0];

        # Rewrite CSS @imports
	$self->{elementChoosingPage} =~ s/\x40import\s*(url)?\s*\(?\s*['"](.*?)['"]\)?/"\x40import \"" . URI->new_abs($2, $base) . "\""/ige;

        # Rewrite Everything Else
	$self->{elementChoosingPage} =~ s/<(.*?)(src|href)=(['"]?)([^'"\s]*)(['"]?)(.*?)>/"<$1$2=$3" . URI->new_abs($4,$base) . "$5$6>"/ige;
}

# Plug the javascript into the page
sub injectJS($){
	my $self = shift;

	my $jquery_url = JQUERY_URL;
	my $selector_js_url = SELECTOR_JS_URL;
	my $selector_css_url = SELECTOR_CSS_URL;
	my $jquery_highlight_url = JQUERY_HIGHLIGHT_URL;
	$self->{elementChoosingPage} =~ s"(.*?)<\/head>(.*)"$1<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" href=\"$selector_css_url\"><script type=\"text/javascript\" src=\"$jquery_url\"></script><script type=\"text/javascript\" src=\"$jquery_highlight_url\"></script><script type=\"text/javascript\" src=\"$selector_js_url\"></script></head>$2"i;
}

# Insert a DIV into the page that will allow the user to submit his/her selection
#
# The first argument is the url that the user will be taken to when he/she clicks "Submit"
# The second argument is the values of the 'terms_url' field found in the injected DIV.
sub injectDiv($$){
	my $self = shift;
	my ($submit_to, $terms_url) = @_;
	my $container;

	open HTML, '<' . SUBMIT_CONTAINER_PATH
		or die "Could not open " . SUBMIT_CONTAINER_PATH;
	while (<HTML>){
		$container .= $_;
	}
	close HTML;

	$container =~ s/\[PATH_TO_SUBMIT_TO\]/$submit_to/;
	$container =~ s/\[TERMS_URL\]/$terms_url/;
	$container =~ s/\[SPOOF_LINK\]/+SPOOF_LINK/e;

	if (!($self->{elementChoosingPage} =~ s/(.*?)<\/body>(.*)/$1$container<\/body>$2/i)){
		$self->{elementChoosingPage} .= $container;
	}
}

sub new{
	my $class = shift;
	my $self = {
		tlwp => new TermswatchLWP,
	};

	bless $self, $class;
	return $self;
}

sub elementChoosingPage(){
	my $self = shift;

	return $self->{elementChoosingPage};
}

sub headers(){
	my $self = shift;
	
	return $self->{headers};
}

sub process($$){
	my $self = shift;
	my ($terms_url, $submit_to) = ($_[0], $_[1]);
	my $user_agent = $_[2];

	# Retrieve the page
	if ($user_agent){
		$self->{tlwp}->setAgentString($user_agent);
	}
	my $response = $self->{tlwp}->retrievePage($terms_url);
	$self->{elementChoosingPage} = $response->decoded_content || $response->content;
	$self->{headers} = $response->headers;
	$terms_url = $response->request->uri;

	# Modify the page
	$self->rewritePaths($terms_url);
	$self->injectJS();
	$self->injectDiv($submit_to, $terms_url);
}

1;
__END__

=head1 NAME

ElementChooserProxy

=head1 SYNOPSIS

my $ecp = new ElementChooserProxy;
$ecp->process($retrieve_url, $submit_to_url, $agent_string);
my $page = $ecp->elementChoosingPage;
my $headers = $ecp->headers;
print $headers->as_string;
print $page;

=head1 DESCRIPTION

The module provides a function, getElementChoosingPage, for retrieving a web page and modifying it so that a user can select
specific DOM elements on the page.

=head1 FUNCTIONS

=over 4

=item process($retrieve_url, $submit_to_url)
=item process($retrieve_url, $submit_to_url, $agent_string)

Retrieves the web page found at $retrieve_url and injects Javascript, CSS, and HTML that allows the user to select DOM elements.
The $submit_to_url will become the action portion of the form that is found in the injected DIV.
If provided, $agent_string will be used as the USER_AGENT header during page retrieval.

Once finished, the resulting page will be accessable via the elementChoosingPage method, and the retrieved headers will be available
via the headers method.

=item elementChoosingPage

Gets the page the results from calling process.

=item headers

Gets the headers that were received during the execution of process.

=back

=head1 HISTORY

v0.01 	Initial Version
v0.02 	Moved web page retrieval to TermswatchLWP
v0.05 	Converted to class
	Added elementChoosingPage and headers methods
	Renamed getElementChoosingPage to process

=head1 AUTHOR

Bill Bushey - wbushey@acm.org

=cut
