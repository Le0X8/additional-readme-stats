<?php

function decrypt_rsa($b64cipher, $private_key) : string {
    $key = openssl_pkey_get_private($private_key);
    $cipher = base64_decode(str_replace(['-', '_'], ['+', '/'], $b64cipher));
    openssl_private_decrypt($cipher, $decrypted, $key);
    if ($decrypted == null) die('Decryption failed.');
    return $decrypted;
};

function get_private_key($db) : string {
    $result = mysqli_query($db, 'SELECT * FROM config WHERE `key`=\'private_key\'');
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };
    return $result_arr[0]['value'];
};