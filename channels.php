<?php
    // include standard variables
    require 'headers.php';
    
    // ~
    // Connecting, selecting database
    // $link = mysqli_connect($hostname,$username,$pswd,$db_name) or die ('Could not connect (ERROR):' .mysqli_error($link));

    $view_channel_array = array();
    $del_channel_array = array();

    function delete_channel(&$channel) {
        $query = "DELETE FROM subscribe WHERE user='{$_SESSION['username']}' AND channel='{$channel}'";
        $result = mysqli_query($_SESSION['link'], $query) or die("Query error test: ". mysqli_error($_SESSION['link'])."\n");;
    }

    function gotoChannel(&$channel) {
        $_SESSION['owner'] = $channel;
        header("Location: view_channel.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Channel Subscriptions </title>
        <link rel="stylesheet" type="text/css" href="homepage-style.css">
        <body>
            <h1> Channel Subscriptions </h1>

            <?php
                $query = "SELECT * FROM subscribe WHERE user = '{$_SESSION['username']}'";
                $result = mysqli_query($link, $query) or die("Query error: ". mysqli_error($link). "\n");
            ?>

            <table class="table center" id="contacts" width="20%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Channel Name</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                <?php
                    while($result_r = mysqli_fetch_row($result)) {
                        $user = $result_r[0];
                        $channel = $result_r[1];                 
                ?>
                <tr valign="top">
                    <td>
                        <a> <?php echo $channel;?> </a>
                    </td>
                    <td>
                    <form method="post">
                        <?php $view_channel = "view_" . $channel;?>
                        <input type='submit' name=<?php echo $view_channel; ?> value='View'>
                        <?php array_push($view_channel_array, array($view_channel, $_SESSION['username'], $channel)); ?>
                    </form>                                     
                    </td>
                    <td>
                        <form method='post'>
                            <?php $delete_channel = "del_".$channel;?>
                            <input type='submit' name=<?php echo $delete_channel; ?> value='Delete'>
                            <?php array_push($del_channel_array, array($delete_channel, $_SESSION['username'], $channel)); ?>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                ?>

                <?php

                    $cnt = 0;
                    // loop through the array of add button names
                    // for every button name ... 
                    foreach ($del_channel_array as $key => $value_array) {
                        // ... check if button has been clicked ...
                        if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                            // ... then add respective user.
                            delete_channel($value_array[2]);
                            $cnt++;
                        }   
                    }

                    $cnt = 0;
                    // loop through the array of add button names
                    // for every button name ... 
                    foreach ($view_channel_array as $key => $value_array) {
                        // ... check if button has been clicked ...
                        if (isset($_POST[$value_array[0]]) && $cnt < 1) {
                            // ... then add respective user.
                            gotoChannel($value_array[2]);
                            $cnt++;
                        }   
                    }

                ?>
            </table>
        </body>
    </head>
</html>
