<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'includes/database.php';

$id = $_GET['id'] ?? '%';
$item_name = $_GET['item_name'] ?? '%';
$price = $_GET['price'] ?? '%';
$image = $_GET['image_link'] ?? '';

// List of table names
$tables_with_image = [
    'sandwiches',
    'steak',
    'salad',
    'drink',
    'pastries'
];

$tables_without_image = [
    'sandwich_option',
    'sandwich_addon',
    'steak_option',
    'pastry_option',
    'dressing',
    'drink_option'
];

$results = [];

// Query tables with image_link
foreach ($tables_with_image as $table) {
    $query = "SELECT * FROM $table WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ? OR image_link LIKE ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('isds', $id, $item_name, $price, $image);
    $statement->execute();
    $results[$table] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $statement->close();
}

// Query tables without image_link
foreach ($tables_without_image as $table) {
    $query = "SELECT * FROM $table WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('isd', $id, $item_name, $price);
    $statement->execute();
    $results[$table] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $statement->close();
}

$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Display</title>
</head>
<body>
    <?php 
    $tables_to_display = ['sandwiches', 'sandwich_option'];
    foreach ($results as $table => $rows): 
        if (in_array($table, $tables_to_display)):
    ?>
        <h2><?php echo ucfirst(str_replace('_', ' ', $table)); ?></h2>
        <ul>
            <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                    <li>
                        <strong><?php echo $row['item_name']; ?></strong> - $<?php echo $row['price']; ?>
                        <?php if (isset($row['image_link']) && !empty($row['image_link'])): ?>
                            <br>
                            <img src="<?php echo $row['image_link']; ?>" alt="<?php echo $row['item_name']; ?>" width="50">
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No records found.</li>
            <?php endif; ?>
        </ul>
    <?php 
        endif;
    endforeach; 
    ?>
</body>
</html>
