<?php
    // include standard variables
   // session_start();
    require 'headers.php';
    
    // ~
    // Connecting, selecting database
    //$link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    function add_friend(&$uid, &$uidf) {
        // echo $uid ."\n";
        // echo $uidf ."\n";
        $query = "INSERT INTO contact_list VALUE ('{$uid}', '{$uidf}')";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }

    function remove_friend(&$uid, &$uidf) {
        $query = "DELETE FROM contact_list WHERE username='{$uid}' AND contact='{$uidf}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Contact List </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>
            <h1> Contact List </h1>
            <h1> View your Friends here! </h1>

            <?php
                // query the database or produce error message 
                // add name, id number
                $data_query = "SELECT contact FROM contact_list WHERE username='{$_SESSION['username']}'";
                $result = mysqli_query($link, $data_query) or die("Query error: ". mysqli_error($link)."\n");;

            ?>

            <table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Username</th>
                    <th>Connection</th>
                </tr>
                <?php
                    while($result_r = mysqli_fetch_row($result)) {
                        $user = $result_r[0];                    
                ?>
                <tr valign="top">
                    <td>
                        <a> <?php echo $user;?> </a>
                    </td>
                    <td>
                        <form method="post">
                            <button class="btn" type="submit" name="remove" value=<?php $user ?>> Remove Friend </button>
                        </form>


                    </td>
                </tr>
                <?php
                    }
                ?>

                <?php    
                            if(array_key_exists('remove', $_POST)) {
                                $mainuser = $_SESSION['username'];
                                // echo "help!". $mainuser ."\n";
                                // echo $user;
                                remove_friend($mainuser, $user);
                            }
                    ?>
            </table>

            <!-- need to work on the formatting of the button -->
            <a text-align="center" href="user_list.php"> View User List </a>
            <h1> </h1>
        </body>
    </head>
</html>
