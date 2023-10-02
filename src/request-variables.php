<?php
$query_split = explode('&', $req_url_query);
$query = [];
foreach ($query_split as $q) {
    $q_split = explode('=', $q);
    $query[$q_split[0]] = $q_split[1];
};