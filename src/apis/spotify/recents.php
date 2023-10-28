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

echo (str_replace([
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
    'data:image/jpeg;base64,' . base64_encode(file_get_contents($img1)),

    htmlspecialchars($name2),
    htmlspecialchars($artist2),
    'data:image/jpeg;base64,' . base64_encode(file_get_contents($img2)),

    htmlspecialchars($name3),
    htmlspecialchars($artist3),
    'data:image/jpeg;base64,' . base64_encode(file_get_contents($img3)),

    htmlspecialchars($name4),
    htmlspecialchars($artist4),
    'data:image/jpeg;base64,' . base64_encode(file_get_contents($img4)),

    htmlspecialchars($name5),
    htmlspecialchars($artist5),
    'data:image/jpeg;base64,' . base64_encode(file_get_contents($img5))
], file_get_contents('src/imgs/spotify/recents.svg')));
