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

$hide_rank = false;
if (isset($query['hide_rank']) && $query['hide_rank'] == 'true') {
    $hide_rank = true;
};

for ($i = 0; $i < $limit; $i++) {
    $description .= "\t" . ($i + 1) . '. "' . htmlspecialchars($tracks[$i]['name']) . '" by ' . htmlspecialchars($tracks[$i]['artist']) . "\n\t";

    $contents .= ($hide_rank ? '' : '<text y="' . (67.5 + $i * 40) . '"' . ($i > 8 ? ' x="-7.5"' : '') . ' class="rank">' . $i + 1 . '</text>') . '<image href="data:image/jpeg;base64,' . base64_encode(file_get_contents($tracks[$i]['img'])) . '" y="' . (48.75 + $i * 40) . '" class="image"></image>
        <text y="' . (60 + $i * 40) . '" class="name">' . htmlspecialchars($tracks[$i]['name']) . '</text>
        <text y="' . (75 + $i * 40) . '" class="artist">' . htmlspecialchars($tracks[$i]['artist']) . '</text>';
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
], file_get_contents('src/imgs/spotify/tracks.svg')));
