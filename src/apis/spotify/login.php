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

if ($req_url_split[2] == 'auth') include 'src/apis/spotify/auth.php';

if ($req_url_split[2] == 'callback' && isset($query['error'])) {
    die(str_replace('[[retryUrl]]', $session->getAuthorizeUrl($options), file_get_contents('src/apis/spotify/auth-error.html')));
};

if ($req_url_split[2] == 'callback' && isset($query['code'])) {
    $client_id = $req_url_split[3];
    $client_secret = $req_url_split[4];
    $session = new SpotifyWebAPI\Session(
        $client_id,
        $client_secret,
        $ROOT_URL . '/spotify/callback/' . $client_id . '/' . $client_secret
    );
    try {
        $session->requestAccessToken($query['code']);
        $api->setAccessToken($session->getAccessToken());
    } catch (SpotifyWebAPI\SpotifyWebAPIException $err) {
        die('Error: ' . $err->getMessage() . '<br><a href="' . $session->getAuthorizeUrl($options) . '">Retry?</a>');
    };

    $logged_in = true;
    $username = $api->me()->id;
    $REFRESH_TOKEN = $session->getRefreshToken();
    mysqli_query($db, 'INSERT INTO spotify (username, client_id, client_secret, refresh_token) VALUES ("' . $username . '", "' . $client_id . '", "' . $client_secret . '", "' . $REFRESH_TOKEN . '") ON DUPLICATE KEY UPDATE client_id = "' . $client_id . '", client_secret = "' . $client_secret . '", refresh_token = "' . $REFRESH_TOKEN . '"');

    die();
};

if ($REFRESH_TOKEN != null) {
    $logged_in = true;
    $session->setRefreshToken($REFRESH_TOKEN);
    $session->refreshAccessToken($REFRESH_TOKEN);
    $ACCESS_TOKEN = $session->getAccessToken();
    $api->setAccessToken($ACCESS_TOKEN);
    $session->setAccessToken($ACCESS_TOKEN);
};

if (!$logged_in) {
    header('Content-Type: image/svg+xml');
    die(file_get_contents('src/imgs/login.svg'));
};