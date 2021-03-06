#!/usr/local/php5/bin/php-cgi
<?php
 // Start the session
 session_start();
 $sessionUsername = $_SESSION["username"];
 // If the username has not been set, redirect to the login page
 if(strlen($sessionUsername) == 0 || !isset($sessionUsername)) {
    // Perform redirect to login page
    header("Location: ./login.php");
    exit();
 }


 $vehicleErr = $detailErr = "";
 $vehicle = $detail = "";
 $orderValidated = false;
 $validForm = true;
 $exterior = $interior = $headlights = "";
 $orderCart = "";
$price = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!isset($_POST["vehicle"])) {
        $vehicleErr = "Please select a vehicle type.";
        $validForm = false;
    } 
    else {
        $vehicle = test_input($_POST["vehicle"]);
                
            if( $vehicle == 'Sedan')  { 
                $price = $price + 10;
            }
            else if( $vehicle == 'Coupe'){
                $price = $price;
            }
            else{
                $price = $price + 20;
            }
        
        
    }
    
    if ( (!isset($_POST["exterior"])) && (!isset($_POST["interior"])) && (!isset($_POST["headlights"]))) {
        $detailErr = "Please select a detailing package.";
        $validForm = false;
    } 
    else {
        //$detail = test_input($_POST["exterior"]);
        if(isset($_POST["exterior"])){
            $exterior = "\nExterior Detailing";
            $price = $price + (int)$_POST["exterior"];
            $orderCart = $orderCart.$exterior;
        }
        if(isset($_POST["interior"])){
            $interior = "\nInterior Detailing";
            $price = $price + (int)$_POST["interior"];
            $orderCart = $orderCart.$interior;
        }
        if(isset($_POST["headlights"])){
            $headlights = "\nHeadlight Restoration";
            $price = $price + (int)$_POST["headlights"];
            $orderCart = $orderCart.$headlights;
        }
    }
    $orderValidated = $validForm;

   // If the order is valid, then call the function to output its information
    if($orderValidated) {
        $_SESSION["vehicle-order"] = $vehicle;
        $_SESSION["cart-order"] = $orderCart;
        $_SESSION["price-order"] = $price;
  
       clearValues();
        // Redirect to order confirmation page
       header("Location: ./order-confirm.php");
       
    }   
    
}


function clearValues(){
    $GLOBALS['vehicle'] = null;
    $GLOBALS['orderCart'] = null;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JSM Order Service</title>

    <link rel = "stylesheet" href = "./assets/style/global.css">
    <link rel = "stylesheet" href = "./assets/style/header.css">
    <link rel = "stylesheet" href = "./assets/style/banner.css">

    <link rel = "stylesheet" href = "./assets/style/order-body.css">
    <link rel = "stylesheet" href = "./assets/style/footer.css">
    <link rel = "icon" href = "https://pbs.twimg.com/profile_images/810848436715192324/LceZ56vC_400x400.jpg">
    <script src="./assets/scripts/order.js"></script>


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
        <a href="registration.php">Registration</a>
        <a href="service.php" class="current">Schedule Service</a>
      </div>

   </div>
  </header>

      <form method="post" class="order" onsubmit="required(event)" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
          <h1 id="head">Order Service</h1>
          <p><span class="error">* required field</span></p>
          <br>
          <br>
          <h2>Select vehicle type:<span class="error">* <?php echo $vehicleErr;?></span></h2>
          <div class="vehicle-type">
                <div class="size">
                    <label for="coupe">
                        <span class="item">Coupe</span>
                    </label>
                    <br>
                    <img src="./assets/images/order/coupe.png" alt="coupe silhouette">
                    <input id="coupe" class="vehicle-type" type="radio" name="vehicle" <?php if (isset($vehicle) && $vehicle=="coupe") echo "checked";?> value="Coupe" >
                    +$0
                    
                </div>

                <div class="size">
                    <label for="sedan">
                        <span class="item">Sedan</span>
                    </label>
                    <br>
                    <img src="./assets/images/order/sedan.png" alt="sedan silhouette">
                    <input id="sedan" class="vehicle-type" type="radio" name="vehicle" <?php if (isset($vehicle) && $vehicle=="sedan") echo "checked";?>value="Sedan" >+$10
                </div>

                <div class="size">
                    <label for="suv">
                        <span class="item">SUV</span>
                    </label>
                    <br>
                    <img src="./assets/images/order/suv.png" alt="suv silhouette">
                    <input id="suv" class="vehicle-type" type="radio" name="vehicle" <?php if (isset($vehicle) && $vehicle=="suv") echo "checked";?>value="SUV" >+$20
                </div>

            </div>
          <div class="detail-package">
              <h2>Select Detailing Options:<span class="error">* <?php echo $detailErr;?></span></h2>
              <div class="category-list">
                    <div class="category">
                        <img src="./assets/images/exterior-detail.png" alt="Exterior Detailing">
                        <label for="exterior">
                            <span class="item">Exterior Detailing</span>
                        </label>
                        <p class="item-cost">$400</p>
                        <ul class="list">
                            <li>Thorough hand wash</li>
                            <li>Removal of all road tar, sap, and bugs</li>
                            <li>Proper cleaning of wheels, wheel wells, and tires</li>
                            <li>Application of durable carnauba wax</li>
                            <li>Tires and trim treated with premium exterior dressing</li>
                        </ul>
                        <input id="exterior" class="package" type="checkbox" name="exterior" value="400">
                    </div>

                    <div class = "category">
                        <img src="./assets/images/interior-detail.jpg" alt="Interior Cleaning">
                        <label for="interior">
                            <span class="item">Interior Cleaning</span>
                        </label>
                        <p class="item-cost">$250</p>
                        <ul class="list">
                            <li>Shampoo all carpet and upholstery</li>
                            <li>Hot water extraction on all carpet, upholstery & floor mats</li>
                            <li>Leather is treated & conditioned with PH balanced solution</li>
                            <li>Premium interior dressing applied to enrich tone of all surfaces</li>
                            <li>Navigation screen delicately wiped to provide streak free clarity</li>
                        </ul>

                        <input id="interior" class="package" type="checkbox" name="interior" value="250" >
                    </div>

                    <div class="category">
                        <img src="./assets/images/headlight-detail.jpg" alt="Headlight Restoration">
                        <label for="headlights">
                            <span class="item">Headlight Restoration</span>
                        </label>
                        <p class="item-cost">$50</p>
                        <ul class="list">
                            <li>Resurface and restore clarity</li>
                            <li>Polish dull foggy headlight lenses</li>
                            <li>Permently seal lenses creating a long lasting finish</li>
                            <li>Cermanic coating for increased clarity, shine, and UV resistance</li>
                            <li>Headlight scuff removal</li>
                        </ul>
                        <input id="headlights" class="package" type="checkbox" name="headlights" value="50">
                    </div>
                </div>
              <br>
          
          </div>
            
         
          <button id="submit" type="submit" value="Checkout"> Checkout   <i class="fas fa-shopping-cart"></i> </button>

      </form>


  <div class="footer">
    <p id="disclaimer">This website was created for a student project at CSULB and is not meant for commerical use.</p>
    <p>Created by - Felix Huang, Andrew Kaichi, Raymond Chin, Jordan Lever. CSULB CECS 470 Spring 2018</p>
    <p>  <?php echo "Last modified: " . date ("F d Y H:i:s.", getlastmod());?></p>
  </div>
  

  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    
</body>
</html>
