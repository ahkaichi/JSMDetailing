#!/usr/local/php5/bin/php-cgi


<?php


// define variables for connecting to the database
$host = "cecs-db01.coe.csulb.edu";
$database ="cecs470o26";
$user = "cecs470o26";
$pass = "oo7emo";
$port = "3306";
$err = "";
$userErr = "";
$passErr ="";
$username = $_POST['username'];
$password = $_POST['password'];
// connect to the MYSQL database
$db = mysqli_connect($host, $user, $pass, $database, $port);
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
    <link rel = "stylesheet" href = "./assets/style/footer.css">
	  <link rel = "stylesheet" href = "./assets/style/registration.css">
	
    <link rel = "icon" href = "https://pbs.twimg.com/profile_images/810848436715192324/LceZ56vC_400x400.jpg">
	
	
	 <script src="./assets/scripts/registration.js"></script>
	
	
	
	

</head>
<body>

<?php
//validation server side
$nameError = $emailError = $lnameError = $usernameError = $passwordError = $confirmError =  "";
$name = $email = $lname = $username = $password = $confirm = "";
$nameFlag = $addFlag = $lnameFlag = $usernameFlag = $passwordFlag = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 //So this for name it will check for if its empty or if there is an error with format
  if (empty($_POST["name"])) {
    $nameError = "First name is required";
	$nameFlag = 0;
  } else {
    $name = test_input($_POST["name"]);
    $nameFlag = 1;
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameError = "Invalid Characters. Only letters and white space allowed";
	  $nameFlag = 0 ;
    }
  }
  //This validates the last name
   if (empty($_POST["lname"])) {
    $lnameError = "Last name is required";
	$lnameFlag = 0;
  } else {
    $lname = test_input($_POST["lname"]);
    $lnameFlag = 1;
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $lnameError = "Invalid Characters. Only letters and white space allowed";
	  $lnameFlag=0;
    }
  }
  //validates user name
   if (empty($_POST["username"])) {
    $usernameError = "Username is required";
	$usernameFlag = 0;
  } else {
    $username = test_input($_POST["username"]);
	
    $usernameFlag = 1;
	$query = "SELECT USERNAME FROM Client where USERNAME = '$username'";
    $result = mysqli_query($db,$query);
	if (mysqli_num_rows($result)> 0){
	
		$usernameError = "Username already exists please choose another";
		$usernameFlag = 0;
	}
  }
  //This checks for if the email is empty
if (empty($_POST["email"])) {
	$emailError = "Email is required";
	$emailFlag = 0;
} else {
  $email = test_input($_POST["email"]);
  $emailFlag =1;
  //this checks for format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailError = "Invalid email format must include @ & .com";
	$emailFlag = 0;
   }
}
/*
if (empty($_POST["address"])) {
    $addressError = "Address is required";
	$addFlag = 0;
  } else {
    $address = test_input($_POST["address"]);
	$addFlag = 1;
  }
  */
//validates password
 if (empty($_POST["password"])) {
    $passwordError = "Password is required";
	$passwordFlag = 0;
  }else {
    $password = test_input($_POST["password"]);
    $passwordFlag = 1;
    /*if (!preg_match("^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&?]).*$",$password)) {
      $passwordError = "Password must contain at least 8 characters, 1 number, and 1 special character";
    }*/
  }
  
 //validates that the confirm password
    if (empty($_POST["confirm"])) {
    $confirmError = "Must confirm password";
	$passwordFlag = 0;
  }else {
	  // checks to make sure password and confirmation match
    $confirm = test_input($_POST["confirm"]);
    $passwordFlag = 1;
    if ($password !== $confirm) {
      $passwordError = "Passwords do not match";
	  $passwordFlag = 0;
    }
  }
  
//$nameFlag = $emailFlag = $lnameFlag = $usernameFlag = $passwordFlag = 1;
if($nameFlag && $emailFlag && $lnameFlag && $usernameFlag && $passwordFlag){
	//echo'<script>success()</script>';
	//echo "Thank You for Registering! Have a Nice Day!";
	$sql = "INSERT INTO Client(USERNAME,FIRSTNAME,LASTNAME,PASSWORD,ADDRESS) VALUES ('$username','$name','$lname','$password','$email')";
	$result = mysqli_query($db,$sql);
	
	header('Location: thank-you.html');
	exit();
}



}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
  <header>
   <div class="header-container">
       <div class="branding">
           <h1>  <a href = "index.html"> <i class="fab fa-pushed"></i>JSM Detailing </a> </h1>
       </div>

       <div class="topnav">
        <a href="index.html">Home</a>
        <a href="portfolio.html">Portfolio</a>
        <a href="registration.php" class="current">Registration</a>
        <a href="login.php">Schedule Service</a>
      </div>

   </div>
  </header>
  
  <div class="form">
	<form id ="registration-form" onsubmit = "return validate()" action = ""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" onreset = "resetHandler()" method = "post">
	<fieldset>
		<legend>Registration</legend>
			<label for="name"><b> First Name: </label><input type = "text" placeholder = "Enter First Name" max = 20 name="name" class = "required" id ="name" value = "<?php echo $name;?>">
			<span class = "error"><?php echo $nameError;?></span><br>
			
			<label for = "lname"><b> Last Name: </label><input type = "text" max = 20 placeholder = "Enter Last Name" name = "lname" class = "required" id = "lname" value = "<?php echo $lname;?>">
			<span class = "error"><?php echo $lnameError;?></span><br>
			
			<label for = "username"><b> Username: </label><input type = "text" max = 30 placeholder = "Create Username" name ="username" class = "required" id = "username" value = "<?php echo $username;?>">
			<span class = "error"><?php echo $usernameError;?></span><br>
			
			<label for="email"><b> Email: </label><input type = "text" name = "email" max = 40 placeholder = "Enter Email" class = "required" id = "email" value = "<?php echo $email;?>">
			<span class = "error"><?php echo $emailError;?></span><br>
			
			<label for="password"><b> Password: </label><input type = "password" max = 20 placeholder = "Create Password" name = "password" class = "required" id = "password" value = "<?php echo $password;?>">
			<span class = "error"><?php echo $passwordError;?></span><br>
			
			<label for = "confirm"><b> Confirm Password: </label><input type = "password" placeholder = "Re-enter Password" max = 20 class = "required" name = "confirm" id = "confirm">
			<span class = "error"><?php echo $confirmError;?></span><br>
			
			
			
			
			
	</fieldset>
	</br></br>
	<button type = "submit" value = "Submit">Submit</button>
		<button type = "reset" onclick = "location.href='registration.php';"; value = "Reset form">Reset</button>
	</form>
  
  
  
 
  
  
  </div>

 

 
   <div class="footer">
    <p id="disclaimer">This website was created for a student project at CSULB and is not meant for commerical use.</p>
    <p>Created by - Felix Huang, Andrew Kaichi, Raymond Chin, Jordan Lever. CSULB CECS 470 Spring 2018</p>
  </div>
  

  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    
</body>
</html>
