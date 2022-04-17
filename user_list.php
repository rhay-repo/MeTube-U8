<?php
    // include standard variables
   // session_start();
    require 'headers.php';
    
    // ~
    // Connecting, selecting database
    //$link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    function add_friend(&$uid, &$uidf) {
        $query = "INSERT INTO contact_list VALUE ('{$uid}', '{$uidf}')";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }

    function remove_friend(&$uid, &$uidf) {
        $query = "DELETE FROM contact_list WHERE username='{$uid}' AND contact='{$uidf}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }

    function check_friend(&$uid, &$uidf) {
        $query = "SELECT * FROM contact_list WHERE username = '{$uid} AND contact = '{$uidf}'";
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
        <title> User List </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>
            <h1> User List </h1>
            <h1> Look for new friends! </h1>

            <?php
                // query the database or produce error message 
                // add name, id number
                $data_query = "SELECT username, email from users";
                $result = mysqli_query($link, $data_query) or die("Query error: ". mysqli_error($link)."\n");;

            ?>

            <table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Friend</th>
                </tr>
                <?php
                    while($result_r = mysqli_fetch_row($result)) {
                        $user = $result_r[0];
                        $email = $result_r[1];
                    
                ?>
                <tr valign="top">
                    <td>
                        <a> <?php echo $user;?> </a>
                    </td>
                    <td>
                        <a> <?php echo $email;?> </a>
                    </td>
                    <td>
                        <form method="post">
    
                                <button class="btn" type="submit" name="add" value=<?php $user ?>> Add Friend </button>
                                <button class="btn" type="submit" name="remove" value=<?php $user ?>> Remove Friend </button>


                        </form>                    
                    </td>
                </tr>
                <?php
                    }
                ?>

                    <?php
                        if(array_key_exists('add', $_POST)) {
                            $mainuser = $_SESSION['username'];
                            // echo "help!". $mainuser ."\n";
                            // echo $user;
                            add_friend($mainuser, $user);
                        }

                        if(array_key_exists('remove', $_POST)) {
                            $mainuser = $_SESSION['username'];
                            // echo "help!". $mainuser ."\n";
                            // echo $user;
                            remove_friend($mainuser, $user);
                        }
                    ?>
            </table>

            <!-- need to work on the formatting of the button -->
            <a href="contact_list.php"> View Contacts </a>
            <h1>  </h1>
        </body>
    </head>
</html>
