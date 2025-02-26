<?php
session_start();

// check if there is session guest id exist
if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php"); 
    exit();
}


error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/database.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = session_id();
}

if (!isset($_SESSION['cart'][$_SESSION['user_id']])) {
    $_SESSION['cart'][$_SESSION['user_id']] = [];
}

$id = $_GET['id'] ?? '%';
$menu_item = $_GET['menu_item'] ?? '%';
$price = $_GET['price'] ?? '%';
$image = $_GET['image_link'] ?? '';

$tables = ['sandwiches', 'cheesesteaks', 'salads', 'pastries', 'drinks'];
$results = [];

foreach ($tables as $table) {
    $query = "SELECT * FROM $table WHERE id LIKE ? OR menu_item LIKE ? OR price LIKE ? OR image_link LIKE ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('isds', $id, $menu_item, $price, $image);
    $statement->execute();
    $results[$table] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $statement->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1</title>
    <link rel="stylesheet" href="css/step1.css">
    <link rel="stylesheet" href="css/filter-bar.css">
</head>
<body>


<?php 
    $tables_to_display = ['sandwiches', 'cheesesteaks', 'salads', 'pastries', 'drinks'];
?>


<div class="menu-container">

    <nav>

        <a href="bag.php">View cart</a>
        <span id="quantity">Quantity: <?= $_SESSION['quantity'] ?? 0; ?></span>


        
    </nav>

    <div class="filter-bar">
        <a class="heading-4 filter" href="#sandwiches">SANDWICHES</a>

        <a class="heading-4 filter" href="#cheesesteaks">CHEESESTEAKS</a>

        <a class="heading-4 filter" href="#salads">SALADS</a>


        <a class="heading-4 filter" href="#pastries">PASTRIES</a>

        <a class="heading-4 filter" href="#drinks">DRINKS</a>
    </div>

    <div class="menu">

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
    
                            
                            <a href="step2-3.php?id=<?= $row['id']; ?>&table=<?= $table; ?>&menu_item=<?= urlencode($row['menu_item']); ?>" class="item">
    
    
    
                                    <!-- <img src="images/menu-item/<?= $row['image_link']?>" alt=""> -->
    
                                    <div class="description">
                                        <p class="menu-title"><?= htmlspecialchars($row['menu_item']); ?></p>
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

<?php echo "ID: ". $_SESSION['guest_id'] . "<br>"; ?>

<script src="js/step.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const filters = document.querySelectorAll(".filter-bar a");

    filters.forEach(filter => {
        filter.addEventListener("click", function (event) {
            // Remove 'active' class from all links
            filters.forEach(f => f.classList.remove("active"));

            // Add 'active' class to the clicked link
            this.classList.add("active");

            // Allow smooth scrolling to work correctly
        });
    });
});

</script>


    
</body>
</html>