<?php

function xor_encrypt($plain, $key)
{
    $cipher = '';

    for ($i = 0; $i < strlen($plain); $i++) {
        $cipher .= $plain[$i] ^ $key[$i % strlen($key)];
    }

    return $cipher;
}

$start = array("showpassword" => "yes", "bgcolor" => "#ffffff");
$key = "KNHL";

$json_start = json_encode($start);
$xor_json = xor_encrypt($json_start, $key);
$base64_xor = base64_encode($xor_json);

echo $base64_xor;
echo "\n";
