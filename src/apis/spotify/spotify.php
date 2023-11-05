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
    id1 VARCHAR(63),
    track2 VARCHAR(255),
    artist2 VARCHAR(255),
    img2 VARCHAR(255),
    id2 VARCHAR(63),
    track3 VARCHAR(255),
    artist3 VARCHAR(255),
    img3 VARCHAR(255),
    id3 VARCHAR(63),
    track4 VARCHAR(255),
    artist4 VARCHAR(255),
    img4 VARCHAR(255),
    id4 VARCHAR(63),
    track5 VARCHAR(255),
    artist5 VARCHAR(255),
    img5 VARCHAR(255),
    id5 VARCHAR(63),
    track6 VARCHAR(255),
    artist6 VARCHAR(255),
    img6 VARCHAR(255),
    id6 VARCHAR(63),
    track7 VARCHAR(255),
    artist7 VARCHAR(255),
    img7 VARCHAR(255),
    id7 VARCHAR(63),
    track8 VARCHAR(255),
    artist8 VARCHAR(255),
    img8 VARCHAR(255),
    id8 VARCHAR(63),
    track9 VARCHAR(255),
    artist9 VARCHAR(255),
    img9 VARCHAR(255),
    id9 VARCHAR(63),
    track10 VARCHAR(255),
    artist10 VARCHAR(255),
    img10 VARCHAR(255),
    id10 VARCHAR(63),
    expiration_time INT UNSIGNED
)');
mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotifycurrent (
    username VARCHAR(255) PRIMARY KEY,
    device VARCHAR(255),
    device_type VARCHAR(255),
    volume INT UNSIGNED,
    shuffle BOOLEAN,
    rpt VARCHAR(255),
    playing BOOLEAN,
    playtype VARCHAR(31),
    track VARCHAR(255),
    artist VARCHAR(255),
    img VARCHAR(255),
    id VARCHAR(63),
    expiration_time INT UNSIGNED
)');
mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotifymtracks (
    username VARCHAR(255) PRIMARY KEY,
    track1 VARCHAR(255),
    artist1 VARCHAR(255),
    img1 VARCHAR(255),
    id1 VARCHAR(63),
    track2 VARCHAR(255),
    artist2 VARCHAR(255),
    img2 VARCHAR(255),
    id2 VARCHAR(63),
    track3 VARCHAR(255),
    artist3 VARCHAR(255),
    img3 VARCHAR(255),
    id3 VARCHAR(63),
    track4 VARCHAR(255),
    artist4 VARCHAR(255),
    img4 VARCHAR(255),
    id4 VARCHAR(63),
    track5 VARCHAR(255),
    artist5 VARCHAR(255),
    img5 VARCHAR(255),
    id5 VARCHAR(63),
    track6 VARCHAR(255),
    artist6 VARCHAR(255),
    img6 VARCHAR(255),
    id6 VARCHAR(63),
    track7 VARCHAR(255),
    artist7 VARCHAR(255),
    img7 VARCHAR(255),
    id7 VARCHAR(63),
    track8 VARCHAR(255),
    artist8 VARCHAR(255),
    img8 VARCHAR(255),
    id8 VARCHAR(63),
    track9 VARCHAR(255),
    artist9 VARCHAR(255),
    img9 VARCHAR(255),
    id9 VARCHAR(63),
    track10 VARCHAR(255),
    artist10 VARCHAR(255),
    img10 VARCHAR(255),
    id10 VARCHAR(63),
    expiration_time INT UNSIGNED
)');
mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotifyhytracks (
    username VARCHAR(255) PRIMARY KEY,
    track1 VARCHAR(255),
    artist1 VARCHAR(255),
    img1 VARCHAR(255),
    id1 VARCHAR(63),
    track2 VARCHAR(255),
    artist2 VARCHAR(255),
    img2 VARCHAR(255),
    id2 VARCHAR(63),
    track3 VARCHAR(255),
    artist3 VARCHAR(255),
    img3 VARCHAR(255),
    id3 VARCHAR(63),
    track4 VARCHAR(255),
    artist4 VARCHAR(255),
    img4 VARCHAR(255),
    id4 VARCHAR(63),
    track5 VARCHAR(255),
    artist5 VARCHAR(255),
    img5 VARCHAR(255),
    id5 VARCHAR(63),
    track6 VARCHAR(255),
    artist6 VARCHAR(255),
    img6 VARCHAR(255),
    id6 VARCHAR(63),
    track7 VARCHAR(255),
    artist7 VARCHAR(255),
    img7 VARCHAR(255),
    id7 VARCHAR(63),
    track8 VARCHAR(255),
    artist8 VARCHAR(255),
    img8 VARCHAR(255),
    id8 VARCHAR(63),
    track9 VARCHAR(255),
    artist9 VARCHAR(255),
    img9 VARCHAR(255),
    id9 VARCHAR(63),
    track10 VARCHAR(255),
    artist10 VARCHAR(255),
    img10 VARCHAR(255),
    id10 VARCHAR(63),
    expiration_time INT UNSIGNED
)');
mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotifyattracks (
    username VARCHAR(255) PRIMARY KEY,
    track1 VARCHAR(255),
    artist1 VARCHAR(255),
    img1 VARCHAR(255),
    id1 VARCHAR(63),
    track2 VARCHAR(255),
    artist2 VARCHAR(255),
    img2 VARCHAR(255),
    id2 VARCHAR(63),
    track3 VARCHAR(255),
    artist3 VARCHAR(255),
    img3 VARCHAR(255),
    id3 VARCHAR(63),
    track4 VARCHAR(255),
    artist4 VARCHAR(255),
    img4 VARCHAR(255),
    id4 VARCHAR(63),
    track5 VARCHAR(255),
    artist5 VARCHAR(255),
    img5 VARCHAR(255),
    id5 VARCHAR(63),
    track6 VARCHAR(255),
    artist6 VARCHAR(255),
    img6 VARCHAR(255),
    id6 VARCHAR(63),
    track7 VARCHAR(255),
    artist7 VARCHAR(255),
    img7 VARCHAR(255),
    id7 VARCHAR(63),
    track8 VARCHAR(255),
    artist8 VARCHAR(255),
    img8 VARCHAR(255),
    id8 VARCHAR(63),
    track9 VARCHAR(255),
    artist9 VARCHAR(255),
    img9 VARCHAR(255),
    id9 VARCHAR(63),
    track10 VARCHAR(255),
    artist10 VARCHAR(255),
    img10 VARCHAR(255),
    id10 VARCHAR(63),
    expiration_time INT UNSIGNED
)');
mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotifymartists (
    username VARCHAR(255) PRIMARY KEY,
    artist1 VARCHAR(255),
    img1 VARCHAR(255),
    id1 VARCHAR(63),
    artist2 VARCHAR(255),
    img2 VARCHAR(255),
    id2 VARCHAR(63),
    artist3 VARCHAR(255),
    img3 VARCHAR(255),
    id3 VARCHAR(63),
    artist4 VARCHAR(255),
    img4 VARCHAR(255),
    id4 VARCHAR(63),
    artist5 VARCHAR(255),
    img5 VARCHAR(255),
    id5 VARCHAR(63),
    artist6 VARCHAR(255),
    img6 VARCHAR(255),
    id6 VARCHAR(63),
    artist7 VARCHAR(255),
    img7 VARCHAR(255),
    id7 VARCHAR(63),
    artist8 VARCHAR(255),
    img8 VARCHAR(255),
    id8 VARCHAR(63),
    artist9 VARCHAR(255),
    img9 VARCHAR(255),
    id9 VARCHAR(63),
    artist10 VARCHAR(255),
    img10 VARCHAR(255),
    id10 VARCHAR(63),
    expiration_time INT UNSIGNED
)');
mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotifyhyartists (
    username VARCHAR(255) PRIMARY KEY,
    artist1 VARCHAR(255),
    img1 VARCHAR(255),
    id1 VARCHAR(63),
    artist2 VARCHAR(255),
    img2 VARCHAR(255),
    id2 VARCHAR(63),
    artist3 VARCHAR(255),
    img3 VARCHAR(255),
    id3 VARCHAR(63),
    artist4 VARCHAR(255),
    img4 VARCHAR(255),
    id4 VARCHAR(63),
    artist5 VARCHAR(255),
    img5 VARCHAR(255),
    id5 VARCHAR(63),
    artist6 VARCHAR(255),
    img6 VARCHAR(255),
    id6 VARCHAR(63),
    artist7 VARCHAR(255),
    img7 VARCHAR(255),
    id7 VARCHAR(63),
    artist8 VARCHAR(255),
    img8 VARCHAR(255),
    id8 VARCHAR(63),
    artist9 VARCHAR(255),
    img9 VARCHAR(255),
    id9 VARCHAR(63),
    artist10 VARCHAR(255),
    img10 VARCHAR(255),
    id10 VARCHAR(63),
    expiration_time INT UNSIGNED
)');
mysqli_query($db, 'CREATE TABLE IF NOT EXISTS spotifyatartists (
    username VARCHAR(255) PRIMARY KEY,
    artist1 VARCHAR(255),
    img1 VARCHAR(255),
    id1 VARCHAR(63),
    artist2 VARCHAR(255),
    img2 VARCHAR(255),
    id2 VARCHAR(63),
    artist3 VARCHAR(255),
    img3 VARCHAR(255),
    id3 VARCHAR(63),
    artist4 VARCHAR(255),
    img4 VARCHAR(255),
    id4 VARCHAR(63),
    artist5 VARCHAR(255),
    img5 VARCHAR(255),
    id5 VARCHAR(63),
    artist6 VARCHAR(255),
    img6 VARCHAR(255),
    id6 VARCHAR(63),
    artist7 VARCHAR(255),
    img7 VARCHAR(255),
    id7 VARCHAR(63),
    artist8 VARCHAR(255),
    img8 VARCHAR(255),
    id8 VARCHAR(63),
    artist9 VARCHAR(255),
    img9 VARCHAR(255),
    id9 VARCHAR(63),
    artist10 VARCHAR(255),
    img10 VARCHAR(255),
    id10 VARCHAR(63),
    expiration_time INT UNSIGNED
)');

mysqli_query($db, 'DELETE FROM spotifyrecents WHERE expiration_time < ' . time());
mysqli_query($db, 'DELETE FROM spotifycurrent WHERE expiration_time < ' . time());
mysqli_query($db, 'DELETE FROM spotifymtracks WHERE expiration_time < ' . time());
mysqli_query($db, 'DELETE FROM spotifyhytracks WHERE expiration_time < ' . time());
mysqli_query($db, 'DELETE FROM spotifyattracks WHERE expiration_time < ' . time());
mysqli_query($db, 'DELETE FROM spotifymartists WHERE expiration_time < ' . time());
mysqli_query($db, 'DELETE FROM spotifyhyartists WHERE expiration_time < ' . time());
mysqli_query($db, 'DELETE FROM spotifyatartists WHERE expiration_time < ' . time());

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

include 'src/customization/colors.php';

switch ($req_url_split[2] ?? '') {
    case 'current':
        include 'src/apis/spotify/current/current.php';
        die();

    case 'recents':
        include 'src/apis/spotify/recents/recents.php';
        die();

    case 'tracks':
        include 'src/apis/spotify/tracks/tracks.php';
        die();

    case 'artists':
        include 'src/apis/spotify/artists/artists.php';
        die();

    default:
        die();
};