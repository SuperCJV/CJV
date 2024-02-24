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

$leaguenameee = $_SESSION["currentleague"];
$sql27 = "SELECT leagueid FROM league WHERE leaguename='$leaguenameee'";
$result = mysqli_query($conn, $sql27);
$row = mysqli_fetch_assoc($result);
$currentleague = $row['leagueid'];

$currentusernames = $_SESSION["currentuser"];

$sql1 = "SELECT userid FROM user WHERE username = '$currentusernames'";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);
$userids = $row['userid'];

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
$row = mysqli_fetch_assoc($result);
$maxmatchid = $row['MAX(matchid)'];

$bmatchid = $maxmatchid - 4;
$cmatchid = $maxmatchid - 3;
$dmatchid = $maxmatchid - 2;
$ematchid = $maxmatchid - 1;

if ($matchnumbers == 1) {
    $sql11 = "SELECT * FROM `prediction` WHERE matchid = $bmatchid AND userid = $userids AND leagueid=$currentleague";
    $result = mysqli_query($conn, $sql11);
    if ($result->num_rows > 0) {
        $sql12 = "UPDATE `prediction` SET `team1prediction` = $team11prediction, `team2prediction` = $team21prediction WHERE matchid = $bmatchid AND userid = $userids";
        $result = mysqli_query($conn, $sql12);
    } else {
        $sql13 = "INSERT INTO `prediction`(`leagueid`, `matchid`, `userid`, `team1prediction`, `team2prediction`) VALUES ('$currentleague', '$bmatchid', '$userids', '$team11prediction', '$team21prediction')";
        $result = mysqli_query($conn, $sql13);
    }
    header("Location:../ultimatefootball_database/predictioninput.php?id=$leaguenameee");
}

if ($matchnumbers == 2) {
    $sql15 = "SELECT * FROM `prediction` WHERE matchid = $cmatchid AND userid = $userids AND leagueid = $currentleague";
    $result = mysqli_query($conn, $sql15);
    if ($result->num_rows > 0) {
        $sql16 = "UPDATE `prediction` SET `team1prediction` = $team12prediction, `team2prediction` = $team22prediction WHERE matchid = $cmatchid AND userid = $userids";
        $result = mysqli_query($conn, $sql16);
    } else {
        $sql17 = "INSERT INTO `prediction`(`leagueid`, `matchid`, `userid`, `team1prediction`, `team2prediction`) VALUES ('$currentleague', '$cmatchid', '$userids', '$team12prediction', '$team22prediction')";
        $result = mysqli_query($conn, $sql17);
    }
    header("Location:../ultimatefootball_database/predictioninput.php?id=$leaguenameee");
}

if ($matchnumbers == 3) {
    $sql18 = "SELECT * FROM `prediction` WHERE matchid = $dmatchid AND userid = $userids AND leagueid = $currentleague";
    $result = mysqli_query($conn, $sql18);
    if ($result->num_rows > 0) {
        $sql19 = "UPDATE `prediction` SET `team1prediction` = $team13prediction, `team2prediction` = $team23prediction WHERE matchid = $dmatchid AND userid = $userids";
        $result = mysqli_query($conn, $sql19);
    } else {
        $sql20 = "INSERT INTO `prediction`(`leagueid`, `matchid`,`userid`, `team1prediction`, `team2prediction`) VALUES ('$currentleague', '$dmatchid', '$userids', '$team13prediction', '$team23prediction')";
        $result = mysqli_query($conn, $sql20);
    }
    header("Location:../ultimatefootball_database/predictioninput.php?id=$leaguenameee");
}

if ($matchnumbers == 4) {
    $sql21 = "SELECT * FROM `prediction` WHERE matchid = $ematchid AND userid = $userids AND leagueid = $currentleague";
    $result = mysqli_query($conn, $sql21);
    if ($result->num_rows > 0) {
        $sql22 = "UPDATE `prediction` SET `team1prediction` = $team14prediction, `team2prediction` = $team24prediction WHERE matchid = $ematchid AND userid = $userids";
        $result = mysqli_query($conn, $sql22);
    } else {
        $sql23 = "INSERT INTO `prediction`(`leagueid`, `matchid`, `userid`, `team1prediction`, `team2prediction`) VALUES ('$currentleague', '$ematchid', '$userids', '$team14prediction', '$team24prediction')";
        $result = mysqli_query($conn, $sql23);
    }
    header("Location:../ultimatefootball_database/predictioninput.php?id=$leaguenameee");
}

if ($matchnumbers == 5) {
    $sql24 = "SELECT * FROM `prediction` WHERE matchid = $maxmatchid AND userid = $userids AND leagueid = $currentleague";
    $result = mysqli_query($conn, $sql24);
    if ($result->num_rows > 0) {
        $sql25 = "UPDATE `prediction` SET `team1prediction` = $team15prediction, `team2prediction` = $team25prediction WHERE matchid = $maxmatchid AND userid = $userids";
        $result = mysqli_query($conn, $sql25);
    } else {
        $sql26 = "INSERT INTO `prediction`(`leagueid`, `matchid`, `userid`, `team1prediction`, `team2prediction`) VALUES ('$currentleague', '$maxmatchid', '$userids', '$team15prediction', '$team25prediction')";
        $result = mysqli_query($conn, $sql26);
    }
    header("Location:../ultimatefootball_database/predictioninput.php?id=$leaguenameee");
}
?>
