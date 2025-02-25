<?php
session_start();

include 'includes/database.php';

// Redirect if not logged in
if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php");
    exit();
}

echo "ID: " . $_SESSION['guest_id'] . "<br>";

if (!isset($_SESSION['cart'])) {
    die("Cart is empty.");
}



// echo '<pre>';
// print_r($_SESSION['cart']);
// echo '</pre>';


// Get the item index from URL
$index = isset($_GET['index']) ? intval($_GET['index']) : -1;

// Check if index exists in cart
if ($index >= 0 && $index < count($_SESSION['cart'])) {
    $item = $_SESSION['cart'][$index];


    // echo '<pre>';
    // print_r($item); 
    // echo '</pre';

    $id = $item['id'];
    $main_table = $item['main_table'];
    $menu_item = $item['menu_item'];
    $quantity = intval($item['quantity']);
    $note = $item['note'];
    $price = floatval($item['price']);
    $customizations = $item['customizations'] ?? [];


} else {
    echo "Invalid item.";
}


$query = "SELECT menu_item, price, image_link FROM `$main_table` WHERE id = ?";
$statement = $connection->prepare($query);

if ($statement) {
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result();
    
    if ($menuitem = $result->fetch_assoc()) {
        // Assign fetched values
        $menu_item = $menuitem['menu_item'];
        $price = floatval($menuitem['price']);
        $image_link = $menuitem['image_link'];
    } else {
        die("Error: Item not found in the database.");
    }

    $statement->close();
}


$item_id = $_GET['id'] ?? '%';
$item_name = $_GET['item_name'] ?? '%';
$item_price = $_GET['item_price'] ?? '%';

$customization_tables_map = [
    'sandwiches' => ['bread', 'protein', 'condiments'],
    'cheesesteaks' => ['cheesesteak_bread'],
    'salads' => ['dressing'],
    'pastries' => ['pastry_option'],
    'drinks' => ['drink_option']
];

$default_customizations_options = [];

if (isset($customization_tables_map[$main_table])) {
    foreach ($customization_tables_map[$main_table] as $custom_table) {
        $query = "SELECT * FROM `$custom_table` WHERE item_id = ? OR item_name LIKE ? OR item_price LIKE ?";
        $statement = $connection->prepare($query);
        $statement->bind_param('isd', $item_id, $item_name, $item_price);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $default_customizations_options[$custom_table] = $result->fetch_all(MYSQLI_ASSOC);
        }

        $statement->close();
    }
}



$connection->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update item</title>
    <link rel="stylesheet" href="css/step2.css">
</head>
<body>

<div class="screen-container">

    <nav>
        <!-- <a href="step1.php">
                <img class="cancel-button" src="images/icons/cancel.svg" alt="cancel icon">
            </a> -->


        </nav>    

    <div class="content">
        <img class="hero-image" src="images/menu-item/<?= $image_link?>" alt="<?= $menu_item?>">
            <div class="description-container">
                <div class="description">
                    <h2><?= $menu_item ?? 'No name available'?></h2>
                    <h2> $<?= number_format($price, 2) ?? '0.00' ?></h2>
                </div>
            </div>
    </div>

    <div class="option-container">
            <?php
                if (!isset($id)) {
                    echo "Warning: \$item_id is not set!";
                }
                ?>

                <form action="update_cart.php" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="index" value="<?= $index; ?>"> 

                    <input type="hidden" name="main_table" value="<?= $main_table ?>">
                    <input type="hidden" name="update" value="1">
                    <input type="hidden" name="menu_item" value="<?= $menu_item ?>">
                    <input type="hidden" name="item_price" value="<?= $price?>">
                    <input type="hidden" id="subtotal_input" name="subtotal" value="<?= number_format($price, 2) ?>">


                    <?php if (!empty($default_customizations_options)): ?>
                        <?php foreach ($default_customizations_options as $custom_table => $options): ?>
                            <div class="option">
                                <h2><?= ucfirst(str_replace('_', ' ', $custom_table)) ?></h2>

                                <?php foreach ($options as $option): ?>
                                    <?php 
                                    $option_name = $option['item_name'];
                                    $option_price = $option['item_price'] ?? 0;
                                    $is_checked = isset($customizations[$custom_table]) && in_array($option_name, (array) $customizations[$custom_table]);
                                    ?>

                                    <?php if ($custom_table === 'protein' || $custom_table === 'condiments'): ?>
                                        <!-- Checkbox -->
                                        <div class="option-label">
                                            <input type="checkbox" id="<?= str_replace(' ', '_', strtolower($option_name)) ?>"
                                                name="<?= $custom_table ?>[]" value="<?= $option_name ?>"
                                                data-price="<?= $option_price ?>"
                                                <?= $is_checked ? 'checked' : '' ?>>
                                            <input type="hidden" name="<?= $custom_table ?>_price[<?= $option_name ?>]" value="<?= $option_price ?>">
                                            <label for="<?= str_replace(' ', '_', strtolower($option_name)) ?>">
                                                <p><?= $option_name ?></p>
                                                <p><?php if ($option_price > 0) echo "+$" . number_format($option_price, 2); ?></p>
                                            </label>
                                        </div>
                                    <?php else: ?>
                                        <!-- Radio Button -->
                                        <div class="option-label">
                                            <input type="radio" id="<?= str_replace(' ', '_', strtolower($option_name)) ?>"
                                                name="<?= $custom_table ?>" value="<?= $option_name ?>"
                                                data-price="<?= $option_price ?>"
                                                <?= ($customizations[$custom_table] ?? '') === $option_name ? 'checked' : '' ?>>
                                            <input type="hidden" name="<?= $custom_table ?>_price" value="<?= $option_price ?>">
                                            <label for="<?= str_replace(' ', '_', strtolower($option_name)) ?>">
                                                <p><?= $option_name ?></p>
                                                <p><?php if ($option_price > 0) echo "+$" . number_format($option_price, 2); ?></p>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Prefill Note -->
                    <textarea class="note" id="note" name="note" placeholder="Add a note"><?= htmlspecialchars($note ?? '') ?></textarea>

                    <!-- Prefill Quantity -->
                    <div class="product-count">
                        <button class="button-count decrement" <?= ($quantity <= 1) ? 'disabled' : '' ?>>-</button>
                        <input type="text" name="quantity" readonly class="number-product" value="<?= $quantity ?>">
                        <button class="button-count increment">+</button>
                    </div>

                    <!-- Prefill Subtotal -->
                    <h2>Total: $<span id="subtotal" data-base-price="<?= number_format($price, 2) ?>">
                        <?= number_format($price * $quantity, 2) ?>
                    </span></h2>



                    <button class="filled-button" type="submit">
                        <h4>Update Item</h4>
                    </button>

                    <a href="step3.php">Cancel</a>

                </form>
            </div>
        </div>


</div>

<script src="js/step.js"></script>



</body>
</html>

