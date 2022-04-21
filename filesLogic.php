<?php
     require 'headers.php';
     include 'db_connection_test.php';

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $username = $_SESSION['username'];

    if (!file_exists('media/' . $username)) {
        mkdir('media/' . $username, 0777, true);
    }
    

    // destination of the file on the server
    $destination = 'media/' . $username . '/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
    $title = $_POST['fname'];
    $keywords = $_POST['keyword'];
    $cat = $_POST['category'];
    $viewgroup = $_POST['group'];
    $desc = $_POST['description'];



    if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpg', 'jpeg', 'mov', 'mp4', 'mp3', 'png'])) {
        echo "You file extension must be .zip, .pdf, .docx, .jpg, .jpeg, .mov, .mp4, .mp3, or .png";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO media(filepath, username, title, file_type, file_size, date_published, views, keywords, media_rating, category, viewing_groups, description) VALUES 
            ('$filename', '$username', '$title', '$extension', $size, curdate(), 0, '$keywords', 0, '$cat', '$viewgroup', '$desc')";
            if (mysqli_query($link, $sql)) {
                echo "File uploaded successfully";
                header("Location: media.php");
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}


// Download Media
if(isset($_GET['filepath'])) {
    $user = $_SESSION['username'];

    $id = $_GET['filepath'];

    $sql = "SELECT * FROM media WHERE filepath = '{$filepath}'";
    $result = mysqli_query($_SESSION['link'], $sql) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");

    $file = mysqli_fetch_assoc($result);

    // $media_id = $result[0];
    $filepath = $result[1];
    //~ echo "<h1 style='color: blue;font-family: verdana;font-size: 300%;'>" . $filepath;
    //~REAGAN:
    $_SESSION['media_id'] = $filepath;
    // $user = $result[2];

    $url = 'media/'.$user.'/'.$file['filepath'];

    if(file_exists($url)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($url));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $user. '/'. $file['filepath']));
        readfile('uploads/' . $file['filepath']);

        $download = "INSERT INTO download_media(username, filepath, time) VALUES ('{$_SESSION['username']}', '$filepath', curdate())";
        $result_down = mysqli_query($_SESSION['link'], $download) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
        exit;

    }
}
?>