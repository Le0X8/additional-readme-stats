<?php

if ($req_url_split[2] == 'callback' && isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());
} else if ($ACCESS_TOKEN != null) {
    $session->setAccessToken($ACCESS_TOKEN);
    $session->setRefreshToken($REFRESH_TOKEN);
};

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

echo('<a href="' . $session->getAuthorizeUrl($options) . '">Authorize</a>');

try {
    $art = $api->getArtist('2wX6xSig4Rig5kZU6ePlWe');
} catch (Error $err) {
    print_r($err->getMessage());
};