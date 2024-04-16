<?php

$period = 'alltime';
switch ($query['period'] ?? 'alltime') {
    case 'month':
        $period = 'month';
        break;
    
    case 'halfyear':
        $period = 'halfyear';
        break;

    default:
        $period = 'alltime';
        break;
};

$title = 'My top artists of ';
switch ($period) {
    case 'month':
        $title .= 'the last month';
        break;
    
    case 'halfyear':
        $title .= 'the last half year';
        break;

    default:
        $title .= 'the past year';
        break;
};

$result = mysqli_query($db, 'SELECT * FROM spotifymartists WHERE username=\'' . $username . '\'');
if (mysqli_num_rows($result) > 0) {
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };

    $artistsm = [
        [
            'name' => $result_arr[0]['artist1'],
            'img' => $result_arr[0]['img1'],
            'id' => $result_arr[0]['id1']
        ],
        [
            'name' => $result_arr[0]['artist2'],
            'img' => $result_arr[0]['img2'],
            'id' => $result_arr[0]['id2']
        ],
        [
            'name' => $result_arr[0]['artist3'],
            'img' => $result_arr[0]['img3'],
            'id' => $result_arr[0]['id3']
        ],
        [
            'name' => $result_arr[0]['artist4'],
            'img' => $result_arr[0]['img4'],
            'id' => $result_arr[0]['id4']
        ],
        [
            'name' => $result_arr[0]['artist5'],
            'img' => $result_arr[0]['img5'],
            'id' => $result_arr[0]['id5']
        ],
        [
            'name' => $result_arr[0]['artist6'],
            'img' => $result_arr[0]['img6'],
            'id' => $result_arr[0]['id6']
        ],
        [
            'name' => $result_arr[0]['artist7'],
            'img' => $result_arr[0]['img7'],
            'id' => $result_arr[0]['id7']
        ],
        [
            'name' => $result_arr[0]['artist8'],
            'img' => $result_arr[0]['img8'],
            'id' => $result_arr[0]['id8']
        ],
        [
            'name' => $result_arr[0]['artist9'],
            'img' => $result_arr[0]['img9'],
            'id' => $result_arr[0]['id9']
        ],
        [
            'name' => $result_arr[0]['artist10'],
            'img' => $result_arr[0]['img10'],
            'id' => $result_arr[0]['id10']
        ]
    ];
} else {
    $artistsm = $api->getMyTop('artists', [
        'limit' => 10,
        'time_range' => 'short_term'
    ]);
    
    $artistsm = array_map(function($artist) {
        return [
            'name' => $artist->name,
            'img' => $artist->images[count($artist->images) - 1]->url,
            'id' => $artist->id
        ];
    }, $artistsm->items);

    mysqli_query($db, 'INSERT INTO spotifymartists (
        username,

        artist1,
        img1,
        id1,

        artist2,
        img2,
        id2,

        artist3,
        img3,
        id3,
        
        artist4,
        img4,
        id4,

        artist5,
        img5,
        id5,

        artist6,
        img6,
        id6,

        artist7,
        img7,
        id7,

        artist8,
        img8,
        id8,

        artist9,
        img9,
        id9,

        artist10,
        img10,
        id10,

        expiration_time
    ) VALUES (
        "' . $username . '",

        "' . $artistsm[0]['name'] . '",
        "' . $artistsm[0]['img'] . '",
        "' . $artistsm[0]['id'] . '",

        "' . $artistsm[1]['name'] . '",
        "' . $artistsm[1]['img'] . '",
        "' . $artistsm[1]['id'] . '",

        "' . $artistsm[2]['name'] . '",
        "' . $artistsm[2]['img'] . '",
        "' . $artistsm[2]['id'] . '",

        "' . $artistsm[3]['name'] . '",
        "' . $artistsm[3]['img'] . '",
        "' . $artistsm[3]['id'] . '",

        "' . $artistsm[4]['name'] . '",
        "' . $artistsm[4]['img'] . '",
        "' . $artistsm[4]['id'] . '",

        "' . $artistsm[5]['name'] . '",
        "' . $artistsm[5]['img'] . '",
        "' . $artistsm[5]['id'] . '",

        "' . $artistsm[6]['name'] . '",
        "' . $artistsm[6]['img'] . '",
        "' . $artistsm[6]['id'] . '",

        "' . $artistsm[7]['name'] . '",
        "' . $artistsm[7]['img'] . '",
        "' . $artistsm[7]['id'] . '",

        "' . $artistsm[8]['name'] . '",
        "' . $artistsm[8]['img'] . '",
        "' . $artistsm[8]['id'] . '",

        "' . $artistsm[9]['name'] . '",
        "' . $artistsm[9]['img'] . '",
        "' . $artistsm[9]['id'] . '",

        ' . (time() + 86400) . '
    )');
};

