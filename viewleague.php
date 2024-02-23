<!DOCTYPE html>
<html lang="en">
    <head>
        <title>viewleague.php</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <style>
            body, h1, h2, h3, h4, h5 {font-family: "Poppins", sans-serif}
            body {font-size:16px;}
            .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
            .w3-half img:hover{opacity:1}
        </style>
    </head>
    <body>

        <!-- Sidebar/menu -->
        <nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar">
            <br>
            <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
            <div class="w3-container">
                <h3 class="w3-padding-64"><b>Ultimate League</b></h3>
                <div class='w3-bar-block'>
                    <a href='/php_ib/ultimatefootball_database/homepage.php' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Home</a>
                    <a href='/php_ib/ultimatefootball_database/logout.php' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Logout</a>
                </div>
            </div>
        </nav>

        <!-- Top menu on small screens -->
        <header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
            <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
            <span>Ultimate League</span>
        </header>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:340px;margin-right:40px">
            <div class='w3-container' style='margin-top:80px' id='viewleague'>
                <h1 class='w3-jumbo'><b>View your own leagues</b></h1>
                <h1 class='w3-xxxlarge w3-text-red'><b>What would you like to do?</b></h1>
                <hr style='width:50px;border:5px solid red' class='w3-round'>
                <?php
                include 'topper.php';
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

                $sql1 = "SELECT userid FROM user WHERE username = '" . $_SESSION["currentuser"] . " '";
                $result = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_assoc($result);
                $ownerid = $row['userid'];

                $leaguenameInput = $_POST['leaguename'];
                $sql2 = "INSERT INTO league (owner, leaguename) VALUES ('$ownerid', '$leaguenameInput')";

                if ($conn->query($sql2) === TRUE) {
                    echo "<p>New League created successfully. <br></p>";
                } else {
                    echo "<p>Error: " . $sql . "<br></p>" . $conn->error;
                }

                $sql3 = "SELECT userid FROM user WHERE username = '" . $_SESSION["currentuser"] . " '";
                $result = mysqli_query($conn, $sql3);
                $row = mysqli_fetch_assoc($result);
                $useridplayerr = $row['userid'];

                $sql4 = "SELECT leagueid FROM league WHERE leaguename = '$leaguenameInput'";
                $result = mysqli_query($conn, $sql4);
                $row = mysqli_fetch_assoc($result);
                $leagueidplayerr = $row['leagueid'];

                $sql5 = "INSERT INTO players (leagueid, userID, username) VALUES ('$leagueidplayerr('$leagueidplayerr', '$useridplayerr', '" .
                
                $_SESSION["currentuser"]. "')";
                $result = mysqli_query($conn, $sql5);
                $row = mysqli_fetch_assoc($result);
                ?>
            </div>
        </div>
    </body>
</html>
