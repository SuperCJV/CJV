<!DOCTYPE html>
<html lang="en">
<head>
    <title>leaderboard.php</title>
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
    <div class='w3-container' style='margin-top:80px' id='viewleague'>
        <h1 class='w3-jumbo'><b>View the leaderboard</b></h1>
        <h1 class='w3-xxxlarge w3-text-red'><b>Who is winning?</b></h1>
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
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $_SESSION["currentleague"] = $_GET['id'];

        echo "<strong>Perfect score:</strong> 5 points<br>
        <strong>Perfect spread:</strong> 3 points<br>
        <strong>Correct winner:</strong> 1 point <br>";

        $leaguenames = $_SESSION["currentleague"];
        $sql1 = "SELECT leagueid FROM league WHERE leaguename = '$leaguenames'";
        $result = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($result);
        $leagueID = $row['leagueid'];

        $usernames = $_SESSION["currentuser"];
        $sql2 = "SELECT userid FROM user WHERE username = '$usernames'";
        $result = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($result);
        $userID = $row['userid'];

        $sql3 = "SELECT MAX(matchid) FROM matches";
        $result = mysqli_query($conn, $sql3);
        $row = mysqli_fetch_assoc($result);
        $maxmatchid = $row['MAX(matchid)'];

        $bmatchid = $maxmatchid - 4;
        $cmatchid = $maxmatchid - 3;
        $dmatchid = $maxmatch - 2;
        $ematchid = $maxmatchid - 1;

$matches = array($bmatchid, $cmatchid, $dmatchid, $ematchid, $maxmatchid);
$users = array();
$finalScores = array();

$newfinalScores = array();

$sql4 = "SELECT userid FROM prediction WHERE leagueid = '$leagueID' AND matchid = 1";
$result = mysqli_query($conn, $sql4);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row['userid'];
    }
}
foreach ($users as $userid) {
    $total = 0;
    foreach ($matches as $matchid) {
        $sql5 = "SELECT matches.team1score, matches.team2score, prediction.team1prediction, prediction.team2prediction FROM matches JOIN prediction ON matches.matchid = prediction.matchid WHERE matches.matchid = $matchid AND prediction.matchid = $matchid AND userid = $userid AND leagueid = $leagueID";
        $result = mysqli_query($conn, $sql5);
        if ($row = mysqli_fetch_assoc($result)) {
            $team1prediction = $row['team1prediction'];
            $team2prediction = $row['team2prediction'];
            $team1score = $row['team1score'];
            $team2score = $row['team2score'];
            $point = 0;
            if ($team1prediction == $team1score && $team2prediction == $team2score) {
                $point = 5;
            } elseif ($team1score - $team2score == $team1prediction - $team2prediction) {
                $point = 3;
            } elseif (($team1prediction > $team2prediction && $team1score > $team2score) || ($team2prediction > $team1prediction && $team2score > $team1score)) {
                $point = 1;
            }
            $total += $point;
        }
    }
    $finalScores[$userid] = $total;
}

arsort($finalScores);
foreach ($finalScores as $userid => $total) {
    $sql11 = "SELECT `username` FROM user WHERE userid = $userid";
    $result = mysqli_query($conn, $sql11);
    if ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $newfinalScores[$username] = $total;
    }
}

$sql12 = "SELECT username FROM players WHERE leagueid = $leagueID";
$result = $conn->query($sql12);
if ($result->num_rows > 0) {
    echo "<br><strong>These are all of the players in the league:</strong>";
    while ($row = $result->fetch_assoc()) {
        echo "<br>" . $row["username"];
    }
} else {
    echo "There are no players in the league.";
}

echo "<br><table><tr><th>Ranking</th><th>Username</th><th>Total Points</th></tr>";
$number = 1;
foreach ($newfinalScores as $username => $total) {
    echo "<tr><td>" . $number . "</td><td>" . $username . "</td><td>" . $total . "</td></tr>";
    $number++;
}
echo "</table>";
?>
            </div>
        </div>
    </body>
</html>
