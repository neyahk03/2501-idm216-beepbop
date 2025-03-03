<?php

include "functions/status.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/status.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/foodcard.css">

</head>
<body>
    <div class="screen-container">

        <nav>
            
            <a href="home.php">
                <img src="../images/icons/cancel.svg" alt="cancel icon">
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

            <h1>Receipt Order</h1>

            <p class="order-number">
                <?= $order_number ?>
            </p>


            <div class="estimate-time">
                <p>Estimated pick up time</p>
                <h2>
                        <?php 
                            if ($pickup_time === "ASAP") {
                                echo "in 15 minutes";
                            } else {
                                echo htmlspecialchars($pickup_time);
                            }
                        ?>
                </h2>
            </div>
            
            <div class="progress-bar">
                <div class="status">
                    <img src="../images/logo.png" alt="logo" width="78px">
                    <div class="step"></div>
                </div>
                <div class="status">
                    <img src="../images/icons/frying-pan.svg" alt="frying-pan">
                    <div class="step"></div>
                </div>
                <div class="status">
                    <img src="../images/icons/checkmark.svg" alt="checkmark">
                    <div class="step"></div>
                </div>
            </div>            

            <p>Your order is being prepared!</p>
            


            <?php if (empty($_SESSION['order']['items'])) :
                header("Location: login-status.php");
                exit();
            else : ?>

                <?php foreach ($_SESSION['order']['items'] as $index => $item) : ?>
                    <div class="food-card">
                        <img class="food-pic" src="../images/menu-item/<?= htmlspecialchars($item['image_link']) ?>" alt="<?= htmlspecialchars($item['menu_item']) ?>">
                        
                        <div class="food-details">
                    
                            <div class="food-description">

                                <div class="food-details-title">
                                    <h3><?= htmlspecialchars($item['menu_item']) ?></h3>
                                    <p class="item-subtotal">$<?= number_format($item['subtotal'], 2) ?></p>
                                </div>

                            </div>

                            <div class="custom-note-container">
                                <p class="customization">
                                    <?php 
                                        if (!empty($item['customizations']) && is_array($item['customizations'])) {
                                            $custom_choices = [];

                                            foreach ($item['customizations'] as $category => $choices) {
                                                if (is_array($choices)) {
                                                    $custom_choices = array_merge($custom_choices, array_values($choices));
                                                } else {
                                                    $custom_choices[] = $choices;
                                                }
                                            }

                                            echo !empty($custom_choices) ? implode(', ', array_map('htmlspecialchars', $custom_choices)) : 'No customizations';
                                        } else {
                                            echo 'No customizations';
                                        }
                                    ?>
                                </p>

                                <p class="note"><strong>Notes: </strong><?= !empty($item['note']) ? htmlspecialchars($item['note']) : 'None' ?></p>

                            </div>

                            
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>




            
            <div class="total-container">
    
                <div class="total">
                    <div class="bag-subtotal">
                        <h4>Subtotal</h4>
                        <h4>$<?php echo number_format($subtotal, 2) ?></h4>
                    </div>

                    <div class="tips">
                        <p>Tips</p>
                        <p>$<?php echo number_format($tip, 2) ?></p>
                    </div>

                    <div class="tax">
                        <p>Tax</p>
                        <p>$<?php echo number_format($tax, 2) ?></p>
                    </div>

                    <div class="bag-total">
                        <h2>Total</h2>
                        <h2>$<?php echo number_format($total, 2) ?></h2>
                    </div>
                </div>
            </div>



        
    </div>

    <script src="js/button.js"></script>
</body>

</html>

<!-- <h2>Order Confirmation</h2>
<p>Pickup Time: <?php echo htmlspecialchars($pickup_time); ?></p>
<p>Tip: $<?php echo number_format($selected_tip, 2); ?></p>
<p>Total: $<?php echo number_format($new_total, 2); ?></p> -->