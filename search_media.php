<?php
    require 'headers.php';
    include 'db_connection_test.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Media Search </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
</head>

<h1>Media Search</h1>

<body>
	<form action="search_media.php" method="GET">
		<input type="text" name="query" />
		<input type="submit" value="Search" />
	</form>
</body>

<h1> </h1>

<head>
	<title>Search results</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
	$query = $_GET['query']; 
	// gets value sent over search form
	
	$min_length = 1;
	// you can set minimum length of the query if you want
	
	if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
		
		$query = htmlspecialchars($query); 
		// changes characters used in html to their equivalents, for example: < to &gt;
		

        $data_query = "SELECT * from media WHERE title LIKE '%{$query}%'";
        $result = mysqli_query($link, $data_query) or die("Query error: ". mysqli_error($link)."\n");


		while($result_r = mysqli_fetch_row($result)) {
            $title = $result_r[0];
            $keywords = $result_r[1];
            $date_published = $result_r[2];
        }
		
	}
	else{ // if query length is less than minimum
		echo "Minimum length is ".$min_length;
	}
?>


<table class="table center" id="contacts" width="33%" cellpadding="1" cellspacing="1">
    <tr>
        <th>Title</th>
        <th>Keywords</th>
        <th>Date Published</th>
    </tr>
    <?php

        $data_list = "SELECT title, keywords, date_published from media";
        $result_list = mysqli_query($link, $data_list) or die("Query error test: ". mysqli_error($link)."\n");;

        while($result_r = mysqli_fetch_row($result_list)) {
            $title = $result_r[0];
            $keywords = $result_r[1];
            $date_published = $result_r[2];
        
    ?>
    <tr valign="top">
        <td>
            <a> <?php echo $title;?> </a>
        </td>
        <td>
            <a> <?php echo $keywords;?> </a>
        </td>
        <td>
            <a> <?php echo $date_published;?> </a>
        </td>
        <td>
        
        <form method="post">
                <button type="submit" name="add" value=<?php $title ?>> Favorite </button>
        </form>
        </label>

        </td>
    </tr>
    <?php
        }
    ?>
</table>
</body>
</html>