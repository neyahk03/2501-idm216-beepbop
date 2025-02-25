<?php
// session_start();

// if (!isset($_SESSION['guest_id'])) {
//     header("Location: login.php");
//     exit();
// }

// $index = $_POST['edit_index'] ?? null;
// $id = $_POST['edit_id'] ?? '';
// $menu_item = $_POST['menu_item'] ?? '';
// $quantity = intval($_POST['quantity'] ?? 1);
// $price = floatval($_POST['price'] ?? 0.00);
// $note = $_POST['note'] ?? '';
// $customizations = [];

// // Retrieve customizations
// foreach ($_POST as $key => $value) {
//     if (!in_array($key, ['edit_index', 'edit_id', 'menu_item', 'quantity', 'price', 'note']) && !is_numeric($value)) {
//         $customizations[$key] = $value;
//     }
// }

// // Update session cart
// if ($index !== null && isset($_SESSION['cart'][$index])) {
//     $_SESSION['cart'][$index] = [
//         'id' => $id,
//         'menu_item' => $menu_item,
//         'quantity' => max($quantity, 1),
//         'price' => $price,
//         'subtotal' => max($quantity * $price, $price),
//         'note' => $note,
//         'customizations' => !empty($customizations) ? $customizations : []
//     ];
// }

// // Redirect back to cart
// header("Location: step3.php");
// exit();



session_start();

if (!isset($_SESSION['cart'])) {
    die("Cart is empty.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = intval($_POST['index']);

    if ($index >= 0 && $index < count($_SESSION['cart'])) {
        $_SESSION['cart'][$index]['menu_item'] = $_POST['menu_item'];
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
