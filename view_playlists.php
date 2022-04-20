<?php
    // include standard variables
    require 'headers.php';
    
    // ~
    // Connecting, selecting database
    // $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    $view_media_array = array();
    $del_media_array = array();

    function delete_media(&$media) {
        $query = "DELETE FROM playlist WHERE username='{$_SESSION['username']}' AND filepath='{$media}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }

    function gotoMedia(&$media) {
        $_SESSION['media_id'] = $media;
        header("Location: media.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> View Playlists </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>
            <?php 
                $_SESSION['playlist'] = 'my first playlist!';
                // $playlist = $_SESSION['playlist'];
            ?>

            <h1> <?php echo $_SESSION['playlist']; ?> Playlist </h1>

            <?php
                $query = "SELECT * FROM playlist WHERE username = '{$_SESSION['username']}' AND playlist_title = '{$_SESSION['playlist']}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link). "\n");
            ?>

            <table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Date Added</th>
                    <th>Media Title</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                <?php
                    while($result_r = mysqli_fetch_row($result)) {
                        $file_title = $result_r[0];
                        $username = $result_r[1];
                        $playlist = $result_r[2]; 
                        $time = $result_r[3];   
                ?>
                <tr valign="top">
                    <td>
                        <a> <?php echo $time;?> </a>
                    </td>
                    <td>
                        <a> <?php echo $file_title;?> </a>
                    </td>
                    <td>
                    <form method="post">
                        <?php $view_media = "view_" . $file_title;?>
                        <input type='submit' name=<?php echo $view_media; ?> value='View'>
                        <?php array_push($view_media_array, array($view_media, $_SESSION['username'], $file_title)); ?>
                    </form>                                     
                    </td>
                    <td>
                        <form method='post'>
                            <?php $delete_media = "del_".$file_title;?>
                            <input type='submit' name=<?php echo $delete_media; ?> value='Delete'>
                            <?php array_push($del_media_array, array($delete_media, $_SESSION['username'], $file_title)); ?>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                ?>

                <?php

                    $cnt = 0;
                    // loop through the array of add button names
                    // for every button name ... 
                    foreach ($del_media_array as $key => $value_array) {
                        // ... check if button has been clicked ...
                        if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                            // ... then add respective user.
                            delete_media($value_array[2]);
                            $cnt++;
                        }   
                    }

                    $cnt = 0;
                    // loop through the array of add button names
                    // for every button name ... 
                    foreach ($view_media_array as $key => $value_array) {
                        // ... check if button has been clicked ...
                        if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                            // ... then add respective user.
                            gotoMedia($value_array[2]);
                            $cnt++;
                        }   
                    }

                ?>
            </table>
        </body>
    </head>
</html>
