#!/usr/local/php5/bin/php-cgi

<?php
// Start the session
session_start();


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
                    <a href="registration.php">Registration</a>
                    <a href="login.php" class="current">Schedule Service</a>
                </div>

            </div>
        </header>
         <?php
        // check if the username has been set
        if(isset($_POST['username'])){
            $error = "";
            if(!$db){
                // check if able to connect to database
                $error = "Failed to connect to MySQL: ". mysqli_connect_error();
                echo $error;
            }
            else{
                // query to retrieve all user information for the input username
                $sql = "select * from Client where USERNAME = '$username'";
                $result = mysqli_query($db,$sql);

                if(!$result){
                    // check if query was successful
                    $error =  "Query Failed";
                    echo $error;

                } else {}
                // put results into an array 
                $rows = mysqli_fetch_array($result);        
                if($rows){
                    // check if the password user entered matches the database
                    if($rows['PASSWORD'] == $password){
                        // close mysql connection
                        mysqli_close($db);

                        // Save the username that was entered as a session variable
                        $_SESSION["username"] = $username;

                        // Perform redirect to service order page
                        header("Location: ./service.php");
                        exit();
                    }else{
                        if(isset($_POST['password'])){
                              $passErr = "Invalid Credentials";
                        
                        }
                        else {
                            $passErr="";
                        }
                      
                    }
                }
                else{
                    $passErr = "Invalid Credentials";
                   
                }  
            } 
        }

        else{
            $userErr = "";
            
        }

        ?>

        <div class="form">
            <br>
            <form class="login-form" onsubmit="validate(event)" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset>
                    <legend>Log In to Schedule Service</legend>
                    <label for="username"><b>Username:</b></label>
                    <input type="text" placeholder="Enter Username" id="username" name="username" onfocus = "removeErrorHint(this)" value = "<?php echo $username; ?>">       
                    <br>
                    <label for="password"><b>Password:</b></label>
                    <input type="password" placeholder="Enter Password" id="password" onfocus = "removeErrorHint(this)" name="password">
                    <span class="error"><?php echo $passErr; ?></span>              
                </fieldset>

                <br>
                <button type="submit">Log In <i class="fas fa-sign-in-alt"></i> </button>
            </form>  

            <p>Don't have an account?</p>
            <a href="registration.php">Create an Account</a>
        </div>

       

        <div class="footer">
            <p id="disclaimer">This website was created for a student project at CSULB and is not meant for commerical use.</p>
            <p>Created by - Felix Huang, Andrew Kaichi, Raymond Chin, Jordan Lever. CSULB CECS 470 Spring 2018</p>
            <p>  <?php echo "Last modified: " . date ("F d Y H:i:s.", getlastmod());?></p>
        </div>


        <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>


    </body>
</html>