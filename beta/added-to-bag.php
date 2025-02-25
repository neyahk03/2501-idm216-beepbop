<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Pete's Lunch Box</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/menu-item.css">
    <link rel="stylesheet" href="css/added.css">
</head>
<body>

    <div class="screen-container">

        <nav>
            <h1>MENU</h1>
            <a href="bag.php">
                <img src="../images/icons/shopping-bag.svg" alt="shopping bag icon">
            </a>
            <p class="quanity">1</p>
        </nav>

        <div class="filter-bar">
            <div class="filter">
                <a href="#sandwiches" class="heading-4">
                    SANDWICHES
                </a>
            </div>

            <div class="filter">
                <a href="#cheese-steak" class="heading-4">
                    CHEESE STEAKS
                </a>
            </div>

            <div class="filter">
            <a href="#salads" class="heading-4">
                    SALADS
                </a>
            </div>

            <div class="filter">
            <a href="#pastries" class="heading-4">
                    PASTRIES
                </a>
            </div>
            <div class="filter">
            <a href="#drinks" class="heading-4">
                    DRINKS
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

    <script src="js/scripts.js"></script>
    
</body>

</html>

