<?php
     require 'headers.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Media Search</title>
    <link rel="stylesheet" type="text/css" href="register-style.css">
<style>

body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #8c72e0;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #3207ba;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body>

<h4>MeTube Media Search</h4>

<form class="example" action="search_action.php" method = "post">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit"><i class="fa fa-search"></i></button>
<!-- </form> -->
<br><br>
<h4>Search by Category</h4>

<!-- <form class="category" action="search_action.php" method = "post"> -->
  <input type="submit" name="music" value="Music">
  <input type="submit" name="sports" value="Sports">
  <input type="submit" name="gaming" value="Gaming">
  <input type="submit" name="movies" value="Movies">
  <input type="submit" name="tvshows" value="TV Shows">
  <input type="submit" name="news" value="News">
  <input type="submit" name="education" value="Education">
  <input type="submit" name="comedy" value="Comedy">
</form>

</body>
</html> 

<!-- <body>
    <br>
    <form action="search3.php" method="post">
        Search <input type="text" name="search"><br>
        <input type ="submit">
    </form>
</body> -->
</html>