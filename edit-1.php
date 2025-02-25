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
    $_SESSION['cart'] = [];
}

print_r($_SESSION['cart']);

foreach ($_SESSION['cart'] as $index => $cart_item): ?>
    <p><?php echo $cart_item['menu_item']; ?> - $<?php echo $cart_item['price']; ?></p>
    <a href="edit.php?index=<?php echo $index; ?>">Edit</a>
    <hr>
<?php endforeach;




// Retrieve item data from GET form in step 3
$id = isset($_GET['edit_id']) ? intval($_GET['edit_id']) : 0;
$index = isset($_GET['edit_index']) ? intval($_GET['edit_index']) : null;
$table = $_GET['main_table'] ?? '';
$menu_item = $_GET['edit_menu_item'] ?? '';
$quantity = intval($_GET['edit_quantity'] ?? 1);
$price = floatval($_GET['edit_price'] ?? 0.00);
$note = $_GET['edit_note'] ?? '';
$image_link = $_GET['image_link'];

if ($index === null || !isset($_SESSION['cart'][$index])) {
    die("Invalid item selection.");
}

// $item = $_SESSION['cart'][$index];


// $menu_item = $item['menu_item'];
// $quantity = $item['quantity'];
// $price = $item['price'];
// $note = $item['note'];
// $customizations = $item['customizations'] ?? [];

echo "<h2>Editing Item: $menu_item</h2>";
echo "<p>Quantity: $quantity</p>";
echo "<p>Price: $$price</p>";
echo "<p>Note: " . htmlspecialchars($note) . "</p>";

echo "<h3>Customizations:</h3>";
if (!empty($customizations)) {
    foreach ($customizations as $category => $choices) {
        echo "<strong>" . htmlspecialchars($category) . ":</strong> ";
        echo is_array($choices) ? implode(', ', array_map('htmlspecialchars', $choices)) : htmlspecialchars($choices);
        echo "<br>";
    }
} else {
    echo "<p>No customizations</p>";
}




$customizations = [];

// customization data
$item_id = $_GET['item_id'] ?? '%';
$item_name = $_GET['item_name'] ?? '%';
$item_price = $_GET['item_price'] ?? '%';

// retrieve customizations from GET parameters
foreach ($_GET as $key => $value) {
    if (!in_array($key, ['edit_index', 'main_table', 'edit_id', 'edit_menu_item', 'edit_quantity', 'edit_price', 'edit_note'])) {
        $customizations[$key] = $value;
    }
}

// data that get from the form
echo "<pre>";
print_r($_GET);
echo "</pre>";

// customization tables that are corresponding to the main table
$customization_tables_map = [
    'sandwiches' => ['bread', 'protein', 'condiments'],
    'cheesesteaks' => ['cheesesteak_bread'],
    'salads' => ['dressing'],
    'pastries' => ['pastry_option'],
    'drinks' => ['drink_option']
];

$allowed_tables = array_keys($customization_tables_map);
if (!in_array($table, $allowed_tables)) {
    die("Invalid table selection.");
}


// get data from main table 
$query = "SELECT menu_item, price, image_link FROM $table WHERE id = ?";
$statement = $connection->prepare($query);

if ($statement) {
    $statement->bind_param('i', $id);
    $statement->execute();
    $item_result = $statement->get_result();
    $item = $item_result->fetch_assoc();
    $statement->close();
} else {
    die("Query failed: " . $connection->error);
}

$customization_data = [];

// echo "<pre>";
// print_r($customization_tables_map[$table]);
// echo "</pre>";


if (isset($customization_tables_map[$table])) {
    foreach ($customization_tables_map[$table] as $custom_table) {
        $query = "SELECT * FROM $custom_table WHERE item_id = ? OR item_name LIKE ? OR item_price LIKE ?";
        $statement = $connection->prepare($query);
        $statement->bind_param('isd', $item_id, $item_name, $item_price);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $customization_data[$custom_table] = $result->fetch_all(MYSQLI_ASSOC);
        }

        $statement->close();
    }
}


// display output that fetch from the main table and custom table
echo "<pre>";
echo "Main Item Data:\n";
print_r($item);
echo "\nCustomization Data:\n";
print_r($customization_data);
echo "</pre>";


$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="css/step2.css">
</head>
<body>

    <h2>Edit Your Order</h2>

    <div class="content">
        <img class="hero-image" src="images/menu-item/<?= $item['image_link']?>" alt="<?= $menu_item?>">

    </div>

    <form action="update_cart.php" method="POST">
        <input type="hidden" name="edit_index" value="<?= htmlspecialchars($index) ?>">
        <input type="hidden" name="edit_id" value="<?= htmlspecialchars($id) ?>">
        
        <label>Item Name:</label>
        <input type="text" name="menu_item" value="<?= htmlspecialchars($menu_item) ?>" readonly>

        <label>Quantity:</label>
        <input type="number" name="quantity" value="<?= htmlspecialchars($quantity) ?>" min="1">

        <label>Price:</label>
        <input type="text" name="price" value="<?= htmlspecialchars($price) ?>" readonly>

        <label>Note:</label>
        <textarea name="note"><?= htmlspecialchars($note) ?></textarea>

        <h3>Customizations</h3>
        <!--  -->

        <button type="submit">Update</button>
        <a href="step3.php">Cancel</a>
    </form>

</body>
</html>

