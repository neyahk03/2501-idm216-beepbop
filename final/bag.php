<?php
session_start();

if (!isset($_SESSION['guest_id'])) {
    header("Location: login.php");
    exit();
}

// echo "ID: ". $_SESSION['guest_id'] . "<br>";


// Ensure the cart exists in session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}




$item_id = $_POST['id'] ?? '';
$main_table = $_POST['main_table'] ?? null;
$image_link = $_POST['image_link'] ?? '';
$menu_item = $_POST['menu_item'] ?? '';
$price = floatval($_POST['item_price'] ?? 0.00);
$subtotal = floatval($_POST['subtotal'] ?? $price);
$note = $_POST['note'] ?? '';
$quantity = intval($_POST['quantity'] ?? 1);


$selected_table = null;
$customizations = [];

foreach ($_POST as $key => $value) {
    if ($key === 'main_table') {
        $selected_table = $value;
        continue;
    }

    if (is_array($value)) {
        // Checkbox selections (filter out numeric values)
        $filtered_values = array_filter($value, fn($v) => !is_numeric($v));
        if (!empty($filtered_values)) {
            $customizations[$key] = array_values($filtered_values);
        }
    } elseif (!in_array($key, ['id','main_table','image_link', 'menu_item', 'item_price', 'subtotal', 'note', 'quantity']) 
            && strpos($key, '_price') === false && !is_numeric($value)) {

                $customizations[$key] = $value;
    }
}




// Check if the item already exists in the cart (same item, same customizations)
ksort($customizations);


$found = false;
foreach ($_SESSION['cart'] as &$cart_item) {
    if (!isset($cart_item['id'])) continue;

    if (
        $cart_item['id'] === $item_id &&
        $cart_item['main_table'] === $main_table &&
        $cart_item['menu_item'] === $menu_item &&
        $cart_item['customizations'] === $customizations &&
        $cart_item['note'] === $note
    ) {
        // If item exists, increase quantity
        $cart_item['quantity'] += $quantity;
        $cart_item['subtotal'] = $cart_item['price'] * $cart_item['quantity'];
        $found = true;
        break;
    }
}


// If item is new, add it to the cart
if (!$found && !empty($menu_item)) {
    $_SESSION['cart'][] = [
        'id' => $item_id ?: uniqid(),
        'main_table' => $selected_table ?: 'Unknown',
        'image_link' => $image_link,
        'menu_item' => $menu_item,
        'price' => $price,
        'quantity' => max($quantity, 1),
        'subtotal' => max($subtotal, $price),
        'note' => $note,
        'customizations' => !empty($customizations) ? $customizations : []
    ];
}

// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";


// Remove empty or invalid items from the cart
$_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) {
    return !empty($item['menu_item']) && isset($item['quantity']) && $item['quantity'] > 0;
});

// bag subtotal
$bag_subtotal = array_reduce($_SESSION['cart'], fn($total, $item) => $total + floatval($item['subtotal']), 0);
$_SESSION['bag_subtotal'] = $bag_subtotal;

// total quantity and store in session
$total_quantity = array_reduce($_SESSION['cart'], fn($sum, $item) => $sum + $item['quantity'], 0);
$_SESSION['quantity'] = $total_quantity;

