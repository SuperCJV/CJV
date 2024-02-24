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

$leaguenameee = $_SESSION["currentleague"];
$sql27 = "SELECT leagueid FROM league WHERE leaguename='$leaguenameee'";
$result = mysqli_query($conn, $sql27);
if ($row = mysqli_fetch_assoc($result)) {
    $currentleague = $row['leagueid'];
}

$currentusernames = $_SESSION["currentuser"];

$sql1 = "SELECT userid FROM user WHERE username = '$currentusernames'";
$result = mysqli_query($conn, $sql1);
if ($row = mysqli_fetch_assoc($result)) {
    $userids = $row['userid'];
}

$matchnumbers = $_POST["matchnumber"];

$team11prediction = $_POST['t11s'];
$team12prediction = $_POST['t12s'];
$team13prediction = $_POST['t13s'];
$team14prediction = $_POST['t14s'];
$team15prediction = $_POST['t15s'];

$team21prediction = $_POST['t21s'];
$team22prediction = $_POST['t22s'];
$team23prediction = $_POST['t23s'];
$team24prediction = $_POST['t24s'];
$team25prediction = $_POST['t25s'];

$sql2 = "SELECT MAX(matchid) FROM matches";
$result = mysqli_query($conn, $sql2);
if ($row = mysqli_fetch_assoc($result)) {
    $maxmatchid = $row['MAX(matchid)'];
}

$bmatchid = $maxmatchid - 4;
$cmatchid = $maxmatchid - 3;
$dmatchid = $maxmatchid - 2;
$ematchid = $maxmatchid - 1;

function updateOrInsertPrediction($conn, $matchid, $userids, $currentleague, $team1prediction, $team2prediction, $leaguenameee) {
    $sqlCheck = "SELECT * FROM `prediction` WHERE matchid = $matchid AND userid = $userids AND leagueid = $currentleague";
    $resultCheck = mysqli_query($conn, $sqlCheck);

    if ($resultCheck->num_rows > 0) {
        $sqlUpdate = "UPDATE `prediction` SET `team1prediction` = $team1prediction, `team2prediction` = $team2prediction WHERE matchid = $matchid AND userid = $userids AND leagueid = $currentleague";
        mysqli_query($conn, $sqlUpdate);
    } else {
        $sqlInsert = "INSERT INTO `prediction`(`leagueid`, `matchid`, `userid`, `team1prediction`, `team2prediction`) VALUES ('$currentleague', '$matchid', '$userids', '$team1prediction', '$team2prediction')";
        mysqli_query($conn, $sqlInsert);
    }
    header("Location: ../ultimatefootball_database/predictioninput.php?id=$leaguenameee");
}

// Handle prediction input based on match number
switch ($matchnumbers) {
    case 1:
        updateOrInsertPrediction($conn, $bmatchid, $userids, $currentleague, $team11prediction, $team21prediction, $leaguenameee);
        break;
    case 2:
        updateOrInsertPrediction($conn, $cmatchid, $userids, $currentleague, $team12prediction, $team22prediction, $leaguenameee);
        break;
    case 3:
        updateOrInsertPrediction($conn, $dmatchid, $userids, $currentleague, $team13prediction, $team23prediction, $leaguenameee);
        break;
    case 4:
        updateOrInsertPrediction($conn, $ematchid, $userids, $currentleague, $team14prediction, $team24prediction, $leaguenameee);
        break;
    case 5:
        updateOrInsertPrediction($conn, $maxmatchid, $userids, $currentleague, $team15prediction, $team25prediction, $leaguenameee);
        break;
}
?>
