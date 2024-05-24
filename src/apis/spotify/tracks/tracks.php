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

$title = 'My top tracks of ';
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

$result = mysqli_query($db, 'SELECT * FROM spotifymtracks WHERE username=\'' . $username . '\'');
if (mysqli_num_rows($result) > 0) {
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };

    $tracksm = [
        [
            'name' => $result_arr[0]['track1'],
            'artist' => $result_arr[0]['artist1'],
            'img' => $result_arr[0]['img1'],
            'id' => $result_arr[0]['id1']
        ],
        [
            'name' => $result_arr[0]['track2'],
            'artist' => $result_arr[0]['artist2'],
            'img' => $result_arr[0]['img2'],
            'id' => $result_arr[0]['id2']
        ],
        [
            'name' => $result_arr[0]['track3'],
            'artist' => $result_arr[0]['artist3'],
            'img' => $result_arr[0]['img3'],
            'id' => $result_arr[0]['id3']
        ],
        [
            'name' => $result_arr[0]['track4'],
            'artist' => $result_arr[0]['artist4'],
            'img' => $result_arr[0]['img4'],
            'id' => $result_arr[0]['id4']
        ],
        [
            'name' => $result_arr[0]['track5'],
            'artist' => $result_arr[0]['artist5'],
            'img' => $result_arr[0]['img5'],
            'id' => $result_arr[0]['id5']
        ],
        [
            'name' => $result_arr[0]['track6'],
            'artist' => $result_arr[0]['artist6'],
            'img' => $result_arr[0]['img6'],
            'id' => $result_arr[0]['id6']
        ],
        [
            'name' => $result_arr[0]['track7'],
            'artist' => $result_arr[0]['artist7'],
            'img' => $result_arr[0]['img7'],
            'id' => $result_arr[0]['id7']
        ],
        [
            'name' => $result_arr[0]['track8'],
            'artist' => $result_arr[0]['artist8'],
            'img' => $result_arr[0]['img8'],
            'id' => $result_arr[0]['id8']
        ],
        [
            'name' => $result_arr[0]['track9'],
            'artist' => $result_arr[0]['artist9'],
            'img' => $result_arr[0]['img9'],
            'id' => $result_arr[0]['id9']
        ],
        [
            'name' => $result_arr[0]['track10'],
            'artist' => $result_arr[0]['artist10'],
            'img' => $result_arr[0]['img10'],
            'id' => $result_arr[0]['id10']
        ]
    ];
} else {
    $tracksm = $api->getMyTop('tracks', [
        'limit' => 10,
        'time_range' => 'short_term'
    ]);
    
    $tracksm = array_map(function($track) {
        return [
            'name' => $track->name,
            'artist' => join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $track->artists)),
            'img' => $track->album->images[count($track->album->images) - 1]->url,
            'id' => $track->id
        ];
    }, $tracksm->items);

    mysqli_query($db, 'INSERT INTO spotifymtracks (
        username,

        track1,
        artist1,
        img1,
        id1,

        track2,
        artist2,
        img2,
        id2,

        track3,
        artist3,
        img3,
        id3,
        
        track4,
        artist4,
        img4,
        id4,

        track5,
        artist5,
        img5,
        id5,

        track6,
        artist6,
        img6,
        id6,

        track7,
        artist7,
        img7,
        id7,

        track8,
        artist8,
        img8,
        id8,

        track9,
        artist9,
        img9,
        id9,

        track10,
        artist10,
        img10,
        id10,

        expiration_time
    ) VALUES (
        "' . $username . '",

        "' . e($tracksm[0]['name']) . '",
        "' . e($tracksm[0]['artist']) . '",
        "' . $tracksm[0]['img'] . '",
        "' . $tracksm[0]['id'] . '",

        "' . e($tracksm[1]['name']) . '",
        "' . e($tracksm[1]['artist']) . '",
        "' . $tracksm[1]['img'] . '",
        "' . $tracksm[1]['id'] . '",

        "' . e($tracksm[2]['name']) . '",
        "' . e($tracksm[2]['artist']) . '",
        "' . $tracksm[2]['img'] . '",
        "' . $tracksm[2]['id'] . '",

        "' . e($tracksm[3]['name']) . '",
        "' . e($tracksm[3]['artist']) . '",
        "' . $tracksm[3]['img'] . '",
        "' . $tracksm[3]['id'] . '",

        "' . e($tracksm[4]['name']) . '",
        "' . e($tracksm[4]['artist']) . '",
        "' . $tracksm[4]['img'] . '",
        "' . $tracksm[4]['id'] . '",

        "' . e($tracksm[5]['name']) . '",
        "' . e($tracksm[5]['artist']) . '",
        "' . $tracksm[5]['img'] . '",
        "' . $tracksm[5]['id'] . '",

        "' . e($tracksm[6]['name']) . '",
        "' . e($tracksm[6]['artist']) . '",
        "' . $tracksm[6]['img'] . '",
        "' . $tracksm[6]['id'] . '",

        "' . e($tracksm[7]['name']) . '",
        "' . e($tracksm[7]['artist']) . '",
        "' . $tracksm[7]['img'] . '",
        "' . $tracksm[7]['id'] . '",

        "' . e($tracksm[8]['name']) . '",
        "' . e($tracksm[8]['artist']) . '",
        "' . $tracksm[8]['img'] . '",
        "' . $tracksm[8]['id'] . '",

        "' . e($tracksm[9]['name']) . '",
        "' . e($tracksm[9]['artist']) . '",
        "' . $tracksm[9]['img'] . '",
        "' . $tracksm[9]['id'] . '",

        ' . (time() + 86400) . '
    )');
};

