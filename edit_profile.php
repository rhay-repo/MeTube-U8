<?php
    // login vars
    require 'headers.php';

    $temp_username = "rjhay";
    $temp_email = "reaganjhay@gmail.com";
    $temp_password = "CPSC4620";

    // 
    $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    $query = "SELECT username, email FROM users WHERE username='rjhay' AND email='reaganjhay@gmail.com' AND password='CPSC4620'";
    $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

    // this is an array
	$data_array = array();
    // loop to store data in local array
    while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data_array[] = $line;
    }
    // store into vars
    $username = $data_array[0]['username'];
    $email = $data_array[0]['email'];

    // echo $username;
    // echo $email;
	
?>

<!DOCTYPE html>
<html>
<head>
    <body>
        <form method="POST">
            <?php echo "<p>username: $username</p>"; ?>
            <input type="text" name="username" placeholder="New Username">
            <button>Save</button>
        </form>
        <form method="POST">
            <?php echo "<p>Email Address: $email</p>"; ?>
            <input type="text" name="email" placeholder="New Email">
            <button>Save</button>
        </form>
        <form method="POST">
            <?php echo "<p>Password</p>"; ?>
            <input type="password" name="password" placeholder="New Password">
            <button>Save</button>
        </form>

        <?php
            $username = $_POST['username'];

        ?>




    </body>
</head>
</html>
