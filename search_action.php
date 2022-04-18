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
</head>
<body>

    <?php
        $search = $_POST['search'];
        
        $sql = "SELECT * FROM media WHERE title LIKE '%$search%' OR keywords LIKE '%$search%'";
    
        $result = $con->query($sql);
    ?>

<?php
        if ($result->num_rows > 0) {
            while($result_r = mysqli_fetch_row($result)){
                $title = $result_r[2];     
                $keywords = $result_r[7]; 
                $date_published = $result_r[5]; 
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

</table>
</body>
</html>
