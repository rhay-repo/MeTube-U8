<?php
    session_start();
    require 'navbar.html';

    // Variables
    $error = '';
    $hostname = "mysql1.cs.clemson.edu";
    $username = "MeTube_4620_q9av";
    $pswd     = "CP\$C4620!";
    $db_name  = "MeTube_4620_2f01";

    // // Connecting, selecting database
    // $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));
?>