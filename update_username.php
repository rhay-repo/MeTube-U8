<?php
    require 'headers.php';
    //~v
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $new_username = $_SESSION['new_username'];
    //~^

    $query = "UPDATE users SET username='{$_SESSION['new_username']}' WHERE username='{$_SESSION['username']}'";
    $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");
    $_SESSION['username'] = $_SESSION['new_username'];
    header('Location: edit_profile.php');
?>