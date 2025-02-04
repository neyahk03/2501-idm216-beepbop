<?php 
session_start();

$user_id = $_SESSION['user_id'];

echo "User ID: $user_id<br>";

$tax_rate = 0.06;
$_SESSION['cart'][$_SESSION['user_id']]['total_price'] *= (1 + $tax_rate);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>
</head>
<body>

    <?php
        if ($user_id && !empty($_SESSION['cart'][$user_id])) {
            $cart = $_SESSION['cart'][$user_id];
        
            echo "<h2>Cart Summary</h2>";
            echo "<p>Selected Items:</p><ul>";
        
            foreach ($cart['selected_items'] as $item) {
                echo "<li>$item</li>";
            }
        
            echo "</ul>";
        
            echo "<p><strong>Subtotal:</strong> $" . number_format($cart['subtotal'], 2) . "</p>";
            echo "<p><strong>Tax:</strong> $" . number_format($cart['subtotal'] * 0.06, 2) . "</p>";
            echo "<p><strong>Total Price (with tax):</strong> $" . number_format($cart['total_price'], 2) . "</p>";

        } 
    ?>
    
    <a href="step1.php">Go Back</a>
</body>
</html>
