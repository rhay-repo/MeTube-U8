<?php 

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        $loggedin= true;
    }
    else{
        $loggedin = false;
    }

    if($loggedin == false){
        echo '<!DOCTYPE html>
        <html>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        
        .navbar {
            width: 100%;
            background-color: #555;
            overflow: auto;
        }
        
        .navbar a {
            float: right;
            padding: 12px;
            color: white;
            text-decoration: none;
            font-size: 17px;
        }
        
        .dropdown {
            float: left;
            overflow: auto;
            
        }
        
        .dropdown .dropbtn {
            font-size: 16px;  
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }
        
        .navbar a:hover, .dropdown:hover .dropbtn {
            background-color: #8c72e0;
        }
        
        @media screen and (max-width: 500px) {
            .navbar a {
            float: none;
            display: block;
            }
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        
        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        </style>
        <body>
        
        <div class="navbar">
            <a href="guest_homepage.php"><i class="fa fa-fw fa-home"></i> Home</a>
            
            <div class="dropdown">
                <button class="dropbtn"> 
                <i class="fa fa-fw fa-user"></i><i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="register.php" target="blank"><i class="fa fa-user-plus"></i> Create Account</a>
                <a href="login.php" target="blank"><i class="fa fa-sign-in"></i> Login</a>
                </div>
            </div> 
        </div>
        
        
        </body>
        </html>';
    }

    if($loggedin == true){
        echo '<!DOCTYPE html>
        <html>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        
        .navbar {
            width: 100%;
            background-color: #555;
            overflow: auto;
        }
        
        .navbar a {
            float: right;
            padding: 12px;
            color: white;
            text-decoration: none;
            font-size: 17px;
        }
        
        .dropdown {
            float: left;
            overflow: auto;
            
        }
        
        .dropdown .dropbtn {
            font-size: 16px;  
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }
        
        .navbar a:hover, .dropdown:hover .dropbtn {
            background-color: #8c72e0;
        }
        
        @media screen and (max-width: 500px) {
            .navbar a {
            float: none;
            display: block;
            }
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        
        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        </style>
        <body>
        
        <div class="navbar">
             <a href="user_homepage.php"><i class="fa fa-fw fa-home"></i> Home</a>
             <a href="#">Welcome back!</a>
            <div class="dropdown">
                <button class="dropbtn"> 
                <i class="fa fa-fw fa-user"></i><i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="view_profile.php" target="blank"><i class="fa fa-user"></i> Profile</a>
                <a href="contact_list.php" target="blank"><i class="fa fa-address-book"></i> Contacts</a>
                <a href="search_media.php" target="blank"><i class="fa fa-search"></i> Search Media</a>
                <a href="upload_media.php" target="blank"><i class="fa fa-upload"></i> Upload Media</a>
                <a href="edit_profile.php" target="blank"><i class="fa fa-cog"></i> Settings</a>
	            <a href="logout.php" target="blank"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </div> 

        </div> 
        </body>
        </html>';
    }
?>