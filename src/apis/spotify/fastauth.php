<?php 
    setcookie('fastauth', 'true', array(
        'path' => '/spotify'
    ));
?><!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify API Fast Auth</title>
</head>
<body>
    <noscript><a href="<?php echo($session->getAuthorizeUrl($options)); ?>">Authorize</a></noscript>
    <script>
        window.location.href = "<?php echo($session->getAuthorizeUrl($options)); ?>";
    </script>
</body>
</html><?php die(); ?>