$result = mysqli_query($db, 'SELECT * FROM spotifyhytracks WHERE username=\'' . $username . '\'');
if (mysqli_num_rows($result) > 0) {
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };

    $trackshy = [
        [
            'name' => $result_arr[0]['track1'],
            'artist' => $result_arr[0]['artist1'],
            'img' => $result_arr[0]['img1'],
            'id' => $result_arr[0]['id1']
        ],
        [
            'name' => $result_arr[0]['track2'],
            'artist' => $result_arr[0]['artist2'],
            'img' => $result_arr[0]['img2'],
            'id' => $result_arr[0]['id2']
        ],
        [
            'name' => $result_arr[0]['track3'],
            'artist' => $result_arr[0]['artist3'],
            'img' => $result_arr[0]['img3'],
            'id' => $result_arr[0]['id3']
        ],
        [
            'name' => $result_arr[0]['track4'],
            'artist' => $result_arr[0]['artist4'],
            'img' => $result_arr[0]['img4'],
            'id' => $result_arr[0]['id4']
        ],
        [
            'name' => $result_arr[0]['track5'],
            'artist' => $result_arr[0]['artist5'],
            'img' => $result_arr[0]['img5'],
            'id' => $result_arr[0]['id5']
        ],
        [
            'name' => $result_arr[0]['track6'],
            'artist' => $result_arr[0]['artist6'],
            'img' => $result_arr[0]['img6'],
            'id' => $result_arr[0]['id6']
        ],
        [
            'name' => $result_arr[0]['track7'],
            'artist' => $result_arr[0]['artist7'],
            'img' => $result_arr[0]['img7'],
            'id' => $result_arr[0]['id7']
        ],
        [
            'name' => $result_arr[0]['track8'],
            'artist' => $result_arr[0]['artist8'],
            'img' => $result_arr[0]['img8'],
            'id' => $result_arr[0]['id8']
        ],
        [
            'name' => $result_arr[0]['track9'],
            'artist' => $result_arr[0]['artist9'],
            'img' => $result_arr[0]['img9'],
            'id' => $result_arr[0]['id9']
        ],
        [
            'name' => $result_arr[0]['track10'],
            'artist' => $result_arr[0]['artist10'],
            'img' => $result_arr[0]['img10'],
            'id' => $result_arr[0]['id10']
        ]
    ];
} else {
    $trackshy = $api->getMyTop('tracks', [
        'limit' => 10,
        'time_range' => 'medium_term'
    ]);
    
    $trackshy = array_map(function($track) {
        return [
            'name' => $track->name,
            'artist' => join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $track->artists)),
            'img' => $track->album->images[count($track->album->images) - 1]->url,
            'id' => $track->id
        ];
    }, $trackshy->items);

    mysqli_query($db, 'INSERT INTO spotifyhytracks (
        username,

        track1,
        artist1,
        img1,
        id1,

        track2,
        artist2,
        img2,
        id2,

        track3,
        artist3,
        img3,
        id3,
        
        track4,
        artist4,
        img4,
        id4,

        track5,
        artist5,
        img5,
        id5,

        track6,
        artist6,
        img6,
        id6,

        track7,
        artist7,
        img7,
        id7,

        track8,
        artist8,
        img8,
        id8,

        track9,
        artist9,
        img9,
        id9,

        track10,
        artist10,
        img10,
        id10,

        expiration_time
    ) VALUES (
        "' . $username . '",

        "' . e($trackshy[0]['name']) . '",
        "' . e($trackshy[0]['artist']) . '",
        "' . $trackshy[0]['img'] . '",
        "' . $trackshy[0]['id'] . '",

        "' . e($trackshy[1]['name']) . '",
        "' . e($trackshy[1]['artist']) . '",
        "' . $trackshy[1]['img'] . '",
        "' . $trackshy[1]['id'] . '",

        "' . e($trackshy[2]['name']) . '",
        "' . e($trackshy[2]['artist']) . '",
        "' . $trackshy[2]['img'] . '",
        "' . $trackshy[2]['id'] . '",

        "' . e($trackshy[3]['name']) . '",
        "' . e($trackshy[3]['artist']) . '",
        "' . $trackshy[3]['img'] . '",
        "' . $trackshy[3]['id'] . '",

        "' . e($trackshy[4]['name']) . '",
        "' . e($trackshy[4]['artist']) . '",
        "' . $trackshy[4]['img'] . '",
        "' . $trackshy[4]['id'] . '",

        "' . e($trackshy[5]['name']) . '",
        "' . e($trackshy[5]['artist']) . '",
        "' . $trackshy[5]['img'] . '",
        "' . $trackshy[5]['id'] . '",

        "' . e($trackshy[6]['name']) . '",
        "' . e($trackshy[6]['artist']) . '",
        "' . $trackshy[6]['img'] . '",
        "' . $trackshy[6]['id'] . '",

        "' . e($trackshy[7]['name']) . '",
        "' . e($trackshy[7]['artist']) . '",
        "' . $trackshy[7]['img'] . '",
        "' . $trackshy[7]['id'] . '",

        "' . e($trackshy[8]['name']) . '",
        "' . e($trackshy[8]['artist']) . '",
        "' . $trackshy[8]['img'] . '",
        "' . $trackshy[8]['id'] . '",

        "' . e($trackshy[9]['name']) . '",
        "' . e($trackshy[9]['artist']) . '",
        "' . $trackshy[9]['img'] . '",
        "' . $trackshy[9]['id'] . '",
        
        ' . (time() + 86400) . '
    )');
};

