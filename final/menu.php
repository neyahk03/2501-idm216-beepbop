<?php
session_start();

// check if there is session guest id exist
if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php"); 
    exit();
}


error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../includes/database.php';

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
    <title>Menu</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <!-- <link rel="stylesheet" href="css/menu.css"> -->
    <link rel="stylesheet" href="css/menu-item.css">
    <link rel="stylesheet" href="css/step1.css">
    <link rel="stylesheet" href="css/filter-bar.css">
    <link rel="stylesheet" href="css/quantity.css">
</head>
<body>

<div class="screen-container">

    
    <?php 
        $tables_to_display = ['sandwiches', 'cheesesteaks', 'salads', 'pastries', 'drinks'];
    ?>
    
    
    <div class="menu-container">
    
        <nav>
    
                <h1>MENU</h1>
    
                <div class="lunchbox">
    
                    <a class="bag-icon" href="bag.php">
                        <img src="../images/icons/shopping-bag.svg" alt="shopping bag icon">
                    </a>
                    
                    

                    <?php 
                        if (!empty($_SESSION['cart'])) {
                            $totalQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
                            if ($totalQuantity > 0) { ?>
                                <div class="quantity">
                                    <p>
                                        <?php echo '<span id="quantity">' . $totalQuantity . '</span>'; ?> 
                                    </p>

                                </div>
                            <?php }
                            }
                    ?>

                </div>
    
    
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
        
                                
                                <a href="detail.php?id=<?= $row['id']; ?>&table=<?= $table; ?>&menu_item=<?= urlencode($row['menu_item']); ?>" class="item">
        
        
        
                                        <img src="../images/menu-item/<?= $row['image_link']?>" alt="<?= htmlspecialchars($row['menu_item']); ?>">
        
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
    
        <div class="bottom-nav">
    
                
                <a href="home.php" class="icon-container">
                    <img src="../images/icons/home.svg" alt="home icon">
                    <p class="label">Home</p>
                </a>
    
                
    
                <a href="menu.php" class="icon-container">
                    <img src="../images/icons/menu.svg" alt="menu icon">
                    <p class="label">Menu</p>
                </a>
    
                <a href="#" class="icon-container">
                    <img src="../images/icons/profile.svg" alt="contact icon">
                    <p class="label">Profile</p>
                </a>
            </div>
        
    
    </div>
    
    <!-- <?php echo "ID: ". $_SESSION['guest_id'] . "<br>"; ?> -->
    
    <script src="js/step.js"></script>
    <script src="js/filter-bar.js"></script>
    
</div>



    
</body>
</html>