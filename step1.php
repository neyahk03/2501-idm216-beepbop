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
$tables = [
    'sandwiches',
    'steak',
    'salad',
    'drink',
    'pastries'
];

$customization = [
    'sandwich_option',
    'sandwich_addon',
    'steak_option',
    'pastry_option',
    'dressing',
    'drink_option'
];

$results = [];

foreach ($tables as $table) {
    $query = "SELECT * FROM $table WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ? OR image_link LIKE ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('isds', $id, $item_name, $price, $image);
    $statement->execute();
    $results[$table] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $statement->close();
}

foreach ($customization as $table) {
    $query = "SELECT * FROM $table WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('isd', $id, $item_name, $price);
    $statement->execute();
    $results[$table] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $statement->close();
}

session_start();

// isset: Check if a variable is set and is not NULL
// !isset: Check if a variable is not set

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = session_id();
}

echo "User ID: " . $_SESSION['user_id'] . "<br>";

if (!isset($_SESSION['cart'][$_SESSION['user_id']])) {
    $_SESSION['cart'][$_SESSION['user_id']] = [];
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['items'])) {
    $_SESSION['cart'][$_SESSION['user_id']]['selected_items'] = $_POST['items']; 
    $_SESSION['cart'][$_SESSION['user_id']]['subtotal'] = 0;
    $_SESSION['cart'][$_SESSION['user_id']]['total_price'] = 0;

    $tax_rate = 0.06;
    
    foreach ($_POST['items'] as $selected_item) {
        foreach ($results as $table => $rows) {
            foreach ($rows as $row) {
                if ($row['item_name'] === $selected_item) {
                    $_SESSION['cart'][$_SESSION['user_id']]['subtotal'] += $row['price'];
                }
            }
        }
    }


    $_SESSION['cart'][$_SESSION['user_id']]['total_price'] = $_SESSION['cart'][$_SESSION['user_id']]['subtotal'] * (1 + $tax_rate);
    
    header("Location: step2.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="post">
    <?php 
    $tables_to_display = ['sandwiches', 'steak', 'salad', 'drink', 'pastries'];
    foreach ($results as $table => $rows): 
        if (in_array($table, $tables_to_display)):
    ?>
    
        <h2><?php echo ucfirst(str_replace('_', ' ', $table)); ?></h2>
        
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
                <label>
                    <input type="checkbox" name="items[]" value="<?php echo htmlspecialchars($row['item_name']); ?>">
                    <strong><?php echo htmlspecialchars($row['item_name']); ?></strong> - $<?php echo htmlspecialchars($row['price']); ?>
                </label>
                <br>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?>
        
    <?php 
        endif;
    endforeach; 
    ?>
    
    <br>
    <input type="submit" value="Submit">
</form>
    
</body>
</html>