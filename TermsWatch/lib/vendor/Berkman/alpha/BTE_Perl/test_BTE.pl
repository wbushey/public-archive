#! /usr/bin/perl

use BTE;

my $page_str = '';
open HTML, '<terms.php.html';

while (<HTML>){
        $page_str .= $_;
}
close HTML;

my $parser = BTE->new;
$parser->parse(\$page_str);
print "Body Text" . $parser->body_text() . "\n";
