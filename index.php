<?php

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
        echo('spotify called');
        break;
    
    default:
        header('Location: https://github.com/Le0X8/additional-readme-stats');
        break;
};