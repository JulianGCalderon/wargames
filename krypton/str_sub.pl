use strict;
use warnings;

open(my $file1, "<", $ARGV[0]);
open(my $file2, "<", $ARGV[1]);

while (1) {
    read($file1, my $char1, 1) or last;
    read($file2, my $char2, 1) or last;

    print abs_chr(((ord($char1) - ord($char2)) % 26))
}

sub abs_chr { return (chr($_[0] + ord("A"))) }
