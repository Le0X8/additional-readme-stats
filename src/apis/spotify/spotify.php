<?php

mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotify (
    username VARCHAR(255) PRIMARY KEY,
    refresh_token VARCHAR(255),
    access_token VARCHAR(255),
    expiration_time INT UNSIGNED
)');
mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotifyrecents (
    username VARCHAR(255) PRIMARY KEY,
    track1 VARCHAR(255),
    artist1 VARCHAR(255),
    img1 VARCHAR(255),
    track2 VARCHAR(255),
    artist2 VARCHAR(255),
    img2 VARCHAR(255),
    track3 VARCHAR(255),
    artist3 VARCHAR(255),
    img3 VARCHAR(255),
    track4 VARCHAR(255),
    artist4 VARCHAR(255),
    img4 VARCHAR(255),
    track5 VARCHAR(255),
    artist5 VARCHAR(255),
    img5 VARCHAR(255),
    expiration_time INT UNSIGNED
)');

mysqli_query($db, 'DELETE FROM spotify WHERE expiration_time < ' . time());
mysqli_query($db, 'DELETE FROM spotifyrecents WHERE expiration_time < ' . time());

$username = $query['username'] ?? '';
$client_id = $SPOTIFY_ID;
$client_secret = $SPOTIFY_SECRET;
$logged_in = false;
$ACCESS_TOKEN = null;
$REFRESH_TOKEN = null;

$result = mysqli_query($db, 'SELECT * FROM spotify WHERE username=\'' . $username . '\'');
if (mysqli_num_rows($result) > 0) {
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };
    $ACCESS_TOKEN = $result_arr[0]['access_token'];
    $REFRESH_TOKEN = $result_arr[0]['refresh_token'];
};

if ($SPOTIFY_FORCE_CUSTOM || isset($query['client_id']) || isset($query['client_secret'])) {
    $client_id = isset($query['client_id']) ? $query['client_id'] : '';
    $client_secret = '';
    if (isset($query['client_secret'])) {
        include 'src/decrypt.php';
        $private_key = get_private_key($db);
        $decrypted = explode('&', decrypt_rsa($query['client_secret'], $private_key));
        if ($username != $decrypted[0]) {
            header('Content-Type: image/svg+xml');
            die(file_get_contents('src/imgs/invalid.svg'));
        };
        $client_secret = $decrypted[1];
    };
};

$session = new SpotifyWebAPI\Session(
    $client_id,
    $client_secret,
    $ROOT_URL . '/spotify/callback'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

$cached = true;
include 'src/apis/spotify/login.php';

header('Content-Type: image/svg+xml');
include 'src/customization/colors.php';

switch ($req_url_split[2] ?? '') {
    case 'recents':
        include 'src/apis/spotify/recents.php';
        die();
    
    default:
        die();
};