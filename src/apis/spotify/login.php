<?php

$ACCESS_TOKEN = null;
$REFRESH_TOKEN = null;

$options = [
    'scope' => [
        'playlist-read-private',
        'user-read-private',
        'user-read-playback-state',
        'user-library-read',
        'user-follow-read',
        'user-top-read'
    ],
];

if ($req_url_split[2] == 'callback' && isset($query['error'])) die('Access denied. <a href="' . $session->getAuthorizeUrl($options) . '">Retry?</a>');

if ($req_url_split[2] == 'callback' && isset($query['code'])) {
    try {
        $session->requestAccessToken($query['code']);
        $api->setAccessToken($session->getAccessToken());
    } catch (SpotifyWebAPI\SpotifyWebAPIException $err) {
        die('Error: ' . $err->getMessage() . '<br><a href="' . $session->getAuthorizeUrl($options) . '">Retry?</a>');
    };

    // if not already in db, insert
    // if already in db, update
    $username = $api->me()->id;
    $REFRESH_TOKEN = $session->getRefreshToken();
    $ACCESS_TOKEN = $session->getAccessToken();
    $expiration_time = time() + $session->getTokenExpiration();
    mysqli_query($db, 'INSERT INTO spotify (username, refresh_token, access_token, expiration_time) VALUES ("' . $username . '", "' . $REFRESH_TOKEN . '", "' . $ACCESS_TOKEN . '", ' . $expiration_time . ') ON DUPLICATE KEY UPDATE refresh_token = "' . $REFRESH_TOKEN . '", access_token = "' . $ACCESS_TOKEN . '", expiration_time = ' . $expiration_time);
} else if ($ACCESS_TOKEN != null) {
    $session->setAccessToken($ACCESS_TOKEN);
    $session->setRefreshToken($REFRESH_TOKEN);
};

echo('<a href="' . $session->getAuthorizeUrl($options) . '">Authorize</a>');

try {
    $art = $api->getArtist('2wX6xSig4Rig5kZU6ePlWe');
    var_dump($art);
} catch (Error $err) {
    die('Unauthorized.');
};