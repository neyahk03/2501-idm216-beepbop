<?php
session_start();

include 'includes/database.php';

// Redirect if not logged in
if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php");
    exit();
}

echo "ID: " . $_SESSION['guest_id'] . "<br>";

if (!isset($_SESSION['cart'])) {
    die("Cart is empty.");
}


echo '<pre>';
print_r($_SESSION['cart']);
echo '</pre>';

// Get the item index from URL
$index = isset($_GET['index']) ? intval($_GET['index']) : -1;

// Check if index exists in cart
if ($index >= 0 && $index < count($_SESSION['cart'])) {
    $item = $_SESSION['cart'][$index];
    print_r($item); 
} else {
    echo "Invalid item.";
}



$connection->close();
?>
