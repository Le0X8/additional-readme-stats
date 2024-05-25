<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo(htmlspecialchars($title)); ?></title>
        <link rel="stylesheet" href="/css">
    </head>
    <body>
        <h1><?php echo(htmlspecialchars($title)); ?></h1>
        <ul>
            <?php
            $limit = 5;

            if (isset($query['limit']) && $query['limit'] >= 1 && $query['limit'] <= 10) {
                $limit = intval($query['limit']);
            };

            $hide_rank = false;
            if (isset($query['hide_rank']) && $query['hide_rank'] == 'true') {
                $hide_rank = true;
            };

            for ($i = 0; $i < $limit; $i++) {
                echo('<li><a href="https://open.spotify.com/artist/' . $artists[$i]['id'] . '">' . ($hide_rank ? '' : '<i>' . $i + 1 . '</i>') . '<img src="' . $artists[$i]['img'] . '"><div><span></span><p>' . htmlspecialchars($artists[$i]['name']) . '</p></div></a></li>');
            };
            ?>
        </ul>
        <b>All data is obtained from the official Spotify API. This project is not related to Spotify AB or any of its partners in any way.</b>
    </body>
</html>
