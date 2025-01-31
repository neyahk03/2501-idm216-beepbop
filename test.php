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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Database - Beepbop</title>
    <link rel="stylesheet" href="css/record.css">
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
            <table>
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
                            <td><?php echo $sandwich['image_link']; ?></td>
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
        <table>
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

    
    

    </div>



</body>
</html>