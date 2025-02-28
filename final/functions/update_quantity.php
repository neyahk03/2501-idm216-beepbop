<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $index = $_POST['index'];
    $newQuantity = intval($_POST['quantity']);
    $newSubtotal = floatval($_POST['subtotal']);

    if (isset($_SESSION['cart'][$index])) {
        if ($newQuantity > 0) {
            $_SESSION['cart'][$index]['quantity'] = $newQuantity;
            $_SESSION['cart'][$index]['subtotal'] = $newSubtotal;
        } else {
            unset($_SESSION['cart'][$index]); // Remove item if quantity = 0
        }
    }

    // Calculate total cart quantity
    $totalQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));

    echo json_encode(["success" => true, "totalQuantity" => $totalQuantity]);
    exit;
}
