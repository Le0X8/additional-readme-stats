<?php

$title = $COLOR['custom_title'] ?? 'My current Spotify track';

$result = mysqli_query($db, 'SELECT * FROM spotifycurrent WHERE username=\'' . $username . '\'');
if (mysqli_num_rows($result) > 0) {
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };

    $device = $result_arr[0]['device'];
    $device_type = $result_arr[0]['device_type'];
    $volume = intval($result_arr[0]['volume']);
    $shuffle = !!$result_arr[0]['shuffle'];
    $repeat = $result_arr[0]['rpt'];
    $playing = !!$result_arr[0]['playing'];

    $name = $result_arr[0]['track'];
    $artist = $result_arr[0]['artist'];
    $image = $result_arr[0]['img'];
} else {
    $current = $api->getMyCurrentPlaybackInfo();

    $device = $current->device->name;
    $device_type = strtolower($current->device->type);
    $volume = $current->device->volume_percent ?? 100;
    $shuffle = $current->shuffle_state;
    $repeat = $current->repeat_state;
    $playing = $current->is_playing;

    $name = $current->item->name;
    $artist = join(', ', array_map(function ($artist) {
        return $artist->name;
    }, $current->item->artists));
    $image = $current->item->album->images[0]->url;

    mysqli_query($db, 'INSERT INTO spotifycurrent (
        username,

        device,
        device_type,
        volume,
        shuffle,
        rpt,
        playing,

        track,
        artist,
        img,

        expiration_time
    ) VALUES (
        "' . $username . '",

        "' . $device . '",
        "' . $device_type . '",
        ' . $volume . ',
        ' . ($shuffle ? 'TRUE' : 'FALSE') . ',
        "' . $repeat . '",
        ' . ($playing ? 'TRUE' : 'FALSE') . ',

        "' . $name . '",
        "' . $artist . '",
        "' . $image . '",

        ' . (time() + 120) . '
    )');
};

switch ($req_url_split[3] ?? 'svg') {
    case 'svg':
        include 'src/apis/spotify/current/svg.php';
        break;

    case 'json':
        include 'src/apis/spotify/current/json.php';
        break;

    case 'html':
        include 'src/apis/spotify/current/html.php';
        break;
};