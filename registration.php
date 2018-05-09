#!/usr/local/php5/bin/php-cgi
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
	<style>
	.jerror{
	background: #FFCDD2;
}

	
	</style>
	
	<script>
	function validate(){
	
	
		
		var inputs = document.getElementsByClassName('required')
		var submit = true;
	//console.log(inputs); helps you see what it actually is and call the correct one.
	for(var i = 0; i <inputs.length;i++)
	{
		
		if(inputs[i].value=="")
		{
			inputs[i].classList.add("jerror");
			
			var submit = false;
		}

		if(inputs[i].value!="" && inputs[i].classList.contains("jerror"))
		{
			inputs[i].classList.remove("jerror");
			
		}
		
	}
	if(!submit){
		alert("Please Fill All Required Fields");
		return false;
	}
	}
	function success(){
	alert("Thank You! You have successfuly completed the form! Have a nice day!.");
	}
	
	</script>

</head>
<body>
<?php
$nameError = $emailError = $lnameError = $usernameError = $passwordError = $confirmError =  "";
$name = $email = $lname = $username = $password = $confirm = "";
$nameFlag = $emailFlag = $lnameFlag = $usernameFlag = $passwordFlag = 1;

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
    }
  }
   if (empty($_POST["lname"])) {
    $lnameError = "Last name is required";
	$lnameFlag = 0;
  } else {
    $lname = test_input($_POST["lname"]);
    $lnameFlag = 1;
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $lnameError = "Invalid Characters. Only letters and white space allowed";
    }
  }
   if (empty($_POST["username"])) {
    $usernameError = "Username is required";
	$usernameFlag = 0;
  } else {
    $username = test_input($_POST["username"]);
    $usernameFlag = 1;
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
    $emailError = "Invalid email format";
   }
}

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
  
 
    if (empty($_POST["confirm"])) {
    $confirmError = "Must confirm password";
	$passwordFlag = 0;
  }else {
    $confirm = test_input($_POST["confirm"]);
    $passwordFlag = 1;
    if ($password !== $confirm) {
      $passwordError = "Passwords do not match";
    }
  }
  
//$nameFlag = $emailFlag = $lnameFlag = $usernameFlag = $passwordFlag = 1;
if($nameFlag && $emailFlag && $lnameFlag && $usernameFlag && $passwordFlag){
	echo'<script>success()</script>';
	
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
        <a href="#schedule">Schedule Service</a>
      </div>

   </div>
  </header>
  
  <div class="form">
	<form id ="mainForm" onsubmit = "return validate()" action = ""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" onreset = "resetHandler()" method = "post">
	<fieldset>
		<legend>Registration</legend>
			<label for="name"> First Name: </label><input type = "text" name="name" class = "required" id ="name" value = "<?php echo $name;?>">
			<span class = "error"><?php echo $nameError;?></span><br>
			
			<label for = "lname"> Last Name: </label><input type = "text" name = "lname" class = "required" id = "lname" value = "<?php echo $lname;?>">
			<span class = "error"><?php echo $lnameError;?></span><br>
			
			<label for = "username"> Username: </label><input type = "text" name ="username" class = "required" id = "username" value = "<?php echo $username;?>">
			<span class = "error"><?php echo $usernameError;?></span><br>
			
			<label for="email"> Email: </label><input type = "text" name = "email" class = "required" id = "email" value = "<?php echo $email;?>">
			<span class = "error"><?php echo $emailError;?></span><br>
			
			<label for="password"> Password: </label><input type = "password" name = "password" class = "required" id = "password" value = "<?php echo $password;?>">
			<span class = "error"><?php echo $passwordError;?></span><br>
			
			<label for = "confirm"> Confirm Password: </label><input type = "password" class = "required" name = "confirm" id = "confirm">
			<span class = "error"><?php echo $confirmError;?></span><br>
			
			
			
			
			
	</fieldset>
	<button type = "submit" value = "Submit">Submit</button>
		<button type = "reset" value = "Reset form">Reset</button>
	</form>
  
  
  
  </br>
  </br>
  </br>
  </br>
  </br>
  </br>
  </br>
  
  
  </div>

 

 
   <div class="footer">
    <p id="disclaimer">This website was created for a student project at CSULB and is not meant for commerical use.</p>
    <p>Created by - Felix Huang, Andrew Kaichi, Raymond Chin, Jordan Lever. CSULB CECS 470 Spring 2018</p>
  </div>
  

  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    
</body>
</html>
