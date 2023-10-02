<?php

mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotify (
    username VARCHAR(255) PRIMARY KEY,
    refresh_token VARCHAR(255),
    access_token VARCHAR(255),
    expiration_time INT UNSIGNED
)');

$client_id = $SPOTIFY_ID;
$client_secret = $SPOTIFY_SECRET;

if ($SPOTIFY_FORCE_CUSTOM || isset($query['client_id']) || isset($query['client_secret'])) {
    $client_id = isset($query['client_id']) ? $query['client_id'] : '';
    $client_secret = '';
    if (isset($query['client_secret'])) {
        include 'src/decrypt.php';
        $private_key = get_private_key($db);
        $client_secret = decrypt_rsa($query['client_secret'], $private_key);
    };
};

$session = new SpotifyWebAPI\Session(
    $client_id,
    $client_secret,
    $ROOT_URL . '/spotify/callback'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

include 'src/apis/spotify/login.php';

