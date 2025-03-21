<?php
session_start();


if (!isset($_SESSION['guest_id'])) {
    header("Location: login-signup.php");
    exit();
}

// echo "ID: ". $_SESSION['guest_id'] . "<br>";

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['order_number'])) {
    $_SESSION['order_number'] = 1; 
} else {
    $_SESSION['order_number']++;
}


if ($_SESSION['order_number'] > 999) {
    $_SESSION['order_number'] = 1;
}

$order_number = str_pad($_SESSION['order_number'], 3, '0', STR_PAD_LEFT);


$_SESSION['order'] = [
    'order_number' => $order_number,
    'items' => $_SESSION['cart'],
    'subtotal' => $_SESSION['bag_subtotal'],
    'total' => $_POST['new_total'] ?? 0.00,
    'tip' => $_POST['selected_tip'] ?? 0.00,
    'tax' => $_POST['tax'],
    'pickup_time' => $_POST['pickup_time'] ?? "ASAP"
];

// print_r($_SESSION['bag_subtotal']);

// Reset cart after placing order
$_SESSION['cart'] = [];

$pickup_time = $_SESSION['order']['pickup_time'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirm</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/confirm.css">
    <link rel="stylesheet" href="css/button.css">

</head>
<body>
    <div class="screen-container">

        <nav>
            <!-- <a href="payment-1.html">
                <img src="../images/icons/back.svg" alt="back icon">
            </a> -->
        </nav>

        <div class="nav-background">
            <svg width="441" height="236" viewBox="0 0 441 236" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M267.5 106.213C386.199 159.628 430.696 106.81 441 73.4255V-7.62939e-05H0V37.7385V235.744C46.1608 240.349 69.0512 170.373 79 142C92.0514 104.778 148.801 52.7971 267.5 106.213Z" fill="#C73715"/>
                <path d="M441 73.4255C430.696 106.81 386.199 159.628 267.5 106.213C148.801 52.7971 92.0514 104.778 79 142C69.0512 170.373 46.1608 240.349 0 235.744V184.823C8.92505 178.973 16.1824 170.909 22.0501 162.197C34.3676 143.909 41.4385 121.424 44.2457 106.213C50.5946 88.1992 67.0412 65.0657 95.0802 52.7785C108.974 46.69 125.834 43.1987 146.187 44.3118C166.654 45.431 191.101 51.2348 219.905 64.2746C280.084 91.5175 325.004 92.3562 356.668 80.3123C387.567 68.5594 403.311 45.4162 408.627 28.0988L408.63 28.0885L417.454 -7.62939e-05H441V73.4255Z" fill="#C73715"/>
                <path d="M403.456 -7.62939e-05H0V37.7385V170.373C3.40987 166.883 6.58679 162.897 9.51556 158.549C21.1549 141.267 27.9964 119.598 30.6793 104.898L30.7226 104.661L30.8036 104.428C37.4803 85.273 55.2038 59.4224 87.4769 45.2799C103.798 38.1276 123.714 34.0397 147.323 35.3308C170.819 36.6157 197.521 43.1995 227.68 56.8522C285.428 82.9945 324.449 82.1558 349.803 72.5119C375.916 62.5794 390.269 42.354 395.193 26.3067L395.196 26.2965L403.456 -7.62939e-05Z" fill="#C73715"/>
                </svg>
        </div>

        <div class="content-container">

            
            <div class="content">
                <h1>Order Confirmed!</h1>


                <p>Your order number: <strong>#<?= $order_number ?></strong>  </p>
               


                <!-- <div class="stars-container">
                    <img src="../images/icons/3stars.svg" class="stars" alt="3 stars">
                </div>                 -->
                <!-- <p>You earned <strong>772 pts</strong> with your order</p> -->
    
                <div class="animation">
                    <img class="heart-gif" src="../images/icons/heart.gif" alt="heart gif">
    
                    <div class="thankyou-gif">
                        <img src="../images/icons/thankyou.gif" alt="thank you gif">
    
                    </div>
    
                </div>
    
                <div class="time-container">
                    <p>Estimated pick up time:</p>
                    <p class="time">
                        <?php 
                            if ($pickup_time === "ASAP") {
                                echo "in 15 minutes";
                            } else {
                                echo htmlspecialchars($pickup_time);
                            }
                        ?>
                    </p>
                </div>
            </div>



            <div class="btn-container">
        
                <button class="nofill-button" onclick="viewStatus()">view order status</button>
        
                <button class="filled-button" onclick="goHome()">home</button>
            </div>
            
            
        </div>
        
    </div>

    <script src="js/button.js"></script>
</body>

</html>
