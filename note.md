<!-- detail page php -->
<?php

include '../includes/database.php';

if (!isset($_GET['id']) || !isset($_GET['table'])) {
    echo "No item ID or table provided.";
    exit;
}

$id = $_GET['id'];
$table_to_display = $_GET['table'];

$item_name = $_GET['item_name'] ?? '%';
$price = $_GET['price'] ?? '%';

// Define the main tables and their corresponding customization tables
$customization_tables_map = [
    'sandwiches' => ['bread', 'protein', 'condiments'],
    'cheesesteaks' => ['cheesesteak_bread'],
    'salads' => ['dressing'],
    'pastries' => ['pastry_option'],
    'drinks' => ['drink_option']
];

// Fetch the item from the correct table
$query = "SELECT * FROM $table_to_display WHERE id = ?";
$statement = $connection->prepare($query);
$statement->bind_param('i', $id);
$statement->execute();
$item_result = $statement->get_result();
$item = $item_result->fetch_assoc();
$statement->close();

if (!$item) {
    echo "Item not found.";
    exit;
}

// Fetch customization options based on the item's table
$customizations = [];

if (isset($customization_tables_map[$table_to_display])) {
    foreach ($customization_tables_map[$table_to_display] as $custom_table) {
        $query = "SELECT * FROM $custom_table WHERE id = ? OR item_name LIKE ? OR price LIKE ?";
        $statement = $connection->prepare($query);
        $statement->bind_param('isd', $id, $item_name, $price);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $customizations[$custom_table] = $result->fetch_all(MYSQLI_ASSOC);
        }

        $statement->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $item['item_name'] ?? 'Item Detail' ?></title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/menu-item.css">
</head>

<body>
    <div class="screen-container">

        
        <img src="../images/menu-item/<?= $item['image_link'] ?? 'default.jpg' ?>" alt="<?= $item['item_name'] ?? 'No image' ?>">
        
        
        <h2><?= $item['item_name'] ?? 'No name available'?></h2>
        <p class="price"> $<?= $item['price'] ?? '0.00' ?></p>

        <!-- custom item -->
        <form action="cart.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="table" value="<?= $table_to_display ?>">
    
            <?php if (!empty($customizations)): ?>
                <!-- <h3>Customizations</h3> -->
                <?php foreach ($customizations as $custom_table => $options): ?>
                    
                    <div class="option">
                        <h4><?= ucfirst(str_replace('_', ' ', $custom_table)) ?></h4>


                        <?php foreach ($options as $option): ?>
                            <?php 
                            $option_name = $option['item_name'] ?? 'Unnamed Option';  
                            ?>

                            <?php if ($custom_table === 'protein' || $custom_table === 'pastry_option'): ?>

                                <!-- radio -->
                                <div class="option-label">

                                </div>
                                <label>
                                    <input type="radio" name="<?= $custom_table ?>" value="<?= $option['id'] ?? '' ?>">
                                    <p class="option-label">

                                        <?= $option_name ?>
                                    </p>

                                    <div class="price">

                                        <?php if (!empty($option['price']) && $option['price'] != '0.00'): ?>
                                            +$<?= $option['price'] ?>
                                        <?php endif; ?>
                                    </div>
                                </label>
                            <?php else: ?>
                                
                                <!-- checkbox -->
                                <div class="option-label">
                                    
                                    <input type="checkbox" name="<?= $custom_table ?>[]" value="<?= $option['id'] ?>">

                                    <label for="<?= $option['item_name'] ?>">
                                        <p><?= $option_name ?></p>
                                        <p>
                                            <?php if (!empty($option['price']) && $option['price'] != '0.00'): ?>
                                            +$<?= $option['price'] ?>
                                            <?php endif; ?>
                                        </p>
                                    </label>
                                </div>

                            <?php endif; ?>

                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
    
            <button type="submit">Add to Cart</button>
        </form>

    </div>


</body>
</html>
