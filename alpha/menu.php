<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Pete's Lunch Box</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/menu-item.css">
</head>
<body>

    <div class="screen-container">

        <nav>
            <h1>Menu</h1>
            <div>
                <img src="../images/icons/shopping-bag.svg" alt="shopping bag icon">
            </div>
        </nav>

        <div class="filter-bar">
            <div class="filter">
                <h4>Sandwiches</h4>
            </div>
            <div class="filter">
                <h4>Cheese Steaks</h4>
            </div>
            <div class="filter">
                <h4>Salads</h4>
            </div>
            <div class="filter">
                <h4>Snacks</h4>
            </div>
            <div class="filter">
                <h4>Drinks</h4>
            </div>
        </div>

        


        
        <div class="bottom-nav">
            
            <a href="#" class="icon-container">
                <img src="../images/icons/home.svg" alt="home icon">
                <p class="label">Home</p>
            </a>

            

            <a href="menu.html" class="icon-container">
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
    
</body>
</html>

