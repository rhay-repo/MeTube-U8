<!DOCTYPE html>
<html>
<head>
<title>User Page</title>
    <link rel="stylesheet" type="text/css" href="general-style.css">
<body>

    <?php 
        $_SESSION["loggedin"] = true; 
        require 'headers.php';
        echo '<div style="font-size:2em;color:white;position: absolute;text-align:center;left: 50%;top: 50%;transform: translate(-50%, -50%);border: 5px solid #FFFFFF;padding: 10px;"> Welcome, '. $_SESSION['username'] ;
    ?>
    <!-- <h4> 
        Welcome <?php $_SESSION['username'] ?> 
    </h4> -->

        <!-- echo '<div style="font-size:2em;color:white;text-align:center;position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);border: 5px solid #FFFFFF;padding: 10px;"> Welcome, '. $_SESSION['username'] ; -->

    

    <!-- <div class="box"> -->
    <a href="upload_media.php"><br>Upload new media here!</a>
    

</body>
</head>
</html>
