<!DOCTYPE html>
<html>
<head>
<title>Account Registration Page Design</title>
    <link rel="stylesheet" type="text/css" href="register-style.css">
<body>

    <?php 
        $_SESSION["loggedin"] = false;
        require 'headers.php';
        $_SESSION["loggedin"] = false;
        echo "Please sign in or create an account";
    ?>
   
</body>
</head>
</html>
