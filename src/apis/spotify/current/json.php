<?php

echo(json_encode([
    'device' => $device,
    'device_type' => $device_type,
    'volume' => $volume,
    'shuffle' => $shuffle,
    'repeat' => $repeat,
    'playing' => $playing,
    'type' => $type,
    'name' => $name,
    'artist' => $artist,
    'image' => $image,
    'id' => $id
]));