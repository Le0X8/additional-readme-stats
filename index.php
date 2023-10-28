<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
include 'keys.php';

$req_url = '/';

if (isset($_SERVER['REQUEST_URI'])) {
    $req_url = $_SERVER['REQUEST_URI'];
};

if (isset($_REQUEST['url'])) {
    $req_url = '/' . $_REQUEST['url'];
};

$req_url_split_qs = explode('?', $req_url);
$req_url_split = explode('/', $req_url_split_qs[0]);
$req_url_query = $req_url_split_qs[1] ?? '';
unset($req_url_split_qs);

include 'src/request-variables.php';

$db = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS) or die('DB connection failed.');
mysqli_select_db($db, $DB_NAME);
mysqli_set_charset($db, 'utf8');

mysqli_query($db, 'CREATE TABLE IF NOT EXISTS config (
    `key` VARCHAR(255) PRIMARY KEY,
    `value` VARCHAR(2047)
)');

switch ($req_url_split[1]) {
    case 'spotify':
        include 'src/apis/spotify/spotify.php';
        break;

    case 'public':
        include 'src/public.php';
        break;

    case 'cron':
        include 'src/cron.php';
        break;
    
    default:
        header('Location: https://github.com/Le0X8/additional-readme-stats');
        break;
};