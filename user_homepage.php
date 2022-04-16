<!DOCTYPE html>
<html>
<head>
<title>Account Registration Page Design</title>
    <link rel="stylesheet" type="text/css" href="general-style.css">
<body>

    <?php 
        $_SESSION["loggedin"] = true; 
        require 'headers.php';
        echo '<div style="font-size:2em;color:white;position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);border: 5px solid #FFFFFF;padding: 10px;"> Welcome, '. $_SESSION['username'] ;
    ?>
    
    <!-- <div class="box"> -->
    <a href="upload_media.php">Upload new media here!</a>
    

</body>
</head>
</html>