$result = mysqli_query($db, 'SELECT * FROM spotifyhyartists WHERE username=\'' . $username . '\'');
if (mysqli_num_rows($result) > 0) {
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };

    $artistshy = [
        [
            'name' => $result_arr[0]['artist1'],
            'img' => $result_arr[0]['img1'],
            'id' => $result_arr[0]['id1']
        ],
        [
            'name' => $result_arr[0]['artist2'],
            'img' => $result_arr[0]['img2'],
            'id' => $result_arr[0]['id2']
        ],
        [
            'name' => $result_arr[0]['artist3'],
            'img' => $result_arr[0]['img3'],
            'id' => $result_arr[0]['id3']
        ],
        [
            'name' => $result_arr[0]['artist4'],
            'img' => $result_arr[0]['img4'],
            'id' => $result_arr[0]['id4']
        ],
        [
            'name' => $result_arr[0]['artist5'],
            'img' => $result_arr[0]['img5'],
            'id' => $result_arr[0]['id5']
        ],
        [
            'name' => $result_arr[0]['artist6'],
            'img' => $result_arr[0]['img6'],
            'id' => $result_arr[0]['id6']
        ],
        [
            'name' => $result_arr[0]['artist7'],
            'img' => $result_arr[0]['img7'],
            'id' => $result_arr[0]['id7']
        ],
        [
            'name' => $result_arr[0]['artist8'],
            'img' => $result_arr[0]['img8'],
            'id' => $result_arr[0]['id8']
        ],
        [
            'name' => $result_arr[0]['artist9'],
            'img' => $result_arr[0]['img9'],
            'id' => $result_arr[0]['id9']
        ],
        [
            'name' => $result_arr[0]['artist10'],
            'img' => $result_arr[0]['img10'],
            'id' => $result_arr[0]['id10']
        ]
    ];
} else {
    $artistshy = $api->getMyTop('artists', [
        'limit' => 10,
        'time_range' => 'medium_term'
    ]);
    
    $artistshy = array_map(function($artist) {
        return [
            'name' => $artist->name,
            'img' => $artist->images[count($artist->images) - 1]->url,
            'id' => $artist->id
        ];
    }, $artistshy->items);

    mysqli_query($db, 'INSERT INTO spotifyhyartists (
        username,

        artist1,
        img1,
        id1,

        artist2,
        img2,
        id2,

        artist3,
        img3,
        id3,
        
        artist4,
        img4,
        id4,

        artist5,
        img5,
        id5,

        artist6,
        img6,
        id6,

        artist7,
        img7,
        id7,

        artist8,
        img8,
        id8,

        artist9,
        img9,
        id9,

        artist10,
        img10,
        id10,

        expiration_time
    ) VALUES (
        "' . $username . '",

        "' . $artistshy[0]['name'] . '",
        "' . $artistshy[0]['img'] . '",
        "' . $artistshy[0]['id'] . '",

        "' . $artistshy[1]['name'] . '",
        "' . $artistshy[1]['img'] . '",
        "' . $artistshy[1]['id'] . '",

        "' . $artistshy[2]['name'] . '",
        "' . $artistshy[2]['img'] . '",
        "' . $artistshy[2]['id'] . '",

        "' . $artistshy[3]['name'] . '",
        "' . $artistshy[3]['img'] . '",
        "' . $artistshy[3]['id'] . '",

        "' . $artistshy[4]['name'] . '",
        "' . $artistshy[4]['img'] . '",
        "' . $artistshy[4]['id'] . '",

        "' . $artistshy[5]['name'] . '",
        "' . $artistshy[5]['img'] . '",
        "' . $artistshy[5]['id'] . '",

        "' . $artistshy[6]['name'] . '",
        "' . $artistshy[6]['img'] . '",
        "' . $artistshy[6]['id'] . '",

        "' . $artistshy[7]['name'] . '",
        "' . $artistshy[7]['img'] . '",
        "' . $artistshy[7]['id'] . '",

        "' . $artistshy[8]['name'] . '",
        "' . $artistshy[8]['img'] . '",
        "' . $artistshy[8]['id'] . '",

        "' . $artistshy[9]['name'] . '",
        "' . $artistshy[9]['img'] . '",
        "' . $artistshy[9]['id'] . '",
        
        ' . (time() + 86400) . '
    )');
};

