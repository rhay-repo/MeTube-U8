<?php
    //~
    // fill this var with dummy value to test later
    // $_SESSION['new_username'] = 'RJHAY_INCORRECT_VALUE';

    // login vars
    require 'headers.php';

    // ~ 
    // $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $query = "SELECT username, email FROM users WHERE username='{$username}' AND email='{$email}'";
    $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

    // this is an array
	$data_array = array();
    // loop to store data in local array
    while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data_array[] = $line;
    }

    // store into vars
    //~
    //$username = $data_array[0]['username'];
    // $email = $data_array[0]['email'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    //~
    // echo "username: " . $username . "<br>";
    // echo "email: " . $email;
	
?>

<!DOCTYPE html>
<html>
<head>
    <body>
        <form method="POST">
            <?php echo "<p>Username: " . $_SESSION['username'] . "</p>"; ?>
            <input type="text" name="new_username" placeholder="New Username">
            <input type="submit" name="update_ubutton" value="Save Changes">
            <!-- <button>Save Changes</button> -->
        </form>

        <!-- <form method="POST">
            <?php echo "<p>Email Address: $email</p>"; ?>
            <input type="text" name="new_email" placeholder="New Email">
            <button>Save Changes</button>
        </form>

        <form method="POST">
            <?php echo "<p>Password</p>"; ?>
            <input type="password" name="new_password" placeholder="New Password">
            <button>Save Changes</button>
        </form> -->

        <?php
            // set session new_username
            //~THIS IS NOT WORKING
            //~FOR SOME REASON, $SESSION['new_username'] IS ALWAYS BLANK
            // if (isset($_POST['update_username'])) {
                // $_SESSION['new_username'] = $_POST['new_username'];
                // $_SESSION['updated'] = $_POST['update_username'];
                // echo $_POST['updated'];
            // }
            // TODO: 
            // set session new_email
            // TODO:
            // set session new_password

            // require 'headers.php';
            //~v

            // if(isset($_POST['update_ubutton'])) {
            //     $username = $_SESSION['username'];
            //     $email = $_SESSION['email'];
            //     $new_username = $_SESSION['new_username'];
            //     //~^
            
                // $query = "UPDATE users SET username='{$_SESSION['new_username']}' WHERE username='{$_SESSION['username']}'";
                // $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");
            //     $_SESSION['username'] = $_SESSION['new_username'];
            //     header('Location: edit_profile.php');
            // }

            if(isset($_POST['update_ubutton'])) {
                
                echo $username . "<br>";
                echo $_POST['new_username'] . "<br>";
                echo $_POST['update_ubutton'];

                $new_username = $_POST['new_username'];

                $query = "UPDATE users SET username='{$new_username}' WHERE username='{$username}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

                $_SESSION['username'] = $new_username;

                

            }

        ?>




    </body>
</head>
</html>
