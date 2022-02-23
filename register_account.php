<?php 

// Variables
$hostname = "mysql1.cs.clemson.edu";
$username = "MeTube_4620_q9av";
$pswd     = "CP\$C4620!";
$db_name  = "MeTube_4620_2f01";

//Connecting, selecting database
$link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

//Send query 
// $insert_query = "INSERT into users VALUES ('something', 'something', 'something')";

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// $insert_query = "INSERT into users VALUES ({$email}, {$username}, {$password})";
$insert_query = "INSERT into users VALUES ('{$email}', '{$username}', '{$password}')";

$result = mysqli_query($link, $insert_query) or die("Query error: ". mysqli_error($link)."\n");

$select_query = "SELECT email FROM users";
$result = mysqli_query($link, $select_query) or die("Query error: ". mysqli_error($link)."\n");

// Printing results in HTML
echo "<table>\n";

// loop through "result" and show each item
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	echo "\t<tr>\n";
	
    // loop through each column in "result"
	foreach($line as $col_value){
		
		echo "\t\t<td>$col_value</td>\n";
	
	}
	
	echo "\t</tr>\n";
}

echo "</table>\n";

// Free resultset

mysqli_free_result($result);

// Closing connection

mysqli_close($link);

?>
