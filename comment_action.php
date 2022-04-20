<?php
    require 'headers.php';

    if (isset($_POST['comment'])) {
        $comment_content = $_POST['comment'];
        $username = $_SESSION['username'];
        $title = $_SESSION['media_id'];

        $number = "SELECT COUNT(*) FROM comments";
        $query = mysqli_query($link, $number) or die("Query error: ". mysqli_error($link)."\n");
        $result_r = mysqli_fetch_row($query);
        $num = $result_r[0] + 1;
        
        // $comment = "INSERT into comments (filepath, username, datetime, comment) VALUES ('{$title}', '{$username}', NOW(), '{$comment_content}')";
        $comment = "INSERT into comments (filepath, comment_id, username, datetime, comment, reply_of) VALUES ('{$title}', '{$num}', '{$username}', NOW(), '{$comment_content}', '{$num}')";

        $result = mysqli_query($link, $comment) or die("Query error: ". mysqli_error($link)."\n");
        header('Location: media.php');
    }
    //header("Location: media.php");
?>