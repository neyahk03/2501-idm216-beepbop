<?php

session_start();

if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php");
    exit();
}

// echo "ID: ". $_SESSION['guest_id'] . "<br>";


// Ensure the cart exists in session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['bag_subtotal'])) {
    $_SESSION['bag_subtotal'] = [];
}


// bag subtotal
$bag_subtotal = array_reduce($_SESSION['cart'], fn($total, $item) => $total + floatval($item['subtotal']), 0);
$_SESSION['bag_subtotal'] = $bag_subtotal;

// total quantity and store in session
$total_quantity = array_reduce($_SESSION['cart'], fn($sum, $item) => $sum + $item['quantity'], 0);
$_SESSION['quantity'] = $total_quantity;

// tax and total
$tax = $bag_subtotal * 0.06;
$total = $bag_subtotal + $tax;


echo "<pre>";
// print_r($_SESSION['cart']);

print_r($_SESSION['bag_subtotal']);

echo "</pre>";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/payment-1.css">
    <link rel="stylesheet" href="css/button.css">

</head>

<body>

    <div class="screen-container">

        <nav>
            <a href="bag.php">
                <img src="../images/icons/back.svg" alt="back icon">
            </a>
        </nav>
        
        <div class="nav-background">
            <svg width="441" height="236" viewBox="0 0 441 236" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M267.5 106.213C386.199 159.628 430.696 106.81 441 73.4255V-7.62939e-05H0V37.7385V235.744C46.1608 240.349 69.0512 170.373 79 142C92.0514 104.778 148.801 52.7971 267.5 106.213Z" fill="#C73715"/>
                <path d="M441 73.4255C430.696 106.81 386.199 159.628 267.5 106.213C148.801 52.7971 92.0514 104.778 79 142C69.0512 170.373 46.1608 240.349 0 235.744V184.823C8.92505 178.973 16.1824 170.909 22.0501 162.197C34.3676 143.909 41.4385 121.424 44.2457 106.213C50.5946 88.1992 67.0412 65.0657 95.0802 52.7785C108.974 46.69 125.834 43.1987 146.187 44.3118C166.654 45.431 191.101 51.2348 219.905 64.2746C280.084 91.5175 325.004 92.3562 356.668 80.3123C387.567 68.5594 403.311 45.4162 408.627 28.0988L408.63 28.0885L417.454 -7.62939e-05H441V73.4255Z" fill="#C73715"/>
                <path d="M403.456 -7.62939e-05H0V37.7385V170.373C3.40987 166.883 6.58679 162.897 9.51556 158.549C21.1549 141.267 27.9964 119.598 30.6793 104.898L30.7226 104.661L30.8036 104.428C37.4803 85.273 55.2038 59.4224 87.4769 45.2799C103.798 38.1276 123.714 34.0397 147.323 35.3308C170.819 36.6157 197.521 43.1995 227.68 56.8522C285.428 82.9945 324.449 82.1558 349.803 72.5119C375.916 62.5794 390.269 42.354 395.193 26.3067L395.196 26.2965L403.456 -7.62939e-05Z" fill="#C73715"/>
                </svg>
        </div>

        <div class="content">

            <h1>Payment</h1>

            <div class="payment-container" >
                <div class="choose-payment" onclick="goToPaymentSelection()" style="cursor: pointer;">
                    
                        <img src="../images/icons/add.svg" alt="add icon">
                        <p>Add payment method</p>
                </div>
    
                <p class="warning">
                    **Payment method is required.
                </p>

            </div>
            
            <!-- <div class="point">
                <p>Use your point</p>
                <p>1200 pts = $1.20</p>
            </div> -->

            <div class="point">
                <p>SIGN UP / LOG IN</p>
                <p>TO EARN POINTS</p>
            </div>

            <div class="pickup-time">
                <h4>Pick Up Time</h4>
                <div class="pickup-selection">
                    <p>ASAP</p>
                    <p>11:20 AM</p>
                    <p>11:50 AM</p>
                    <p>12:20 PM</p>
                    <p>12:50 PM</p>
                    <p>13:20 PM</p>
                    <p>13:20 PM</p>
                    <p>13:50 PM</p>
                </div>
            </div>

            <div class="add-tips">
                <h4>Add Tips:</h4>
                <div class="tips-selection">
                    <p>Custom Tip</p>
                    <p>$1.00</p>
                    <p>$2.00</p>
                    <p>$3.00</p>
                </div>
            </div>
        </div>

        <div class="total-container">

            <div class="total">
                <div class="bag-subtotal">
                    <h4>Subtotal</h4>
                    <h4><?php number_format($_SESSION['bag_subtotal'], 2) ?><h4>
                </div>

                <div class="tips">
                    <p>Tips</p>
                    <p>$1.00</p>
                </div>

                <div class="tax">
                    <p>Tax</p>
                    <p>$0.72</p>
                </div>

                <div class="bag-total">
                    <h2>Total</h2>
                    <h2>$6.72</h2>
                </div>
            </div>

        
            <!-- <div class="two-columns">
                <div class="column left-column">
                    <h4>Subtotal</h4>
                    <p>Tips</p>
                    <p>Tax</p>
                    <h2>Total</h2>
                </div>
                <div class="column right-column">
                    <h4>$6.00</h4>
                    <p>$1.00</p>
                    <p>$0.72</p>
                    <h2>$6.72</h2>
                </div>
            </div> -->
            
            <button id="place-order-button" class="filled-button disabled" onclick="gotoConfirmOrder()" >
                PLACE ORDER
            </button>
        </div>


    </div>
    
    <script src="js/button.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/pickup-tips.js"></script>

</body>

</html>