use strict;
use warnings;
use List::UtilsBy qw(max_by);
use List::MoreUtils qw(natatime);

my $MOST_COMMON_CHARACTER = "E";
my $LENGTH = $ENV{"LENGTH"};

my @frequencies_by_position;
while (<>) {
    chomp;
    tr/ //d;
    my @characters = split '';
    my $groups = natatime($LENGTH, @characters);
    while (my @group = $groups->())
    {
        while (my ($index, $char) = each @group) {
            $frequencies_by_position[$index]{$char}++;
        }
    }
}

while (my ($position, $frequencies) = each @frequencies_by_position) {
    my $most_frequent = max_by { %$frequencies{$_} } keys %$frequencies;

    print abs_chr((ord($most_frequent) - ord($MOST_COMMON_CHARACTER)) % 26)
}

print "\n";

sub abs_chr { return (chr($_[0] + ord("A"))) }
