<?php
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$index = $data['index'] ?? null;
$newQuantity = intval($data['quantity'] ?? 1);

if ($index !== null && isset($_SESSION['cart'][$index])) {
    // Update the quantity
    $_SESSION['cart'][$index]['quantity'] = max($newQuantity, 1);
    $_SESSION['cart'][$index]['subtotal'] = $_SESSION['cart'][$index]['price'] * $_SESSION['cart'][$index]['quantity'];

    // Recalculate total bag subtotal
    $_SESSION['bag_subtotal'] = array_reduce($_SESSION['cart'], function ($total, $item) {
        return $total + floatval($item['subtotal']);
    }, 0);

    echo json_encode([
        'success' => true,
        'new_subtotal' => $_SESSION['cart'][$index]['subtotal'],
        'bag_subtotal' => $_SESSION['bag_subtotal']
    ]);
} else {
    echo json_encode(['success' => false]);
}
?>
