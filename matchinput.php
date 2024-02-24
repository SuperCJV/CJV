<!DOCTYPE html>
  <html lang="en">
    <head>
        <title>matchinput.php</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <style>
            body, h1, h2, h3, h4, h5 {font-family: "Poppins", sans-serif}
            body {font-size:16px;}
            .w3-half img {margin-bottom: -6px; margin-top: 16px; opacity: 0.8; cursor: pointer;}
            .w3-half img:hover {opacity: 1;}
        </style>
    </head>
    <body>
    
    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
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
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $datedueInput = $_POST['datedue'];
    
        // INSERT datedue
        $sql = "INSERT INTO weeks (datedue) VALUES ('$datedueInput')";
        mysqli_query($conn, $sql);
    
        // INSERT team name
        $team11 = $_POST['t11name'];
        $team12 = $_POST['t12name'];
        $team13 = $_POST['t13name'];
        $team14 = $_POST['t14name'];
        $team15 = $_POST['t15name'];
        $team21 = $_POST['t21name'];
        $team22 = $_POST['t22name'];
        $team23 = $_POST['t23name'];
        $team24 = $_POST['t24name'];
        $team25 = $_POST['t25name'];
    
        // Select max weekID from weeks
        $sql2 = "SELECT MAX(weekID) FROM weeks";
        $result = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($result);
        $weekIDmatch = $row['MAX(weekID)'];
    
        // team1score and team2score have default values
        $sql3 = "INSERT INTO matches (weekID, team1, team1score, team2, team2score) VALUES
        ($weekIDmatch, '$team11', -1, '$team21', -1),
        ($weekIDmatch, '$team12', -1, '$team22', -1),
    
        ($weekIDmatch, '$team13', -1, '$team23', -1),
        ($weekIDmatch, '$team14', -1, '$team24', -1),
        ($weekIDmatch, '$team15', -1, '$team25', -1)";
    
    if ($conn->query($sql3) === TRUE) {
        echo "<p>You have successfully inputted the matches.<br></p>";
    } else {
        echo "<p>Error: " . $sql3 . "<br></p>" . $conn->error;
    }
    ?>
    </div>
    </div>
  </body>
</html>
