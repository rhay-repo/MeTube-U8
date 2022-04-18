<!-- 
media.php

Displays a media item

TODO:
-->
<?php
	include "headers.php";
	include_once "functions.php";
	if(isset($_POST['id']) && isset($_POST['description'])){
		$postid = $_POST['id'];
		$postdescription = $_POST['description'];
		$query = "UPDATE media 
					SET description = '$postdescription '
					WHERE id = $postid";
		$result = mysqli_query($link, $query);
		if (!$result){
		   die ("Could not query the media table in the database: <br>". mysqli_error($link));
		}
		echo "success";
		return;
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>View Media</title>
</head>
<style>
.jumbotron
{
	padding-top: 10px;
}
#mainimage{
   	width:100%;
   	max-width:600px;
   	margin: 0 auto;
}
</style>
	<body> 
	
<div class="container">
  <div class="jumbotron">
	<?php
		if(isset($_GET['id'])) {
			$user = $_SESSION['username'];
			$query = "SELECT title, filepath, file_type, description, username FROM media WHERE id='".$_GET['id']."'";
			$result = mysqli_query($link, $query);
			$result_row = mysqli_fetch_row($result);
	
	//updateMediaTime($_GET['id']);
	
			$filename=$result_row[0];
			$filepath=$result_row[1]; 
			$type=$result_row[2];
			$description = $result_row[3];
			$submitter = $result_row[4];
	

	// this part is confusing
	$query = "SELECT username FROM user WHERE username = $submitter";
	$result = mysqli_query($link,$query);
	if (!$result){
	   die ($query."Could not query the comment table in the database: <br />". mysqli_error($link));
	}
	$result_row = mysqli_fetch_row($result);
	$sname = $result_row[0];
	$ucasename = ucfirst($sname);
	echo "<h1>$filename by <a href =\"user.php?id=$submitter\">$ucasename</a></h1>";
	
	// view image
	if(substr($type,0,5)=="image")  {
		?>
		<img id="mainimage" src="<?php echo $filepath;?>" class="img-responsive" alt="<?php echo $filename;?>">
		<?php 
	} else {	
		?>
		<!-- view movie -->
			<video id="mainvideo" width="580" controls>
				<source src="<?php echo $filepath?>" type="video/mp4">
				<source src="mov_bbb.ogg" type="video/ogg">
				Your browser does not support HTML5 video.
			</video>
			<br />
		<?php
	}
	
	// $vid_id = $_GET['id'];
	// echo "<br>";
	// favorite($vid_id);
	// echo "<br>";
	// echo "<br>";
	// playlists($vid_id);
		
	// enter description
	if(!empty($description)) {
		echo "<b>Media Description:</b><p id=\"description\">$description</p>";
	} else {
		echo "<b><h2>Media Description:</h2></b><p id=\"description\">No Description Available</p>";
		echo "</p>";
	}
	
	echo "<p>Comments: </br></p>";
	// comment things


		$query = "SELECT username, comments, comment_date, filepath FROM comments WHERE filepath = '{$filepath}' ORDER BY comment_date ASC";
		$result = mysqli_query($link,$query);
		if (!$result){
		   die ($query."Could not query the comment table in the database: <br />". mysqli_error($link));
		}
		echo "<table width=\"95%\" border=\"1\">";
		while($result_row = mysqli_fetch_row($result)){
			$u_id = $result_row[0];
			$content = $result_row[1];
			$c_time = $result_row[2];
			$comment_id = $result_row[3];
			// $query = "SELECT username FROM user WHERE id = $u_id";
			// $result2 = mysqli_query($link,$query);
			// if (!$result){
			//    die ($query."Could not query the comment table in the database: <br />". mysqli_error($link));
			// }
			// $result_row2 = mysqli_fetch_row($result2);
			// $uname = $result_row2[0];
			?>
			<tr>
				<td id="comment_cell">
					<?php
					if(isset($_SESSION['username'])) {		
						echo "<form method=\"post\" action=\"comment_process.php?v_id=".$_GET['id']."\" >";
						?>
						<input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
						<input value="X" name="X" type="submit" />
						</form>
						<?php
					}
					?>
					<b><?php echo $u_id ?>:</b>
					<?php echo $content ?>
					<br />
					<br />
					<em>Posted at: <?php echo $c_time ?> </em>
				</td>
			</tr>
			
<?php

	if(isset($_SESSION['username'])) {
			echo "<p>
			<form method=\"post\" action=\"comment_process.php?v_id=".$_GET['id']."\" >";
			?>
			<textarea rows="4" cols="50" name="comment" id="comment"></textarea></br>
			<input value="Submit" name="submit" type="submit" />
			</form>
			</p>
			<?php
		}
	} 

if(isset($_GET['result'])) {
	$res = $_GET['result'];
	if($res > 0 && $res <= 4)
		echo "File error. File was not uploaded";
	else if($res == 5)
		echo "A file that you uploaded has the same name, try changing the filename. File was not 	
			uploaded.";
	else if($res == 6)
		echo "Failed to move file from temporary directory. File was not uploaded.";
	else
		echo "File was successfully uploaded.";
} else {
?>
<meta http-equiv="refresh" content="0;url=browse_media.php?category=All&search=">
<?php
}
}
?>
</div>
</div>
</body>
</head>
</html>