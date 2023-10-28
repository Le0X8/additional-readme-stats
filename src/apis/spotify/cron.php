- <?php echo(time()); ?>: Spotify cronjob started
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

$result = mysqli_query($db, 'SELECT * FROM spotifyrecents WHERE update_time < ' . time());
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $userdata = mysqli_query($db, 'SELECT * FROM spotify WHERE username=\'' . $row['username'] . '\'');
        while ($userrow = mysqli_fetch_assoc($userdata)) {
            $REFRESH_TOKEN = $userrow['refresh_token'];
            $username = $userrow['username'];
            $client_id = $userrow['client_id'];
            $client_secret = $userrow['client_secret'];

            $session = new SpotifyWebAPI\Session(
                $client_id,
                $client_secret,
                $ROOT_URL . '/spotify/callback/' . $client_id . '/' . $client_secret
            );
            $api = new SpotifyWebAPI\SpotifyWebAPI();

            $session->setRefreshToken($REFRESH_TOKEN);
            $session->refreshAccessToken($REFRESH_TOKEN);
            $ACCESS_TOKEN = $session->getAccessToken();
            $api->setAccessToken($ACCESS_TOKEN);
            $session->setAccessToken($ACCESS_TOKEN);
    
            echo('- ' . time() . ': Updating recent tracks for ' . $username . "\n");

            $recents = $api->getMyRecentTracks([
                'limit' => 5
            ]);

            mysqli_query($db, 'UPDATE spotifyrecents SET 
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
                img5 = "' . $recents->items[4]->track->album->images[0]->url . '",
                update_time = ' .
            time() + 300 . ' WHERE username = "' . $username . '"');
        };
    };
};

?>
- <?php echo(time()); ?>: Spotify cronjob finished