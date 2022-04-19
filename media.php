<?php
	require 'headers.php';
	include 'db_connection_test.php';
?>

<!DOCTYPE html>
<html>
	<title> Media </title>
	<body>
		<h1> View Media </h1>
		<?php
			// if(isset($_SESSION['media_id'])) {
				// $media_id = $_SESSION['media_id'];
				$media_id = 3;

				$query = "SELECT (filepath) FROM media WHERE id = '{$media_id}'";
				$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;

				echo $media_id;

				echo "<img src='media/me/goodvibes.jpg' width='460' height='345' >";

			// }
		?>

		<img src='*/images/rjhay/goodvibes.jpg' width='460' height='345' >
	</body>
</html>
