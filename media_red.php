<?php
    if(isset($_POST['value'])) {
        $val = $_POST['value'];
        $_SESSION['media_id'] = $val;
        header("Location: media.php");
    }
    header("Location: media.php");

?>