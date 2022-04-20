<?php
	require 'headers.php';
	include 'db_connection_test.php';

	function add_friend(&$uid, &$uidf) {
		if($_SESSION['username'] != NULL) {
			$query = "INSERT INTO contact_list VALUE ('{$uid}', '{$uidf}')";
			$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
		} else {
			$_SESSION['error'] = "You are not logged in, therefore you cannot complete this action!";

			echo $_SESSION['error'];
			unset($_SESSION['error']);
		}
    }

	function subscribe(&$uid, &$uidf) {
		if($_SESSION['username'] != NULL) {
			$query = "INSERT INTO subscribe VALUE ('{$uid}', '{$uidf}')";
			$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
		}
		//  else {
		// 	$_SESSION['error'] = "You are not logged in, therefore you cannot complete this action!";

		// 	echo $_SESSION['error'];
		// 	unset($_SESSION['error']);
		// }
    }

	function favorite(&$user, &$file) {
		if($_SESSION['username'] != NULL) {
			$query = "INSERT INTO favorite_list VALUE ('{$user}', '{$file}', curdate())";
			$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
		}
	}

	// function toChannel() {
	// 	header("Location: view_channel.php");
	// }
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

		a {
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
				// $_SESSION['media_id'] = 9;
				$media_id = $_SESSION['media_id'];
				// echo "<h1>".$media_id."</h1>";

				$query = "SELECT * FROM media WHERE title = '{$media_id}'";
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

					$_SESSION['owner'] = $user;
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
						echo "<a href='channel_red.php'> Go to Channel </a>";
						echo "<br><br>";
						echo "<div class='btn-group' style='width:100%'>
								<button style='width=33.3%' onClick=".subscribe($_SESSION['username'], $user).">Subscribe</button>
								<button style='width=33.3%' onClick=".add_friend($_SESSION['username'], $user).">Add Friend</button>
								<button style='width=33.3%' onClick=".favorite($_SESSION['username'], $filepath).">Favorite</button>
							</div>";

						echo "<br><form action='filesLogic.php' method='post'>
								<button type='submit' name='download'>DOWNDLOAD</button>";
						
						echo "<br> <h3> Category: ". $cat."</h3> <br>";
						echo "<h3> Keywords: ". $keys."</h3> <br>";
						echo "<h3> Description: ". $desc."</h3> <br><br></form>";
					// Would like to change this to contacts only
					} else if($view_private) {
						echo "<h1> Your have private permissions! </h1>";
						echo "<h1>".$title."</h1>";

						echo "<img src='media/".$user."/".$filepath."' width='460' height='345'>";
						// echo "<img src='media/me/goodvibes.jpg' width='460' height='345' >";

						echo "<h3>Published by ".$user."!</h3>";
						echo "<a href='channel_red.php'> Go to Channel </a>";
						echo "<br><br>";
						echo "<div class='btn-group' style='width:100%'>
								<button style='width=33.3%' onClick=".subscribe($_SESSION['username'], $user).">Subscribe</button>
								<button style='width=33.3%' onClick=".add_friend($_SESSION['username'], $user).">Add Friend</button>
								<button style='width=33.3%' onClick=".favorite($_SESSION['username'], $filepath).">Favorite</button>
							</div>";
						
						echo "<br><form action='filesLogic.php' method='post'>
							<button type='submit' name='download'>DOWNDLOAD</button>";

						echo "<br> <h3> Category: ". $cat."</h3> <br>";
						echo "<h3> Keywords: ". $keys."</h3> <br>";
						echo "<h3> Description: ". $desc."</h3> <br><br></form>";
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
		?>
		<!-- <php
				$data_query = "SELECT comments.username, comments.datetime, comments.comment 
				FROM comments INNER JOIN media ON comments.filepath = media.filepath WHERE 
				comments.filepath = media.filepath";
				$result = mysqli_query($link, $data_query) or die("Query error: ". mysqli_error($link)."\n");
			?> -->
			<h3>Comments</h3>
			<table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Date & Time Posted</th>
                </tr>
                <?php
					$data_query = "SELECT comments.username, comments.comment, comments.datetime
					FROM comments INNER JOIN media ON comments.filepath = $id WHERE 
					comments.filepath = $id";
					$result = mysqli_query($link, $data_query) or die("Query error: ". mysqli_error($link)."\n");
					
					if ($result->num_rows > 0) {
						while($result_r = mysqli_fetch_row($result)) {
							$user = $result_r[0];
							$comment = $result_r[1];
							$date_time = $result_r[2]; 
							?>
							<tr valign="top">
								<td>
									<a> <?php echo $user;?> </a>
								</td>
								<td>
									<a> <?php echo $result_r[2];?> </a>
								</td>
								<td>
									<a> <?php echo $date_time;?> </a>
								</td>
							</tr>
							<?php
						}
					}
                ?>
  			</table>

				<!-- <form action="comment_action.php" method="post">
					<br>
					<h3>Add Comment:</h3>
					
					<div class="form-group">
                    	<textarea class="form-control" rows="7" style="width:500px" id="description" name="description"></textarea>
               		</div>

              		<button type="submit" name="post_comment">Post Comment</button>
				</form> -->

				<form action="comment_action.php" method="post">
					<h3>Add Comment</h3>
					<input type="text" name="comment" size = "100">
				
					<input type="submit" name="post" value="Post Comment">
				</form>
				<br><br>

		</div>
	</body>
</html>
