<?php
    $query = "UPDATE users SET username=$username WHERE username=$username";
    $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");


?>