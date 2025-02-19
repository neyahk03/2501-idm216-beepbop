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
            <h1>Menu</h1>
            <a href="empty-bag.html">
                <img src="../images/icons/shopping-bag.svg" alt="shopping bag icon">
            </a>
        </nav>

        <div class="filter-bar">
            <div class="filter">
                <a href="#sandwiches" class="heading-4">
                    Sandwiches
                </a>
            </div>

            <div class="filter">
                <a href="#cheesesteaks" class="heading-4">
                    Cheese Steaks
                </a>
            </div>

            <div class="filter">
            <a href="#salads" class="heading-4">
                    Salads
                </a>
            </div>

            <div class="filter">
            <a href="#pastries" class="heading-4">
                    Pastries
                </a>
            </div>
            <div class="filter">
            <a href="#drinks" class="heading-4">
                    Drinks
                </a>
            </div>
        </div>

        


        
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
    
</body>

</html>

