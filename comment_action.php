<?php
    require 'headers.php';

    if (isset($_POST['comment'])) {
        $comment_content = $_POST['comment'];
       // echo '<h1>' . $comment_content . "</h1>";
        $username = $_SESSION['username'];
        $title = $_SESSION['media_id'];
        
        $comment = "INSERT into comments VALUES ('{$title}', '{$username}', NOW(), '{$comment_content}')";

        $result = mysqli_query($link, $comment) or die("Query error: ". mysqli_error($link)."\n");
        header('Location: media.php');
    }
?>