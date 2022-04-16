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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Contact List </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>
            <h1> Contact List </h1>

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
                    <th>Connection</th>
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
                        <button class="btn"> Remove Friend </button>
                    </td>
                    <td>
                   
                    <form method="post">
                            <!-- <input type="submit" name="add"
                             class="button" value="ADD" /> -->
                            <button type="submit" name="add" value=<?php $user ?>> Add </button>
                    </form>
                    </label>

                    </td>
                </tr>
                <?php
                    }
                ?>

                <?php
                            if(array_key_exists('add', $_POST)) {
                                $mainuser = $_SESSION['username'];
                                echo "help!". $mainuser ."\n";
                                echo $user;
                                add_friend($_SESSION['username'], $user);
                            }
                    ?>
            </table>

        </body>
    </head>
</html>
