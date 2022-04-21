<?php
    // include standard variables
    require 'headers.php';

    //~
    // Connecting, selecting database
    //$link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));
?>

<!DOCTYPE html>
<html>
<head>
<title>Account Registration Page Design</title>
    <link rel="stylesheet" type="text/css" href="login-style.css">
<body>
    <div class="loginbox">
    <img src="profile-icon.jpg" class="avatar">
        <h1>MeTube Login</h1>

        <!-- begin form -->
        <form id="login" method="post">

            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username">
            
            <p>Password</p>
            <input type="password" name="password" placeholder="Password">

            <input type="submit" name="loginbutton" value="Login">
            <!--~ <a href="too-bad.html">Forgot your password?</a><br> -->
            <a href="register.php">Don't have an account? Register here</a>
        </form>


        <!-- begin new stuff -->
<?php

    $err_counter = 0;

        if (isset($_POST['loginbutton'])) {

            // gather variable info from html form
            $username = $_POST['username']; // gathered from name 'username'
            $password = $_POST['password']; // gathered from name 'password'
            

            // query: find how mnay users have the name $username
            // $count_users_query = "SELECT COUNT(*) as cnt from users where username='{$username}'";
            $count_users_query = "SELECT username from users where username='{$username}'";
            $count_users_result = mysqli_query($link, $count_users_query) or die("Query error: ". mysqli_error($link)."\n");

            $matching_password_query = "SELECT * from users WHERE username='{$username}' and password='{$password}'";
            $matching_password_result = mysqli_query($link, $matching_password_query) or die("Query error: ". mysqli_error($link)."\n");
            
            // deny if any field is blank
            if ($username == '' or $password == '') {
                $error .= "<h3>no field can be left blank!</h3><br>";
                $err_counter++;
            }

            elseif ($count_users_result->num_rows == 0) {
                $error .= "<h3>username $username does not exist!</h3><br>";
                $err_counter++;
            }


            elseif ($matching_password_result->num_rows == 0) {
                $error .= "<h3>incorrect password</h3><br>";
                $err_counter++;
            }


            if ($err_counter > 0) {
                echo $error;
            }

            // otherwise, accept the login and add take the user to the home page
            else {

                // save session variable values
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                // set session email (HAVE TO RETREIVE FROM DATABASE)
                $query = "SELECT email from users where username='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");
                $result_row = mysqli_fetch_row($result);
                $email = $result_row[0];
                $_SESSION['email'] = $email;

                header('Location: view_profile.php');
            }

        }

mysqli_close($link);
?>
        <!-- end new stuff -->

    </div>

</body>
</head>
</html>