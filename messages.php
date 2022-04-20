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
                <h2>Type in someone's username:</h2>
                <input type="text" id="recipient_username" name="recipient_username"><br>
                <h2>Type in your message:</h2>
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
                }

                // query for users sending and receiving messages in the correct order
                $query = "SELECT `sender`, `message_text` FROM `direct_messages` WHERE sender='{$sender}' AND recipient='{$recipient}' OR sender='{$recipient}' AND recipient='{$sender}' ORDER BY datetime";
                $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");

            ?>

            <table width="25%" cellpadding="0.5" cellspacing="0.5">
            <!-- loop through every row of results and print user and their message -->
            <?php 
            while($result_r = mysqli_fetch_row($result)){
                $the_sender = $result_r[0];     
                $the_message = $result_r[1];
                if ($the_sender == $sender) {
                    echo "<tr><th><h4 class='message'><span class='sender'>{$the_sender}:</span> {$the_message}</h4></th></tr>";
                }
                else {
                    echo "<tr><th><h4 class='message'><span class='recipient'>{$the_sender}:</span> {$the_message}</h4></th></tr>";
                }
            }
            ?>

            <!-- INBOX / OUTBOX -->
            <iframe src="messages_inbox_outbox.php" style="height:20%;width:300px" title="Iframe Example"></iframe>

            </table>

        </body>
    </head>
</html>
