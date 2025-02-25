<?php
session_start();

if (!isset($_SESSION['cart'])) {
    die("Cart is empty.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = intval($_POST['index']);

    if ($index >= 0 && $index < count($_SESSION['cart'])) {
        $_SESSION['cart'][$index]['menu_item'] = $_POST['menu_item'];
        $_SESSION['cart'][$index]['main_table'] = $_POST['main_table'];
        $_SESSION['cart'][$index]['quantity'] = max(intval($_POST['quantity']), 1);
        $_SESSION['cart'][$index]['note'] = $_POST['note'];
        $_SESSION['cart'][$index]['main_table'] = $_POST['main_table'];

        // Recalculate subtotal
        $_SESSION['cart'][$index]['subtotal'] = $_SESSION['cart'][$index]['price'] * $_SESSION['cart'][$index]['quantity'];
        
        header("Location: step3.php"); // Redirect back to cart page
        exit();
    } else {
        echo "Invalid item index.";
    }
}


?>





