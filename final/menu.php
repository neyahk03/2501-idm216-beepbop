<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Pete's Lunch Box</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/menu-item.css">
</head>
<body>

    <div class="screen-container">

        <nav>
            <h1>MENU</h1>
            <a href="empty-bag.html">
                <img src="../images/icons/shopping-bag.svg" alt="shopping bag icon">
            </a>
        </nav>

        <!-- <div class="filter-bar">
        <a class="test heading-4 filter" href="#sandwiches">SANDWICHES</a>

        <a class="test heading-4 filter" href="#cheese-steak">CHEESESTEAKS</a>

        <a class="test heading-4 filter" href="#salads">SALADS</a>


        <a class="test heading-4 filter" href="#pastries">PATRIES</a>

        <a class="test heading-4 filter" href="#drinks">DRINKS</a>
        </div> -->

        
        


        
        <div class="bottom-nav">
            
            <a href="home.html" class="icon-container">
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

        <?php
        include 'components/menu-item.php'

        ?>

    </div>

    <script src="js/scroll.js"></script>
    
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

