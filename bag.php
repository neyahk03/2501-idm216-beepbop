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
    } elseif (!in_array($key, ['id','main_table', 'menu_item', 'item_price', 'subtotal', 'note', 'quantity']) 
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

    <h2>Your lunchbox</h2>

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
                <th>Actions</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $index => $item) : ?>

                
                <tr>
                    <td><?= htmlspecialchars($item['menu_item']) ?></td>
                    <td>
                        <div class="product-count" data-index="<?= $index ?>" data-price-per-item="<?= $item['subtotal'] / $item['quantity'] ?>">
                            <button class="button-count minus-btn">-</button>
                            <input type="text" readonly class="number-product" value="<?= $item['quantity'] ?>">
                            <button class="button-count plus-btn">+</button>
                        </div>
                    </td>
                    <td>
                    <?php 
                        if (!empty($item['customizations']) && is_array($item['customizations'])) {
                            $custom_choices = [];

                            foreach ($item['customizations'] as $category => $choices) {
                                

                                if (is_array($choices)) {
                                    $custom_choices = array_merge($custom_choices, array_values($choices));
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

                    <td class="item-subtotal">$<?= number_format($item['subtotal'], 2) ?></td>
                    <td>
                        <!-- edit button -->

                        <a href="edit-2.php?index=<?php echo $index; ?>">Edit</a>

                        <!-- remove button -->
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
        <!-- <p>
            <strong>Quantity: </strong>
            <?= $_SESSION['quantity'] ?>
        </p> -->

        <h3>Subtotal: <span id="bag-subtotal">$<?= number_format($_SESSION['bag_subtotal'], 2) ?></span></h3>

        <!-- <h3>Subtotal: $<?= number_format($bag_subtotal, 2) ?></h3> -->
        <!-- <p>Tax: $ <?= number_format($tax, 2) ?></p>
        <h2>Total: $ <?= number_format($total, 2) ?></h2> -->
    <?php endif; ?>

    <br>
    <a href="step1.php">Add More Items</a>
    <br>
    <a href="clear_cart.php">Clear Cart</a>

    <br>

    <h3>
        <a href="checkout.php">Checkout</a>
    </h3>


<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".product-count").forEach(function (counter) {
        let minusBtn = counter.querySelector(".minus-btn");
        let plusBtn = counter.querySelector(".plus-btn");
        let quantityInput = counter.querySelector(".number-product");
        let index = counter.getAttribute("data-index");
        let pricePerItem = parseFloat(counter.getAttribute("data-price-per-item"));
        let subtotalElement = counter.closest("tr").querySelector(".item-subtotal");
        let bagSubtotalElement = document.querySelector("#bag-subtotal");

        function updateCart(newQuantity) {
            fetch("change_quantity.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ index: index, quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    quantityInput.value = newQuantity;
                    subtotalElement.textContent = "$" + data.new_subtotal.toFixed(2);
                    if (bagSubtotalElement) {
                        bagSubtotalElement.textContent = "$" + data.bag_subtotal.toFixed(2);
                    }

                    updateMenuQuantity(data.quantity);
                } else {
                    alert("Error updating cart.");
                }
            })
            .catch(error => console.error("Error:", error));
        }

        function updateMenuQuantity(newQuantity) {
            fetch("update_menu_quantity.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let quantityElement = document.querySelector("#quantity");
                    if (quantityElement) {
                        quantityElement.textContent = "Quantity: " + data.quantity;
                    }
                }
            })
            .catch(error => console.error("Error updating menu:", error));
        }

        minusBtn.addEventListener("click", function () {
            
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) {
                updateCart(currentQuantity - 1);
            }
        });

        plusBtn.addEventListener("click", function () {
            console.log ('plus button is clicked');
            let currentQuantity = parseInt(quantityInput.value);
            updateCart(currentQuantity + 1);
        });
    });
});


</script>

</body>
</html>