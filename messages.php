<?php
    // include standard variables
    require 'headers.php';

    function send_message(&$sender, &$recipient, &$message_text) {
        $query = "INSERT INTO direct_messages VALUES ('{$sender}', '{$recipient}', '{$message_text}', NOW())";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
    }

?>

<!DOCTYPE html>
<html>
<style>
textarea { resize: none; }
.message { text-align: left; font-size: 20px; }
.sender { color: blue }
.recipient { color: red }
.text { color: white }
</style>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Messages </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>
            <h1> Messages </h1>
            <h1> Message people on MeTube! </h1>

            <form method="POST">
                <h2 style="text-align:left;">To message someone for the first time or reply to them, type in their username:</h2>
                <input type="text" id="recipient_username" name="recipient_username"><br>
                <h2 style="text-align:left;">Type in your message:</h2>
                <textarea id="message_text" name="message_text" rows="4"></textarea><br>
                <input type='submit' name='send_message_button' value='Send Message!'>
            </form>

            <?php
                if (isset($_POST['send_message_button'])) {
                    $sender = $_SESSION['username'];
                    $recipient = $_POST['recipient_username'];
                    $message_text = $_POST['message_text'];
                    $query = "INSERT INTO direct_messages VALUES ('{$sender}', '{$recipient}', '{$message_text}', NOW())";
                    $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
                

                    // query for users sending and receiving messages in the correct order
                    $query = "SELECT `sender`, `message_text` FROM `direct_messages` WHERE sender='{$sender}' AND recipient='{$recipient}' OR sender='{$recipient}' AND recipient='{$sender}' ORDER BY datetime";
                    $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
                }
            ?>


            <!-- BEGIN TABLE -->
            <table width="25%" cellpadding="0.5" cellspacing="0.5">
            
            <tr>
                <!-- RIGHT COLUMN: IN/OUTBOX -->
                <!-- loop through every row of results and print user and their message -->
                <td>
                    <iframe src="messages_inbox_outbox.php" style="height:500px;width:500px" title="Iframe Example"></iframe>
                </td>

                <!-- LEFT COLUMN: MESSAGES -->
                <td>
                    <?php 
                    if (isset($_POST['send_message_button'])) {
                        while($result_r = mysqli_fetch_row($result)){
                            $the_sender = $result_r[0];     
                            $the_message = $result_r[1];
                            if ($the_sender == $sender) {
                                echo "<tr><th><h4 class='message'><span class='sender'>{$the_sender}:</span> {$the_message}</h4></th></tr>";
                                // echo "<input = submit "
                            }
                            else {
                                echo "<tr><th><h4 class='message'><span class='recipient'>{$the_sender}:</span> {$the_message}</h4></th></tr>";
                            }
                        }
                    }
                    ?>
                </td>

            </tr>

            </table>

        </body>
    </head>
</html>