// tax and total
$tax = $bag_subtotal * 0.06;
$total = $bag_subtotal + $tax;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bag | Pete's Lunch Box</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/bag.css">
    <!-- <link rel="stylesheet" href="css/item-counter.css"> -->
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/foodcard.css">
</head>
<body>

    <div class="screen-container">
        <nav>
            <button onclick="gotoMenu()">
                <img class="back-button" src="../images/icons/back.svg" alt="back icon">
            </button>
        </nav>

        <div class="nav-background">
            <svg xmlns="http://www.w3.org/2000/svg" width="441" height="236" viewBox="0 0 441 236" fill="none">
                <path d="M179.285 106.81C60.5861 160.226 10.3038 120.939 0 87.5539V0.000106812H441V37.7386V235.744C394.839 240.349 377.786 183 366.813 151.707C353.762 114.485 297.984 53.3949 179.285 106.81Z" fill="#C73715"/>
                <path d="M0 87.5539C10.3038 120.939 60.5861 160.226 179.285 106.81C297.984 53.3949 353.762 114.485 366.813 151.707C377.786 183 394.839 240.349 441 235.744V184.823C432.075 178.973 424.818 170.909 418.95 162.197C406.632 143.909 399.561 121.424 396.754 106.213C390.405 88.1994 373.959 65.0659 345.92 52.7787C332.026 46.6902 315.166 43.1989 294.813 44.3119C274.346 45.4312 249.899 51.235 221.095 64.2748C160.916 91.5177 115.996 92.3564 84.3317 80.3125C53.4325 68.5596 37.6894 45.4163 32.3729 28.099L32.3698 28.0887L23.5462 0.000106812H0V87.5539Z" fill="#C73715"/>
                <path d="M37.5437 0.000106812H441V37.7386V170.373C437.59 166.883 434.413 162.897 431.484 158.549C419.845 141.267 413.004 119.598 410.321 104.898L410.277 104.661L410.196 104.428C403.52 85.2732 385.796 59.4226 353.523 45.2801C337.202 38.1278 317.286 34.0399 293.677 35.331C270.181 36.6159 243.479 43.1997 213.32 56.8524C155.572 82.9947 116.551 82.156 91.1968 72.5121C65.0836 62.5796 50.7308 42.3542 45.8075 26.3069L45.8043 26.2967L37.5437 0.000106812Z" fill="#C73715"/>
            </svg>
        </div>

        <div class="content-container">
            <h1>Your Lunchbox</h1>

            <div class="content">

            <?php if (empty($_SESSION['cart'])) : ?>
                    <div class="empty-bag">
                        <img src="../images/icons/brown-shopping-bag.svg" alt="empty bag">
                        <h4>Oh No! Your Bag is Empty</h4>
                    </div>

            <?php else : ?>

            <?php foreach ($_SESSION['cart'] as $index => $item) : ?>

                <div class="food-card">
                    <img class="food-pic" src="../images/menu-item/<?= $item['image_link'] ?>" alt="<?= $item['menu_item'] ?>">
                    
                    <div class="food-details">
                
                        <div class="food-description">

                            <div class="food-details-title">
                                <h3><?= $item['menu_item'] ?></h3>
                                <p class="item-subtotal">$<?= number_format($item['subtotal'], 2) ?></p>
                                

                            </div>

                            
                        </div>

                        <div class="custom-note-container">
                            <p class="customization">
                                <!-- <strong>Customization: </strong> -->
                            <?php 
                                    if (!empty($item['customizations']) && is_array($item['customizations'])) {
                                        $custom_choices = [];
            
                                        foreach ($item['customizations'] as $category => $choices) {
                                            
            
                                            if (is_array($choices)) {
                                                $custom_choices = array_merge($custom_choices, array_values($choices));
                                            } else {
                                                $custom_choices[] = $choices;
                                            }
                                        }
            
                                        echo !empty($custom_choices) ? implode(', ', array_map('htmlspecialchars', $custom_choices)) : 'No customizations';
                                    } else {
                                        echo 'No customizations';
                                    }
                                    ?>
                            </p>

                            <p class="note" ><strong>Notes: </strong><?= $item['note'] ? '' . $item['note'] : 'None' ?></p>

                        </div>

                        <div class="actions">

                            <div class="button-container">
                                <a href="edit.php?index=<?= $index ?>" class="edit-button">
                                    <img src="../images/icons/edit.svg" alt="edit icon">
                                </a>
                                
                                <form action="functions/remove_item.php" method="POST">
                                    <input type="hidden" name="index" value="<?= $index ?>">
                                    <button type="submit" class="delete-button">
                                        <img src="../images/icons/trash-can.svg" alt="delete icon">
                                    </button>
                                </form>

                            </div>


                            <div class="product-count" data-index="<?= $index ?>" data-price-per-item="<?= $item['subtotal'] / $item['quantity'] ?>">
                                <button class="button-count minus-btn">
                                    <img class="minus-btn" src="../images/icons/minus-black.svg" alt="minus button">
                                </button>

                                <input type="text" readonly class="number-product" value="<?= $item['quantity'] ?>">
                                
                                <button class="button-count plus-btn">
                                    <img class="plus-btn" src="../images/icons/plus-black.svg" alt="plus icon">
                                </button>
                            </div>

                        </div>
                    </div>


                </div>
                
                <?php endforeach; ?>

                <a class="clear-bag" href="functions/clear_cart.php">Empty Lunchbox</a>

            <?php endif; ?>


                
                                            
    
                
                <div class="fav-section">
                    <h4>Popular items to add to your order:</h4>

                    <div class="popular-items">

                        <div class="pop-items-container">
                            
                            <a href="detail.php?id=6&table=drinks&menu_item=Thai+Tea">

                                <img src="../images/menu-item/thai-tea.jpg" alt="Thai Tea">

                                <div class="description">
                                    <div class="item-info">
                                        <p class="item-name">Thai Tea</p>
                                        <p class="item-price">$3.00</p>
                                    </div>
                                    <button class="add-button">VIEW ITEM</button>
                                </div>
                            </a>
                                    
                            
                        </div>

                        <div class="pop-items-container">
                            
                            <a href="detail.php?id=4&table=pastries&menu_item=Hashbrown">

                                <img src="../images/menu-item/hashbrown.png " alt="Hashbrown">

                                <div class="description">
                                    <div class="item-info">
                                        <p class="item-name">Hashbrown</p>
                                        <p class="item-price">$1.50</p>
                                    </div>
                                    <button class="add-button">VIEW ITEM</button>
                                </div>
                                
                            </a>
                            
                        </div>

                        <div class="pop-items-container">
                            
                            <a href="detail.php?id=2&table=pastries&menu_item=Muffin">

                                <img src="../images/menu-item/muffin.jpg " alt="Muffin">

                                <div class="description">
                                    <div class="item-info">
                                        <p class="item-name">Muffin</p>
                                        <p class="item-price">$2.50</p>
                                    </div>
                                    <button class="add-button">VIEW ITEM</button>
                                </div>
                            </a>
                                    
                            
                        </div>

                        <div class="pop-items-container">
                            
                            <a href="detail.php?id=4&table=drinks&menu_item=Soda">

                                <img src="../images/menu-item/soda.png " alt="Soda">

                                <div class="description">
                                    <div class="item-info">
                                        <p class="item-name">Soda</p>
                                        <p class="item-price">$1.50</p>
                                    </div>
                                    <button class="add-button">VIEW ITEM</button>
                                </div>
                            </a>
                                    
                            
                        </div>


                </div>
            </div>


            
        </div>

        
        <div class="total-container">

            <div class="subtotal">
                <h2>Subtotal:</h2>

                <h2><span class="total-subtotal">$<?= number_format(array_sum(array_column($_SESSION['cart'], 'subtotal')), 2) ?></span></h2>

                


            </div>
            
            <?php if (empty($_SESSION['cart'])) : ?>

                <button class="filled-button" onclick="gotoMenu()">
                    VIEW MENU
                </button>      
            
            <?php else : ?>
                <button class="filled-button" onclick="gotoCheckout()">
                    PROCEED TO CHECKOUT
                </button>
            <?php endif; ?>
        </div>
        
        
    

    </div>


    <script src="js/button.js"></script>
    <!-- <script src="js/item-counter.js"></script> -->
    <script src="js/change-quantity.js"></script>

</body>
</html>