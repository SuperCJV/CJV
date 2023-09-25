<html lang='en'> 
<title>Homepage</title> 
<meta charset='UTF-8'> 
<meta name='viewport' content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" 
href="https://fonts.googleapis.com/css?family=Poppins"> 
<style> 
  body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif} 
  body {font-size:16px;} 
  .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
  .w3-half img:hover{opacity:1} 
</style> 
<body>

<!-- Sidebar/menu --> 
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3- hide-large w3-display-topleft" style="width:100%;font-size:22px">Close  Menu</a> 
  <div class="w3-container"> 
    <h3 class="w3-padding-64"><b>Homepage</b></h3> 
    <a href='/php_ib/ultimatefootball_database/viewleague.php' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Your own  leagues</a> 
    <a href='/php_ib/ultimatefootball_database/viewjoinedleagues.php' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Joined  leagues</a> 
    <a href='/php_ib/ultimatefootball_database/createaleague.html' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Create a  league</a> 
    <a href='/php_ib/ultimatefootball_database/changepasswordinput.php' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Change  Password</a> 
    <a href='/php_ib/ultimatefootball_database/logout.php' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Logout</a>
  </div> 
</nav> 

  <!-- Top menu on small screens --> 
  <header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3- padding"> 
    <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a> 
    <span>Ultimate League</span> 
  </header> 

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay">
  </div>
  <!-- !PAGE CONTENT! --> 
  <div class="w3-main" style="margin-left:340px;margin-right:40px"> 39. 
    <!-- Header --> 
    <div class='w3-container' style='margin-top:80px' 
id='viewjoinedleagues'> 
    <p> 
      <?php 
        session_start(); //connect to current session
        if (!isset($_SESSION["currentuser"])){ //if the current user vairable is not  set 
          session_destroy(); 
          header ("Location:../ultimatefootball_database/userlogin.html");
        } 
        
        $currentusername = $_SESSION["currentuser"]; 
        echo "<h1 class='w3-jumbo'><b> Welcome, $currentusername!</b></h1>"; 
        $servername = "localhost"; 
        $username = "Cristian"; 
        $password = "Thisiscristian"; 
        $dbname = "UltimateFootball"; 
        
        $conn = mysqli_connect($servername, $username, $password, $dbname); 
        if (!$conn) { 
          die("Connection failed: " . mysqli_connect_error()); 61. } 
        
        $sql1 = "SELECT MAX(weekID) FROM weeks"; 
        $result = mysqli_query($conn, $sql1); 
        $row = mysqli_fetch_assoc($result); 
        $weekIDs = $row['MAX(weekID)']; 

        $sql2 = "SELECT datedue FROM weeks WHERE weekID = $weekIDs";
        $result = mysqli_query($conn, $sql2); 
        $row = mysqli_fetch_assoc($result); 
        $datedueoutputt = $row['datedue']; 
        
        echo "<h1 class='w3-xxxlarge w3-text-red'><b>Today is " . date('Y-m d')."</b></h1> 
        <hr style='width:50px;border:5px solid red' class='w3-round'>"; 
        echo "<p>These are the current matches to be played where the due date is:  $datedueoutputt!</p>"; 
        
        $sql3= "SELECT team1, team2 FROM matches WHERE weekID = $weekIDs";
        $result = $conn->query($sql3); 
        if ($result->num_rows > 0) { 
          echo "<p><table><tr><th> Team 1 </th><th> vs </th><th> Team 2  </th></tr></p>"; 
          // output data of each row 
          while($row = $result->fetch_assoc()) { 
            echo "<p><tr><td>" . $row["team1"]. "</td><td></td><td>" . $row["team2"]. "</td></tr></p>"; 
          } 
          echo "<p></table></p>"; 
        } else {
          echo "<p>There are no following matches. </p>"; 
        } 

        echo "<br><p>These are the last matches that have already been played last  time</p>"; 

        $lastweekIDs = $weekIDs - 1; 

        $sql5= "SELECT team1, team1score, team2, team2score FROM matches WHERE  weekID = $lastweekIDs."; 
        $result = $conn->query($sql5); 
        if ($result->num_rows > 0) { 
          echo "<p><table><tr><th> Team 1 </th><th> Score 1  </th><th></th><th> Team 2 </th><th> Score 2 </th></tr></p>"; 
          // output data of each row 
          while($row = $result->fetch_assoc()) { 
            echo "<p><tr><td>" . $row["team1"]. "</td><td>" . $row["team1score"]. "</td><td> vs </td><td>" . $row["team2"]. "</td><td>" . $row["team2score"]. "</td></tr></p>"; 
          } 
          echo "<p></table></p>"; 
        } else { 
          echo "<p>There were no matches last week. </p>";
        } 

        echo "</div>"; 
      ?> 
    </div> 
  </body> 
</html> 
