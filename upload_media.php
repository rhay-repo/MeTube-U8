<?php

    require 'headers.php';

?>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Upload Media </title>
    <!-- <link rel="stylesheet" type="text/css" href="homepage-style.css"> -->
    <body>
        <h1> Upload Media </h1>
        <div>
            <form action="/action_page.php">
                <input type="file" id="myFile" name="filename">
                <input type="submit"> <br>

                <br>

                <label for="fname">Title:</label><br>
                <input type="text" id="fname" name="fname"><br>

                <br>

                <label for="file_type">File Type:</label><br>
                <input type="radio" id="jpg" name="file_type" value="JPG">
                <label for="jpg">JPG</label><br>
                <input type="radio" id="png" name="file_type" value="PNG">
                <label for="png">PNG</label><br>
                <input type="radio" id="jpeg" name="file_type" value="JPEG">
                <label for="jpeg">JPEG</label><br>
                <input type="radio" id="gif" name="file_type" value="GIF">
                <label for="gif">GIF</label><br>

                <br>

                <label for="category">Category:</label><br>
                <input type="checkbox" id="sports" name="sports" value="Sports">
                <label for="sports"> SPORTS </label><br>
                <input type="checkbox" id="entertainment" name="entertainment" value="Entertainment">
                <label for="entertainment"> ENTERTAINMENT </label><br>
                <input type="checkbox" id="food" name="food" value="Food">
                <label for="food"> FOOD </label><br>
                <input type="checkbox" id="home" name="home" value="Home">
                <label for="home"> HOME </label><br>

                <br>

                <label for="view_group">View Group:</label><br>
                <input type="radio" id="public" name="view_group" value="Public">
                <label for="Public">Public</label><br>
                <input type="radio" id="private" name="view_group" value="Private">
                <label for="Private">Private</label><br>
                <input type="radio" id="friends" name="view_group" value="Friends">
                <label for="Friends">Friends</label><br>
                
                <br>

                <label for="description">Description:</label><br>
                <input type="text" id="desc" name="desc"><br>

                <br>

                <label for="keyword">Keywords:</label><br>
                <input type="text" id="key" name="key"><br>

                <br>

                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>