<?php
    // include standard variables
    require 'headers.php';

    // create array of button names
    $add_friend_buttons_array = array();
    $remove_friend_buttons_array = array();

    function add_friend(&$uid, &$uidf) {
        $query = "INSERT INTO contact_list VALUE ('{$uid}', '{$uidf}')";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }

    function remove_friend(&$uid, &$uidf) {
        $query = "DELETE FROM contact_list WHERE username='{$uid}' AND contact='{$uidf}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }

    function check_friend(&$uid, &$uidf) {
        $query = "SELECT * FROM contact_list WHERE username = '{$uid}' AND contact = '{$uidf}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error : ". mysqli_error($_SESSION['link'])."\n");;

        if($result->num_rows == 0) {
            return false;
        } else { return true; }
    }
?>

<!DOCTYPE html>
<html>
    <style>
        .container {
            height: 200px;
            position: relative;
        }

        .vertical-center {
            margin-left: 45%;
            margin-right: 45%;
            position: absolute;
            top: 50%;
        }
    </style>
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
    
                            <!-- string variables to store button names -->
                            <?php $add_user = "add_" . $user;?>
                            <?php $remove_user = "remove_" . $user;?>

                            <!-- if the user and the contact are NOT already friends... -->
                            <?php 
                            if (!check_friend($_SESSION['username'], $user)) {      
                                // ... print an add friend button ... 
                                echo "<input type='submit' name='{$add_user}' value='Add {$user}'>";
                                // ... and push the add_user button to the list.
                                array_push($add_friend_buttons_array, array($add_user, $_SESSION['username'], $user));
                            }
                            ?>

                            <!-- if the user and the contact are already friends... -->
                            <?php 
                            if (check_friend($_SESSION['username'], $user)) {      
                                // ... print a remove friend button ... 
                                echo "<input type='submit' name='{$remove_user}' value='Remove {$user}'>";
                                // ... and push the remove_user button to the list.
                                array_push($remove_friend_buttons_array, array($remove_user, $_SESSION['username'], $user));
                            }
                            ?>

                            
                        </form>                    
                    </td>
                </tr>
                <?php
                    }
                ?>


            <!-- FINAL PHP SCRIPT -->
                <?php

                    $cnt = 0;
                    // loop through the array of add button names
                    // for every button name ... 
                    foreach ($add_friend_buttons_array as $key => $value_array) {
                        // ... check if button has been clicked ...
                        if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                            // ... then add respective user.
                            add_friend($value_array[1], $value_array[2]);
                            $cnt++;
                        }   
                    }

                    $cnt = 0;
                    // loop through the array of remove button names
                    // for every button name
                    foreach ($remove_friend_buttons_array as $key => $value_array) {
                        // ... check if button has been clicked ...
                        if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                            // ... then remove respective user.
                            remove_friend($value_array[1], $value_array[2]);
                            $cnt++;
                        }   
                    }

                ?>

            </table>

            <!-- need to work on the formatting of the button -->
            <div class="container">
                <div class='vertical-center'>
                    <a class='btn' href="contact_list.php"> View Contacts </a>
                </div>
            </div>
        </body>
    </head>
</html>
