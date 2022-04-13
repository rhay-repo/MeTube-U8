<?php
// start session
session_start();
// Variables
// $error = '';
// $hostname = "mysql1.cs.clemson.edu";
// $username = "MeTube_4620_q9av";
// $pswd     = "CP\$C4620!";
// $db_name  = "MeTube_4620_2f01";
// // Connecting, selecting database
// $link = mysqli_connect($hostname,$username,$pswd,$db_name) 
// or die ('Could not connect (ERROR):' .mysqli_error($link));
require 'headers.php';
?>

<!DOCTYPE html>
<html>
<style>
h1 {text-align: center;}
</style>
<body>


<!-- begin printing all users in a table -->
<table align="center" border='1' width="100%">
<?php

// query database and return all users
$query = "SELECT * from users";
$result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

// size of table should be rows in table "users"
$size = 9;

for($i = 1; $i <= 9; $i++)
{	
    $line = mysqli_fetch_array($result, MYSQLI_ASSOC);
    echo "<tr>";
	
    foreach($line as $column) {
		// display data here
        echo "<td>" . $column . "</td>";
	}	
	echo "<tr/>";
}
?>
</table>


<!-- free vars and close connection -->
<?php
// Free resultset
mysqli_free_result($result);
// Closing connection
mysqli_close($link);
?>

</body>
</html>