<?php

mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotify (
    username VARCHAR(255) PRIMARY KEY,
    client_id VARCHAR(32),
    client_secret VARCHAR(32),
    refresh_token VARCHAR(255)
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
    update_time INT UNSIGNED
)');

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
    $REFRESH_TOKEN = $result_arr[0]['refresh_token'];
    $username = $result_arr[0]['username'];
    $client_id = $result_arr[0]['client_id'];
    $client_secret = $result_arr[0]['client_secret'];
} else {
    if ($SPOTIFY_FORCE_CUSTOM || isset($query['client_id']) || isset($query['client_secret'])) {
        $client_id = isset($query['client_id']) ? $query['client_id'] : '';
        $client_secret = isset($query['client_secret']) ? $query['client_secret'] : '';
    };
};

$session = new SpotifyWebAPI\Session(
    $client_id,
    $client_secret,
    $ROOT_URL . '/spotify/callback/' . $client_id . '/' . $client_secret
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

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