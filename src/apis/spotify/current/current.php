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
    $type = $result_arr[0]['playtype'];

    $name = $result_arr[0]['track'];
    $artist = $result_arr[0]['artist'];
    $image = $result_arr[0]['img'];
    $id = $result_arr[0]['id'];
} else {
    $current = $api->getMyCurrentPlaybackInfo();

    $device = $current?->device?->name ?? 'Unknown';
    $device_type = strtolower($current?->device?->type ?? 'speaker');
    $volume = $current?->device->volume_percent ?? 100;
    $shuffle = $current?->shuffle_state ?? false;
    $repeat = $current?->repeat_state ?? 'off';
    $playing = $current?->is_playing ?? false;

    if (($current->item ?? null) == null) {
        $device = 'Unknown';
        $device_type = 'speaker';
        $volume = 0;
        $shuffle = false;
        $repeat = 'off';
        $playing = false;
        $type = 'track';

        $current = $api->getMyCurrentTrack();

        if (($current ?? null) == null) {
            $norender = true;
            include 'src/apis/spotify/recents/recents.php';
            $norender = false;

            $name = $name1;
            $artist = $artist1;
            $image = $img1;
            $id = $id1;
        } else {
            $name = $current->item->name;
            $artist = join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $current->item->artists));
            $image = $current->item->album->images[0]->url;
            $id = $current->item->id;
        };
    } else {
        $type = $current->item->type;

        $name = $current->item->name;
        $artist = join(', ', array_map(function ($artist) {
            return $artist->name;
        }, $current->item->artists));
        $image = $current->item->album->images[0]->url;
        $id = $current->item->id;
    };

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
        id,
        playtype,

        expiration_time
    ) VALUES (
        "' . $username . '",

        "' . $device . '",
        "' . $device_type . '",
        ' . $volume . ',
        ' . ($shuffle ? 'TRUE' : 'FALSE') . ',
        "' . $repeat . '",
        ' . ($playing ? 'TRUE' : 'FALSE') . ',

        "' . e($name) . '",
        "' . e($artist) . '",
        "' . $image . '",
        "' . $id . '",
        "' . $type . '",

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
