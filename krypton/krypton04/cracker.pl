use strict;
use warnings;
use List::UtilsBy qw(max_by);
use List::MoreUtils qw(natatime);

my $MOST_COMMON_CHARACTER = "E";

my @frequencies_by_position;
while (<>) {
    chomp;
    tr/ //d;
    my @characters = split '';
    my $groups = natatime(6, @characters);
    while (my @group = $groups->())
    {
        while (my ($index, $char) = each @group) {
            $frequencies_by_position[$index]{$char}++;
        }
    }
}

while (my ($position, $frequencies) = each @frequencies_by_position) {
    my $most_frequent = max_by { %$frequencies{$_} } keys %$frequencies;

    my $key = abs_chr((abs_ord($most_frequent) - abs_ord($MOST_COMMON_CHARACTER)) % 26);

    print "$key";
}

print "\n";

sub abs_ord { return (ord($_[0]) - ord("A")) }
sub abs_chr { return (chr($_[0] + ord("A"))) }

