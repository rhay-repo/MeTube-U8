<!-- WORK IN PROGRESS
- NEED TO CREATE SQL TABLE WITH DATA TO FULLY IMPLEMENT
- NEED TO CREATE "FAVORITE BUTTON" IN FUNCTIONS.PHP -->

<?php
    // include standard variables
    require 'headers.php';
    
    // ~
    // Connecting, selecting database
    // $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    $add_favorite_buttons_array = array();
    $remove_favorite_buttons_array = array();

    function favorite(&$uid, &$file) {
			$query = "INSERT INTO favorite_list VALUE ('{$uid}', '{$file}', curdate())";
			$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
	}

    function remove_favorite(&$uid, &$file) {
        $query = "DELETE FROM favorite_list WHERE username='{$uid}' AND filepath='{$file}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }

    function check_favorite(&$uid, &$file) {
        $query = "SELECT * FROM favorite_list WHERE username = '{$uid}' AND filepath = '{$file}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error : ". mysqli_error($_SESSION['link'])."\n");;

        if($result->num_rows == 0) {
            return false;
        } else { return true; }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Favorites List </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>
            <h1> Favorites List </h1>

            <?php
                // query the database or produce error message 
                // $fav_query = "SELECT * from favorite_list";
                // $fav_result = mysqli_query($link, $fav_query) or die("Query error: ". mysqli_error($link)."\n");

                // while($result_r = mysqli_fetch_row($fav_result)) {
                //     $user = $result_r[0]; 
                //     $file = $result_r[1];
                //     $time = $result_r[2];
                // }

                // $vid_query = "SELECT title FROM media WHERE filepath='{$file}'";
                // $vid_result = mysqli_query($link, $vid_query) or die("Query error: ". mysqli_error($link). "\n");

                $fav = "SELECT favorite_list.username, favorite_list.time, media.title FROM favorite_list INNER JOIN media ON favorite_list.filepath = media.title WHERE favorite_list.username = media.username";
                $f_result = mysqli_query($link, $fav) or die("Query error: ". mysqli_error($link). "\n");

            ?>

            <table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Date Added</th>
                    <th>Media Name</th>
                    <th>Heart</th>
                </tr>
                <?php
                    while($result_r = mysqli_fetch_row($f_result)) {
                    // while($result_rfav = mysqli_fetch_row($fav_result) && $result_rvid = mysqli_fetch_row($vid_result)) {
                        $username = $result_r[0];
                        $time = $result_r[1];
                        $media_name = $result_r[2];

                        echo $username ." ". $time ." ". $media_name ."\n";
                    
                ?>
                <tr valign="top">
                    <td>
                        <a> <?php echo $time;?> </a>
                    </td>
                    <td>
                        <a href="#"> <?php echo $media_name;?> </a>
                    </td>
                    <td>
                    <form method="post">
                        
                        <!-- string variables to store button names -->
                        <?php $add_fav = "add_" . $media_name;?>
                        <?php $remove_fav = "remove_" . $media_name;?>

                        <!-- if the user and the contact are NOT already friends... -->
                        <?php 
                        if (!check_favorite($_SESSION['username'], $media_name)) {      
                            // ... print an add friend button ... 
                            echo "<input type='submit' name='{$add_fav}' value='Add {$media_name}'>";
                            // ... and push the add_user button to the list.
                            array_push($add_favorite_buttons_array, array($add_fav, $_SESSION['username'], $media_name));
                        }
                        ?>

                        <!-- if the user and the contact are already friends... -->
                        <?php 
                        if (check_favorite($_SESSION['username'], $media_name)) {      
                            // ... print a remove friend button ... 
                            echo "<input type='submit' name='{$remove_fav}' value='Remove {$media_name}'>";
                            // ... and push the remove_user button to the list.
                            array_push($remove_favorite_buttons_array, array($remove_fav, $_SESSION['username'], $media_name));
                        }
                        ?>

                        
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
                    foreach ($add_favorite_buttons_array as $key => $value_array) {
                        // ... check if button has been clicked ...
                        if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                            // ... then add respective user.
                            favorite($value_array[1], $value_array[2]);
                            $cnt++;
                        }   
                    }

                    $cnt = 0;
                    // loop through the array of remove button names
                    // for every button name
                    foreach ($remove_favorite_buttons_array as $key => $value_array) {
                        // ... check if button has been clicked ...
                        if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                            // ... then remove respective user.
                            remove_favorite($value_array[1], $value_array[2]);
                            $cnt++;
                        }   
                    }

                ?>
            </table>

        </body>
    </head>
</html>
