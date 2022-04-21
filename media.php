<?php
	require 'headers.php';
	include 'db_connection_test.php';

	function add_friend(&$uid, &$uidf) {
		if($_SESSION['username'] != NULL) {
			$query = "INSERT INTO contact_list VALUE ('{$uid}', '{$uidf}')";
			$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
		} else {
			$_SESSION['error'] = "You are not logged in, therefore you cannot complete this action!";

			echo $_SESSION['error'];
			unset($_SESSION['error']);
		}
    }

	function subscribe(&$uid, &$uidf) {
		if($_SESSION['username'] != NULL) {
			$query = "INSERT INTO subscribe VALUE ('{$uid}', '{$uidf}')";
			$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
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
			$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
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
				// $MEDIA_ID = $_SESSION['media_id'];
				// $_SESSION['media_id'] = 9;
				$MEDIA_ID = $_SESSION['media_id'];
				// echo "<h1>".$MEDIA_ID."</h1>";

				$query = "SELECT * FROM media WHERE title = '{$MEDIA_ID}'";
				$result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");

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
				// $friend_query = "SELECT contact FROM contact_list WHERE username='{$user}'";
				// $friend_result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");

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

				if($MEDIA_ID != NULL) {
					if($group == 'Public') {
						echo "<h1>".$title."</h1>";
						
						echo "<img src='media/".$user."/".$filepath."' width='460' height='345'>";
						// echo "<img src='images/rjhay/goodvibes.jpg' width='460' height='345' >";

						echo "<h3>Published by ".$user."!</h3>";
						echo "<a href='channel_red.php'> Go to Channel </a>";
						echo "<br><br>";
						echo "<div class='btn-group' style='width:100%'>
								<button style='width=33.3%' onClick=".subscribe($_SESSION['username'], $user).">Subscribe</button>
								<button style='width=33.3%' onClick=".add_friend($_SESSION['username'], $user).">Add Friend</button>
								<button style='width=33.3%' onClick=".favorite($_SESSION['username'], $filepath).">Favorite</button>
							</div>";

						echo "<br><form action='filesLogic.php' method='post'>
								<button type='submit' name='download'>DOWNLOAD</button>
								</form>";

						echo "<br> <form method='POST'>
								<a> Add to Playlist </a><br>
								<input type='text' name='playlist' placeholder='Enter Playlist Name'>
								<input type='submit' name='add_to_playlist' value='Add to Playlist'>
							</form>";
						
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
							<button type='submit' name='download'>DOWNDLOAD</button>
							</form>";

						echo "<br> <form method='POST'>
								<a> Add to Playlist </a><br>
								<input type='text' name='playlist' placeholder='Enter Playlist Name'>
								<input type='submit' name='add_to_playlist' value='Add to Playlist'>
							</form>";

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

		<?php
			if (isset($_POST['add_to_playlist'])) {
                // assign the new username
                $new_playlist = $_POST['playlist'];
                // update the that user's username in the database
                $query = "INSERT INTO playlist(filepath, username, playlist_title, time) VALUES ('{$title}', '{$_SESSION['username']}', '{$new_playlist}', NOW())";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");

				echo "<br><a> Added to ".$new_playlist." Playlist!</a>";
            }
		?>

		<!-- <php
				$data_query = "SELECT comments.username, comments.datetime, comments.comment 
				FROM comments INNER JOIN media ON comments.filepath = media.filepath WHERE 
				comments.filepath = media.filepath";
				$result = mysqli_query($link, $data_query) or die("Query error: ". mysqli_error($link)."\n");
			?> -->
		<?php if($view_private or $group == 'Public') {?>
			
			<h3>Comments</h3>
			<table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Date & Time Posted</th>
					<th>Reply to Comment</th>
                </tr>
                <?php

					$data_query = "SELECT username, comment, datetime, comment_id
					FROM comments WHERE comments.filepath = '{$MEDIA_ID}' ORDER BY comment_id DESC, datetime DESC";

					$result = mysqli_query($link, $data_query) or die("Query error: ". mysqli_error($link)."\n");
					$c_id;
					while($result_r = mysqli_fetch_row($result)) {
						$user = $result_r[0];
						$comment = $result_r[1];
						$date_time = $result_r[2];
						$c_id = $result_r[3]; 
						?>
						<tr valign="top">
							<td>
								<a> <?php echo $user;?> </a>
							</td>
							<td>
								<a> <?php echo $comment;?> </a>
							</td>
							<td>
								<a> <?php echo $date_time;?> </a>
							</td>
							
							<?php if($_SESSION['username'] != NULL) {  ?>
								<td>
								<form action="reply_comment.php" method="post">
								<input type="text" name="reply" size = "50">
								<input type="hidden" name="id" value='<?php echo "$c_id";?>'> 
								<input type="submit" name="post" value="Reply">
							</form>                    
							</td>
							<a><?php } else { ?> <td> <?php echo ' Must be signed in to reply to comments'; } ?></td></a>
							 </td>
						</tr>
						<?php
					}
                		?>
  			</table>
				
			  <?php if($_SESSION['username'] != NULL) {  ?>
				<form action="comment_action.php" method="post">
					<h3>Add Comment</h3>
					<input type="text" name="comment" size = "50">
				
					<input type="submit" name="post" value="Post Comment">
				</form>
				<br><br>
				<?php } else {?> <br><br> <?php echo '<h3>Must be signed in to post comments</h3>'; } ?>
		<?php } ?>
		</div>
	</body>
</html>
