package TosDetector::Structure;

use constant BAYES_FILE => 'structure_state.dat';
use constant DB_DB => 'termswatch';
use constant DB_USERNAME => 'termswatch';
use constant DB_PASSWORD => 'termswatch';

use strict;
use warnings;
use Algorithm::NaiveBayes;
use Scraper;

# Constructor
sub new(){
	my $class = shift;
	
	my $self = {
		bayes => Algorithm::NaiveBayes->new,
		scraper => new Scraper
	};

	if (-e BAYES_FILE){
		$self->{bayes} = Algorithm::NaiveBayes->restore_state(BAYES_FILE);
	}

	bless $self, $class;
	return $self;
}

sub getCounts($){
	my $self = shift;

	my $content = $_[0];
	my %counts;
	while ($content =~ /\b(\w+)\b/g){
		$counts{lc($1)}++;
	}
	return %counts;
}

sub learnFromDB(){
	my $self = shift;

	use DBI;
	my $dbh = DBI->connect("dbi:mysql:" . DB_DB, DB_USERNAME, DB_PASSWORD)
		or die ('Could not connect to database.');

	# Add instances of TOS and NONTOS
	my $sth = $dbh->prepare('select scrapeMethod, scrapeData, url, spoof from policy');
	$sth->execute or die ("Could not execute statement.\n");
	while (my $row_ref = $sth->fetchrow_arrayref){
		print "Getting " . $$row_ref[2] . "\n";
		my ($tos, $nontos) = $self->{scraper}->getTOSandNONTOS($$row_ref[0], $$row_ref[1], $$row_ref[2], $$row_ref[3]);
		my %tos_counts = $self->getCounts($tos);
		my %nontos_counts = $self->getCounts($nontos);
		$self->{bayes}->add_instance(attributes => \%tos_counts, label => "tos");
		print "Added TOS\n";
		$self->{bayes}->add_instance(attributes => \%nontos_counts, label => 'nontos');
		print "Added NONTOS\n";
	}
	$sth->finish;

	$dbh->disconnect;

	# Learn that Bayes a thing or two
	$self->{bayes}->train;
	$self->{bayes}->save_state(BAYES_FILE);
}

# Takes a reference 
sub analyse($){
	my $self = shift;

	my %counts = $self->getCounts($_[0]);
	return $self->{bayes}->predict(attributes => \%counts);
}

sub train(){
	my $self = shift;
	$self->{bayes}->train;
}
1;
__END__
