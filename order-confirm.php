<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JSM Order Confirmation</title>

    <link rel = "stylesheet" href = "./assets/style/global.css">
    <link rel = "stylesheet" href = "./assets/style/header.css">
    <link rel = "stylesheet" href = "./assets/style/footer.css">
    <link rel = "icon" href = "https://pbs.twimg.com/profile_images/810848436715192324/LceZ56vC_400x400.jpg">

</head>
<body>
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



    <div class="footer">
      <p id="disclaimer">This website was created for a student project at CSULB and is not meant for commerical use.</p>
      <p>Created by - Felix Huang, Andrew Kaichi, Raymond Chin, Jordan Lever. CSULB CECS 470 Spring 2018</p>
      <p>  <?php echo "Last modified: " . date ("F d Y H:i:s.", getlastmod());?></p>
    </div>
    

    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  
    
</body>
</html>