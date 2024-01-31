<!DOCTYPE html>
<html lang="en">
    <title>changepasswordinput.php</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <style>
        body, h1, h2, h3, h4, h5 {font-family: "Poppins", sans-serif}
        body {font-size: 16px;}
        .w3-half img {margin-bottom: -6px; margin-top: 16px; opacity: 0.8; cursor: pointer}
        .w3-half img:hover {opacity: 1}
    </style>
    <body>
        <!-- Sidebar/menu -->
        <nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
            <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
            <div class="w3-container">
                <h3 class="w3-padding-64"><b>Ultimate Football</b></h3>
                <div class='w3-bar-block'>
                    <a href='/php_ib/ultimatefootball_database/homepage.php' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Home</a>
                    <a href='/php_ib/ultimatefootball_database/logout.php' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Logout</a>
                </div>
            </div>
        </nav>

        <!-- Top menu on small screens -->
        <header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
            <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
            <span>Ultimate Football</span>
        </header>

        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:340px;margin-right:40px">

            <!-- Header -->
            <div class="w3-container" style="margin-top:80px" id="showcase">
                <h1 class="w3-jumbo"><b>Change your password</b></h1>
                <h1 class="w3-xxxlarge w3-text-red"><b>Are you sure you want to change your password? </b></h1>
                <hr style="width:50px;border:5px solid red" class="w3-round">
                <p>
                    <form action="changepassword.php" method="post">
                        <label for="password">New Password: <br>
                            <input type="password" name="password" id="password"></br>
                            <br><input type="submit" value="Change Password"></br>
                    </form>
                </p>

                <?php 
                session_start(); //connect to current session 
                if (!isset($_SESSION["currentuser"])){ //if the current user variable is not set 
                    session_destroy(); 
                    header("Location:../ultimatefootball_database/userlogin.html");
                } 
                $servername = "localhost"; 
                $username = "Cristian"; 
                $password = "Thisiscristian"; 
                $dbname = "UltimateFootball"; 

                // Create connection 
                $conn = mysqli_connect($servername, $username, $password, $dbname); 

                // Check connection 
                if ($conn->connect_error) { 
                    die("Connection failed: " . $conn->connect_error);
                } 
                ?>
            </div>
        </div>
    </body>
</html>
