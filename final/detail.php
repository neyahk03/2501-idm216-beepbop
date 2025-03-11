<?php
session_start();
include '../includes/database.php';

if (!isset($_SESSION['guest_id'])) {
    header("Location: login-signup.php"); 
    exit();
}

// echo "ID: ". $_SESSION['guest_id'] . "<br>";



// data from the url
$id = $_GET['id'] ?? null;
$table_to_display = $_GET['table'] ?? null;

if (!$id || !$table_to_display) {
    echo "No item ID or table provided.";
    exit;
}

$item_table = $table_to_display;


$query = "SELECT menu_item, price, image_link FROM $item_table WHERE id = ?";
$statement = $connection->prepare($query);
$statement->bind_param('i', $id);
$statement->execute();
$item_result = $statement->get_result();
$item = $item_result->fetch_assoc();
$statement->close();

// data gonna get from the database of this item
$menu_item = $item['menu_item'] ?? 'Unknown Item';
$price = $item['price'] ?? 0.00;
$image_link = $item['image_link'] ?? 'default-image.jpg';

// echo "<p>Table: " . $item_table . "</p>";
// echo "<p>Item Name: " . $menu_item . "</p>";
// echo "<p>Item Price: $" . number_format($price, 2) . "</p>";
// echo "<p>Image Link: " . $image_link . "</p>";


// echo "<pre>GET Data:\n";
// print_r($_GET);
// echo "</pre>";

$item_id = $_GET['id'] ?? '%';
$item_name = $_GET['item_name'] ?? '%';
$item_price = $_GET['item_price'] ?? '%';



//  Define the main tables and their corresponding customization tables
$customization_tables_map = [
    'sandwiches' => ['bread', 'protein', 'condiments'],
    'cheesesteaks' => ['cheesesteak_bread'],
    'salads' => ['dressing'],
    'pastries' => ['preparation_option'],
    'drinks' => ['drink_option', 'soda_type', 'drink_size']
];

$customizations = [];


if (isset($customization_tables_map[$table_to_display])) {
    foreach ($customization_tables_map[$table_to_display] as $custom_table) {
        $query = "SELECT * FROM $custom_table WHERE item_id = ? OR item_name LIKE ? OR item_price LIKE ?";
        $statement = $connection->prepare($query);
        $statement->bind_param('isd', $item_id, $item_name, $item_price);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $customizations[$custom_table] = $result->fetch_all(MYSQLI_ASSOC);
        }

        $statement->close();
    }
}

$category_icons = [
    'bread' => 'bread.svg',
    'cheesesteak_bread' => 'bread.svg',
    'protein' => 'meat.svg',
    'condiments' => 'salt.svg',
    'dressing' => 'dressing.svg',
    'preparation_option' => 'toast.svg',
    'drink_size' => 'cup.svg',
    'drink_option' => 'can.svg',
    'soda_type' => 'soda_type.svg'
];

$require = ['bread', 'cheesesteak_bread', 'dressig', 'preparation_option', 'drink_option', 'soda_type', 'drink_size' ];

// Debug: Print Retrieved Customization Data
// echo "<pre>Customization Data:\n";
// print_r($customizations);
// echo "</pre>";



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $menu_item ?? 'Item Detail' ?></title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/item-counter.css">
    <link rel="stylesheet" href="css/heart-button.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>

