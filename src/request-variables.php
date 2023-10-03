<?php
$query_split = explode('&', $req_url_query);
$query = [];
foreach ($query_split as $q) {
    $q_split = explode('=', $q);
    if (isset($q_split[1])) $query[$q_split[0]] = $q_split[1]; else $query[$q_split[0]] = '';
};