<?php header('Location: https://open.spotify.com/' . $type . '/' . $id); ?><!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(htmlspecialchars($title)); ?></title>
    <link rel="stylesheet" href="/css">
    <meta http-equiv="refresh" content="0; url=https://open.spotify.com/<?php echo($type); ?>/<?php echo($id); ?>" />
</head>
<body>
    <h1><?php echo(htmlspecialchars($title)); ?></h1>

    <b>You will be redirected automatically, please wait...</b>
    <br><br><br>
    <b>All data is obtained from the official Spotify API. This project is not related to Spotify AB or any of its partners in any way.</b>
    <script>
        window.location.href = 'https://open.spotify.com/<?php echo($type); ?>/<?php echo($id); ?>';
    </script>
</body>
</html>