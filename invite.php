<!DOCTYPE html>
<html lang="en">
    <head>
        <title>invite.php</title>
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

        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:340px;margin-right:40px">

            <!-- Header -->
            <div class="w3-container" style="margin-top:80px" id="showcase">
                <hr style="width:50px;border:5px solid red" class="w3-round">
                <?php
                include 'topper.php';
                $servername = "localhost";
                $username = "Cristian";
                $password = "Thisiscristian";
                $dbname = "UltimateFootball";

                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                //Select userid from user
                $inviteInput = $_POST["inviteuser"];
                $sql1 = "SELECT userid FROM user WHERE username = '$inviteInput'";
                $result = mysqli_query($conn, $sql1);
                if ($row = mysqli_fetch_assoc($result)) {
                    $useridplayer = $row['userid'];

                    $leaguename = $_SESSION["currentleague"];
                    //Select leagueid from league
                    $sql2 = "SELECT leagueid FROM league WHERE leaguename = '$leaguename'";
                    $result = mysqli_query($conn, $sql2);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $leagueidplayer = $row['leagueid'];

                        //Selecting invite and verify if user exists
                        $sql3 = "SELECT username FROM user WHERE username = '$inviteInput'";
                        $result = mysqli_query($conn, $sql3);
                        if ($result->num_rows > 0) {
                            //Insert into players table leagueid, userid and invited user
                            $sql4 = "INSERT INTO players (leagueid, userID, username) VALUES ('$leagueidplayer', '$useridplayer', '$inviteInput')";
                            if (mysqli_query($conn, $sql4)) {
                                echo "Successfully invited player. ";
                            } else {
                                echo "Error in inviting player. ";
                            }
                        } else {
                            echo "Error. Player does not exist. ";
                        }
                    } else {
                        echo "League not found.";
                    }
                } else {
                    echo "User not found.";
                }

                echo "<br><a href='inviteinput.php?id=" . $leaguename . "'>Would you like to invite another player?</a>";
                ?>
            </div>
        </div>
    </body>
</html>
