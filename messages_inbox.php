<?php
    // include standard variables
    require 'headers.php';

    function print_inbox_message(&$uid, &$uidf) {
        $query = "SELECT FROM contact_list VALUE ('{$uid}', '{$uidf}')";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> User List </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>

            <h1>INBOX</h1>
            <br>
            echo date('H:i:s Y-m-d');
            CURDATE();
            CURTIME();
            


        </body>
    </head>
</html>