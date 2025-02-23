<?php
session_start();

if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php");
    exit();
}

// Ensure the cart exists in session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Retrieve form data from `step2.php`
$id = $_POST['id'] ?? '';
// $table = $_POST['table_to_display'] ?? null;
$menu_item = $_POST['menu_item'] ?? '';
$price = floatval($_POST['item_price'] ?? 0.00);
$subtotal = floatval($_POST['subtotal'] ?? $price);
$note = $_POST['note'] ?? '';
$quantity = intval($_POST['quantity'] ?? 1);

// Retrieve selected customizations (excluding prices)
$customizations = [];

foreach ($_POST as $key => $value) {
    if (is_array($value)) {
        // Checkbox selections (filter out numeric values)
        $filtered_values = array_filter($value, fn($v) => !is_numeric($v));
        if (!empty($filtered_values)) {
            $customizations[$key] = array_values($filtered_values);
        }
    } elseif (!in_array($key, ['id', 'table_to_display', 'menu_item', 'item_price', 'subtotal', 'note', 'quantity']) 
              && strpos($key, '_price') === false && !is_numeric($value)) {
        // Radio button or dropdown selections (excluding prices)
        $customizations[$key] = $value;
    }
}

// Check if the item already exists in the cart (same item, same customizations)
$found = false;
foreach ($_SESSION['cart'] as &$cart_item) {
    if ($cart_item['id'] === $id && $cart_item['customizations'] == $customizations) {
        $cart_item['quantity'] += $quantity;
        $cart_item['subtotal'] += $subtotal * $quantity;
        $found = true;
        break;
    }
}

// If item is new, add it to the cart
if (!$found && !empty($menu_item)) {
    $_SESSION['cart'][] = [
        'id' => $id ?: uniqid(),
        // 'table' => $table ?: 'Unknown',
        'menu_item' => $menu_item,
        'price' => $price,
        'quantity' => max($quantity, 1),
        'subtotal' => max($subtotal * $quantity, $price),
        'note' => $note,
        'customizations' => !empty($customizations) ? $customizations : []
    ];
}

// Remove empty or invalid items from the cart
$_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) {
    return !empty($item['menu_item']) && isset($item['quantity']) && $item['quantity'] > 0;
});

// Calculate bag subtotal
$bag_subtotal = array_reduce($_SESSION['cart'], fn($total, $item) => $total + floatval($item['subtotal']), 0);
$_SESSION['bag_subtotal'] = $bag_subtotal;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>

    <h2>Your Shopping Cart</h2>

    <?php if (empty($_SESSION['cart'])) : ?>
        <p>Your cart is empty.</p>
    <?php else : ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Customizations</th>
                <th>Note</th>
                <th>Subtotal</th>
                <th>Remove</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $index => $item) : ?>
                <tr>
                    <td><?= htmlspecialchars($item['menu_item']) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td>
                        <?php 
                        if (!empty($item['customizations'])) {
                            $custom_choices = [];
                            foreach ($item['customizations'] as $category => $choices) {
                                if (is_array($choices)) {
                                    $custom_choices = array_merge($custom_choices, $choices);
                                } else {
                                    $custom_choices[] = $choices;
                                }
                            }
                            echo !empty($custom_choices) ? implode(', ', array_map('htmlspecialchars', $custom_choices)) : 'No customizations';
                        } else {
                            echo 'No customizations';
                        }
                        ?>
                    </td>
                    <td><?= !empty($item['note']) ? htmlspecialchars($item['note']) : 'None' ?></td>
                    <td>$<?= number_format($item['subtotal'], 2) ?></td>
                    <td>
                        <form action="remove_item.php" method="POST">
                            <input type="hidden" name="index" value="<?= $index ?>">
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <?php if (!empty($_SESSION['cart'])) : ?>
        <h3>Subtotal: $<?= number_format($bag_subtotal, 2) ?></h3>
    <?php endif; ?>

    <br>
    <a href="step1.php">Add More Items</a>
    <br>
    <a href="clear_cart.php">Clear Cart</a>

</body>
</html>
