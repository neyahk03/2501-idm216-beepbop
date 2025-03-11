<?php

session_start();

if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php");
    exit();
}

// echo "ID: ". $_SESSION['guest_id'] . "<br>";

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['bag_subtotal'])) {
    $_SESSION['bag_subtotal'] = [];
}


$selected_tip = $_POST['selected_tip'] ?? 0;
$tips = [0 => "No Tip", 1.00 => "$1.00", 2.00 => "$2.00", 3.00 => "$3.00"];


$bag_subtotal = $_SESSION['bag_subtotal'] ?? 0.00;

// print_r($bag_subtotal);

$selected_tip = $_SESSION['selected_tip'] ?? 0.00;
$tax = $bag_subtotal * 0.06;
$new_total = $bag_subtotal + $tax + $selected_tip;
$pickup_time = $_SESSION['pickup_time'] ?? "ASAP";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/payment-1.css">

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
            
            <div class="point-wrapper">
                <div class="point">
                    <p>SIGN UP / LOG IN</p>
                    <p>TO EARN POINTS</p>
                </div>

                <div class="point-swirl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="440" height="198" viewBox="0 0 440 198" fill="none">
                        <path d="M278.985 66.9751C414.584 100.47 472.026 66.9751 483.797 46.041V-0.000854492H-19.9937V23.6633L-2.79187 197.922C7.45352 182.609 22.9483 126.285 64.7562 95.1278C106.564 63.971 143.385 33.4806 278.985 66.9751Z" fill="#FFBB00"/>
                        <path d="M483.797 46.041C472.026 66.9751 414.584 100.47 278.985 66.9751C143.385 33.4806 106.564 63.971 64.7562 95.1278C22.9483 126.285 7.45352 182.609 -2.79187 197.922L-19.9937 115.894C-20.3656 114.089 -5.19748 112.211 -2.79187 108.708C26.0029 55.4073 61.5305 39.6113 88.6243 33.0942C104.497 29.2764 123.757 27.0871 147.008 27.7851C170.389 28.4869 198.316 32.1262 231.222 40.3029C299.97 57.3857 351.285 57.9116 387.458 50.3595C422.757 42.9897 440.741 28.4776 446.815 17.6187L446.818 17.6123L456.898 -0.000854492H483.797V46.041Z" fill="#C73715"/>
                        <path d="M440.908 -0.000854492H-19.9937V23.6633V106.832C-19.9937 106.832 -17.9917 103.288 -2.79187 61.4629C21.7714 16.3981 121.335 21.3439 148.306 22.1535C175.147 22.9592 205.651 27.0876 240.104 35.6486C306.074 52.0413 350.651 51.5154 379.615 45.4682C409.447 39.2399 425.843 26.5575 431.467 16.495L431.471 16.4886L440.908 -0.000854492Z" fill="white"/>
                    </svg>
                </div>
            </div>


            <form action="confirm.php" method="post">

                <input type="hidden" name="new_total" value="<?php echo $new_total; ?>">
                <input type="hidden" name="selected_tip" value="<?php echo $selected_tip; ?>">
                <input type="hidden" name="bag_subtotal" value="<?php echo $bag_subtotal ?>">
                <input type="hidden" name="tax" value="<?php echo $tax ?>">
                <!-- <input type="hidden" id="selectedPickupTime" name="pickup_time" value="<?php echo $pickup_time; ?>"> -->


                <div class="pickup-time">
                    <h4>Pick Up Time</h4>
                
                    <div class="pickup-selection">
                        <?php
                        $times = ["ASAP", "11:20 AM", "11:50 AM", "12:20 PM", "12:50 PM", "1:20 PM", "1:50 PM"];
                        foreach ($times as $time) {
                            $selected = ($pickup_time === $time) ? "checked" : "";
                            echo "<label class='pickup-option $selected'>
                                    <input type='radio' name='pickup_time' value='$time' $selected> $time
                                  </label>";
                        }
                        ?>
                    </div>

                </div>

                <div class="add-tips">
                    <h4>Add Tips: </h4>
                    <div class="tips-selection">
                        <?php
                        foreach ($tips as $value => $label) {
                            $selected = ($selected_tip == $value) ? "selected" : "";
                            $checked = ($selected_tip == $value) ? "checked" : "";
                            echo "<label class='$selected' data-value='$value'>$label
                                    <input type='radio' name='selected_tip' value='$value' $checked>
                                </label>";
                        }
                        ?>
                    </div>
                </div>



            </div>
    
            <div class="total-container">
    
                <div class="total">
                    <div class="bag-subtotal">
                        <h4>Subtotal</h4>
                        <h4>$<?php echo number_format($bag_subtotal, 2); ?></h4>
                    </div>
    
                    <div class="tips">
                        <p>Tips</p>
                        <p>$0.00</p>
                    </div>
    
                    <div class="tax">
                        <p>Tax</p>
                        <p>$<?php echo number_format($tax, 2) ?></p>
                    </div>
    
                    <div class="bag-total">
                        <h2>Total</h2>
                        <h2>$<?php echo number_format($new_total, 2) ?></h2>
                    </div>
                </div>
    
        
                
                <button id="place-order-button" class="filled-button disabled" type="submit" >
                    PLACE ORDER
                </button>
            </div>
            </form>



    </div>
    
    <script src="js/button.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/pickup-tips.js"></script>

</body>

</html>