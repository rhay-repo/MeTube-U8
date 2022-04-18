<?php
    include_once "functions.php";
    include_once "headers.php";

    $username = $_SESSION['username'];

    // creates editable media directory
    if(!file_exists('media/')) {
        mkdir('media/');
        chmod('media', 0755);
    }

    // creates editable user directory
    $dir = 'media/'.$username.'/';
    if(!file_exists($dir)) {
        mkdir($dir);
        chmod($dir, 0755);

        if($_FILES["file"]["error"] > 0) {
            // produces number 1-4
            $result = $_FILES["file"]["error"];
        } else {
            $upload = $dir.urlencode($_FILES["file"]["name"]);
            while(file_exists($upload)) {
                $rand = rand();
                $upload = $dir.urlencode($rand."".$_FILES["file"]["name"]);
            }

            if(file_exists($upload)) {
                // file successfully uploaded
                $result = "5";
            } else {
                if(is_uploaded_file($_FILES["file"]["tmp"])) {
                    if(!move_uploaded_file($_FILES["file"]["tmp"], $upload)) {
                        // failed to move file successfully
                        $result = "6";
                    } else {
                        $insert = "INSERT INTO media(filepath, username, title, file_type, keywords, category, viewing_groups, description)".
                        "values(
                            '$upload',
                            '$username',
                            '".$_POST["title"]."',
                            '".$_FILES["file"]["type"]."',
                            '".$_POST["keyword"]."',
                            '".$_POST["category"]."',
                            '".$_POST["group"]."',
                            '".mysqli_real_escape_string($link, $_POST["description"])."'
                            )";

                        $query_insert = mysqli_query($link, $insert) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
                        // successful upload
                        $result = "0";
                        chmod($upload, 0644);
                        $id_query = "SELECT id FROM media WHERE file_path = '$upload'";
                        $id_result = mysqli_query($link, $id_query);
                        if(!$id_result) die("Query error test: ". mysqli_error($_SESSION['link'])."\n");
                        $result_r = mysqli_fetch_row($id_result);
                        $id = $result_r[0];
                    }
                } else {
                    // failed to upload
                    $result = "7";
                }
            }
        }
    }

    if(isset($id)) {
        ?>
        <meta http-equiv="refresh" content="0;url=media.php?id=<?php echo $id;?>">
        <?php
    } else {
        ?>
        <meta http-equiv="refresh" content="0;url=media.php?result=<?php echo $result;?>">
        <?php
    }
?>