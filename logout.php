<!DOCTYPE html>
<html>
<head>
<title>Account Registration Page Design</title>
    <link rel="stylesheet" type="text/css" href="register-style.css">
<body>

    <?php 
      session_start();

      session_unset();
      session_destroy();
      
      require 'headers.php';
      exit;
    ?>
   
</body>
</head>
</html>