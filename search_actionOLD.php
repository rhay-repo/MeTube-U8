<?php
     require 'headers.php';
     include 'db_connection_test.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Search Results </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
</head>

<h1>Search Results</h1>

<h1> </h1>

<head>
	<title>Search results</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css"/>

    <style>
.button {
    background-color: #e0e0e0;
    border: none;
    color: #8c72e0;
    padding: 4px 4px;
    text-align: center;
    display: inline-block;
    font-size: 20px;
    height:25px; 
    width:120px; 
    margin: -30px -75px; 
    position:relative;
    top:50%; 
    left:50%;
}
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

.content {
  max-width: 500px;
  margin: auto;
}

.btn-group button {
  background-color: blueviolet; /* purple background */
  border: 1px blueviolet; /* purple border */
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
  max-width:500px;
  margin: auto;
}

/* Clear floats (clearfix hack) */
.btn-group:after {
  content: "";
  clear: both;
  display: table;
}

.btn-group button:not(:last-child) {
  border-right: none; /* Prevent double borders */
}

/* Add a background color on hover */
.btn-group button:hover {
  background-color: black;
}

h3 { 
  text-align: center; 
  color: white;
} 

a {
  text-align: center; 
  color: white;
}
        </style>
</head>
<body>

    <?php

        if (isset($_POST['music'])) {
            $val = $_POST['music'];
        } 
        else if (isset($_POST['sports'])) {
            $val = $_POST['sports'];
        }
        else if (isset($_POST['gaming'])) {
            $val = $_POST['gaming'];
        }
        else if (isset($_POST['movies'])) {
            $val = $_POST['movies'];
        }
        else if (isset($_POST['tvshows'])) {
            $val = $_POST['tvshows'];
        }
        else if (isset($_POST['news'])) {
            $val = $_POST['news'];
        }
        else if (isset($_POST['education'])) {
            $val = $_POST['education'];
        }
        else if (isset($_POST['comedy'])) {
            $val = $_POST['comedy'];
        }
        else {
            $val = $_POST['search'];
        }
  
        if ($val == '') {
            header("Location: search_media.php");
        }
        else {
        
            $sql = "SELECT * FROM media WHERE title LIKE '%$val%' OR keywords LIKE '%$val%' OR category LIKE '$val' OR description LIKE '%$val%'";
        
           // $result = $con->query($sql);
            $result = mysqli_query($link, $sql) or die("Query error: ". mysqli_error($link)."\n");

        }
    ?>

<?php 
// DO NOT EDIT ABOVE THIS LINE ################################################################
        
            echo 
            '<table class="table center" id="contacts" width="25%" cellpadding="1" cellspacing="1">
                <tr>
                    <th>Title</th>
                    <th>Keywords</th>
                    <th>Date Published</th>
                </tr>';
                    
                if ($result->num_rows > 0) {
                    while($result_r = mysqli_fetch_row($result)){
                        $title = $result_r[3];     
                        $keywords = $result_r[8]; 
                        $date_published = $result_r[6]; 
                        $_SESSION['media_id'] = $title;
                    echo '   
                        <tr valign="top">
                        <td> <a href="media_red.php">' . $title . '</a>';
                    echo '
                            </td>
                            <td>
                                <a>' .$keywords;
                    echo '</a>
                            </td>
                            <td>
                                <a>' .$date_published;
                    echo '</a>
                            </td>
                            
                            </tr>';
                    }
                    
                //     <form method="post">
                //             <button type="submit" name="add" value=<?php $title >> Favorite </button>
                //     </form>
                //     </label>
            
                //     </td>
                // </tr>';


// DO NOT EDIT BELOW THIS LINE ################################################################               
        }
        else {
            echo "<h4> <font color=white> No results for '". $val ."'</h4>";
        }
     
    ?>

     <a href="search_media.php" class="button">Search Again</a><br><br>
    
</table>
</body>
</html>