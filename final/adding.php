<?php
session_start();

if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php");
    exit();
}

// echo "ID: ". $_SESSION['guest_id'] . "<br>";


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

// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";


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

// header("Location: menu.php");
// exit();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding to bag...</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/button.css">
    <style>
        .screen-container {
            height: 100vh;
        }

        img {
            width: 100%;
            max-width: 27.5rem;
        }

        .btn-container {
            position: absolute;
            bottom: 2.5rem;
            z-index: 1000;
            width: 100%;
            max-width: 27.5rem;
        }
    </style>

    <!-- <script>
        setTimeout(() => {
            document.getElementById('gif-container').style.display = 'block';

            setTimeout(() => {
                window.location.href = "menu.php";
            }, 800); 
        }, 1800);
    </script> -->
</head>

<body>

    <div class="screen-container">

            <div id="gif-container">
                <img src="../images/adding-to-bag.gif" alt="Add to Bag GIF" id="gif">
            </div>

            <div class="btn-container">

                <button class="nofill-button" onclick="gotoMenu()">
                    <h4>add more items</h4>
                </button>

                <button class="filled-button" onclick="gotoBag()">
                    <h4>checkout</h4>
                </button>
            </div>
    </div>

    <script src="js/button.js"></script>

</body>
</html>