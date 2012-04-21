#! /usr/bin/perl

use DomFinder::DomFinder;

my $page_str = '';
my @nodes;
open HTML, '<test.html';

while (<HTML>){
	$page_str .= $_;
}
close HTML;

$search_text = "Little holder is in here somewhere.";

@nodes = DomFinder->findContainingElements($page_str, $search_text);

foreach (@nodes){
	print "Node:\n";
	print $_->as_text;
	print "\n";
}
