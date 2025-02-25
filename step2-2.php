<?php
session_start();
include 'includes/database.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = session_id();
}


echo  $_SESSION['user_id'];

if (!isset($_GET['id']) || !isset($_GET['table'])) {
    echo "No item ID or table provided.";
    exit;
}

// $id = $_GET['id'];
// $table_to_display = $_GET['table'];

// $menu_item = $_GET['menu_item'] ?? '%';
// $price = $_GET['price'] ?? '%';

$id = $_GET['id'] ?? null;
$table_to_display = $_GET['table'] ?? null;
$menu_item = $_GET['menu_item'] ?? null;
$price = $_GET['price'] ?? null;

$item_name = $_GET['item_name'];
$item_price = $_GET['item_price'];

echo "<pre>";
print_r($_GET);
echo "</pre>";

$item_query = "SELECT * FROM $table_to_display WHERE id = ?";
$statement = $connection->prepare($item_query);
$statement->bind_param('i', $id);
$statement->execute();
$item_result = $statement->get_result();
$item = $item_result->fetch_assoc();
$statement->close();

if (!$item) {
    echo "Item not found.";
    exit;
}

$customization_tables_map = [
    'sandwiches' => ['bread', 'protein', 'condiments'],
    'cheesesteaks' => ['cheesesteak_bread'],
    'salads' => ['dressing'],
    'pastries' => ['pastry_option'],
    'drinks' => ['drink_option']
];

$customizations = [];

if (isset($customization_tables_map[$table_to_display])) {
    foreach ($customization_tables_map[$table_to_display] as $custom_table) {
        $query = "SELECT * FROM $custom_table WHERE id = ? OR item_name = ? OR item_price = ? ";
        $statement = $connection->prepare($query);
        $statement->bind_param('isd', $id, $item_name, $item_price);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $customizations[$custom_table] = $result->fetch_all(MYSQLI_ASSOC);
        }
        $statement->close();
    }
}

echo "<pre>";
print_r($custom_table);
echo "</pre>";




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $item['menu_item'] ?? 'Item Detail' ?></title>
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
            <img class="hero-image" src="images/menu-item/<?= $item['image_link']?>" alt="<?= $item['menu_item']?>">
            <div class="description-container">
                <div class="description">
                    <h2><?= $item['menu_item'] ?? 'No name available'?></h2>
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