<?php
header('Content-Type: text/plain; charset=utf-8');
header('Access-Control-Allow-Origin: *');

if (!mysqli_num_rows(mysqli_query($db, 'SELECT * FROM config WHERE `key`=\'public_key\''))) {
    $private_key = openssl_pkey_new(array(
        'private_key_bits' => 2048,
    ));
    $public_key_pem = openssl_pkey_get_details($private_key)['key'];
    $private_key = openssl_pkey_get_private($private_key);

    openssl_pkey_export($private_key, $private_key_pem);
    
    $private_key_pem = $private_key_pem;

    mysqli_query($db, 'INSERT INTO config VALUES (\'private_key\', \'' . mysqli_escape_string($db, $private_key_pem) . '\')');
    mysqli_query($db, 'INSERT INTO config VALUES (\'public_key\', \'' . mysqli_escape_string($db, $public_key_pem) . '\')');
};

$result = mysqli_query($db, 'SELECT * FROM config WHERE `key`=\'public_key\'');
$result_arr = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($result_arr, $row);
};
$public_key = $result_arr[0]['value'];
echo($public_key);