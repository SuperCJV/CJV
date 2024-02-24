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

$matchnum = $_POST["matchnum"];

$team11score = $_POST['t11'];
$team12score = $_POST['t12'];
$team13score = $_POST['t13'];
$team14score = $_POST['t14'];
$team15score = $_POST['t15'];

$team21score = $_POST['t21'];
$team22score = $_POST['t22'];
$team23score = $_POST['t23'];
$team24score = $_POST['t24'];
$team25score = $_POST['t25'];

$sql1 = "SELECT MAX(matchid) FROM matches";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);
$maxmatchid = $row['MAX(matchid)'];

$bmatchid = $maxmatchid - 4;
$cmatchid = $maxmatchid - 3;
$dmatchid = $maxmatchid - 2;
$ematchid = $maxmatchid - 1;

if ($matchnum == 1) {
    $sql2 = "UPDATE `matches` SET `team1score`= '$team11score', `team2score`='$team21score' WHERE `matchid`=$bmatchid";
    mysqli_query($conn, $sql2);
}

if ($matchnum == 2) {
    $sql3 = "UPDATE `matches` SET `team1score`= '$team12score', `team2score`='$team22score' WHERE `matchid`=$cmatchid";
    mysqli_query($conn, $sql3);
}

if ($matchnum == 3) {
    $sql4 = "UPDATE `matches` SET `team1score`= '$team13score', `team2score`='$team23score' WHERE `matchid`=$dmatchid";
    mysqli_query($conn, $sql4);
}

if ($matchnum == 4) {
    $sql5 = "UPDATE `matches` SET `team1score`= '$team14score', `team2score`='$team24score' WHERE `matchid`=$ematchid";
    mysqli_query($conn, $sql5);
}

if ($matchnum == 5) {
    $sql6 = "UPDATE `matches` SET `team1score`= '$team15score', `team2score`='$team25score' WHERE `matchid`=$maxmatchid";
    mysqli_query($conn, $sql6);
}
header("Location:../ultimatefootball_database/finalscoreinput.php");
?>
