<?php
    // include standard variables
    require 'headers_no_navbar.php';

    // direct message array
    $dm_array = array();

    function print_inbox_message(&$uid, &$uidf) {
        $query = "SELECT recipient FROM contact_list where sender='{$uid}' and recipient='{$uidf}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
    }
    


?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> User List </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body style="background:black">

            <h1 style="background-color:DodgerBlue;">INBOX</h1>
            
            <?php 
                $query1 = "SELECT DISTINCT `recipient` FROM `direct_messages` WHERE sender='{$_SESSION['username']}' ORDER BY datetime";

                $result1 = mysqli_query($_SESSION['link'], $query1) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");

                
                while($result_r1 = mysqli_fetch_row($result1)){

                    $the_recipient = $result_r1[0];   

                    $query2 = "SELECT `message_text` FROM `direct_messages` WHERE sender='{$the_recipient}' AND recipient='{$_SESSION['username']}' ORDER BY datetime DESC LIMIT 1";
                    $result2 = mysqli_query($_SESSION['link'], $query2) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
                    $result_r2 = mysqli_fetch_row($result2);
                    if ($result_r2 != NULL) {
                        $the_message = $result_r2[0];
                        

                        echo "<h4 style=\"color:white\">From {$the_recipient}: {$the_message}</h4>";
                        

                        // BUTTON: reply to contact
                        echo "<form method='post' value='{$the_recipient}'>";
                        $replyto_recipient = "replyto_" . $the_recipient;

                            //  $_SESSION['media_id'] = $title; 

                            // echo "<input type='submit' name='{$title}' value='Go to {$title}'>";
                        array_push($dm_array, array($_SESSION['username'], $the_recipient));

                        echo "<input type='submit' name='{$replyto_recipient}' value='Reply to {$the_recipient}'>";
                        echo "<meta http-equiv='refresh' content='5'>";
                        echo "</form>";
                    } // close if statement
                    
                } // close while loop

            
            ?> 


            <br>

            <h1 style="background-color:DodgerBlue;">OUTBOX</h1>

            <?php 
                $query1 = "SELECT DISTINCT `recipient` FROM `direct_messages` WHERE sender='{$_SESSION['username']}' ORDER BY datetime";

                $result1 = mysqli_query($_SESSION['link'], $query1) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");

                
                while($result_r1 = mysqli_fetch_row($result1)){

                    $the_recipient = $result_r1[0];   

                    $query2 = "SELECT `message_text` FROM `direct_messages` WHERE recipient='{$the_recipient}' AND sender='{$_SESSION['username']}' ORDER BY datetime DESC LIMIT 1";
                    $result2 = mysqli_query($_SESSION['link'], $query2) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
                    $result_r2 = mysqli_fetch_row($result2);
                    if ($result_r2 != NULL) {
                        $the_message = $result_r2[0];

                        echo "<h4 style=\"color:white\">Sent to {$the_recipient}: {$the_message}</h4>";
                    }
                    
                }

            
            ?> 
            


        </body>
    </head>
</html>