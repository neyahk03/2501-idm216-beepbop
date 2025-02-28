<?php
session_start();

if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php");
    exit();
}

echo "ID: ". $_SESSION['guest_id'] . "<br>";


// Ensure the cart exists in session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


// Retrieve form data from `step2.php`
$item_id = $_POST['id'] ?? '';
$main_table = $_POST['main_table'] ?? null;
$image_link = $_POST['image_link'] ?? '';
$menu_item = $_POST['menu_item'] ?? '';
$price = floatval($_POST['item_price'] ?? 0.00);
$subtotal = floatval($_POST['subtotal'] ?? $price);
$note = $_POST['note'] ?? '';
$quantity = intval($_POST['quantity'] ?? 1);



$selected_table = null;
$customizations = [];

foreach ($_POST as $key => $value) {
    if ($key === 'main_table') {
        $selected_table = $value;
        continue;
    }

    if (is_array($value)) {
        // Checkbox selections (filter out numeric values)
        $filtered_values = array_filter($value, fn($v) => !is_numeric($v));
        if (!empty($filtered_values)) {
            $customizations[$key] = array_values($filtered_values);
        }
    } elseif (!in_array($key, ['id','main_table','image_link', 'menu_item', 'item_price', 'subtotal', 'note', 'quantity']) 
              && strpos($key, '_price') === false && !is_numeric($value)) {

                $customizations[$key] = $value;
    }
}



// Check if the item already exists in the cart (same item, same customizations)

ksort($customizations);


$found = false;
foreach ($_SESSION['cart'] as &$cart_item) {
    if (!isset($cart_item['id'])) continue;

    if (
        $cart_item['id'] === $item_id &&
        $cart_item['main_table'] === $main_table &&
        $cart_item['menu_item'] === $menu_item &&
        $cart_item['customizations'] === $customizations &&
        $cart_item['note'] === $note
    ) {
        // If item exists, increase quantity
        $cart_item['quantity'] += $quantity;
        $cart_item['subtotal'] = $cart_item['price'] * $cart_item['quantity'];
        $found = true;
        break;
    }
}


// If item is new, add it to the cart
if (!$found && !empty($menu_item)) {
    $_SESSION['cart'][] = [
        'id' => $item_id ?: uniqid(),
        'main_table' => $selected_table ?: 'Unknown',
        'image_link' => $image_link,
        'menu_item' => $menu_item,
        'price' => $price,
        'quantity' => max($quantity, 1),
        'subtotal' => max($subtotal, $price),
        'note' => $note,
        'customizations' => !empty($customizations) ? $customizations : []
    ];
}

echo "<pre>";
print_r($_SESSION['cart']);
echo "</pre>";


// Remove empty or invalid items from the cart
$_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) {
    return !empty($item['menu_item']) && isset($item['quantity']) && $item['quantity'] > 0;
});

// bag subtotal
$bag_subtotal = array_reduce($_SESSION['cart'], fn($total, $item) => $total + floatval($item['subtotal']), 0);
$_SESSION['bag_subtotal'] = $bag_subtotal;

// total quantity and store in session
$total_quantity = array_reduce($_SESSION['cart'], fn($sum, $item) => $sum + $item['quantity'], 0);
$_SESSION['quantity'] = $total_quantity;

// tax and total
$tax = $bag_subtotal * 0.06;
$total = $bag_subtotal + $tax;

header("Location: step1.php");
exit();


?>
