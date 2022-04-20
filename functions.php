<?php
    //require 'headers.php';
    $error       = '';
    $hostname    = "mysql1.cs.clemson.edu";
    $db_username = "MeTube_4620_q9av";
    $pswd        = "CP\$C4620!";
    $db_name     = "MeTube_4620_2f01";
    $loggedin;

    // // Connecting, selecting database
    $link = mysqli_connect($hostname,$db_username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    // verify that session started for page
    // function session_start_check() {
    //     if ( php_sapi_name() !== 'cli' ) {
    //         if ( version_compare(phpversion(), '5.4.0', '>=') ) {
    //             return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    //         } else { return session_id() === '' ? FALSE : TRUE; }
    //     }
    //     return FALSE;
    // }

    // verify that user is logged in
    // function user_login_check() {
    //     if(isset($_SESSION['loggedin'])) {
    //         return TRUE;
    //     } else { return FALSE; }
    // }

    // add friend
    // function add_friend(&$uid, &$uidf) {
    //     $query = "INSERT INTO contact_list VALUE ($uid, $uidf)";
    //     $result = mysqli_query($link, $query) or die("Query error: ". mysquli_error($link)."\n");
    // }
    // function add_friend($friend) {
    //     if($_SESSION['loggedin'] != $friend && user_login_check()) {
            
    //     }
    // }

    // remove friend
    // function remove_friend(&$uid, &$uidf) {
    //     $query = "DELETE FROM contact_list WHERE username = $uid AND contact = $uidf";
    //     $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link)."\n");
    // }
?>