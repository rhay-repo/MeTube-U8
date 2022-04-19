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
        </style>
</head>
<body>

    <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if (isset($_POST['search'])) {
            //     $search = $_POST['search'];
            // } 
            if (isset($_POST['music'])) {
                $search = $_POST['music'];
            } 
            else if (isset($_POST['sports'])) {
                $search = $_POST['sports'];
            }
            else if (isset($_POST['gaming'])) {
                $search = $_POST['gaming'];
            }
            else if (isset($_POST['movies'])) {
                $search = $_POST['movies'];
            }
            else if (isset($_POST['tvshows'])) {
                $search = $_POST['tvshows'];
            }
            else if (isset($_POST['news'])) {
                $search = $_POST['news'];
            }
            else if (isset($_POST['education'])) {
                $search = $_POST['education'];
            }
            else if (isset($_POST['comedy'])) {
                $search = $_POST['comedy'];
            }
            else {
                $search = $_POST['search'];
            }
        }

        // $search = $_POST['search'];

        if ($search == '') {
            header("Location: search_media.php");
        }
        else {
        
            $sql = "SELECT * FROM media WHERE title LIKE '%$search%' OR keywords LIKE '%$search%' OR category LIKE '$search";
        
            $result = $con->query($sql);
        }
    ?>

<?php
        if ($result->num_rows > 0) {
            while($result_r = mysqli_fetch_row($result)){
                $title = $result_r[3];     
                $keywords = $result_r[8]; 
                $date_published = $result_r[6]; 
            }
        
            echo 
            '<table class="table center" id="contacts" width="25%" cellpadding="1" cellspacing="1">
                <tr>
                    <th>Title</th>
                    <th>Keywords</th>
                    <th>Date Published</th>
                    <th>Favorite Media</th>
                </tr>
            
                
                <tr valign="top">
                    <td>
                        <a>' .$title;
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
                    <td>
                    </td>
                    </tr>';
                    
                //     <form method="post">
                //             <button type="submit" name="add" value=<?php $title >> Favorite </button>
                //     </form>
                //     </label>
            
                //     </td>
                // </tr>';
        }
        else {
            echo "<h4> <font color=white> No results for '". $search ."'</h4>";
        }
     
    ?>

     <a href="search_media.php" class="button">Search Again</a><br><br>
    
</table>
</body>
</html>
