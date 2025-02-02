<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'includes/database.php';

$id = $_GET['id'] ?? '%';
$item_name = $_GET['item_name'] ?? '%';
$price = $_GET['price'] ?? '%';
$image = $_GET['image_link'] ?? '';

$statement = $connection->prepare('SELECT * FROM sandwiches WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ? OR image_link LIKE ?');
$statement->bind_param('isds', $id, $item_name, $price, $image);
$statement->execute();
$sandwiches = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM sandwich_option WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?');
$statement->bind_param('isd', $id, $item_name, $price);
$statement->execute();
$sandwich_options = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM sandwich_addon WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?');
$statement->bind_param('isd', $id, $item_name, $price);
$statement->execute();
$sandwich_addons = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM sandwich_topping WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?');
$statement->bind_param('isd', $id, $item_name, $price);
$statement->execute();
$sandwich_toppings = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM sandwich_addon WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?');
$statement->bind_param('isd', $id, $item_name, $price);
$statement->execute();
$sandwich_addons = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM steak WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ? OR image_link LIKE ?');
$statement->bind_param('isds', $id, $item_name, $price, $image);
$statement->execute();
$steaks = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM steak_option WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?');
$statement->bind_param('isd', $id, $item_name, $price);
$statement->execute();
$steak_options = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM pastries WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ? OR image_link LIKE ?');
$statement->bind_param('isds', $id, $item_name, $price, $image);
$statement->execute();
$pastries = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM pastry_option WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?');
$statement->bind_param('isd', $id, $item_name, $price);
$statement->execute();
$pastry_options = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM salad WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ? OR image_link LIKE ?');
$statement->bind_param('isds', $id, $item_name, $price, $image);
$statement->execute();
$salads = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM dressing WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?');
$statement->bind_param('isd', $id, $item_name, $price);
$statement->execute();
$dressings = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM drink WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ? OR image_link LIKE ?');
$statement->bind_param('isds', $id, $item_name, $price, $image);
$statement->execute();
$drinks = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$statement = $connection->prepare('SELECT * FROM drink_option WHERE id LIKE ? OR item_name LIKE ? OR price LIKE ?');
$statement->bind_param('isd', $id, $item_name, $price);
$statement->execute();
$drink_options = $statement->get_result()->fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Database - Beepbop</title>
    <link rel="stylesheet" href="css/record.css">
    <link rel="stylesheet" href="css/test.css">
</head>

