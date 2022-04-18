<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Profile</title>
    <link rel="stylesheet" type="text/css" href="user-style.css">

</head>
<body>

  <?php
    require 'headers.php';
    include 'db_connection_test.php';
    
    $id=$_SESSION['username'];
    $query=mysqli_query($con,"SELECT * FROM users where username='$id'")or die(mysqli_error());
    $row=mysqli_fetch_array($query);
  ?>
  <h1>User Profile</h1>
  <div class="profile-input-field">
    <div class="form-group">
      <?php echo "<font color=white>"?>
      <label>Email: </label>
      <?php echo "<font color=white>" . $row['email']; ?>
    </div>
    <br>
    <div class="form-group">
      <label>Username: </label>
      <?php echo $row['username']; ?>
    </div>
  </div>


  <head>
	<title>User Media</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css"/>

</head>
<body>

    <?php
        
        $sql = "SELECT * FROM media WHERE username LIKE '$id'";
        
        $result = $con->query($sql);
    ?>

<?php
        if ($result->num_rows > 0) {
            while($result_r = mysqli_fetch_row($result)){
                $title = $result_r[3];     
                $date_published = $result_r[6]; 
                $views = $result_r[7];
                $keywords = $result_r[8]; 
                $viewing_groups = $result_r[11]; 
                $description = $result_r[12]; 
            }
        
            echo 
            '<table class="table center" id="contacts" width="25%" cellpadding="1" cellspacing="1">
                <tr>
                    <th>Title</th>
                    <th>Date Published</th>
                    <th>Views</th>
                    <th>Keywords</th>
                    <th>Viewing Groups</th>
                    <th>Description</th>
                </tr>
            
                
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
                    <td>
                    </td>
                    </tr>';
        }
      
    ?>
</body>
</html>
      