<?php

    // login vars
    require 'headers.php';

    // gather session variables
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
    <body>
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

        <?php 

            // if the user updates their username...
            if (isset($_POST['update_username_button'])) {
                // assign the new username
                $new_username = $_POST['new_username'];
                // update the that user's username in the database
                $query = "UPDATE users SET username='{$new_username}' WHERE username='{$username}'";
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
                $new_email = $_POST['new_password'];
                // update the that user's password in the database
                $query = "UPDATE users SET password='{$new_password}' WHERE username='{$username}' AND email='{$email}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");
            }

        ?>
    </body>
</head>
</html>
