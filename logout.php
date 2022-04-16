<!DOCTYPE html>
<html>
<head>
<title>Logout Page</title>
    <link rel="stylesheet" type="text/css" href="register-style.css">
<body>

    <?php 
      session_start();

      session_unset();
      session_destroy();
      
      require 'headers.php';
      echo '<div style="font-size:2em;color:white;text-align:center;position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);border: 5px solid #FFFFFF;padding: 10px;"> Come back soon!';
   
      exit;
    ?>
   
</body>
</head>
</html>