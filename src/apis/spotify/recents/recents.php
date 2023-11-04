<?php
switch ($req_url_split[3] ?? 'svg') {
    case 'svg':
        include 'src/apis/spotify/recents/svg.php';
        break;
    
    case 'json':
        include 'src/apis/spotify/recents/json.php';
        break;

    case 'html':
        include 'src/apis/spotify/recents/html.php';
        break;
};