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
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Profile</title>
    <link rel="stylesheet" type="text/css" href="user-style.css">

    
</head>
<body>

  <?php
    require 'headers.php';
    include 'db_connection_test.php';
    
    $id=$_SESSION['owner'];
    // $user_email=$_SESSION['email'];
    $query=mysqli_query($con,"SELECT viewing, email FROM users where username='$id'")or die(mysqli_error());
    //$row=mysqli_fetch_array($query);

    while($r = $query->fetch_row()) {
        $viewing = $r[0];
        $user_email = $r[1];
    }

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

    if($viewing == 'Public') {
        echo ' <br><h1>'.$id.' Profile </h1>';

        echo "<div class='btn-group' style='width:100%'>
                <button style='width=25%' onClick=".subscribe($id, $_SESSION['username']).">Subscribe</button>
                <button style='width=25%' onClick=".add_friend($id, $_SESSION['username']).">Add Friend</button>
            </div><br>";

        echo'  <table class="table center" id="contacts" width="50%" cellpadding="1" cellspacing="1">';

        echo'    <tr>
                <th>Email</th>
                <th>Username</th>
            </tr>
        
            <tr valign="top">
                <td>
                    <a>' .$user_email;
        echo '
                </td>
                <td>
                    <a>' .$id;
        echo '</a>
                </td>';
    
        
        $sql = "SELECT * FROM media WHERE username LIKE '$id'";
        
        $result = $con->query($sql);
    
    echo ' <table class="table center" id="contacts" width="10%" cellpadding="1" cellspacing="1">
             <br><br><h1>'.$id.' Media</h1>
                 <tr>
                    <th>Title</th>
                    <th>Date Published</th>
                    <th>Views</th>
                    <th>Keywords</th>
                    <th>Viewing Groups</th>
                    <th>Description</th>
                </tr>';
        if ($result->num_rows > 0) {
            
            while($result_r = mysqli_fetch_row($result)){
                $title = $result_r[3];     
                $date_published = $result_r[6]; 
                $views = $result_r[7];
                $keywords = $result_r[8]; 
                $viewing_groups = $result_r[11]; 
                $description = $result_r[12]; 

                echo '   
                    <tr valign="top">
                    <td>
                        <a>' .$title;
            echo '
                    </td>
                    <td>
                        <a>' .$date_published;
            echo '</a>
                    </td>
                    <td>
                        <a>' .$views;
            echo '</a>
                    </td>
                    <td>
                        <a>' .$keywords;
            echo '
                    </td>
                    <td>
                        <a>' .$viewing_groups;
            echo '
                    </td>
                    <td>
                        <a>' .$description;
            echo '
                    </td>
                    </tr>';
            }
        
        }
    } else {
        echo "<h1> This is a Private User! </h1>";
    }    
      
    ?>
</body>
</html>
      