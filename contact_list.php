<?php
    // include standard variables
    require 'headers.php';

    // ~
    // Connecting, selecting database
    // $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Contact List </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>
            <h1> Contact List </h1>

            <?php
                // query the database or produce error message 
                // add name, id number
                $data_query = "SELECT username, email from users";
                $result = mysqli_query($link, $data_query) or die("Query error: ". mysquli_error($link)."\n");;

            ?>

            <table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
                <?php
                    while($result_r = mysqli_fetch_row($result)) {
                        $username = $result_r[0];
                        $email = $result_r[1];
                    
                ?>
                <tr valign="top">
                    <td>
                        <a href="#"> <?php echo $username;?> </a>
                    </td>
                    <td>
                        <a> <?php echo $email;?> </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </body>
    </head>
</html>
