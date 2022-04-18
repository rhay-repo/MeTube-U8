<!-- WORK IN PROGRESS
- NEED TO CREATE SQL TABLE WITH DATA TO FULLY IMPLEMENT
- NEED TO CREATE "FAVORITE BUTTON" IN FUNCTIONS.PHP -->

<?php
    // include standard variables
    require 'headers.php';
    
    // ~
    // Connecting, selecting database
    // $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    function remove_favorite(&$uid, &$file) {
        $query = "DELETE FROM favorite_list WHERE username='{$uid}' AND filepath='{$file}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
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
                $fav_query = "SELECT * from favorite_list";
                $fav_result = mysqli_query($link, $fav_query) or die("Query error: ". mysqli_error($link)."\n");

                $vid_query = "SELECT filepath, title from media";
                $vid_result = mysqli_query($link, $vid_query) or die("Query error: ". mysqli_error($link). "\n");
            ?>

            <table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Date Added</th>
                    <th>Media Name</th>
                    <th>Heart</th>
                </tr>
                <?php
                    while($result_rfav = mysqli_fetch_row($fav_result) && $result_rvid = mysqli_fetch_row($vid_result)) {
                        $date_added = $result_rfav[0];
                        $media_name = $result_rvid[1];
                    
                ?>
                <tr valign="top">
                    <td>
                        <a> <?php echo $date_added;?> </a>
                    </td>
                    <td>
                        <a href="#"> <?php echo $media_name;?> </a>
                    </td>
                    <td>
                        <button class="btn"> Favorite </button>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>

        </body>
    </head>
</html>
