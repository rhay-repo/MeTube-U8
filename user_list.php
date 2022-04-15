<?php
    // include standard variables
    require 'headers.php';
    
    // ~
    // Connecting, selecting database
    // $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));
    function add_friend(&$uid, &$uidf) {
        $query = "INSERT INTO contact_list VALUE ($uid, $uidf)";
        $result = mysqli_query($link, $query) or die("Query error: ". mysquli_error($link)."\n");;
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
                $result = mysqli_query($link, $data_query) or die("Query error: ". mysquli_error($link)."\n");;

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
                        <a href="#"> <?php echo $user;?> </a>
                    </td>
                    <td>
                        <a> <?php echo $email;?> </a>
                    </td>
                    <td>
                        <button class="btn" onClick=<?php add_friend($username, $user)?>> Friend </button>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>

        </body>
    </head>
</html>
