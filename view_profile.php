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
    $user_email=$_SESSION['email'];
    $query=mysqli_query($con,"SELECT * FROM users where username='$id'")or die(mysqli_error());
    $row=mysqli_fetch_array($query);
  ?>
    <?php echo 
        '<table class="table center" id="contacts" width="50%" cellpadding="1" cellspacing="1">
            <br><h1>Your Profile</h1>    
            <tr>
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
    ?>
            
<body>

    <?php
        
        $sql = "SELECT * FROM media WHERE username LIKE '$id'";
        
        $result = $con->query($sql);
    ?>

<?php
    echo ' <table class="table center" id="contacts" width="10%" cellpadding="1" cellspacing="1">
             <br><br><h1>Your Media</h1>
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
        
            // echo 
            // '<table class="table center" id="contacts" width="10%" cellpadding="1" cellspacing="1">
            //     <br><br><h1>Your Media</h1>
            //     <tr>
            //         <th>Title</th>
            //         <th>Date Published</th>
            //         <th>Views</th>
            //         <th>Keywords</th>
            //         <th>Viewing Groups</th>
            //         <th>Description</th>
            //     </tr>
            
                
            //     <tr valign="top">
            //         <td>
            //             <a>' .$title;
            // echo '
            //         </td>
            //         <td>
            //             <a>' .$date_published;
            // echo '</a>
            //         </td>
            //         <td>
            //             <a>' .$views;
            // echo '</a>
            //         </td>
            //         <td>
            //             <a>' .$keywords;
            // echo '
            //         </td>
            //         <td>
            //             <a>' .$viewing_groups;
            // echo '
            //         </td>
            //         <td>
            //             <a>' .$description;
            // echo '
            //         </td>
            //         </tr>';
        }
      
    ?>
</body>
</html>
      