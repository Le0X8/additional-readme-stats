<?php
include 'src/customization/styles.php';

$STYLE = isset($query['theme']) && array_key_exists($query['theme'], $STYLES) ? $STYLES[$query['theme']] : $STYLES['default'];

$COLORS = array_merge($STYLES['default'], $STYLE);

$COLORS['show'] = [];

if (isset($query['title_color'])) $COLORS['title_color'] = $query['title_color'];
if (isset($query['icon_color'])) $COLORS['icon_color'] = $query['icon_color'];
if (isset($query['text_color'])) $COLORS['text_color'] = $query['text_color'];
if (isset($query['bg_color'])) $COLORS['bg_color'] = $query['bg_color'];
if (isset($query['inner_bg_color'])) $COLORS['inner_bg_color'] = $query['inner_bg_color']; // HIGHLY EXPERIMENTAL, NAME WILL CHANGE IN THE FUTURE
if (isset($query['border_color'])) $COLORS['border_color'] = $query['border_color'];
if (isset($query['hide_border'])) $COLORS['border_color'] = '00000000';
if (isset($query['border_radius'])) $COLORS['border_radius'] = $query['border_radius'];
if (isset($query['inner_border_radius'])) $COLORS['inner_border_radius'] = $query['inner_border_radius']; // HIGHLY EXPERIMENTAL, NAME WILL CHANGE IN THE FUTURE
if (isset($query['hide_title'])) $COLORS['title_color'] = '00000000';
if (isset($query['custom_title'])) $COLORS['custom_title'] = urldecode($query['custom_title']);
if (isset($query['layout'])) $COLORS['layout'] = $query['layout'];
if (isset($query['show'])) {
    $show = explode(',', $query['show']);
    foreach ($show as $key) {
        $COLORS['show'][$key] = true;
    };
    unset($show);
    unset($key);
};