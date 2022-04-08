<?php 

// Variables
$hostname = "mysql1.cs.clemson.edu";
$username = "MeTube_4620_q9av";
$pswd     = "CP\$C4620!";
$db_name  = "MeTube_4620_2f01";

//Connecting, selecting database
$link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

// BEGIN PLAYGROUND AREA -- DO NOT EDIT ABOVE THIS LINE

//Send query // MODIFY THIS QUERY TO ANYTHING YOU LIKE, THIS IS WHAT IS DISPLAYED ON THE WEBPAGE WHEN NAVIGATED TO
$query = 'SELECT * from users';

$result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

// Printing results in HTML
echo "<table>\n";

while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	echo "\t<tr>\n";
	
	foreach($line as $col_value){
		
		echo "\t\t<td>$col_value</td>\n";
	
	}
	
	echo "\t</tr>\n";
}

echo "</table>\n";

// Free resultset

mysqli_free_result($result);


// END OF PLAYGROUND AREA -- DO NOT EDIT BELOW THIS LINE

// Closing connection
mysqli_close($link);
?>
