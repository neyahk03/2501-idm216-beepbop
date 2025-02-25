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
    die("Cart is empty.");
}

// Get the item index from URL
$index = isset($_GET['index']) ? intval($_GET['index']) : -1;

// Check if index exists in cart
if ($index >= 0 && $index < count($_SESSION['cart'])) {
    $item = $_SESSION['cart'][$index];

    echo '<pre>';
    print_r($item); 
    echo '</pre>';

    $id = $item['id'];
    $main_table = $item['main_table'];
    $menu_item = $item['menu_item'];
    $quantity = intval($item['quantity']);
    $note = $item['note'];
    $price = floatval($item['price']);
    $customizations = $item['customizations'] ?? [];
} else {
    die("Invalid item.");
}

// Debugging: Ensure $main_table and $id are correct
echo "Main Table: " . htmlspecialchars($main_table) . "<br>";
echo "ID: " . htmlspecialchars($id) . "<br>";

// Fetch item data from the correct table
$query = "SELECT menu_item, price, image_link FROM `$main_table` WHERE id = ?";
$statement = $connection->prepare($query);

if (!$statement) {
    die("Query preparation failed: " . $connection->error);
}

$statement->bind_param('s', $id); // Use 's' if ID is a string
$statement->execute();
$result = $statement->get_result();

if ($menuitem = $result->fetch_assoc()) {
    // Assign fetched values
    $menu_item = $menuitem['menu_item'];
    $price = floatval($menuitem['price']);
    $image_link = $menuitem['image_link'];

    echo "Fetched Menu Item: " . htmlspecialchars($menu_item) . "<br>";
    echo "Fetched Price: " . htmlspecialchars($price) . "<br>";
    echo "Fetched Image Link: " . htmlspecialchars($image_link) . "<br>";
} else {
    die("Error: Item not found in the database.");
}

$statement->close();

// Define customization tables mapping
$customization_tables_map = [
    'sandwiches' => ['bread', 'protein', 'condiments'],
    'cheesesteaks' => ['cheesesteak_bread'],
    'salads' => ['dressing'],
    'pastries' => ['pastry_option'],
    'drinks' => ['drink_option']
];

$default_customizations_options = [];

// Fetch customization options
if (isset($customization_tables_map[$main_table])) {
    foreach ($customization_tables_map[$main_table] as $custom_table) {
        $query = "SELECT * FROM `$custom_table` WHERE item_id = ? OR item_name LIKE ? OR item_price LIKE ?";
        $statement = $connection->prepare($query);

        if (!$statement) {
            die("Query preparation failed: " . $connection->error);
        }

        $like_menu_item = "%$menu_item%"; // Adjusting LIKE parameter
        $statement->bind_param('ssd', $id, $like_menu_item, $price);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $default_customizations_options[$custom_table] = $result->fetch_all(MYSQLI_ASSOC);
        }

        $statement->close();
    }
}

// Debugging: Print customization options
echo "<pre>Customization Options: ";
print_r($default_customizations_options);
echo "</pre>";

$connection->close();
?>
