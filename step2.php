<?php
session_start();
include 'includes/database.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = session_id();
}

echo $_SESSION['user_id'] . "<br>";

// 1. Get Data from URL
$id = $_GET['id'] ?? null;
$table_to_display = $_GET['table'] ?? null;
$menu_item = $_GET['menu_item'] ?? null;
$price = $_GET['price'] ?? null;
$image_link = $GET['image_link'] ?? null;


if (!$id || !$table_to_display) {
    echo "No item ID or table provided.";
    exit;
}

// Debug: Check received GET data
echo "<pre>GET Data:\n";
print_r($_GET);
echo "</pre>";

// 2. Customization Table Mapping
$customization_tables_map = [
    'sandwiches' => ['bread', 'protein', 'condiments'],
    'cheesesteaks' => ['cheesesteak_bread'],
    'salads' => ['dressing'],
    'pastries' => ['pastry_option'],
    'drinks' => ['drink_option']
];

// 3. Fetch Customization Options from Mapped Tables
$customizations = [];

if (isset($customization_tables_map[$table_to_display])) {
    foreach ($customization_tables_map[$table_to_display] as $custom_table) {
        
        // Ensure we are querying a valid table
        echo "Querying customization table: " . htmlspecialchars($custom_table) . "<br>";

        // Query customization options
        $query = "SELECT * FROM $custom_table WHERE id = ? OR item_name = ? OR item_price = ?";
        $statement = $connection->prepare($query);
        
        // Ensure proper data types: id (integer), menu_item (string), price (double)
        $statement->bind_param('isd', $id, $menu_item, $item_price);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $customizations[$custom_table] = $result->fetch_all(MYSQLI_ASSOC);
        }
        $statement->close();
    }
}

// Debug: Print Retrieved Customization Data
echo "<pre>Customization Data:\n";
print_r($customizations);
echo "</pre>";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $menu_item ?? 'Item Detail' ?></title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/step2.css">
</head>
<body>
    <div class="screen-container">
        <!-- nav bar -->
        <nav>
            <a href="step1.php">
                <img class="cancel-button" src="images/icons/cancel.svg" alt="cancel icon">
            </a>
        </nav>

        <div class="content">
            <img class="hero-image" src="images/menu-item/<?= $item['image_link']?>" alt="<?= $menu_item?>">
            <div class="description-container">
                <div class="description">
                    <h2><?= $menu_item ?? 'No name available'?></h2>
                    <h2> $<?= $item['price'] ?? '0.00' ?></h2>
                </div>
            </div>
            
            <div class="option-container">
                
                <form action="step3.php" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="table" value="<?= $table_to_display ?>">
                    <input type="hidden" name="menu_item" value="<?= $menu_item ?>">
                    <input type="hidden" name="item_price" value="<?= $price?>">

                   

                    <?php if (!empty($customizations)): ?>
                        <?php foreach ($customizations as $custom_table => $options): ?>
                            <div class="option">
                                <h2><?= ucfirst(str_replace('_', ' ', $custom_table)) ?></h2>
                                
                                <?php foreach ($options as $option): ?>
                                    <?php 
                                    $option_name = $option['item_name'];
                                    $option_price = $option['price'] ?? 0;
                                    ?>
                                    
                                    <?php if ($custom_table === 'protein' || $custom_table === 'condiments'): ?>
                                        <!-- Checkbox  -->
                                        <div class="option-label">
                                            <input type="checkbox" id="<?= str_replace(' ', '_', strtolower($option_name)) ?>"
                                                name="<?= $custom_table ?>[]" value="<?= $option_name ?>">
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
                                                name="<?= $custom_table ?>" value="<?= $option_name ?>">
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

                    <button class="filled-button" type="submit">
                        <h4>ADD TO BAG</h4>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>