<?php
session_start();

if (isset($_POST['guest'])) {
    // id for guest
    $_SESSION['guest_id'] = uniqid('guest_'); 

    // empty cart
    $_SESSION['cart'] = []; 

    // when click on continue as guest, redirect to step 1 (menu screen)
    // header("Location: step1.php");
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="icon" type="image/gif" href="/images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/log-in.css">
    <link rel="stylesheet" href="css/button.css">
</head>
<body>

    <div class="screen-container">

        <nav>
            <!-- <a href="bag.php">
                <img src="../images/icons/cancel.svg" alt="cancelicon">
            </a>

            
             -->
        </nav>

        <div class="nav-background">
            <svg width="100%" height="458" viewBox="0 0 440 458" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_932_1514" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="440" height="458">
                <rect width="440" height="458" fill="#D9D9D9"/>
                </mask>
                <g mask="url(#mask0_932_1514)">
                <path d="M178.879 189.634C60.4487 284.469 10.2804 189.633 0 130.361V0H440V67.0019V418.546C393.944 426.721 376.455 322.5 365.981 269.344C352.959 203.259 297.308 94.7984 178.879 189.634Z" fill="#C73715"/>
                <path d="M216.715 107.526C99.0554 202.307 49.2135 107.526 39 48.2875L18.4867 -67.9139C17.1895 -75.2621 22.842 -82 30.3039 -82H39H464.138C470.765 -82 476.138 -76.6274 476.138 -70V-15.0362V326.261C476.138 332.075 471.848 337.372 466.134 336.301C427.093 328.981 407.635 236.276 402.6 187.191C389.663 121.144 334.374 12.7446 216.715 107.526Z" stroke="#FFBB00" stroke-width="16"/>
                </g>
                </svg>
        </div>
    
        <div class="content">
    
            <div class="logo-container">
                <img class="logo-box" src="../images/logo.png" alt="Pete's logo">

                <div class="logo-text">

                    <img  src="../images/logo-text.svg" alt="Pete's logo text">
                </div>
            </div>
            
                <form class="login-container" method="POST">
        
                    <button type="submit" class="filled-button" >Log In</button>
                    <button type="submit" class="signup-button" >Sign Up To Earn Rewards</button>

                    <!-- <a href="home.html">Continue as Guest</a> -->

                    <form method="post">
                        <button class="guest" type="submit" name="guest">Continue as Guest</button>
                    </form>
                </form>
            

        </div>




    </div>

    <script src="js/button.js"></script>
    
</body>
</html>