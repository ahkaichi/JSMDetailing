#!/usr/local/php5/bin/php-cgi
 <?php
// define variables and set to empty values
$host = "cecs-db01.coe.csulb.edu:3306";
$database = "";
$user = "cecs470o26";
$pass = "oo7emo";
$err = "";    
$db = mysqli_connect($host, $user, $pass, $database);
    if( mysqli_connect_errno()){
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
}

?>
<?php
  
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($db,$sql) or die("Error: ".mysqli_error($db));
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
       mysqli_close($db)
   
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JSM Detailing</title>

    <link rel = "stylesheet" href = "./assets/style/global.css">
    <link rel = "stylesheet" href = "./assets/style/header.css">
    <link rel = "stylesheet" href = "./assets/style/banner.css">
    <link rel = "stylesheet" href = "./assets/style/homepage-body.css">
    <link rel = "stylesheet" href = "./assets/style/footer.css">
    <link rel = "icon" href = "https://pbs.twimg.com/profile_images/810848436715192324/LceZ56vC_400x400.jpg">
    <link rel = "stylesheet" href = "./assets/style/login.css">
    <script src="./assets/scripts/login.js"></script>
</head>
<body>
   
  <header>
   <div class="header-container">
       <div class="branding">
           <h1>  <a href = "index.html"> <i class="fab fa-pushed"></i>JSM Detailing </a> </h1>
       </div>

       <div class="topnav">
        <a href="index.html" >Home</a>
        <a href="portfolio.html">Portfolio</a>
        <a href="#sign">Registration</a>
        <a href="#schedule" class="current">Schedule Service</a>
      </div>

   </div>
  </header>
      
    
      <div class="form">
          <br>
        <form class="login-form" onsubmit="validate(event)" >
            <fieldset>
                <legend>Log In to Schedule Service</legend>
         <label for="username"><b>Username:</b></label>
        <input type="text" placeholder="Enter Username" id="username" name="username">
        <span class ="error"> </span>        
        <br>
      <label for="password"><b>Password:</b></label>
      <input type="password" placeholder="Enter Password" id="password" name="password">
         <span class="error"></span> 
                
        
            </fieldset>
         
     <br>
      <button type="submit">Log In <i class="fas fa-sign-in-alt"></i> </button>
          </form>  
     
          <p>Dont have an account?</p>
       <a href="register.html">Create an Account</a>
    </div>
    




  <div class="footer">
    <p id="disclaimer">This website was created for a student project at CSULB and is not meant for commerical use.</p>
    <p>Created by - Felix Huang, Andrew Kaichi, Raymond Chin, Jordan Lever. CSULB CECS 470 Spring 2018</p>
  </div>
  

  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    
</body>
</html>