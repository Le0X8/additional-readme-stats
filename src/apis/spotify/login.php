<?php

$options = [
    'scope' => [
        'playlist-read-private',
        'user-read-private',
        'user-read-playback-state',
        'user-library-read',
        'user-follow-read',
        'user-top-read',
        'user-read-recently-played'
    ],
];



if ($req_url_split[2] == 'fastauth') include 'src/apis/spotify/fastauth.php';

if ($req_url_split[2] == 'callback' && isset($query['error']) && $_COOKIE['fastauth'] == 'true') {
    setcookie('fastauth', 'false', array(
        'path' => '/spotify',
        'expires' => 0
    ));
    die(file_get_contents('src/apis/spotify/fa-error.html'));
};

if ($req_url_split[2] == 'callback' && isset($query['code']) && $_COOKIE['fastauth'] == 'true') {
    setcookie('fastauth', 'false', array(
        'path' => '/spotify',
        'expires' => 0
    ));

    try {
        $session->requestAccessToken($query['code']);
        $api->setAccessToken($session->getAccessToken());
    } catch (SpotifyWebAPI\SpotifyWebAPIException $err) {
        die('Error: ' . $err->getMessage() . '<br><a href="' . $session->getAuthorizeUrl($options) . '">Retry?</a>');
    };

    $logged_in = true;
    $username = $api->me()->id;
    $REFRESH_TOKEN = $session->getRefreshToken();
    $ACCESS_TOKEN = $session->getAccessToken();
    $expiration_time = $session->getTokenExpiration();
    mysqli_query($db, 'INSERT INTO spotify (username, refresh_token, access_token, expiration_time) VALUES ("' . $username . '", "' . $REFRESH_TOKEN . '", "' . $ACCESS_TOKEN . '", ' . $expiration_time . ') ON DUPLICATE KEY UPDATE refresh_token = "' . $REFRESH_TOKEN . '", access_token = "' . $ACCESS_TOKEN . '", expiration_time = ' . $expiration_time);

    die(file_get_contents('src/apis/spotify/fa-success.html'));
};

if ($req_url_split[2] == 'callback' && isset($query['error'])) die('Access denied. <a href="' . $session->getAuthorizeUrl($options) . '">Retry?</a>');

if ($req_url_split[2] == 'callback' && isset($query['code'])) {
    try {
        $session->requestAccessToken($query['code']);
        $api->setAccessToken($session->getAccessToken());
    } catch (SpotifyWebAPI\SpotifyWebAPIException $err) {
        die('Error: ' . $err->getMessage() . '<br><a href="' . $session->getAuthorizeUrl($options) . '">Retry?</a>');
    };

    $logged_in = true;
    $username = $api->me()->id;
    $REFRESH_TOKEN = $session->getRefreshToken();
    $ACCESS_TOKEN = $session->getAccessToken();
    $expiration_time = $session->getTokenExpiration();
    mysqli_query($db, 'INSERT INTO spotify (username, refresh_token, access_token, expiration_time) VALUES ("' . $username . '", "' . $REFRESH_TOKEN . '", "' . $ACCESS_TOKEN . '", ' . $expiration_time . ') ON DUPLICATE KEY UPDATE refresh_token = "' . $REFRESH_TOKEN . '", access_token = "' . $ACCESS_TOKEN . '", expiration_time = ' . $expiration_time);
} else if ($ACCESS_TOKEN != null) {
    $logged_in = true;
    $api->setAccessToken($ACCESS_TOKEN);
    $session->setAccessToken($ACCESS_TOKEN);
    $session->setRefreshToken($REFRESH_TOKEN);
};

if (!$logged_in && !$cached) {
    header('Content-Type: image/svg+xml');
    die(file_get_contents('src/imgs/login.svg'));
};