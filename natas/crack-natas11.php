<?php

function xor_encrypt($plain, $key)
{
    $cipher = '';

    for ($i = 0; $i < strlen($plain); $i++) {
        $cipher .= $plain[$i] ^ $key[$i % strlen($key)];
    }

    return $cipher;
}

$start = array("showpassword" => "no", "bgcolor" => "#ffffff");
$end = "MGw7JCQ5OC04PT8jOSpqdmkgJ25nbCorKCEkIzlscm5oKC4qLSgubjY%3D";

$json_start = json_encode($start);
$xord_end = base64_decode($end);

$key = xor_encrypt($json_start, $xord_end);

echo $key;
echo "\n";
