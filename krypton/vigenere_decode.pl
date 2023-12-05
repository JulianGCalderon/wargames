use strict;
use warnings;
use List::MoreUtils qw(natatime);

my @KEY = split(//, $ENV{"KEY"});

while (<>) {
    chomp;
    tr/ //d;
    my @characters = split '';
    my $groups = natatime($#KEY+1, @characters);
    while (my @group = $groups->())
    {
        while (my ($index, $char) = each @group) {
            print decode($char, $index);
        }
    }
    print "\n";
}

sub decode {
    return abs_chr((ord($_[0]) - ord($KEY[$_[1]])) % 26)
}

sub abs_chr { return (chr($_[0] + ord("A"))) }

