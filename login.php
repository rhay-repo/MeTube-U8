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
            <a href="http://webapp.computing.clemson.edu/~rjhay/MeTube/too-bad.html?#">Forgot your password?</a><br>
            <a href="http://webapp.computing.clemson.edu/~rjhay/MeTube/register.php?#">Don't have an account? Register here</a>
        </form>


        <!-- begin new stuff -->
<?php

    $err_counter = 0;

        if (isset($_POST['loginbutton'])) {

            // gather variable info from html form
            $username = $_POST['username']; // gathered from name 'username'
            $password = $_POST['password']; // gathered from name 'password'

            //~
            // // gather variable info from html form
            // $check_username_query = "SELECT * from users WHERE username='{$username}'";
            // $check_username_result = mysqli_query($link, $check_username_query) or die("Query error: ". mysqli_error($link)."\n");

            // // loop through all results to see if it's empty
            // $counter = 0;
            // while ($line = mysqli_fetch_array($check_username_result, MYSQLI_ASSOC)){
            //     // loop through each column
            //     foreach($line as $col_value){	
            //         if ($col_value == '' and $counter < 1) {
            //             $error .= "<h3>username $username does not exist!</h3><br>";
            //             $err_counter++;
            //             $counter++;
            //         }
            //     }	
            // }


            //~
            // print the count query
            // $count_users_query = "SELECT COUNT(*) as cnt from users where username='{$username}'";
            // $count_users_result = mysqli_query($link, $count_users_query) or die("Query error: ". mysqli_error($link)."\n");

            // while ($row = $count_users_result->fetch_assoc()) {
            //     $username_occurrences = $row['cnt'];
            //     echo $row['cnt']."<br>";
            // }

            // if ($username_occurrences < 1) {
            //     $error .= "<h3>username $username does not exist!</h3><br>";
            //     $err_counter++;
            // }

            // print the count query
            $count_users_query = "SELECT COUNT(*) as cnt from users where username='{$username}'";
            $count_users_result = mysqli_query($link, $count_users_query) or die("Query error: ". mysqli_error($link)."\n");

            if($count_users_result->num_rows == 0) {
                $error .= "<h3>username $username does not exist!</h3><br>";
                $err_counter++;
            }

            echo "number of users with the username $username = " . $count_users_result->num_rows . "<br>";

            // // check if username and password match
            // $check_password_query = "SELECT * from users WHERE username='{$username}' and password='{$password}'";
            // $check_password_result = mysqli_query($link, $check_password_query) or die("Query error: ". mysqli_error($link)."\n");

            // // loop through all results
            // $counter = 0;
            // while ($line = mysqli_fetch_array($check_password_result, MYSQLI_ASSOC)){
            //     // loop through each column
            //     foreach($line as $col_value){	
            //         if ($col_value == '' and $counter < 1) {
            //             $error .= "<h3>password is incorrect!</h3><br>";
            //             $err_counter++;
            //             $counter++;
            //         }
            //     }	
            // }

            $matching_password_query = "SELECT * from users WHERE username='{$username}' and password='{$password}'";
            $matching_password_result = mysqli_query($link, $matching_password_query) or die("Query error: ". mysqli_error($link)."\n");

            if($matching_password_result->num_rows == 0) {
                $error .= "<h3>username $username does not exist!</h3><br>";
                $err_counter++;
            }

            echo "number of users with the credentials: $username/$password = " . $matching_password_result->num_rows . "<br>";


            // deny if any field is blank
            if ($username == '' or $password == '') {
                $error .= "<h3>no field can be left blank!</h3><br>";
                $err_counter++;
            }

            //~
            if (1 == 1) {
                echo $error;
                // ~
                // echo "<h3>\$usernmae = " . $username . "</h3>";
                // echo "<h3>\$password = " . $password . "</h3>";
                echo "<h3>\$err_counter = " . $err_counter . "</h3>";
            }

            // otherwise, accept the login and add take the user to the home page
            else {

                // construct db query
                // $insert_query = "IF (0<=2) PRINT \'email address is valid\';";
                // $insert_query = "IF ({$email} RLIKE {$valid_email_regex}) { echo 'email is valid!' };";
                // $insert_query = "INSERT into users VALUES ('{$email}', '{$username}', '{$password}')";

                // $result = mysqli_query($link, $insert_query) or die("Query error: ". mysqli_error($link)."\n");

                // redirect them to the home page
                //~THIS ISN'T WORKING
                header('Location: http://webapp.computing.clemson.edu/~rjhay/MeTube/homepage.html');

            }

        }

mysqli_close($link);
?>
        <!-- end new stuff -->

    </div>

</body>
</head>
</html>