$result = mysqli_query($db, 'SELECT * FROM spotifyatartists WHERE username=\'' . $username . '\'');
if (mysqli_num_rows($result) > 0) {
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };

    $artistsat = [
        [
            'name' => $result_arr[0]['artist1'],
            'img' => $result_arr[0]['img1'],
            'id' => $result_arr[0]['id1']
        ],
        [
            'name' => $result_arr[0]['artist2'],
            'img' => $result_arr[0]['img2'],
            'id' => $result_arr[0]['id2']
        ],
        [
            'name' => $result_arr[0]['artist3'],
            'img' => $result_arr[0]['img3'],
            'id' => $result_arr[0]['id3']
        ],
        [
            'name' => $result_arr[0]['artist4'],
            'img' => $result_arr[0]['img4'],
            'id' => $result_arr[0]['id4']
        ],
        [
            'name' => $result_arr[0]['artist5'],
            'img' => $result_arr[0]['img5'],
            'id' => $result_arr[0]['id5']
        ],
        [
            'name' => $result_arr[0]['artist6'],
            'img' => $result_arr[0]['img6'],
            'id' => $result_arr[0]['id6']
        ],
        [
            'name' => $result_arr[0]['artist7'],
            'img' => $result_arr[0]['img7'],
            'id' => $result_arr[0]['id7']
        ],
        [
            'name' => $result_arr[0]['artist8'],
            'img' => $result_arr[0]['img8'],
            'id' => $result_arr[0]['id8']
        ],
        [
            'name' => $result_arr[0]['artist9'],
            'img' => $result_arr[0]['img9'],
            'id' => $result_arr[0]['id9']
        ],
        [
            'name' => $result_arr[0]['artist10'],
            'img' => $result_arr[0]['img10'],
            'id' => $result_arr[0]['id10']
        ]
    ];
} else {
    $artistsat = $api->getMyTop('artists', [
        'limit' => 10,
        'time_range' => 'long_term'
    ]);

    $artistsat = array_map(function($artist) {
        return [
            'name' => $artist->name,
            'img' => $artist->images[count($artist->images) - 1]->url,
            'id' => $artist->id
        ];
    }, $artistsat->items);

    mysqli_query($db, 'INSERT INTO spotifyatartists (
        username,

        artist1,
        img1,
        id1,

        artist2,
        img2,
        id2,

        artist3,
        img3,
        id3,
        
        artist4,
        img4,
        id4,

        artist5,
        img5,
        id5,

        artist6,
        img6,
        id6,

        artist7,
        img7,
        id7,

        artist8,
        img8,
        id8,

        artist9,
        img9,
        id9,

        artist10,
        img10,
        id10,

        expiration_time
    ) VALUES (
        "' . $username . '",

        "' . $artistsat[0]['name'] . '",
        "' . $artistsat[0]['img'] . '",
        "' . $artistsat[0]['id'] . '",

        "' . $artistsat[1]['name'] . '",
        "' . $artistsat[1]['img'] . '",
        "' . $artistsat[1]['id'] . '",

        "' . $artistsat[2]['name'] . '",
        "' . $artistsat[2]['img'] . '",
        "' . $artistsat[2]['id'] . '",

        "' . $artistsat[3]['name'] . '",
        "' . $artistsat[3]['img'] . '",
        "' . $artistsat[3]['id'] . '",

        "' . $artistsat[4]['name'] . '",
        "' . $artistsat[4]['img'] . '",
        "' . $artistsat[4]['id'] . '",

        "' . $artistsat[5]['name'] . '",
        "' . $artistsat[5]['img'] . '",
        "' . $artistsat[5]['id'] . '",

        "' . $artistsat[6]['name'] . '",
        "' . $artistsat[6]['img'] . '",
        "' . $artistsat[6]['id'] . '",

        "' . $artistsat[7]['name'] . '",
        "' . $artistsat[7]['img'] . '",
        "' . $artistsat[7]['id'] . '",

        "' . $artistsat[8]['name'] . '",
        "' . $artistsat[8]['img'] . '",
        "' . $artistsat[8]['id'] . '",

        "' . $artistsat[9]['name'] . '",
        "' . $artistsat[9]['img'] . '",
        "' . $artistsat[9]['id'] . '",

        ' . (time() + 86400) . '
    )');
};

switch ($period) {
    case 'month':
        $artists = $artistsm;
        break;

    case 'halfyear':
        $artists = $artistshy;
        break;

    default:
        $artists = $artistsat;
        break;
};

if (!$norender) switch ($req_url_split[3] ?? 'svg') {
    case 'svg':
        include 'src/apis/spotify/artists/svg.php';
        break;
    
    case 'json':
        include 'src/apis/spotify/artists/json.php';
        break;

    case 'html':
        include 'src/apis/spotify/artists/html.php';
        break;
};