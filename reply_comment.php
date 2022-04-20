<?php
	require 'headers.php';
	include 'db_connection_test.php';

    
    if(isset($_POST['reply'])) {
        $reply_comment = $_POST['reply'];
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $username = $_SESSION['username'];
        $title = $_SESSION['media_id'];
        
        $query = "INSERT into comments (filepath, comment_id, username, datetime, comment, reply_of) VALUES ('{$title}', '{$id}', '{$username}', NOW(), '{$reply_comment}', '{$id}')";

        $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");
        header('Location: media.php');
    }
    header('Location: media.php');
?>