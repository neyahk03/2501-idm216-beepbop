<?php
session_start();


if (!isset($_SESSION['guest_id'])) {
    header("Location: login-signup.php");
    exit();
}

// echo "ID: ". $_SESSION['guest_id'] . "<br>";

if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = [];
}



// if (empty($_SESSION['order']['items'])) {
//     header("Location: order-status.php");
//     exit();
// }

// echo '<pre>';
// print_r($_SESSION['order']);
// echo '</pre>';

$order = $_SESSION['order'] ?? [];

$order_number = $order['order_number'] ?? 'N/A';
$items = $order['items'] ?? [];
$bag_subtotal = $order['subtotal'] ?? 0.00;
$total = $order['total'] ?? 0.00;
$tip = $order['tip'] ?? 0.00;
$tax = $order['tax'] ?? 0.00;
$pickup_time = $order['pickup_time'] ?? 'ASAP';

foreach ($items as $item) {
    $item_id = $item['id'];
    $main_table = $item['main_table'];
    $image_link = $item['image_link'];
    $menu_item = $item['menu_item'];
    $price = $item['price'];
    $quantity = $item['quantity'];
    $subtotal = $item['subtotal'];
    $note = $item['note'] ?? '';
    $customizations = $item['customizations'] ?? [];
}


?>