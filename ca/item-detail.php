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
        $query = "SELECT * FROM $custom_table WHERE item_id = ? OR item_name LIKE ? OR item_price LIKE ?";
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
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/detail-2.css">
    <link rel="stylesheet" href="css/item-counter.css">

    
    
    
</head>

<body>
    <div class="screen-container">

        <!-- nav bar -->
        <nav>
            <a href="menu.php">
                <img class="cancel-button" src="../images/icons/cancel.svg" alt="cancel icon">
            </a>
        </nav>

        <div class="content">

            <img class="hero-image" src="../images/menu-item/<?= $item['image_link']?>" alt="<?= $item['menu_item']?>">
    
            <div class="description-container">
                <div class="description">
                    <h2><?= $item['item_name'] ?? 'No name available'?></h2>
                    <h2> $<?= $item['price'] ?? '0.00' ?></h2>
                </div>
            </div>
            
            <div class="option-container">
    
    
                <!-- custom item -->
                <form action="cart.php" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="table" value="<?= $table_to_display ?>">
            
                    <?php if (!empty($customizations)): ?>
                        <!-- <h3>Customizations</h3> -->
                        <?php foreach ($customizations as $custom_table => $options): ?>
                            
                            <div class="option">
                                <h2><?= ucfirst(str_replace('_', ' ', $custom_table)) ?></h2>
        
        
                                <?php foreach ($options as $option): ?>
                                    <?php 
                                    $option_name = $option['item_name'];  
                                    ?>
        
                                    <?php if ($custom_table === 'protein' || $custom_table === 'pastry_option' || $custom_table === 'drink_option' || $custom_table === 'dressing'): ?>
        
                                        <!-- radio -->
                                        <div class="option-label">
                                            <input type="radio" id="<?= str_replace(' ', '_', strtolower($option['item_name'])) ?>" 
                                                name="<?= $custom_table ?>" 
                                                value="<?= $option['item_name'] ?>">
    
                                            <label class="<?= $custom_table ?>" for="<?= str_replace(' ', '_', strtolower($option['item_name'])) ?>">
                                                <p><?= $option['item_name']?></p>
    
                                                <p>
                                                    <?php if (!empty($option['price']) && $option['price'] != '0.00'): ?>
                                                        +$<?= $option['price'] ?>
                                                    <?php endif; ?>
                                                </p>
                                            </label>
                                        </div>
    
                                        
                                    <?php else: ?>
                                        
                                        <!-- checkbox -->
                                        <div class="option-label">
                                            
                                            <input type="checkbox" id="<?= str_replace(' ', '_', strtolower($option['item_name'])) ?>"
                                                name="<?= $custom_table ?>"
                                                value="<?= $option['item_name']  ?>">
        
                                            <label class="<?= $custom_table ?>" for="<?= str_replace(' ', '_', strtolower($option['item_name'])) ?>">
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

                    <textarea class="note" id="note" name="note" placeholder="Add a note"></textarea>

                    <div class="fav-container">
                        <div class="counter">
                            <p>-</p>
                            <p>1</p>
                            <p>+</p>
                        </div>

                        <?php include 'components/item-counter.php' ?>

                        <div class="heart-btn">
                            <img src="../images/icons/heart.svg" alt="heart btn">
                        </div>
                    </div>

                    <div class="subtotal">
                        <h2>Subtotal:</h2>
                        <h2>$4.50</h2>
                    </div>


            
                    <!-- <button type="submit">Add to Cart</button> -->
                </form>

                <button class="filled-button" type="submit" onclick="window.location.href='added-to-bag-animation.html'">
                    <h4>ADD TO BAG</h4>
                </button>


        </div>
        

        </div>
        


    </div>


</body>
</html>
