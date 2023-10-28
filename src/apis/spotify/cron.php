- <?php echo(time()); ?>: Spotify cronjob started
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

$session = new SpotifyWebAPI\Session(
    '', // this is not needed
    '', // also not needed
    $ROOT_URL . '/spotify/callback'
);
$api = new SpotifyWebAPI\SpotifyWebAPI();

echo('- ' . time() . ': Updating recent tracks' . "\n");

$result = mysqli_query($db, 'SELECT * FROM spotify');
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ACCESS_TOKEN = $row['access_token'];
        $REFRESH_TOKEN = $row['refresh_token'];
        $username = $row['username'];

        echo('- ' . time() . ': Updating recent tracks for ' . $username . "\n");

        $api->setAccessToken($ACCESS_TOKEN);
        $session->setAccessToken($ACCESS_TOKEN);
        $session->setRefreshToken($REFRESH_TOKEN);

        $recents = $api->getMyRecentTracks([
            'limit' => 5
        ]);

        mysqli_query($db, 'INSERT INTO spotifyrecents (username, track1, artist1, img1, track2, artist2, img2, track3, artist3, img3, track4, artist4, img4, track5, artist5, img5, expiration_time) VALUES (
            "' . $username . '",

            "' . $recents->items[0]->track->name . '",
            "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[0]->track->artists)) . '",
            "' . $recents->items[0]->track->album->images[0]->url . '",

            "' . $recents->items[1]->track->name . '",
            "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[1]->track->artists)) . '",
            "' . $recents->items[1]->track->album->images[0]->url . '",

            "' . $recents->items[2]->track->name . '",
            "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[2]->track->artists)) . '",
            "' . $recents->items[2]->track->album->images[0]->url . '",

            "' . $recents->items[3]->track->name . '",
            "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[3]->track->artists)) . '",
            "' . $recents->items[3]->track->album->images[0]->url . '",

            "' . $recents->items[4]->track->name . '",
            "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[4]->track->artists)) . '",
            "' . $recents->items[4]->track->album->images[0]->url . '",

            ' . time() + 1209600 . '
        ) ON DUPLICATE KEY UPDATE 
            track1 = "' . $recents->items[0]->track->name . '",
            artist1 = "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[0]->track->artists)) . '",
            img1 = "' . $recents->items[0]->track->album->images[0]->url . '",

            track2 = "' . $recents->items[1]->track->name . '",
            artist2 = "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[1]->track->artists)) . '",
            img2 = "' . $recents->items[1]->track->album->images[0]->url . '",

            track3 = "' . $recents->items[2]->track->name . '",
            artist3 = "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[2]->track->artists)) . '",
            img3 = "' . $recents->items[2]->track->album->images[0]->url . '",

            track4 = "' . $recents->items[3]->track->name . '",
            artist4 = "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[3]->track->artists)) . '",
            img4 = "' . $recents->items[3]->track->album->images[0]->url . '",

            track5 = "' . $recents->items[4]->track->name . '",
            artist5 = "' . join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $recents->items[4]->track->artists)) . '",
            img5 = "' . $recents->items[4]->track->album->images[0]->url . '"
        ');
    };
};

?>
- <?php echo(time()); ?>: Spotify cronjob finished