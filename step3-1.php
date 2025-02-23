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
$table = $_POST['table_to_display'] ?? null;
$menu_item = $_POST['menu_item'] ?? 'Unknown Item';
$price = floatval($_POST['item_price'] ?? 0.00);
$subtotal = floatval($_POST['subtotal'] ?? $price);
$note = $_POST['note'] ?? '';
$quantity = intval($_POST['quantity'] ?? 1);

// Retrieve selected customizations
$customizations = [];
foreach ($_POST as $key => $value) {
    if (is_array($value)) {
        $customizations[$key] = $value; // Multiple selections (checkbox)
    } elseif (!in_array($key, ['id', 'table', 'menu_item', 'item_price', 'subtotal', 'note', 'quantity'])) {
        $customizations[$key] = $value; // Single selection (radio)
    }
}

// Check if the item already exists in the cart (same item, same customizations)
$found = false;
foreach ($_SESSION['cart'] as &$cart_item) {
    if ($cart_item['id'] == $id && $cart_item['customizations'] == $customizations) {
        $cart_item['quantity'] += $quantity;
        $cart_item['subtotal'] += $subtotal * $quantity;
        $found = true;
        break;
    }
}

// If item is new, add it to the cart
if (!$found) {
    $_SESSION['cart'][] = [
        'id' => $id,
        'table' => $table,
        'menu_item' => $menu_item,
        'price' => $price,
        'quantity' => $quantity,
        'subtotal' => $subtotal * $quantity,
        'note' => $note,
        'customizations' => $customizations
    ];
}

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
                <th>Price</th>
                <th>Quantity</th>
                <th>Customizations</th>
                <th>Note</th>
                <th>Subtotal</th>
                <th>Remove</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $index => $item) : ?>
                <tr>
                    <td><?= htmlspecialchars($item['menu_item']) ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>
                        <?php foreach ($item['customizations'] as $category => $choices) : ?>
                            <strong><?= ucfirst(str_replace('_', ' ', $category)) ?>:</strong> 
                            <?= is_array($choices) ? implode(', ', $choices) : htmlspecialchars($choices) ?>
                            <br>
                        <?php endforeach; ?>
                    </td>
                    <td><?= htmlspecialchars($item['note']) ?></td>
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

    <br>
    <a href="step2.php">Add More Items</a>
    <br>
    <a href="clear_cart.php">Clear Cart</a>

</body>
</html>
