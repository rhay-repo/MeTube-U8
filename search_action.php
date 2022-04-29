<?php
     require 'headers.php';
     include 'db_connection_test.php';

     $media_array = array();

    function toMedia(&$file) {
      $_SESSION['media_id'] = $file;
      // header("Location: media.php");
    }

    function add_friend(&$uid, &$uidf) {
      if($_SESSION['username'] != NULL) {
        $query = "INSERT INTO contact_list VALUE ('{$uid}', '{$uidf}')";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
      } else {
        $_SESSION['error'] = "<a style='color:red;background-color:black;'>You are not logged in, therefore you cant subscribe, add friend, or favorite!</a>";

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
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Media Search</title>
    <link rel="stylesheet" type="text/css" href="homepage-style.css">
<style>

body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #8c72e0;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #3207ba;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}

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
</head>
<body>

<h1>MeTube Media Search</h1>

<form class="example" action="search_action.php" method = "post">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit"><i class="fa fa-search"></i></button>
<!-- </form> -->
<br><br>
<h1>Search by Category</h1>

<!-- <form class="category" action="search_action.php" method = "post"> -->
  <input type="submit" name="music" value="Music">
  <input type="submit" name="sports" value="Sports">
  <input type="submit" name="gaming" value="Gaming">
  <input type="submit" name="movies" value="Movies">
  <input type="submit" name="tvshows" value="TV Shows">
  <input type="submit" name="news" value="News">
  <input type="submit" name="education" value="Education">
  <input type="submit" name="comedy" value="Comedy">
</form>
<br>
<?php
  $data_query = "SELECT title, keywords, date_published, username FROM media";
  $result = mysqli_query($link, $data_query) or die("Query error: ". mysqli_error($link)."\n");
?>

<!-- Print the viewing table -->
<table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Title</th>
                    <th>Publisher</th>
                    <th>Keywords</th>
                    <th>Date Published</th>
                    <th>View Media</th>
                </tr>
                <?php
                    while($result_r = mysqli_fetch_row($result)) {
                        $title = $result_r[0];
                        $keywords = $result_r[1];
                        $date = $result_r[2]; 
                        // publisher of the media
                        $username = $result_r[3];
                ?>
                <tr valign="top">
                    <!-- Print the title of the media -->
                    <td>
                        <a> <?php echo $title;?> </a>
                    </td>
                    <!-- Print the publisher of the media -->
                    <td>
                        <a> <?php echo $username;?> </a>
                    </td>
                    <!-- Print the keywords of the media -->
                    <td>
                        <a> <?php echo $keywords;?> </a>
                    </td>
                    <!-- Print the date published of the media -->
                    <td>
                        <a> <?php echo $date;?> </a>
                    </td>
                    <!-- Print the button to open the media -->
                    <td>
                        <!-- <form action="media.php" method="post" value="<?php //echo $title; ?>"> -->
                        <form method="post" value="<?php echo $title; ?>">
                          <!-- Set the $view_title variable -->
                          <?php $view_title = "view_" . $title;?>
                          <!-- replace all spaces with underscores in the view title -->
                          <?php $view_title = str_replace(' ', '_', $view_title); ?>
                          <?php 
                                  
                            // print a view media button ... 
                            echo "<input type='submit' name='{$view_title}' value='View {$title}'>";
                            // ... and push the view_media button to the list (view_<title>, <title>)
                            array_push($media_array, array($view_title, $title)); //~need another var in the array being pushed??
                            
                            ?>
                                                 
                        </form>                    
                    </td>
                </tr>
                <?php
                    }
                ?>

                <?php    
                        $cnt = 0;
                        // loop through the array of remove button names
                        // for every button name ...
                        foreach ($media_array as $key => $value_array) { // $value_array ordered as [view_<title>, <title>]
                          // ... check if the button has been clicked ...  
                          if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                                // toMedia($value_array[2]);
                                // $_SESSION['media_id'] = $value_array[1];
                                $display_title = $value_array[1];

                                $cnt++;
                                // header("Location: media.php");

                                // echo "<meta http-equiv='refresh' content='0'>";

                        //     }   
                        // }
                ?>
  </table>
</body>
</html> 

<!-- ################################################### -->
<!--              HERE BEGINS MEDIA.PHP CODE             -->
<!-- ################################################### -->

<!-- <body>
    <br>
    <form action="search3.php" method="post">
        Search <input type="text" name="search"><br>
        <input type ="submit">
    </form>
</body> -->
  <div class="content">

  

		<?php
        if (isset($_POST['music'])) {
            $val = $_POST['music'];
        } 
        else if (isset($_POST['sports'])) {
            $val = $_POST['sports'];
        }
        else if (isset($_POST['gaming'])) {
            $val = $_POST['gaming'];
        }
        else if (isset($_POST['movies'])) {
            $val = $_POST['movies'];
        }
        else if (isset($_POST['tvshows'])) {
            $val = $_POST['tvshows'];
        }
        else if (isset($_POST['news'])) {
            $val = $_POST['news'];
        }
        else if (isset($_POST['education'])) {
            $val = $_POST['education'];
        }
        else if (isset($_POST['comedy'])) {
            $val = $_POST['comedy'];
        }
        else {
            $val = $_POST['search'];
        }
  
        if ($val == '') {
            header("Location: search_media.php");
        }
        else {
        
            $sql = "SELECT * FROM media WHERE title LIKE '%$val%' OR keywords LIKE '%$val%' OR category LIKE '$val' OR description LIKE '%$val%'";
        
           // $result = $con->query($sql);
            $result = mysqli_query($link, $sql) or die("Query error: ". mysqli_error($link)."\n");

        }

        // pull all of the associated information from the media
				while($r = $result->fetch_assoc()) {
					$id = $r["id"];
					$filepath = $r["filepath"];
					$user = $r["username"];
          // ~ consider changing THIS  $display_title variable to something unique
					$display_title = $r["title"];
					$type = $r["file_type"];
					$size = $r["file_size"];
					$date = $r["date_published"];
					$views = $r["views"];
					$keywordss = $r["keywords"];
					$rate = $r["media_rating"];
					$cat = $r["category"];
					$group = $r["viewing_groups"];
					$desc = $r["description"];

					$_SESSION['owner'] = $user;
				}




        // ~ add private and public viewing permissions

				// check if user is friend of media being viewed
        $array_of_contacts = array();
				$friend_query = "SELECT contact FROM contact_list WHERE username='{$user}'";
				$friend_result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
        // push all of my contacts to the array
        while($result_r = mysqli_fetch_row($result)) {
          array_push($array_of_contacts, $result_r[0]);
        }

        // loop through the array and check if I am contacts with the poster of this media file

				$has_private_permissions = false;

				// doesn't work needs some help
				// while($fr = $friend_result->fetch_assoc()) {
				// 	$c = $fr['contact'];
				// 	echo $c;
				// 	if($c == $_SESSION['username']) {
				// 		$has_private_permissions = true;
				// 	}
				// }

        // ~ handle public and private media

        // if the user logged in IS the publisher of the media
        if($loggedin == true) {
          // ... they automatically have private viewing permissions
          if($_SESSION['username'] == $user) {
            $has_private_permissions = true;
          }
        }







				// if($media_id != NULL) {
        // ~ consider changing this to "if isset(...)"
        if($display_title != NULL) {
					if($group == 'Public') {
						echo "<h1 style='background-color:black;'>".$display_title."</h1>";
						
						// Choose HTML option based on media type:
            // media is a video
						if ($type == 'mp4' or $type == 'ogg' or $type == 'webm') {
              //~
              echo "<h2 style='background-color:black;'>POSTING A VIDEO</h2>";
              echo "<video width='460' controls><source src='media/".$user."/".$filepath."' type='video/".$type."'></video>";
            }
            // media is an audio file (mp3)
            elseif ($type == 'mp3' or $type == 'wav') {
              //~
              echo "<h2 style='background-color:black;'>POSTING AUDIO</h2>";
              echo "<audio controls><source src='media/".$user."/".$filepath."' type='video/".$type."'></audio>";
            }
            // media is a jpeg or jpg
            elseif ($type == 'jpeg' or $type == 'jpg') {
              //~
              echo "<h2>POSTING A JPG</h2>";
              echo "<object data='media/".$user."/".$filepath."' width='460'></object>";
            }
            // media is some other kind of file
            else {
              //~
              echo "<h2 style='background-color:black;'>POSTING A PHOTO</h2>";
              echo "<img src='media/".$user."/".$filepath."' width='460'>"; //~height='345'
            }
						// echo "<img src='images/rjhay/goodvibes.jpg' width='460' height='345' >";

						echo "<h3 style='background-color:black;'>Published by ".$user."!</h3>";
						echo "<a href='channel_red.php'> Go to Channel </a>";
						echo "<br><br>";
            if($_SESSION['username'] == NULL) {
              echo "<a style='color:red;background-color:black;'>You are not logged in, therefore you cant subscribe, add friend, download, comment, or favorite!</a>";
            }
            else {
            // subscribe, add friend, favorite button group
						echo "<div class='btn-group' style='width:100%'>
								<button style='width=33.3%' onClick=".subscribe($_SESSION['username'], $user).">Subscribe</button>
								<button style='width=33.3%' onClick=".add_friend($_SESSION['username'], $user).">Add Friend</button>
								<button style='width=33.3%' onClick=".favorite($_SESSION['username'], $filepath).">Favorite</button>
							</div>";
            // download button
						echo "<br><form action='filesLogic.php' method='post'>
								<button type='submit' name='download'>DOWNLOAD</button>
								</form>";
            // add to playlist form
						echo "<br> <form method='POST'>
								<a> Add to Playlist </a><br>
								<input type='text' name='playlist' placeholder='Enter Playlist Name'>
								<input type='submit' name='add_to_playlist' value='Add to Playlist'>
							</form>";
            }
						
						echo "<br> <h3> Category: ". $cat."</h3> <br>";
						echo "<h3> Keywords: ". $keywordss."</h3> <br>";
						echo "<h3> Description: ". $desc."</h3> <br><br></form>";
					// Would like to change this to contacts only
					} else if($has_private_permissions) {
						echo "<h1 style='background-color:black;'> You have private permissions! </h1>";
						echo "<h1 style='background-color:black;'>".$display_title."</h1>";

						// Choose HTML option based on media type:
            // media is a video
						if ($type == 'mp4' or $type == 'ogg' or $type == 'webm') {
              echo "<video width='460' controls><source src='media/".$user."/".$filepath."' type='video/".$type."'></video>";
            }
            // media is an audio file (mp3)
            elseif ($type == 'mp3' or $type == 'wav') {
              echo "<audio controls><source src='media/".$user."/".$filepath."' type='video/".$type."'></audio>";
            }
            // media is a jpeg or jpg
            elseif ($type == 'jpeg' or $type == 'jpg') {
              echo "<object data='media/".$user."/".$filepath."' width='460'></object>";
            }
            // media is some other kind of file
            else {
              echo "<img src='media/".$user."/".$filepath."' width='460'>"; //~height='345'
            }
						// echo "<img src='media/me/goodvibes.jpg' width='460' height='345' >";

						echo "<h3 style='background-color:black;'>Published by ".$user."!</h3>";
						echo "<a href='channel_red.php'> Go to Channel </a>";
						echo "<br><br>";

            if($_SESSION['username'] == NULL) {
              echo "<a style='color:red;background-color:black;'>You are not logged in, therefore you cant subscribe, add friend, download, comment, or favorite!</a>";
            }
            else {
            // subscribe, add friend, favorite button group
						echo "<div class='btn-group' style='width:100%'>
								<button style='width=33.3%' onClick=".subscribe($_SESSION['username'], $user).">Subscribe</button>
								<button style='width=33.3%' onClick=".add_friend($_SESSION['username'], $user).">Add Friend</button>
								<button style='width=33.3%' onClick=".favorite($_SESSION['username'], $filepath).">Favorite</button>
							</div>";
            // download button
						echo "<br><form action='filesLogic.php' method='post'>
								<button type='submit' name='download'>DOWNLOAD</button>
								</form>";
            // add to playlist form
						echo "<br> <form method='POST'>
								<a> Add to Playlist </a><br>
								<input type='text' name='playlist' placeholder='Enter Playlist Name'>
								<input type='submit' name='add_to_playlist' value='Add to Playlist'>
							</form>";
            }

						echo "<br> <h3> Category: ". $cat."</h3> <br>";
						echo "<h3> Keywords: ". $keywordss."</h3> <br>";
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
                $query = "INSERT INTO playlist(filepath, username, playlist_title, time) VALUES ('{$display_title}', '{$_SESSION['username']}', '{$new_playlist}', NOW())";
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
		<?php if($has_private_permissions or $group == 'Public') { ?>
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
					FROM comments WHERE comments.filepath = '{$display_title}' ORDER BY comment_id DESC, datetime DESC";

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
							<td>
							<form action="reply_comment.php" method="post">
								<input type="text" name="reply" size = "50">
								<input type="hidden" name="id" value='<?php echo "$c_id";?>'> 
								<input type="submit" name="post" value="Reply">
							</form>                    
							</td>
						</tr>
						<?php
					}
                		?>
  			</table>

				<form action="comment_action.php" method="post">
					<h3>Add Comment</h3>
					<input type="text" name="comment" size = "50">
				
					<input type="submit" name="post" value="Post Comment">
				</form>
				<br><br>
		<?php } ?>
		</div>

<?php
// echo "<meta http-equiv='refresh' content='0'>";
        }   // close if (isset($_POST[$value_array[0]])) at the end of search_media.php
    } // close for each loop foreach ($media_array as $key => $value_array) at
 
?>