#!/usr/bin/perl

=head 1
 A simple CGI driver for the ElementChooserProxy. The script takes the desired URL and whether or not to spoof
 the request and passes this information on to an instance of ElementChooserProxy. 
=cut

use constant SUBMIT_TO => "http://localhost/frontend_dev.php/addTerms/confirm";

use strict;
use warnings;
use lib "../lib/vendor/Berkman";

my $submit_to = "http://localhost/frontend_dev.php/addTerms/confirm";

use CGI '-debug';
use ElementChooserProxy;

my $q = CGI->new;
my $terms_url = $q->param('terms_url');
my $user_agent = (($q->param('s')) ? $ENV{'HTTP_USER_AGENT'} : undef);
my $ecp = new ElementChooserProxy;
$ecp->process($terms_url, SUBMIT_TO, $user_agent);
my $page = $ecp->elementChoosingPage;

print $q->header;
print $page;
