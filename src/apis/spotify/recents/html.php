<?php

$name1 = '';
$artist1 = '';
$img1 = '';
$id1 = '';

$name2 = '';
$artist2 = '';
$img2 = '';
$id2 = '';

$name3 = '';
$artist3 = '';
$img3 = '';
$id3 = '';

$name4 = '';
$artist4 = '';
$img4 = '';
$id4 = '';

$name5 = '';
$artist5 = '';
$img5 = '';
$id5 = '';

$name6 = '';
$artist6 = '';
$img6 = '';
$id6 = '';

$name7 = '';
$artist7 = '';
$img7 = '';
$id7 = '';

$name8 = '';
$artist8 = '';
$img8 = '';
$id8 = '';

$name9 = '';
$artist9 = '';
$img9 = '';
$id9 = '';

$name10 = '';
$artist10 = '';
$img10 = '';
$id10 = '';

$result = mysqli_query($db, 'SELECT * FROM spotifyrecents WHERE username=\'' . $username . '\'');
if (mysqli_num_rows($result) > 0) {
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };

    $name1 = $result_arr[0]['track1'];
    $artist1 = $result_arr[0]['artist1'];
    $img1 = $result_arr[0]['img1'];
    $id1 = $result_arr[0]['id1'];

    $name2 = $result_arr[0]['track2'];
    $artist2 = $result_arr[0]['artist2'];
    $img2 = $result_arr[0]['img2'];
    $id2 = $result_arr[0]['id2'];

    $name3 = $result_arr[0]['track3'];
    $artist3 = $result_arr[0]['artist3'];
    $img3 = $result_arr[0]['img3'];
    $id3 = $result_arr[0]['id3'];

    $name4 = $result_arr[0]['track4'];
    $artist4 = $result_arr[0]['artist4'];
    $img4 = $result_arr[0]['img4'];
    $id4 = $result_arr[0]['id4'];

    $name5 = $result_arr[0]['track5'];
    $artist5 = $result_arr[0]['artist5'];
    $img5 = $result_arr[0]['img5'];
    $id5 = $result_arr[0]['id5'];

    $name6 = $result_arr[0]['track6'];
    $artist6 = $result_arr[0]['artist6'];
    $img6 = $result_arr[0]['img6'];
    $id6 = $result_arr[0]['id6'];

    $name7 = $result_arr[0]['track7'];
    $artist7 = $result_arr[0]['artist7'];
    $img7 = $result_arr[0]['img7'];
    $id7 = $result_arr[0]['id7'];

    $name8 = $result_arr[0]['track8'];
    $artist8 = $result_arr[0]['artist8'];
    $img8 = $result_arr[0]['img8'];
    $id8 = $result_arr[0]['id8'];

    $name9 = $result_arr[0]['track9'];
    $artist9 = $result_arr[0]['artist9'];
    $img9 = $result_arr[0]['img9'];
    $id9 = $result_arr[0]['id9'];

    $name10 = $result_arr[0]['track10'];
    $artist10 = $result_arr[0]['artist10'];
    $img10 = $result_arr[0]['img10'];
    $id10 = $result_arr[0]['id10'];
} else {
    $result = mysqli_query($db, 'SELECT * FROM spotify WHERE username=\'' . $username . '\'');
    $recents = $api->getMyRecentTracks([
        'limit' => 10
    ]);

    $name1 = $recents->items[0]->track->name;
    $artist1 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[0]->track->artists));
    $img1 = $recents->items[0]->track->album->images[count($recents->items[0]->track->album->images) - 1]->url;
    $id1 = $recents->items[0]->track->id;

    $name2 = $recents->items[1]->track->name;
    $artist2 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[1]->track->artists));
    $img2 = $recents->items[1]->track->album->images[count($recents->items[1]->track->album->images) - 1]->url;
    $id2 = $recents->items[1]->track->id;

    $name3 = $recents->items[2]->track->name;
    $artist3 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[2]->track->artists));
    $img3 = $recents->items[2]->track->album->images[count($recents->items[2]->track->album->images) - 1]->url;
    $id3 = $recents->items[2]->track->id;

    $name4 = $recents->items[3]->track->name;
    $artist4 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[3]->track->artists));
    $img4 = $recents->items[3]->track->album->images[count($recents->items[3]->track->album->images) - 1]->url;
    $id4 = $recents->items[3]->track->id;

    $name5 = $recents->items[4]->track->name;
    $artist5 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[4]->track->artists));
    $img5 = $recents->items[4]->track->album->images[count($recents->items[4]->track->album->images) - 1]->url;
    $id5 = $recents->items[4]->track->id;

    $name6 = $recents->items[5]->track->name;
    $artist6 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[5]->track->artists));
    $img6 = $recents->items[5]->track->album->images[count($recents->items[5]->track->album->images) - 1]->url;
    $id6 = $recents->items[5]->track->id;

    $name7 = $recents->items[6]->track->name;
    $artist7 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[6]->track->artists));
    $img7 = $recents->items[6]->track->album->images[count($recents->items[6]->track->album->images) - 1]->url;
    $id7 = $recents->items[6]->track->id;

    $name8 = $recents->items[7]->track->name;
    $artist8 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[7]->track->artists));
    $img8 = $recents->items[7]->track->album->images[count($recents->items[7]->track->album->images) - 1]->url;
    $id8 = $recents->items[7]->track->id;

    $name9 = $recents->items[8]->track->name;
    $artist9 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[8]->track->artists));
    $img9 = $recents->items[8]->track->album->images[count($recents->items[8]->track->album->images) - 1]->url;
    $id9 = $recents->items[8]->track->id;

    $name10 = $recents->items[9]->track->name;
    $artist10 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[9]->track->artists));
    $img10 = $recents->items[9]->track->album->images[count($recents->items[9]->track->album->images) - 1]->url;
    $id10 = $recents->items[9]->track->id;

    mysqli_query($db, 'INSERT INTO spotifyrecents (
        username,

        track1,
        artist1,
        img1,
        id1,

        track2,
        artist2,
        img2,
        id2,

        track3,
        artist3,
        img3,
        id3,
        
        track4,
        artist4,
        img4,
        id4,

        track5,
        artist5,
        img5,
        id5,

        track6,
        artist6,
        img6,
        id6,

        track7,
        artist7,
        img7,
        id7,

        track8,
        artist8,
        img8,
        id8,

        track9,
        artist9,
        img9,
        id9,

        track10,
        artist10,
        img10,
        id10,

        expiration_time
    ) VALUES (
        "' . $username . '",

        "' . $name1 . '",
        "' . $artist1 . '",
        "' . $img1 . '",
        "' . $id1 . '",

        "' . $name2 . '",
        "' . $artist2 . '",
        "' . $img2 . '",
        "' . $id2 . '",

        "' . $name3 . '",
        "' . $artist3 . '",
        "' . $img3 . '",
        "' . $id3 . '",

        "' . $name4 . '",
        "' . $artist4 . '",
        "' . $img4 . '",
        "' . $id4 . '",

        "' . $name5 . '",
        "' . $artist5 . '",
        "' . $img5 . '",
        "' . $id5 . '",

        "' . $name6 . '",
        "' . $artist6 . '",
        "' . $img6 . '",
        "' . $id6 . '",

        "' . $name7 . '",
        "' . $artist7 . '",
        "' . $img7 . '",
        "' . $id7 . '",

        "' . $name8 . '",
        "' . $artist8 . '",
        "' . $img8 . '",
        "' . $id8 . '",

        "' . $name9 . '",
        "' . $artist9 . '",
        "' . $img9 . '",
        "' . $id9 . '",

        "' . $name10 . '",
        "' . $artist10 . '",
        "' . $img10 . '",
        "' . $id10 . '",

        ' . (time() + 300) . '
    )');
};
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo(isset($COLORS['custom_title']) ? htmlspecialchars($COLORS['custom_title']) : 'My recently played tracks'); ?></title>
        <link rel="stylesheet" href="/css">
    </head>
    <body>
        <h1><?php echo(isset($COLORS['custom_title']) ? htmlspecialchars($COLORS['custom_title']) : 'My recently played tracks'); ?></h1>
        <ul>
            <?php
            $limit = 5;

            if (isset($query['limit']) && $query['limit'] >= 1 && $query['limit'] <= 10) {
                $limit = intval($query['limit']);
            };

            for ($i = 0; $i < $limit; $i++) {
                switch ($i) {
                    case 0:
                        $name = $name1;
                        $artist = $artist1;
                        $img = $img1;
                        $id = $id1;
                        break;
            
                    case 1:
                        $name = $name2;
                        $artist = $artist2;
                        $img = $img2;
                        $id = $id2;
                        break;
            
                    case 2:
                        $name = $name3;
                        $artist = $artist3;
                        $img = $img3;
                        $id = $id3;
                        break;
            
                    case 3:
                        $name = $name4;
                        $artist = $artist4;
                        $img = $img4;
                        $id = $id4;
                        break;
            
                    case 4:
                        $name = $name5;
                        $artist = $artist5;
                        $img = $img5;
                        $id = $id5;
                        break;
            
                    case 5:
                        $name = $name6;
                        $artist = $artist6;
                        $img = $img6;
                        $id = $id6;
                        break;
            
                    case 6:
                        $name = $name7;
                        $artist = $artist7;
                        $img = $img7;
                        $id = $id7;
                        break;
            
                    case 7:
                        $name = $name8;
                        $artist = $artist8;
                        $img = $img8;
                        $id = $id8;
                        break;
            
                    case 8:
                        $name = $name9;
                        $artist = $artist9;
                        $img = $img9;
                        $id = $id9;
                        break;
            
                    case 9:
                        $name = $name10;
                        $artist = $artist10;
                        $img = $img10;
                        $id = $id10;
                        break;
                };

                echo('<li><a href="https://open.spotify.com/track/' . $id . '"><img src="' . $img . '"><p>' . htmlspecialchars($name) . '</p><span>' . htmlspecialchars($artist) . '</span></a></li>');
            }; 
            ?>
        </ul>
        <b>All data is obtained from the official Spotify API. This project is not related to Spotify AB or any of its partners in any way.</b>
    </body>
</html>