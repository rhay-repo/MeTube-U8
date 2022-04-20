<?php

    include 'filesLogic.php'

?>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="homepage-style.css">
    <style>
        label {
			text-align: center; 
			color: white;
		}
        form {
            margin: auto; 
            width: 220px;
        }
    </style>
    <title> Upload Media </title>
    <!-- <link rel="stylesheet" type="text/css" href="homepage-style.css"> -->
    <body>
        <div>
          <form action="upload_media.php" method="post" enctype="multipart/form-data" >
            <h1>Upload File</h1>
            <input type="file" name="myfile"> <br>
            <!-- <button type="submit" name="save">upload</button> -->
            

                <br>
                <br>

                <label for="fname">Title:</label><br>
                <input type="text" id="fname" name="fname"><br>

                <br>

                <br>

                <!-- <label for="category">Category:</label><br>
                <input type="checkbox" id="sports" name="sports" value="Sports">
                <label for="sports"> SPORTS </label><br>
                <input type="checkbox" id="entertainment" name="entertainment" value="Entertainment">
                <label for="entertainment"> ENTERTAINMENT </label><br>
                <input type="checkbox" id="food" name="food" value="Food">
                <label for="food"> FOOD </label><br>
                <input type="checkbox" id="home" name="home" value="Home">
                <label for="home"> HOME </label><br> -->

                <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" name="category" id="categories">
                    <option value="Music">Music</option>
                    <option value="Sports">Sports</option>
                    <option value="Gaming">Gaming</option>
                    <option value="Movies">Movies</option>
                    <option value="TV Shows">TV Shows</option>
                    <option value="News">News</option>
                    <option value="Education">Education</option>
                    <option value="Comedy">Comedy</option>
                </select>
                </div>

                <br>

                <div class="form-group">
                <label for="group">Viewing Group:</label>
                <select class="form-control" name="group" id="group">
                    <option value="Public">Public</option>
                    <option value="Private">Private</option>
                </select>
                </div>

                <!-- <label for="view_group">View Group:</label><br>
                <input type="radio" id="public" name="view_group" value="Public">
                <label for="Public">Public</label><br>
                <input type="radio" id="private" name="view_group" value="Private">
                <label for="Private">Private</label><br>
                <input type="radio" id="friends" name="view_group" value="Friends">
                <label for="Friends">Friends</label><br> -->

                <br>

                <label for="description">Description:</label><br>
                <div class="form-group">
                    <textarea class="form-control" rows="7" id="description" name="description"></textarea>
                </div>

                <br>

                <label for="keyword">Keywords (separate by commas):</label><br>
                <div class="form-group">
                    <textarea class="form-control" rows="7" id="keyword" name="keyword"></textarea>
                </div>

                <br>

              <button type="submit" name="save">UPLOAD</button>
            </form>
        </div>
    </body>
</html>