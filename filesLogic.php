<?php
     require 'headers.php';
     include 'db_connection_test.php';

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $username = $_SESSION['username'];

    if (!file_exists('../media/' . $username)) {
        mkdir('../media/' . $username, 0777, true);
    }
    

    // destination of the file on the server
    $destination = '../media/' . $username . '/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
    $title = $_GET['fname'];
    $keywords = $_GET['keyword'];
    $cat = $_GET['category'];
    $viewgroup = $_GET['group'];
    $desc = $_GET['description'];



    if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpg', 'jpeg', 'mov', 'mp4', 'mp3', 'png'])) {
        echo "You file extension must be .zip, .pdf, .docx, .jpg, .jpeg, .mov, .mp4, .mp3, or .png";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO media(filepath, username, title, file_type, file_size, date_published, views, keywords, media_rating, category, viewing_groups, description) VALUES 
            ('$filename', '$username', '$title', '$extension', $size, GETDATE(), 0, '$keywords', 0, '$cat', '$viewgroup', '$desc')";
            if (mysqli_query($link, $sql)) {
                echo "File uploaded successfully";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}


// Download Media
if(isset($_GET['filepath'])) {
    $id = $_GET['filepath'];
}
?>