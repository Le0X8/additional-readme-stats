<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$client_id = $SPOTIFY_ID;
$client_secret = $SPOTIFY_SECRET;

if ($SPOTIFY_FORCE_CUSTOM) {
    $client_id = isset($_REQUEST['client_id']) ? $_REQUEST['client_id'] : '';
    $client_secret = isset($_REQUEST['client_secret']) ? $_REQUEST['client_secret'] : '';
};

$session = new SpotifyWebAPI\Session(
    $client_id,
    $client_secret,
    $ROOT_URL . '/spotify/callback'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

$api->setAccessToken($session->getAccessToken());

var_dump($api->getArtist('2wX6xSig4Rig5kZU6ePlWe'));
