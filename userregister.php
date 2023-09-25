<!DOCTYPE html> 
<html lang="en"> 
<title>userregister.php</title> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" 
href="https://fonts.googleapis.com/css?family=Poppins"> 
<style> 
  body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif} 
  body {font-size:16px;} 
  .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer} 12. .w3-half img:hover{opacity:1} 
</style> 
  <body> 
 
<!-- Sidebar/menu --> 
  <nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br> 18. <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3- hide-large w3-display-topleft" style="width:100%;font-size:22px">Close  Menu</a> 
  <div class="w3-container"> 
    <h3 class="w3-padding-64"><b>Ultimate Football</b></h3> 
    <div class='w3-bar-block'> 
      <a href='/php_ib/ultimatefootball_database/userlogin.html' onclick='w3_close()' class='w3-bar-item w3-button w3-hover-white'>Go back to  login</a>  
    </div> 
  </div> 
  </nav> 

<!-- Top menu on small screens --> 
  <header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3- padding"> 
    <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a> 
    <span>Ultimate Football</span> 
  </header> 

<!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" 
    style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <!-- !PAGE CONTENT! --> 
    <div class="w3-main" style="margin-left:340px;margin-right:40px">
    
    <!-- Header --> 
      <div class="w3-container" style="margin-top:80px" id="showcase">
        <hr style="width:50px;border:5px solid red" class="w3-round"> 
      <?php 
        $servername = "localhost"; 
        $username = "Cristian"; 
        $password = "Thisiscristian"; 
        $dbname = "UltimateFootball"; 
        // Create connection 
        $conn = mysqli_connect($servername, $username, $password, $dbname); 51. 
        // Check connection 
        if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); 55. } 

        //encrypt password 
          $passwordInput = password_hash($_POST["password"], PASSWORD_BCRYPT); 59. $usernameInput = $_POST['username']; 
          $favouriteTeamInput = $_POST['favouriteTeam']; 
          $sql = "INSERT INTO user (username, password, favouriteTeam) 63. VALUES ('$usernameInput', '$passwordInput',  '$favouriteTeamInput')"; 
      
        //message to show that the record had been created successfully; else  throw an error 
          if ($conn->query($sql) === TRUE) { 
            echo "New account registered successfully. "; 
          } else{ 
            echo "Error: " . $sql . "<br>" . $conn->error; 70. } 
        
        ?> 
      </div> 
    </body> 
</html> 
