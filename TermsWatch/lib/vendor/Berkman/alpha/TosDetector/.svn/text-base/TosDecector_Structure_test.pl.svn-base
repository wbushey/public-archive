#!/usr/bin/perl

use strict;
use warnings;
use TosDetector::Structure;

my $td = new TosDetector::Structure;
#$td->learnFromDB;
$td->train;

my $fb_tos = '';
open FILE, '<fb_tos.html';
while(<FILE>){
	$fb_tos .= $_;
}
close FILE;

my $fb = '';
open FILE, '<fb.html';
while(<FILE>){
	$fb .= $_;
}
close FILE;

my $fb_tos_results = $td->analyse($fb_tos);
print "TOS done\n";
my $fb_results = $td->analyse($fb);
print "FB done\n";

print "FB TOS results:\n";
for my $key(keys(%$fb_tos_results)){
	print $key . ": " . $$fb_tos_results{$key} . "\n";
}

print "FB results:\n";
for my $key(keys(%$fb_results)){
	print $key . ": " . $$fb_results{$key} . "\n";
}
