<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../includes/database.php';

$id = $_GET['id'] ?? '%';
$item_name = $_GET['item_name'] ?? '%';
$price = $_GET['price'] ?? '%';
$image = $_GET['image_link'] ?? '';

// List of table names
$tables = [
    'sandwiches',
    'cheesesteaks',
    'salads',
    'pastries',
    'drinks'
];

$customization = [
    'bread',
    'protein',
    'condiments',
    'cheesesteak_bread',
    'pastry_option',
    'dressing',
    'drink_option'
];

$results = [];

foreach ($tables as $table) {
    $query = "SELECT * FROM $table WHERE id LIKE ? OR menu_item LIKE ? OR price LIKE ? OR image_link LIKE ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('isds', $id, $item_name, $price, $image);
    $statement->execute();
    $results[$table] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $statement->close();
}

foreach ($customization as $table) {
    $query = "SELECT * FROM $table WHERE item_id LIKE ? OR item_name LIKE ? OR item_price LIKE ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('isd', $id, $item_name, $price);
    $statement->execute();
    $results[$table] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $statement->close();
}


?>



<div class="wrapper">

<?php 
    $tables_to_display = ['sandwiches', 'cheesesteaks', 'salads', 'pastries', 'drinks'];
?>


<div class="menu-container">
    <?php foreach ($results as $table => $rows): ?>
        <?php if (in_array($table, $tables_to_display)): ?>

            <?php 
                
                $category_id = strtolower(str_replace(' ', '-', $table)); 
            ?>

            <div class="title">
                <div class="line"></div>
                <h2 id="<?= htmlspecialchars($category_id); ?>">
                    <?= ucfirst(str_replace('_', ' ', $table)); ?>
                </h2>
                <div class="line"></div>
            </div>
                    
            <?php if (!empty($rows)): ?>
                
                <div class="category">
                    <?php foreach ($rows as $row): ?>

                        <a href="item-detail.php?id=<?= $row['id']; ?>&table=<?= $category_id; ?>" class="item">
                    
                            
                                <img src="../images/menu-item/<?=$row['image_link']; ?>" 
                                    alt="<?= $row['menu_item']; ?>">

                                <div class="description">
                                    <p class="menu-title"><?= $row['menu_item']; ?></p>
                                    <p class="price">$<?= number_format($row['price'] ?? 0, 2); ?></p>
                                </div>
                            
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No records found.</p>
            <?php endif; ?>
        
        <?php endif; ?>
    <?php endforeach; ?>
</div>



</div>

