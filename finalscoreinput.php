<!DOCTYPE html>
<html lang="en">
<head>
    <title>finalscoreinput.php</title>
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

<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
    <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
    <span>Company Name</span>
</header>

<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<div class="w3-main" style="margin-left:340px;margin-right:40px">
    <div class="w3-container" style="margin-top:80px" id="showcase">
        <h1 class="w3-jumbo"><b>Input final scores</b></h1>
        <h1 class="w3-xxxlarge w3-text-red"><b>Are you sure you want to input the final scores cris?</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
        <?php
        include 'topper.php';
        $servername = "localhost";
        $username = "Cristian";
        $password = "Thisiscristian";
        $dbname = "UltimateFootball";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql1 = "SELECT MAX(weekID) FROM weeks";
        $result = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($result);
        $weekIDid = $row['MAX(weekID)'];
        $sql2 = "SELECT datedue FROM weeks WHERE weekID = $weekIDid";
        $result = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($result);
        $datedueoutput = $row['datedue'];
        echo "<p><br><strong>Input final score from the matches where the date due is:</strong> $datedueoutput<br></p>";
        $team1score = array('t0', 't11', 't12', 't13', 't14', 't15');
        $team2score = array('t0', 't21', 't22', 't23', 't24', 't25');
        $matchnum = array('0', '1', '2', '3', '4', '5');
        $sql3 = "SELECT team1, team2 FROM matches WHERE weekID = $weekIDid";
        $result = $conn->query($sql3);
        if ($result->num_rows > 0) {
            echo "<p><br><table><tr><th> Match Num. </th><th> Team 1 </th><th>Final Score </th><th> Team 2 </th><th> Final Score </th><th> Submit </th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td><input type='text' name='matchnum[]' value='" . current($matchnum) . "' readonly></td>
                <td>" . $row['team1'] . "</td>
                <td><input type='number' name='team1score[]'></td>
                <td>" . $row['team2'] . "</td>
                <td><input type='number' name='team2score[]'></td>
                <td><input type='submit' value='Submit'></td></tr>";
                next($matchnum);
            }
            echo "</table>";
        } else {
            echo "You have no matches scheduled for this week.";
        }
        echo "</form>";
        ?>
    </div>
</div>
</body>
</html>
