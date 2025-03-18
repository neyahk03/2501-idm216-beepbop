<?php
session_start();

if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php"); 
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../includes/database.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = session_id();
}

if (!isset($_SESSION['cart'][$_SESSION['user_id']])) {
    $_SESSION['cart'][$_SESSION['user_id']] = [];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Pete's Lunch Box</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/quantity.css">
    <link rel="stylesheet" href="css/button.css">
</head>
<body>

    <div class="screen-container">

    <nav>
            <h1>PROFILE </h1>

            <div class="lunchbox">

                <a href="bag.php" >
                    <img src="../images/icons/shopping-bag.svg" alt="shopping bag icon">
                </a>

                <?php 
                        if (!empty($_SESSION['cart'])) {
                            $totalQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
                            if ($totalQuantity > 0) { ?>
                                <div class="quantity">
                                    <p>
                                        <?php echo '<span id="quantity">' . $totalQuantity . '</span>'; ?> 
                                    </p>

                                </div>
                            <?php }
                            }
                    ?>

            </div>

            
        </nav>

        <div class="content">

            <div class="rewards-section">
    
                <div class="points">
                    <h2>You have:</h2>
                    <h1>0 Pts</h1>
                    <p>$10 spent = 1000pts</p>
                    <p>1000 pts = $1.00</p>
                </div> 
    
                <div class="rules">
                    <h1>How to Use Points:</h1>
                    <p>Redeem your points at checkout for cash value!</p>
                    <p>For every $10 spent, you gain 1000 points. Each 1000 points can be redeemed for $1.00 at checkout.   </p>
                    <p>Points can only be redeemed in increments of 1,000. For example: With 1,300 points, you can use 1,000 points and save the remaining 300 or wait until you reach 2,000 points.</p>
                    <p>Available for mobile orders through app only.</p>
                </div>
    
            </div>
    
            <div class="reward-buttons">
                <button class="filled-button">log in</button>
    
                <button class="nofill-button">sign up to earn rewards</button>
            </div>
                
        </div>

        <div class="bottom-nav">

            
            <a href="home.php" class="icon-container">
                <img src="../images/icons/home.svg" alt="home icon">
                <p class="label">Home</p>
            </a>

            

            <a href="menu.php" class="icon-container">
                <img src="../images/icons/menu.svg" alt="menu icon">
                <p class="label">Menu</p>
            </a>

            <a href="profile.php" class="icon-container">
                <img src="../images/icons/profile.svg" alt="contact icon">
                <p class="label">Profile</p>
            </a>
        </div>


    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navItems = document.querySelectorAll(".bottom-nav .icon-container");
    
            navItems.forEach(item => {
                item.addEventListener("click", function () {
                    // Remove active class from all items
                    navItems.forEach(nav => nav.classList.remove("active"));
    
                    // Add active class to the clicked item
                    this.classList.add("active");
                });
            });
    
            // Optional: Maintain active state based on current URL
            navItems.forEach(item => {
                if (item.href === window.location.href) {
                    item.classList.add("active");
                }
            });
        });
    </script>
</body>
</html>

