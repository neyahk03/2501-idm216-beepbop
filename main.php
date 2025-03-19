<?php

require_once 'includes/database.php';

$id = $_GET['id'] ?? '%';
$menu_item= $_GET['menu_item'] ?? '%';
$price = $_GET['price'] ?? '%';
$image_link = $_GET['image_link'] ?? '%';

$item_id = $_GET['item_id'] ?? '%';
$item_name = $_GET['item_name'] ?? '%';
$item_price = $_GET['item_price'] ?? '%';


$main_table = ['sandwiches', 'cheesesteaks', 'salads', 'pastries', 'drinks'];
$custom_table = ['bread', 'protein', 'condiments', 'cheesesteak_bread', 'dressing', 'drink_option', 'drink_size', 'preparation_option', 'soda_type'];

$main_results = [];
$custom_results = [];

foreach ($main_table as $table) {
    $query = "SELECT *  FROM $table WHERE id LIKE ? OR menu_item LIKE ? OR price LIKE ? OR image_link LIKE ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('ssss', $id, $menu_item, $price, $image_link);
    $statement->execute();
    $main_results[$table] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
}

foreach ($custom_table as $table) {
    $query = "SELECT * FROM $table WHERE item_id LIKE ? OR item_name LIKE ? OR item_price LIKE ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('sss', $item_id, $item_name, $item_price);
    $statement->execute();
    $custom_results[$table] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database - Beepbop</title>
    <link rel="stylesheet" href="css/record.css">
    <link rel="stylesheet" href="css/test.css">
</head>
<body>
    <section class="title">
        <div class="bar"></div>
        <h1>BEEPBOP DATABASE</h1>
    </section>

    <div class="container">
        
        <!-- Main Menu Items -->
        <?php foreach ($main_results as $category => $items): ?>
            <section class="window">
                <div class="window-top">
                    <h2><?php echo ucfirst($category); ?></h2>
    
                    <div class="icon">
                        <div><img src="images/database/minimize.svg" alt="minimize icon"></div>
                        <div><img src="images/database/tab.svg" alt="tab icon"></div>
                        <div><img src="images/database/close.svg" alt="close icon"></div>
                    </div>
                </div>
    
                <div class="content">
                    <table class="menu_table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($items)): ?>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td><?php echo $item['menu_item']; ?></td>
                                        <td>$<?php echo $item['price']; ?></td>
                                        <td>
                                            <?php if (!empty($item['image_link'])): ?>
                                                <img class="image_link" src="images/menu-item/<?php echo $item['image_link']; ?>" alt="<?php echo $item['menu_item']; ?>">
                                            <?php else: ?>
                                                No Image
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4">No records found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php endforeach; ?>
    
        <!-- Custom Items -->
        <?php foreach ($custom_results as $category => $items): ?>
            <section class="window">
                <div class="window-top">
                    <h2><?php echo ucfirst(str_replace('_', ' ', $category)); ?></h2>
    
                    <div class="icon">
                        <div><img src="images/database/minimize.svg" alt="minimize icon"></div>
                        <div><img src="images/database/tab.svg" alt="tab icon"></div>
                        <div><img src="images/database/close.svg" alt="close icon"></div>
                    </div>
                </div>
    
                <div class="content">
                    <table class="custom_table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Item</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($items)): ?>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td><?php echo $item['item_id']; ?></td>
                                        <td><?php echo $item['item_name']; ?></td>
                                        <td>$<?php echo $item['item_price']; ?></td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="3">No records found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php endforeach; ?>
    </div>


</body>
</html>
