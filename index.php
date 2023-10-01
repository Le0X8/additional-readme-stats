<?php

require 'vendor/autoload.php';
include 'keys.php';

$req_url = '/';

if (isset($_SERVER['REQUEST_URI'])) {
    $req_url = $_SERVER['REQUEST_URI'];
};

if (isset($_REQUEST['url'])) {
    $req_url = '/' . $_REQUEST['url'];
};

$req_url_split = explode('/', $req_url);


switch ($req_url_split[1]) {
    case 'spotify':
        include 'apis/spotify/spotify.php';
        break;
    
    default:
        header('Location: https://github.com/Le0X8/additional-readme-stats');
        break;
};