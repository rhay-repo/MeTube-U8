<?php
    // include standard variables
    require 'headers.php';
    
    // ~
    // Connecting, selecting database
    // $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    $view_playlist_array = array();
    $del_playlist_array = array();

    function delete_playlist(&$playlist) {
        $query = "DELETE FROM playlist WHERE username='{$_SESSION['username']}' AND playlist_title='{$playlist}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Playlists </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>
            <h1> Playlists </h1>

            <?php
                $query = "SELECT * FROM playlist WHERE username = '{$_SESSION['username']}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link). "\n");
            ?>

            <table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Date Added</th>
                    <th>Playlist Name</th>
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
                        <a> <?php echo $playlist;?> </a>
                    </td>
                    <td>
                    <form action="view_playlists.php" method="post">
                        <?php $view_playlist = "view_" . $playlist;?>
                        <?php $_SESSION['playlist'] = $playlist; ?>
                        <input type='submit' name=<?php echo $view_playlist; ?> value='View'>
                    </form>                                     
                    </td>
                    <td>
                        <form method='post'>
                            <?php $delete_playlist = "del_".$playlist;?>
                            <input type='submit' name=<?php echo $delete_playlist; ?> value='Delete'>
                            <?php array_push($del_playlist_array, array($delete_playlist, $_SESSION['username'], $playlist)); ?>
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
                    foreach ($del_playlist_array as $key => $value_array) {
                        // ... check if button has been clicked ...
                        if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                            // ... then add respective user.
                            delete_playlist($value_array[2]);
                            $cnt++;
                        }   
                    }
                ?>
            </table>
        </body>
    </head>
</html>
