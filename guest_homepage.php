<!DOCTYPE html>
<html>
<head>
<title>Guest Page</title>
    <link rel="stylesheet" type="text/css" href="register-style.css">
<body>

    <?php 
        $_SESSION["loggedin"] = false;
        require 'headers.php';
        $_SESSION["loggedin"] = false;
        echo '<div style="font-size:2em;color:white;text-align:center;position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);border: 5px solid #FFFFFF;padding: 10px;"> Welcome to MeTube<br>Please sign in or Create an account' ;
    ?>
   
</body>
</head>
</html>
