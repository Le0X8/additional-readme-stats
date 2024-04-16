<?php

switch ($req_url_split[2] ?? '') {
  case 'ratings':
    include 'src/apis/chess/ratings/ratings.php';
    die();

  default:
    die();
};
