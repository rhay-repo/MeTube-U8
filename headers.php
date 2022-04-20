<?php
    session_start();
    require 'navbar.php';
    require 'functions.php';

    // Variables
    $error       = '';
    $hostname    = "mysql1.cs.clemson.edu";
    $db_username = "MeTube_4620_q9av";
    $pswd        = "CP\$C4620!";
    $db_name     = "MeTube_4620_2f01";
    $loggedin;
    $media_search;
    $media_category;

    $media_id;
    $channel_owner;
    $playlist;

    // // Connecting, selecting database
    $_SESSION['link'] = mysqli_connect($hostname,$db_username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    $link = mysqli_connect($hostname,$db_username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));
?>