$result = mysqli_query($db, 'SELECT * FROM spotifyattracks WHERE username=\'' . $username . '\'');
if (mysqli_num_rows($result) > 0) {
    $result_arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($result_arr, $row);
    };

    $tracksat = [
        [
            'name' => $result_arr[0]['track1'],
            'artist' => $result_arr[0]['artist1'],
            'img' => $result_arr[0]['img1'],
            'id' => $result_arr[0]['id1']
        ],
        [
            'name' => $result_arr[0]['track2'],
            'artist' => $result_arr[0]['artist2'],
            'img' => $result_arr[0]['img2'],
            'id' => $result_arr[0]['id2']
        ],
        [
            'name' => $result_arr[0]['track3'],
            'artist' => $result_arr[0]['artist3'],
            'img' => $result_arr[0]['img3'],
            'id' => $result_arr[0]['id3']
        ],
        [
            'name' => $result_arr[0]['track4'],
            'artist' => $result_arr[0]['artist4'],
            'img' => $result_arr[0]['img4'],
            'id' => $result_arr[0]['id4']
        ],
        [
            'name' => $result_arr[0]['track5'],
            'artist' => $result_arr[0]['artist5'],
            'img' => $result_arr[0]['img5'],
            'id' => $result_arr[0]['id5']
        ],
        [
            'name' => $result_arr[0]['track6'],
            'artist' => $result_arr[0]['artist6'],
            'img' => $result_arr[0]['img6'],
            'id' => $result_arr[0]['id6']
        ],
        [
            'name' => $result_arr[0]['track7'],
            'artist' => $result_arr[0]['artist7'],
            'img' => $result_arr[0]['img7'],
            'id' => $result_arr[0]['id7']
        ],
        [
            'name' => $result_arr[0]['track8'],
            'artist' => $result_arr[0]['artist8'],
            'img' => $result_arr[0]['img8'],
            'id' => $result_arr[0]['id8']
        ],
        [
            'name' => $result_arr[0]['track9'],
            'artist' => $result_arr[0]['artist9'],
            'img' => $result_arr[0]['img9'],
            'id' => $result_arr[0]['id9']
        ],
        [
            'name' => $result_arr[0]['track10'],
            'artist' => $result_arr[0]['artist10'],
            'img' => $result_arr[0]['img10'],
            'id' => $result_arr[0]['id10']
        ]
    ];
} else {
    $tracksat = $api->getMyTop('tracks', [
        'limit' => 10,
        'time_range' => 'long_term'
    ]);

    $tracksat = array_map(function($track) {
        return [
            'name' => $track->name,
            'artist' => join(', ', array_map(function ($artist) {
                return $artist->name;
            }, $track->artists)),
            'img' => $track->album->images[count($track->album->images) - 1]->url,
            'id' => $track->id
        ];
    }, $tracksat->items);

    mysqli_query($db, 'INSERT INTO spotifyattracks (
        username,

        track1,
        artist1,
        img1,
        id1,

        track2,
        artist2,
        img2,
        id2,

        track3,
        artist3,
        img3,
        id3,
        
        track4,
        artist4,
        img4,
        id4,

        track5,
        artist5,
        img5,
        id5,

        track6,
        artist6,
        img6,
        id6,

        track7,
        artist7,
        img7,
        id7,

        track8,
        artist8,
        img8,
        id8,

        track9,
        artist9,
        img9,
        id9,

        track10,
        artist10,
        img10,
        id10,

        expiration_time
    ) VALUES (
        "' . $username . '",

        "' . e($tracksat[0]['name']) . '",
        "' . e($tracksat[0]['artist']) . '",
        "' . $tracksat[0]['img'] . '",
        "' . $tracksat[0]['id'] . '",

        "' . e($tracksat[1]['name']) . '",
        "' . e($tracksat[1]['artist']) . '",
        "' . $tracksat[1]['img'] . '",
        "' . $tracksat[1]['id'] . '",

        "' . e($tracksat[2]['name']) . '",
        "' . e($tracksat[2]['artist']) . '",
        "' . $tracksat[2]['img'] . '",
        "' . $tracksat[2]['id'] . '",

        "' . e($tracksat[3]['name']) . '",
        "' . e($tracksat[3]['artist']) . '",
        "' . $tracksat[3]['img'] . '",
        "' . $tracksat[3]['id'] . '",

        "' . e($tracksat[4]['name']) . '",
        "' . e($tracksat[4]['artist']) . '",
        "' . $tracksat[4]['img'] . '",
        "' . $tracksat[4]['id'] . '",

        "' . e($tracksat[5]['name']) . '",
        "' . e($tracksat[5]['artist']) . '",
        "' . $tracksat[5]['img'] . '",
        "' . $tracksat[5]['id'] . '",

        "' . e($tracksat[6]['name']) . '",
        "' . e($tracksat[6]['artist']) . '",
        "' . $tracksat[6]['img'] . '",
        "' . $tracksat[6]['id'] . '",

        "' . e($tracksat[7]['name']) . '",
        "' . e($tracksat[7]['artist']) . '",
        "' . $tracksat[7]['img'] . '",
        "' . $tracksat[7]['id'] . '",

        "' . e($tracksat[8]['name']) . '",
        "' . e($tracksat[8]['artist']) . '",
        "' . $tracksat[8]['img'] . '",
        "' . $tracksat[8]['id'] . '",

        "' . e($tracksat[9]['name']) . '",
        "' . e($tracksat[9]['artist']) . '",
        "' . $tracksat[9]['img'] . '",
        "' . $tracksat[9]['id'] . '",

        ' . (time() + 86400) . '
    )');
};

switch ($period) {
    case 'month':
        $tracks = $tracksm;
        break;

    case 'halfyear':
        $tracks = $trackshy;
        break;

    default:
        $tracks = $tracksat;
        break;
};

if (!$norender) switch ($req_url_split[3] ?? 'svg') {
    case 'svg':
        include 'src/apis/spotify/tracks/svg.php';
        break;
    
    case 'json':
        include 'src/apis/spotify/tracks/json.php';
        break;

    case 'html':
        include 'src/apis/spotify/tracks/html.php';
        break;
};
