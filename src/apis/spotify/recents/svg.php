<?php

$contents = '';
$description = "\n\t";

$limit = 5;

if (isset($query['limit']) && $query['limit'] >= 1 && $query['limit'] <= 10) {
    $limit = intval($query['limit']);
};

$height = 60 + $limit * 40;

$logotype = 'icon';
if (isset($query['logo']) && $query['logo'] == 'logo') {
    $logotype = 'logo';
};

$logocolor = 'black';
if (isset($query['logo_color']) && ($query['logo_color'] == 'white' || $query['logo_color'] == 'green')) {
    $logocolor = $query['logo_color'];
};

for ($i = 0; $i < $limit; $i++) {
    $name = '';
    $artist = '';
    $img = '';

    switch ($i) {
        case 0:
            $name = $name1;
            $artist = $artist1;
            $img = $img1;
            break;

        case 1:
            $name = $name2;
            $artist = $artist2;
            $img = $img2;
            break;

        case 2:
            $name = $name3;
            $artist = $artist3;
            $img = $img3;
            break;

        case 3:
            $name = $name4;
            $artist = $artist4;
            $img = $img4;
            break;

        case 4:
            $name = $name5;
            $artist = $artist5;
            $img = $img5;
            break;

        case 5:
            $name = $name6;
            $artist = $artist6;
            $img = $img6;
            break;

        case 6:
            $name = $name7;
            $artist = $artist7;
            $img = $img7;
            break;

        case 7:
            $name = $name8;
            $artist = $artist8;
            $img = $img8;
            break;

        case 8:
            $name = $name9;
            $artist = $artist9;
            $img = $img9;
            break;

        case 9:
            $name = $name10;
            $artist = $artist10;
            $img = $img10;
            break;
    };

    $description .= "\t" . ($i + 1) . '. "' . htmlspecialchars($name) . '" by ' . htmlspecialchars($artist) . "\n\t";

    $contents .= '<image href="data:image/jpeg;base64,' . base64_encode(file_get_contents($img)) . '" y="' . (48.75 + $i * 40) . '" class="image"></image>
        <text y="' . (60 + $i * 40) . '" class="name">' . htmlspecialchars($name) . '</text>
        <text y="' . (75 + $i * 40) . '" class="artist">' . htmlspecialchars($artist) . '</text>';
};

$logoposy = 19;
if (isset($query['logo_position']) && $query['logo_position'] == 'bottom_right') {
    $logoposy = $height - 40;
};

if ($logotype == 'icon') {
    $contents .= '<image href="data:image/png;base64,' . base64_encode(file_get_contents('assets/spotify/icons/' . $logocolor . '.png')) . '" x="310" y="' . $logoposy . '" class="icon"></image>';
} else {
    $contents .= '<image href="data:image/png;base64,' . base64_encode(file_get_contents('assets/spotify/logos/' . $logocolor . '.png')) . '" x="260" y="' . $logoposy . '" class="logo"></image>';
};

echo (str_replace([
    '[[height]]',
    '[[boxHeight]]',

    '[[titleColor]]',
    '[[iconColor]]',
    '[[textColor]]',
    '[[bgColor]]',
    '[[borderColor]]',
    '[[borderRadius]]',
    '[[title]]',

    '<!--[[description]]-->',
    '<!--[[contents]]-->'
], [
    $height,
    $height - 2,

    $COLORS['title_color'],
    $COLORS['icon_color'],
    $COLORS['text_color'],
    $COLORS['bg_color'],
    $COLORS['border_color'],
    $COLORS['border_radius'],
    htmlspecialchars($title),

    htmlspecialchars($description),
    $contents
], file_get_contents('src/imgs/spotify/recents.svg')));
