<?php

    // login vars
    require 'headers.php';

    // gather session variables
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    $query = "SELECT viewing FROM users WHERE username='{$username}'";
    $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

    while($r = $result->fetch_row()) {
        $viewing = $r[0];
    }

    // refresh the page to update session vars
    // header("Location: edit_profile.php");
	
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        p {
			text-align: center; 
			color: white;
		}
        form {
            margin: auto; 
            width: 220px;
        }
    </style>
    <title> Settings </title>
    <link rel="stylesheet" type="text/css" href="homepage-style.css">

    <body>
        <h1> Edit Profile: </h1>
        <form method="POST">
            <?php echo "<p>Username: " . $username . "</p>"; ?>
            <input type="text" name="new_username" placeholder="New Username"> 
            <input type="submit" name="update_username_button" value="Save Changes">
        </form>

        <form method="POST">
            <?php echo "<p>Email Address: $email</p>"; ?>
            <input type="text" name="new_email" placeholder="New Email">
            <input type="submit" name="update_email_button" value="Save Changes">
        </form>

        <form method="POST">
            <?php echo "<p>Password</p>"; ?>
            <input type="password" name="new_password" placeholder="New Password">
            <input type="submit" name="update_password_button" value="Save Changes">
        </form>

        <form method="POST">
            <?php echo "<p>Viewing: ".$viewing." </p>"; ?>
            <input type="text" name="new_view" placeholder="Public or Private">
            <input type="submit" name="update_view_button" value="Save Changes">
        </form>
        <!-- <br>
        <div class="form-group">
                <label for="view">Profile Viewing:</label>
                <select class="form-control" name="new_view" id="view">
                    <option value="Public">Public</option>
                    <option value="Private">Private</option>
                </select>
        </div>
        <button type="submit" name="update_view_button">Save Changes</button> -->

        <?php 

            // if the user updates their username IN EVERY TABLE
            if (isset($_POST['update_username_button'])) {
                // assign the new username
                $new_username = $_POST['new_username'];


                // ~~ EXECUTE SHELL COMMAND TO CHANGE THEIR FILEPATH ON THE WEBSERVER


                // ~~ CHANGE ALL ENTRIES OF THE FILE PATH IN THE DATABASE TOO


                // update the that user's username TABLE: users -> username
                $query = "UPDATE users SET username='{$new_username}' WHERE username='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");


                // comments
                // TABLE: comments -> reply_of
                $query = "UPDATE comments SET reply_of='{$new_username}' WHERE reply_of='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

                // TABLE: comments -> username
                $query = "UPDATE comments SET username='{$new_username}' WHERE username='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");


                // contact_list
                // TABLE: contact_list -> username
                $query = "UPDATE contact_list SET username='{$new_username}' WHERE username='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

                // TABLE: contact_list -> contact
                $query = "UPDATE contact_list SET contact='{$new_username}' WHERE contact='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");


                // direct_messages
                // TABLE: direct_messages -> sender
                $query = "UPDATE direct_messages SET sender='{$new_username}' WHERE sender='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

                // TABLE: direct_messages -> recipient
                $query = "UPDATE direct_messages SET recipient='{$new_username}' WHERE recipient='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");


                // favorite_list
                // TABLE: favorite_list -> username
                $query = "UPDATE favorite_list SET username='{$new_username}' WHERE username='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");


                // media
                // TABLE: media -> username
                $query = "UPDATE media SET username='{$new_username}' WHERE username='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");


                // playlist
                // TABLE: playlist -> username
                $query = "UPDATE playlist SET username='{$new_username}' WHERE username='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");


                // subscribe
                // TABLE: subscribe -> user
                $query = "UPDATE subscribe SET user='{$new_username}' WHERE user='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

                // TABLE: subscribe -> channel
                $query = "UPDATE subscribe SET channel='{$new_username}' WHERE channel='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");
                


                // replace the session username with the new username
                $_SESSION['username'] = $new_username;
            }

            // if the user updates their email...
            elseif (isset($_POST['update_email_button'])) {
                // assign the new email address
                $new_email = $_POST['new_email'];
                // update the that user's email address in the database
                $query = "UPDATE users SET email='{$new_email}' WHERE email='{$email}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");
                // replace the session email with the new email
                $_SESSION['email'] = $new_email;
            }

            // if the user updates their 
            elseif (isset($_POST['update_password_button'])) {
                // assign the new password
                $new_password = $_POST['new_password'];
                // update the that user's password in the database
                $query = "UPDATE users SET password='{$new_password}' WHERE username='{$username}' AND email='{$email}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");
            }

        ?>
    </body>
</head>
</html>
