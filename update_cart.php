<?php

// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";


// $item_id = $_POST['id'] ?? '';
// $index = $_POST['index'];
// $main_table = $_POST['main_table'] ?? null;
// $update = $_POST['update'];
// $menu_item = $_POST['menu_item'] ?? '';
// $price = floatval($_POST['item_price'] ?? 0.00);

// $subtotal = floatval($_POST['subtotal'] ?? $price);
// $note = $_POST['note'] ?? '';
// $quantity = intval($_POST['quantity'] ?? 1);



// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

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

    // Check if the index is valid within the session cart
    if ($index >= 0 && $index < count($_SESSION['cart'])) {
        // Update session cart with new values
        $_SESSION['cart'][$index]['menu_item'] = $_POST['menu_item'] ?? $_SESSION['cart'][$index]['menu_item'];
        $_SESSION['cart'][$index]['main_table'] = $_POST['main_table'] ?? $_SESSION['cart'][$index]['main_table'];
        $_SESSION['cart'][$index]['quantity'] = max(intval($_POST['quantity']), 1);
        $_SESSION['cart'][$index]['note'] = $_POST['note'] ?? '';

        // Filter out customizations (excluding any key containing "_price" or unnecessary fields)
        $customizations = [];
        foreach ($_POST as $key => $value) {
            if (is_array($value) && strpos($key, '_price') === false) {
                continue;
            } elseif (!is_array($value) && !in_array($key, ['index', 'menu_item', 'main_table', 'quantity', 'note', 'subtotal', 'id', 'update', 'item_price'])) {
                $customizations[$key] = $value;
            }
        }

        $_SESSION['cart'][$index]['customizations'] = $customizations;

        // Recalculate subtotal
        $_SESSION['cart'][$index]['subtotal'] = floatval($_POST['subtotal'] ?? $_SESSION['cart'][$index]['price'] * $_SESSION['cart'][$index]['quantity']);

        // Redirect back to step3.php after updating
        header("Location: step3.php");
        exit();
    } else {
        echo "Invalid item index.";
    }
}



?>

