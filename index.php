<?php

$req_url = '/';

if (isset($_SERVER['REQUEST_URI'])) {
    $req_url = $_SERVER['REQUEST_URI'];
};

if (isset($_REQUEST['url'])) {
    $req_url = '/' . $_REQUEST['url'];
};

echo($req_url);