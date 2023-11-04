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
    track VARCHAR(255),
    artist VARCHAR(255),
    img VARCHAR(255),
    expiration_time INT UNSIGNED
)');

echo('Removing expired Spotify recents...' . "\n");

mysqli_query($db, 'DELETE FROM spotifyrecents WHERE expiration_time < ' . time());

echo('Removing expired Spotify current...' . "\n");

mysqli_query($db, 'DELETE FROM spotifycurrent WHERE expiration_time < ' . time());

?>
- <?php echo(time()); ?>: Spotify cronjob finished