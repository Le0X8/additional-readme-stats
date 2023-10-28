<?php

$title = $COLORS['custom_title'] ?? 'My recently played tracks';

$name1 = '';
$artist1 = '';
$img1 = '';

$name2 = '';
$artist2 = '';
$img2 = '';

$name3 = '';
$artist3 = '';
$img3 = '';

$name4 = '';
$artist4 = '';
$img4 = '';

$name5 = '';
$artist5 = '';
$img5 = '';

if ($logged_in) {
    $recents = $api->getMyRecentTracks([
        'limit' => 5
    ]);

    $name1 = $recents->items[0]->track->name;
    $artist1 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[0]->track->artists));
    $img1 = $recents->items[0]->track->album->images[0]->url;

    $name2 = $recents->items[1]->track->name;
    $artist2 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[1]->track->artists));
    $img2 = $recents->items[1]->track->album->images[0]->url;

    $name3 = $recents->items[2]->track->name;
    $artist3 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[2]->track->artists));
    $img3 = $recents->items[2]->track->album->images[0]->url;

    $name4 = $recents->items[3]->track->name;
    $artist4 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[3]->track->artists));
    $img4 = $recents->items[3]->track->album->images[0]->url;

    $name5 = $recents->items[4]->track->name;
    $artist5 = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $recents->items[4]->track->artists));
    $img5 = $recents->items[4]->track->album->images[0]->url;

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
        img5 = "' . $recents->items[4]->track->album->images[0]->url . '",
        expiration_time = ' . 
    time() + 1209600);
} else {
    $result = mysqli_query($db, 'SELECT * FROM spotifyrecents WHERE username=\'' . $username . '\'');
    if (mysqli_num_rows($result) > 0) {
        $result_arr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($result_arr, $row);
        };
        
        $name1 = $result_arr[0]['track1'];
        $artist1 = $result_arr[0]['artist1'];
        $img1 = $result_arr[0]['img1'];

        $name2 = $result_arr[0]['track2'];
        $artist2 = $result_arr[0]['artist2'];
        $img2 = $result_arr[0]['img2'];

        $name3 = $result_arr[0]['track3'];
        $artist3 = $result_arr[0]['artist3'];
        $img3 = $result_arr[0]['img3'];

        $name4 = $result_arr[0]['track4'];
        $artist4 = $result_arr[0]['artist4'];
        $img4 = $result_arr[0]['img4'];

        $name5 = $result_arr[0]['track5'];
        $artist5 = $result_arr[0]['artist5'];
        $img5 = $result_arr[0]['img5'];
    } else {
        die(file_get_contents('src/imgs/login.svg'));
    };
};

echo(str_replace([
    '[[titleColor]]',
    '[[iconColor]]',
    '[[textColor]]',
    '[[bgColor]]',
    '[[borderColor]]',
    '[[borderRadius]]',
    '[[title]]',

    '[[name1]]',
    '[[artist1]]',
    '[[img1]]',

    '[[name2]]',
    '[[artist2]]',
    '[[img2]]',

    '[[name3]]',
    '[[artist3]]',
    '[[img3]]',

    '[[name4]]',
    '[[artist4]]',
    '[[img4]]',

    '[[name5]]',
    '[[artist5]]',
    '[[img5]]'
], [
    $COLORS['title_color'],
    $COLORS['icon_color'],
    $COLORS['text_color'],
    $COLORS['bg_color'],
    $COLORS['border_color'],
    $COLORS['border_radius'],
    $title,

    htmlspecialchars($name1),
    htmlspecialchars($artist1),
    $img1,

    htmlspecialchars($name2),
    htmlspecialchars($artist2),
    $img2,

    htmlspecialchars($name3),
    htmlspecialchars($artist3),
    $img3,

    htmlspecialchars($name4),
    htmlspecialchars($artist4),
    $img4,

    htmlspecialchars($name5),
    htmlspecialchars($artist5),
    $img5
], file_get_contents('src/imgs/spotify/recents.svg')));