<?php
	require 'headers.php';
	include 'db_connection_test.php';
?>

<!DOCTYPE html>
<html>
	<style>
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

	</style>
	<title> Media </title>
	<link rel="stylesheet" type="text/css" href="homepage-style.css">
	<body alight>
		<!-- <h1> View Media </h1> -->
		<div class="content">
		<?php
			// if(isset($_SESSION['media_id'])) {
				// $media_id = $_SESSION['media_id'];
				$_SESSION['media_id'] = 3;
				$media_id = $_SESSION['media_id'];

				$query = "SELECT * FROM media WHERE id = '{$media_id}'";
				$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;

				while($r = $result->fetch_assoc()) {
					$id = $r["id"];
					$filepath = $r["filepath"];
					$user = $r["username"];
					$title = $r["title"];
					$type = $r["file_type"];
					$size = $r["file_size"];
					$date = $r["date_published"];
					$views = $r["views"];
					$keys = $r["keywords"];
					$rate = $r["media_rating"];
					$cat = $r["category"];
					$group = $r["viewing_groups"];
					$desc = $r["description"];
				}

				// check if user is friend of media being viewed
				$friend_query = "SELECT contact FROM contact_list WHERE username='{$user}'";
				$friend_result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;

				$view_private = false;

				// doesn't work needs some help
				// while($fr = $friend_result->fetch_assoc()) {
				// 	$c = $fr['contact'];
				// 	echo $c;
				// 	if($c == $_SESSION['username']) {
				// 		$view_private = true;
				// 	}
				// }

				if($_SESSION['username'] == $user) {
					$view_private = true;
				}

				if($media_id != NULL) {
					if($group == 'Public') {
						echo "<h1>".$title."</h1>";

						echo "<img src='media/".$user."/".$filepath."' width='460' height='345'>";
						// echo "<img src='media/me/goodvibes.jpg' width='460' height='345' >";

						echo "<h3>Published by ".$user."!</h3>";
						echo "<div class='btn-group' style='width:100%'>
								<button style='width=25%'>Channel</button>
								<button style='width=25%'>Subscribe</button>
								<button style='width=25%'>Add Friend</button>
								<button style='width=25%'>Download</button>
							</div>";
						
						echo "<br> <h3> Category: ". $cat."</h3> <br>";
						echo "<h3> Keywords: ". $keys."</h3> <br>";
						echo "<h3> Description: ". $desc."</h3> <br><br>";
					// Would like to change this to contacts only
					} else if($view_private) {
						echo "<h1> Your have private permissions! </h1>";
						echo "<h1>".$title."</h1>";

						echo "<img src='media/".$user."/".$filepath."' width='460' height='345'>";
						// echo "<img src='media/me/goodvibes.jpg' width='460' height='345' >";

						echo "<h3>Published by ".$user."!</h3>";
						echo "<div class='btn-group' style='width:100%'>
								<button style='width=25%'>Channel</button>
								<button style='width=25%'>Subscribe</button>
								<button style='width=25%'>Add Friend</button>
								<button style='width=25%'>Download</button>
							</div>";
						
						echo "<br> <h3> Category: ". $cat."</h3> <br>";
						echo "<h3> Keywords: ". $keys."</h3> <br>";
						echo "<h3> Description: ". $desc."</h3> <br><br>";
					} else {
						echo "<h1> This file is private! </h1>";
						echo "<h1> You do not have permission to view this media! </h1>";
					}
				} else {
					echo "<h1> This media does not exsit! </h1>";
					echo "<h1> Upload new media! </h1>";

					echo "<div class='content'>
								<div class='vertical-center'>
									<a class='btn' href='upload_media.php'> Upload Media </a>
								</div>
							</div>";
				}



			// }
		?>
		</div>
	</body>
</html>
