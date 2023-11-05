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



echo('Removing expired Spotify recents...' . "\n");

mysqli_query($db, 'DELETE FROM spotifyrecents WHERE expiration_time < ' . time());

echo('Removing expired Spotify current...' . "\n");

mysqli_query($db, 'DELETE FROM spotifycurrent WHERE expiration_time < ' . time());

echo('Removing expired Spotify mtracks...' . "\n");

mysqli_query($db, 'DELETE FROM spotifymtracks WHERE expiration_time < ' . time());

echo('Removing expired Spotify hytracks...' . "\n");

mysqli_query($db, 'DELETE FROM spotifyhytracks WHERE expiration_time < ' . time());

echo('Removing expired Spotify attracks...' . "\n");

mysqli_query($db, 'DELETE FROM spotifyattracks WHERE expiration_time < ' . time());

echo('Removing expired Spotify martists...' . "\n");

mysqli_query($db, 'DELETE FROM spotifymartists WHERE expiration_time < ' . time());

echo('Removing expired Spotify hyartists...' . "\n");

mysqli_query($db, 'DELETE FROM spotifyhyartists WHERE expiration_time < ' . time());

echo('Removing expired Spotify atartists...' . "\n");

mysqli_query($db, 'DELETE FROM spotifyatartists WHERE expiration_time < ' . time());

?>
- <?php echo(time()); ?>: Spotify cronjob finished