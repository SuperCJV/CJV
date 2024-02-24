<?php
session_start(); // Connect to current session
if (!isset($_SESSION["currentuser"])) { // If the current user variable is not set
    session_destroy();
    header("Location:../ultimatefootball_database/userlogin.html");
}
?>
