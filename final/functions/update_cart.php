<?php

session_start();

if (!isset($_SESSION['cart'])) {
    die("Cart is empty.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    print_r($_SESSION['cart']);
    echo "</pre>";

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $index = intval($_POST['index']); // Ensure index is an integer

    // Validate index
    if ($index < 0 || $index >= count($_SESSION['cart'])) {
        die("Invalid item index.");
    }

    // Get the existing item from the cart
    $existing_item = $_SESSION['cart'][$index];

    $item_id = $_POST['id'] ?? $existing_item['id'];
    $main_table = $_POST['main_table'] ?? $existing_item['main_table'];
    $menu_item = $_POST['menu_item'] ?? $existing_item['menu_item'];
    $quantity = max(intval($_POST['quantity']), 1);
    $note = $_POST['note'] ?? '';

    // Extract customizations, ignoring _price-related keys
    $customizations = [];
    foreach ($_POST as $key => $value) {
        if (is_array($value) && strpos($key, '_price') === false) {
            $customizations[$key] = $value;
        } elseif (!is_array($value) && !in_array($key, ['index', 'drink_option_price', 'preparation_option_price', 'drink_size_price', 'soda_type_price', 'pastry_option_price','dressing_price', 'bread_price','cheesesteak_bread_price', 'menu_item', 'main_table', 'quantity', 'note', 'subtotal', 'id', 'update', 'item_price'])) {
            $customizations[$key] = $value;
        }
    }

    // Sort customizations for consistency
    ksort($customizations);

    // **Check if there's an existing item in the cart that matches**
    foreach ($_SESSION['cart'] as $cart_index => &$cart_item) {
        if (
            $cart_index !== $index && // Avoid comparing with itself
            $cart_item['id'] === $item_id &&
            $cart_item['main_table'] === $main_table &&
            $cart_item['menu_item'] === $menu_item &&
            $cart_item['customizations'] === $customizations &&
            $cart_item['note'] === $note
        ) {
            // If a match is found, add the quantity instead of creating a duplicate
            $cart_item['quantity'] += $quantity;
            $cart_item['subtotal'] = $cart_item['price'] * $cart_item['quantity'];

            // Remove the original item at $index since it's merged
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array

            // Redirect to step3.php
            header("Location: step3.php");
            exit();
        }
    }

    // **If no match, update the existing item**
    $_SESSION['cart'][$index]['id'] = $item_id;
    $_SESSION['cart'][$index]['main_table'] = $main_table;
    $_SESSION['cart'][$index]['menu_item'] = $menu_item;
    $_SESSION['cart'][$index]['quantity'] = $quantity;
    $_SESSION['cart'][$index]['note'] = $note;
    $_SESSION['cart'][$index]['customizations'] = $customizations;
    $_SESSION['cart'][$index]['subtotal'] = floatval($_POST['subtotal'] ?? $_SESSION['cart'][$index]['price'] * $_SESSION['cart'][$index]['quantity']);

    // Redirect back to step3.php after updating
    header("Location: ../bag.php");
    exit();
}

?>
