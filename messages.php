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
textarea {
    resize: none;
}
</style>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> User List </title>
        <link rel="stylesheet" type="text/css" href="general-style.css">
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
                    // send_message($_SESSION['username'], $_POST['recipient_username'], $_POST['message_text']);
                    // $query = "INSERT INTO direct_messages VALUES ('{$_SESSION['username']}', '{$_POST['recipient_username']}', '{$_POST['message_text']}', NOW())";
                    $query = "INSERT INTO direct_messages VALUES ('{$sender}', '{$recipient}', '{$message_text}', NOW())";
                    $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
                }

                

                echo 
                '<table class="table center" id="messages" width="85%" cellpadding="1" cellspacing="1">
                    <tr>
                        <th>Title</th>
                        <th>Keywords</th>
                        <th>Date Published</th>
                        <th>Favorite Media</th>
                    </tr>';
                        
                    if ($result->num_rows > 0) {
                        while($result_r = mysqli_fetch_row($result)){
                            $title = $result_r[3];     
                            $keywords = $result_r[8]; 
                            $date_published = $result_r[6]; 
                        
                    
                        echo '<tr valign="top">
                            <td>
                                <a>' .$title;
                        echo '
                                </td>
                                <td>
                                    <a>' .$keywords;
                        echo '</a>
                                </td>
                                <td>
                                    <a>' .$date_published;
                        echo '</a>
                                </td>
                                <td>
                                </td>
                                </tr>';
                        }
        }


            ?>

            

            
        </body>
    </head>
</html>
