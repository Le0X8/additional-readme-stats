<?php

$description = '"' . htmlspecialchars($name) . '" by ' . htmlspecialchars($artist);

if (strlen($name) > 35) {
    $name = substr($name, 0, 35) . '...';
};

if (strlen($artist) > 35) {
    $artist = substr($artist, 0, 35) . '...';
};

$image = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($image));

$playstate = 'data:image/svg+xml;base64,' . base64_encode(str_replace('[[color]]' , $COLORS['icon_color'], file_get_contents('assets/material/' . ($playing ? 'play_arrow' : 'pause') . '.svg')));
$shuffleimg = 'data:image/svg+xml;base64,' . base64_encode(str_replace('[[color]]' , $COLORS['icon_color'], file_get_contents('assets/material/' . ($shuffle ? 'shuffle_on' : 'shuffle') . '.svg')));
$repeatimg = 'data:image/svg+xml;base64,' . base64_encode(str_replace('[[color]]' , $COLORS['icon_color'], file_get_contents('assets/material/' . ($repeat == 'off' ? 'repeat' : ($repeat == 'context' ? 'repeat_on' : 'repeat_one_on')) . '.svg')));

$contents = '';


if (isset($COLORS['show']['volume'])) {
    $volumetype = 'volume_up';
    if ($volume < 50) {
        $volumetype = 'volume_down';
        if ($volume == 0) {
            $volumetype = 'volume_mute';
        };
    };
    $contents .= '<rect x="317.5" y="60" width="10" height="150" fill="#' . $COLORS['inner_bg_color'] . '" rx="' . $COLORS['inner_border_radius'] . '"></rect>
        <rect x="317.5" y="' . 210 - $volume * 1.5 . '" width="10" height="' . $volume * 1.5 . '" fill="#' . $COLORS['icon_color'] . '" rx="' . $COLORS['inner_border_radius'] . '"></rect>
        <image href="data:image/svg+xml;base64,' . base64_encode(str_replace('[[color]]' , $COLORS['icon_color'], file_get_contents('assets/material/' . $volumetype . '.svg'))) . '" x="310" y="222.5" width="25" height="25"></image>';
};

if (isset($COLORS['show']['device'])) {
    $contents .= '<text x="15" y="210" font-size="25" fill="#' . $COLORS['icon_color'] . '" class="vertical">' . htmlspecialchars($device) . '</text>
        <image href="data:image/svg+xml;base64,' . base64_encode(str_replace('[[color]]' , $COLORS['icon_color'], file_get_contents('assets/material/' . $device_type . '.svg'))) . '" x="15" y="222.5" width="25" height="25"></image>';
};


$logotype = 'icon';
if (isset($query['logo']) && $query['logo'] == 'logo') {
    $logotype = 'logo';
};

$logocolor = 'black';
if (isset($query['logo_color']) && ($query['logo_color'] == 'white' || $query['logo_color'] == 'green')) {
    $logocolor = $query['logo_color'];
};

$logoposy = 19;
if (isset($query['logo_position']) && $query['logo_position'] == 'bottom_right') {
    $logoposy = 310;
};

if ($logotype == 'icon') {
    $contents .= '<image href="data:image/png;base64,' . base64_encode(file_get_contents('assets/spotify/icons/' . $logocolor . '.png')) . '" x="310" y="' . $logoposy . '" class="icon"></image>';
} else {
    $contents .= '<image href="data:image/png;base64,' . base64_encode(file_get_contents('assets/spotify/logos/' . $logocolor . '.png')) . '" x="260" y="' . $logoposy . '" class="logo"></image>';
};

echo(str_replace([
    '[[titleColor]]',
    '[[iconColor]]',
    '[[textColor]]',
    '[[bgColor]]',
    '[[borderColor]]',
    '[[borderRadius]]',

    '[[title]]',
    '[[description]]',

    '[[name]]',
    '[[artist]]',
    '[[image]]',
    '[[playstate]]',
    '[[shuffle]]',
    '[[repeat]]',

    '<!--[[contents]]-->'
], [
    $COLORS['title_color'],
    $COLORS['icon_color'],
    $COLORS['text_color'],
    $COLORS['bg_color'],
    $COLORS['border_color'],
    $COLORS['border_radius'],

    htmlspecialchars($title),
    htmlspecialchars($description),

    htmlspecialchars($name),
    htmlspecialchars($artist),
    $image,
    $playstate,
    $shuffleimg,
    $repeatimg,

    $contents
], file_get_contents('src/imgs/spotify/current.svg')));