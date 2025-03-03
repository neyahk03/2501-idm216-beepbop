<?php
session_start();

// check if there is session guest id exist
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
    <title>Home | Pete's Lunch Box</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/quantity.css">
</head>
<body>

    <div class="screen-container">

        <nav>
            <h1>PETE'S </h1>

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

            <div class="CTA">
                <h1>HI THERE, I'M PETE!</h1>
                <img class="mascot" src="../images/homepage-featured-img.svg" alt="mascot">
                <a href="menu.php"><button class="nofill-button">ORDER NOW</button></a>
            </div> 

            <div class="petes-fav">
                <h3>Pete's Favorites</h3>

                <div class="fav-container">

                    <div class="fav">
                        <a class="fav-link" href="detail.php?id=6&table=drinks&menu_item=Thai+Tea">

                            <img src="../images/menu-item/thai-tea.jpg " alt="Thai Tea">
                            <div class="description">
                                <p>Thai Tea</p>
                                <p>$3.00</p>
                            </div>
                        </a>
                    </div>

                    <div class="fav">
                        <a class="fav-link" href="detail.php?id=3&table=sandwiches&menu_item=B.L.T">

                            <img src="../images/menu-item/bacon-lettuce-tomato.jpg" alt="BLT Sandwich">
                            <div class="description">
                                <p>B.L.T Sandwich</p>
                                <p>$6.00</p>
                            </div>
                        </a>
                    </div>

                    <div class="fav">
                        <a href="detail.php?id=1&table=sandwiches&menu_item=Egg+%26+Cheese">
                            <img src="../images/menu-item/egg-and-cheese.jpg " alt="Egg & Cheese">
                            <div class="description">
                                <p>Egg &amp; Cheese</p>
                                <p>$4.50</p>
                            </div>
                        </a>
                    </div>

                    <div class="fav">
                        <a href="detail.php?id=1&table=pastries&menu_item=Bagel+with+Cream+Cheese" class="fav-link">

                            <img src="../images/menu-item/bagel-and-cream-cheese.jpg " alt="Bagel">
                            <div class="description">
                                <p>Bagel</p>
                                <p>$4.50</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="location-container">
                <h3>Where to Find Us?</h3>

                <div class="hours">
                    <h4>Hours:</h4>
                    <div class="description">
                        <p>Monday - Friday</p>
                        <p>6AM - 3PM</p>
                    </div>
                    
                </div>
    
                <div class="location">
                    <h4>Location</h4>
                    <p>11 N 33rd St</p> 
                    <p>Philadelphia, PA 19104</p>
                </div>
                
                <img src="../images/new-map.svg" alt="map" class="map">
            </div>

            <div class="help">
                <h3>Want to Help Us?</h3>
                <p>Pete's is a small family business that would really appreciate your support by leaving a Google Review. Just snap a picture of your lunch and you’re good to go!</p>
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

            <a href="#" class="icon-container">
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