<body>
    <section class="title">
        <div class="bar"></div>
        <h1>BEEPBOP DATABASE</h1>
    </section>

    <div class="container">

    <section class="window">
        <div class="window-top">
            <h2>Sandwiches</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
            <table class="sanwiches">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if (!empty($sandwiches)): ?>
                    <?php foreach ($sandwiches as $sandwich): ?>
                        <tr>
                            <td><?php echo $sandwich['id']; ?></td>
                            <td><?php echo $sandwich['item_name']; ?></td>
                            <td>$<?php echo $sandwich['price']; ?></td>
                            <td>
                                <div class="image_link">
                                    <img class="image_link" src="images/menu-item/sandwiches/<?php echo $sandwich['image_link']; ?>" alt="<?php echo $sandwich['item_name']; ?>'s image"></td>
                                </div>
                                
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Sandwich Option</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
        <table class="sandwich_option">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if (!empty($sandwich_options)): ?>
                    <?php foreach ($sandwich_options as $sandwich_option): ?>
                        <tr>
                            <td><?php echo $sandwich_option['id']; ?></td>
                            <td><?php echo $sandwich_option['item_name']; ?></td>
                            <td>$<?php echo $sandwich_option['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Sandwich Add-on</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
        <table class="sandwich_addon">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if (!empty($sandwich_addons)): ?>
                    <?php foreach ($sandwich_addons as $sandwich_addon): ?>
                        <tr>
                            <td><?php echo $sandwich_addon['id']; ?></td>
                            <td><?php echo $sandwich_addon['item_name']; ?></td>
                            <td>$<?php echo $sandwich_addon['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

    </section>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Sandwich Topping</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
        <table class="sandwich_topping">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if (!empty($sandwich_toppings)): ?>
                    <?php foreach ($sandwich_toppings as $sandwich_topping): ?>
                        <tr>
                            <td><?php echo $sandwich_topping['id']; ?></td>
                            <td><?php echo $sandwich_topping['item_name']; ?></td>
                            <td>$<?php echo $sandwich_topping['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Cheese Steak</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
            <table class="steak">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php if (!empty($steaks)): ?>
                        <?php foreach ($steaks as $steak): ?>
                            <tr>
                                <td><?php echo $steak['id']; ?></td>
                                <td><?php echo $steak['item_name']; ?></td>
                                <td>$<?php echo $steak['price']; ?></td>
                                <td>
                                    <div class="image_link">
                                            <img class="image_link" src="images/menu-item/steak/<?php echo $steak['image_link']; ?>" alt="<?php echo $steak['item_name']; ?>'s image"></td>
                                        </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Steak Option</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
        <table class="sandwich_topping">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if (!empty($steak_options)): ?>
                    <?php foreach ($steak_options as $steak_option): ?>
                        <tr>
                            <td><?php echo $steak_option['id']; ?></td>
                            <td><?php echo $steak_option['item_name']; ?></td>
                            <td>$<?php echo $steak_option['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Salad</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
            <table class="salad">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php if (!empty($salads)): ?>
                        <?php foreach ($salads as $salad): ?>
                            <tr>
                                <td><?php echo $salad['id']; ?></td>
                                <td><?php echo $salad['item_name']; ?></td>
                                <td>$<?php echo $salad['price']; ?></td>
                                <td>
                                    <div class="image_link">
                                            <img class="image_link" src="images/menu-item/salad/<?php echo $salad['image_link']; ?>" alt="<?php echo $salad['item_name']; ?>'s image"></td>
                                        </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Pastry Option</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
        <table class="sandwich_topping">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if (!empty($pastry_options)): ?>
                    <?php foreach ($pastry_options as $pastry_option): ?>
                        <tr>
                            <td><?php echo $pastry_option['id']; ?></td>
                            <td><?php echo $pastry_option['item_name']; ?></td>
                            <td>$<?php echo $pastry_option['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Salad</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
            <table class="salad">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php if (!empty($salads)): ?>
                    <?php foreach ($salads as $salad): ?>
                            <tr>
                                <td><?php echo $salad['id']; ?></td>
                                <td><?php echo $salad['item_name']; ?></td>
                                <td>$<?php echo $salad['price']; ?></td>
                                <td>
                                    <div class="image_link">
                                            <img class="image_link" src="images/menu-item/salad/<?php echo $salad['image_link']; ?>" alt="<?php echo $salad['item_name']; ?>'s image"></td>
                                        </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Dressing</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
        <table class="dressing">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if (!empty($dressings)): ?>
                    <?php foreach ($dressings as $dressing): ?>
                        <tr>
                            <td><?php echo $dressing['id']; ?></td>
                            <td><?php echo $dressing['item_name']; ?></td>
                            <td>$<?php echo $dressing['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Drink</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
            <table class="drink">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php if (!empty($drinks)): ?>
                    <?php foreach ($drinks as $drink): ?>
                            <tr>
                                <td><?php echo $drink['id']; ?></td>
                                <td><?php echo $drink['item_name']; ?></td>
                                <td>$<?php echo $drink['price']; ?></td>
                                <td>
                                    <div class="image_link">
                                            <img class="image_link" src="images/menu-item/drink/<?php echo $drink['image_link']; ?>" alt="<?php echo $drink['item_name']; ?>'s image"></td>
                                        </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </section>

    <section class="window">
        <div class="window-top">
            <h2>Drink Option</h2>

            <div class="icon">
                <div>
                    <img src="images/database/minimize.svg" alt="minimize icon">
                </div>

                <div>
                    <img src="images/database/tab.svg" alt="tab icon">
                </div>

                <div>
                    <img src="images/database/close.svg" alt="close icon">
                </div>
            </div>
        </div>

        <div class="content">
        <table class="drink_option">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if (!empty($drink_options)): ?>
                    <?php foreach ($drink_options as $drink_options): ?>
                        <tr>
                            <td><?php echo $drink_options['id']; ?></td>
                            <td><?php echo $drink_options['item_name']; ?></td>
                            <td>$<?php echo $drink_options['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

    </section>







    
    

    </div>



</body>
</html>