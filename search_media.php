<?php
     require 'headers.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Media Search</title>
    <link rel="stylesheet" type="text/css" href="homepage-style.css">
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

<h1>MeTube Media Search</h1>

<form class="example" action="search_action.php" method = "post">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit"><i class="fa fa-search"></i></button>
<!-- </form> -->
<br><br>
<h1>Search by Category</h1>

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
<br>
<?php
  $data_query = "SELECT title, keywords, date_published FROM media";
  $result = mysqli_query($link, $data_query) or die("Query error: ". mysqli_error($link)."\n");;
?>

<table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Title</th>
                    <th>Keywords</th>
                    <th>Date Published</th>
                    <th>Favorite Media</th>
                </tr>
                <?php
                    while($result_r = mysqli_fetch_row($result)) {
                        $title = $result_r[0];
                        $key = $result_r[1];
                        $date = $result_r[2]; 
                ?>
                <tr valign="top">
                    <td>
                        <a> <?php echo $title;?> </a>
                    </td>
                    <td>
                        <a> <?php echo $key;?> </a>
                    </td>
                    <td>
                        <a> <?php echo $date;?> </a>
                    </td>
                    <td>
                        <form method="post">
                          <button> Add Stuff Here Later </button>                           
                        </form>                    
                    </td>
                </tr>
                <?php
                    }
                ?>
  </table>
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