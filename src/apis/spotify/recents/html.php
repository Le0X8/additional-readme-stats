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

            for ($i = 0; $i < $limit; $i++) {
                switch ($i) {
                    case 0:
                        $name = $name1;
                        $artist = $artist1;
                        $img = $img1;
                        $id = $id1;
                        break;
            
                    case 1:
                        $name = $name2;
                        $artist = $artist2;
                        $img = $img2;
                        $id = $id2;
                        break;
            
                    case 2:
                        $name = $name3;
                        $artist = $artist3;
                        $img = $img3;
                        $id = $id3;
                        break;
            
                    case 3:
                        $name = $name4;
                        $artist = $artist4;
                        $img = $img4;
                        $id = $id4;
                        break;
            
                    case 4:
                        $name = $name5;
                        $artist = $artist5;
                        $img = $img5;
                        $id = $id5;
                        break;
            
                    case 5:
                        $name = $name6;
                        $artist = $artist6;
                        $img = $img6;
                        $id = $id6;
                        break;
            
                    case 6:
                        $name = $name7;
                        $artist = $artist7;
                        $img = $img7;
                        $id = $id7;
                        break;
            
                    case 7:
                        $name = $name8;
                        $artist = $artist8;
                        $img = $img8;
                        $id = $id8;
                        break;
            
                    case 8:
                        $name = $name9;
                        $artist = $artist9;
                        $img = $img9;
                        $id = $id9;
                        break;
            
                    case 9:
                        $name = $name10;
                        $artist = $artist10;
                        $img = $img10;
                        $id = $id10;
                        break;
                };

                echo('<li><a href="https://open.spotify.com/track/' . $id . '"><img src="' . $img . '"><div><p>' . htmlspecialchars($name) . '</p><span>' . htmlspecialchars($artist) . '</span></div></a></li>');
            }; 
            ?>
        </ul>
        <b>All data is obtained from the official Spotify API. This project is not related to Spotify AB or any of its partners in any way.</b>
    </body>
</html>
