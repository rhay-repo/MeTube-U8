<?php
    //require 'headers.php';

    // verify that session started for page
    function session_start_check() {
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else { return session_id() === '' ? FALSE : TRUE; }
        }
        return FALSE;
    }

    // verify that user is logged in
    function user_login_check() {
        if(isset($_SESSION['logged_in'])) {
            return TRUE;
        } else { return FALSE; }
    }

    // add friend
    function add_friend($uid, $uidf) {
        $query = "SELECT * FROM friendList where uiD = $uid and uidF = $uidf";

    }

    // remove friend
    function remove_friend() {

    }
?>