<body>
    <div class="screen-container">
        <!-- nav bar -->
        

        <nav>
            <!-- <a href="menu.php">
                <img class="cancel-button" src="../images/icons/cancel.svg" alt="cancel icon">
            </a> -->

            <button onclick="history.back()">
                <img class="cancel-button" src="../images/icons/cancel.svg" alt="cancel icon">

            </button>
        </nav>

        <div class="content">
            <img class="hero-image" src="../images/menu-item/<?= $image_link?>" alt="<?= $menu_item?>">

            <div class="description-container">
                <div class="description">
                    <h2><?= $menu_item ?? 'No name available'?></h2>
                    <h2> $<?= $price ?? '0.00' ?></h2>
                </div>
            </div>
            
            <div class="option-container">
            <?php
                if (!isset($item_id)) {
                    echo "Warning: \$item_id is not set!";
                }
                ?>

                <form action="adding.php" method="POST">
                    <input type="hidden" name="id" value="<?= $item_id ?>">
                    <input type="hidden" name="image_link" value="<?= $image_link ?>">
                    <input type="hidden" name="main_table" value="<?= $item_table ?>">
                    <input type="hidden" name="update" value="1">

                    <input type="hidden" name="menu_item" value="<?= $menu_item ?>">
                    <input type="hidden" name="item_price" value="<?= $price?>">
                    <input type="hidden" id="subtotal_input" name="subtotal" value="<?= number_format($price, 2) ?>">


                    <?php if (!empty($customizations)): ?>
                        <?php foreach ($customizations as $custom_table => $options): ?>
                            
                            <?php  
                            if ($table_to_display === 'drinks') {
                                if ($menu_item === 'Water') {
                                    continue; 
                                } elseif ($menu_item === 'Soda') {
                                    if ($custom_table !== 'soda_type' && $custom_table !== 'drink_option') {
                                        continue; 
                                    }
                                } else {
                                    if ($custom_table !== 'drink_size') {
                                        continue; 
                                    }
                                }
                            }
                            ?>
                            
                            <div class="option">

                                <div class="option-title">
                                    <h2>
                                        <?= ucfirst(str_replace('_', ' ', $custom_table)) ?>
                                    
                                        <?php 
                                            if (isset($category_icons[$custom_table])) {
                                                echo '<img src="../images/icons/' . $category_icons[$custom_table] . '" alt="info icon" class="icon">';
                                            }
                                        ?>
                                    </h2>
                                    
                                    <?php 
                                        if (in_array($custom_table, ['bread', 'cheesesteak_bread', 'dressing', 'preparation_option', 'drink_option', 'soda_type', 'drink_size'])) {
                                            echo '<p class="require">*</p>';
                                        }
                                    ?>
                                </div>

                                <div class ="line">
                                    <hr style="border: 2px solid var(--bg-yellow); width: 100%; margin: 0;">
                                </div>
                                
                        
                                <?php foreach ($options as $option): ?>
                                    <?php 
                                    $option_name = $option['item_name'];
                                    $option_price = $option['item_price'] ?? 0;

                                    ?>
                                    
                                    
                                    <?php if ($custom_table === 'protein' || $custom_table === 'condiments'): ?>
                                        <!-- Checkbox  -->
                                        
                                        <div class="option-label">
                                            <input type="checkbox" id="<?= str_replace(' ', '_', strtolower($option_name)) ?>"
                                                name="<?= $custom_table ?>[]" value="<?= $option_name ?>"
                                                data-price="<?= $option_price ?>">
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
                                                data-price="<?= $option_price ?>" required>
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

                    <textarea class="note" id="note" name="note" placeholder="Add a note"></textarea>

                    <div class="fav-container">
                        <div class="product-count">
                            <button class="button-count decrement" disabled>
                                <img src="../images/icons/minus-red.svg" alt="minus button">
                            </button>
                            <input type="text" name="quantity" readonly class="number-product" value="1">
                            <button class="button-count increment">
                                <img src="../images/icons/plus-red.svg" alt="plus button">
                            </button>
                        </div>

                        <div class="heart-btn">
                            <img src="../images/icons/heart-empty.svg" alt="heart btn">
                        </div>

                    </div>

                    <div class="subtotal">
                        <h2>Subtotal:</h2>
                        
                        <h2>$<span id="subtotal" data-base-price="<?= number_format($price, 2) ?>"><?= number_format($price, 2) ?></span></h2>
                    </div>


                    <button class="filled-button" type="submit">
                        <h4>ADD TO BAG</h4>
                    </button>

                </form>
            </div>
        </div>
    </div>


    <script src="js/calculate-subtotal.js"></script>
    <script src="js/button.js"></script>
    <script src="js/heart-button.js"></script>

</body>
</html>