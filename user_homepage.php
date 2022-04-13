<!DOCTYPE html>
<html>
<head>
<title>Account Registration Page Design</title>
    <link rel="stylesheet" type="text/css" href="register-style.css">
<body>

    <?php 
        $_SESSION["loggedin"] = true; 
        require 'headers.php';
        echo '<div style="font-size:1.25em;color:white"> Welcome '. $_SESSION['username'] ;
    ?>
   
</body>
</head>
</html>
