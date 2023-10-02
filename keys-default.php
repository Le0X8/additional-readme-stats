<?php
// Info: doc/self-hosting.md#keys

$ROOT_URL = ''; // The root url of your instance, e.g. https://armstats.leox.dev or http://localhost:8000 (no trailing slash)

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'armstats';

$SPOTIFY_ID = '';
$SPOTIFY_SECRET = '';
$SPOTIFY_DEVMODE = true; // If your application is not in extended quota mode, set this to true
$SPOTIFY_FORCE_CUSTOM = false; // If every user should use their own keys, set this to true (not very user friendly btw)