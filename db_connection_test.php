<?php
$pswd="CP\$C4620!";
$con=mysqli_connect("mysql1.cs.clemson.edu","MeTube_4620_q9av",$pswd,"MeTube_4620_2f01");

// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}

// Perform query
if ($result = mysqli_query($con, "SELECT *  FROM 'test'")) {
	echo "Returned rows are: " . mysqli_num_rows($result);

	// Free result set
	mysqli_free_result($result);
}

// Close the connection
mysqli_close($con);
?>
