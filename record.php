<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'includes/database.php';

$id = $_GET['id'] ?? '%'; 
$username = $_GET['username'] ?? '%';
$email = $_GET['email'] ?? '%';
$firstname = $_GET['firstname'] ?? '%';
$lastname = $_GET['lastname'] ?? '%';

$item_name = $_GET['name'] ?? '%';
$price = $_GET['price'] ?? '%';
$image = $_GET['image'] ?? '';


$statement = $connection->prepare('SELECT * FROM users WHERE id LIKE ? OR firstname LIKE ? OR lastname LIKE ? OR username LIKE ? OR email LIKE ?');
$statement->bind_param('issss', $id, $firstname, $lastname, $username, $email);
$statement->execute();
$users = $statement->get_result()->fetch_all(MYSQLI_ASSOC);


$menuStatement = $connection->prepare('SELECT * FROM menu_item WHERE id LIKE ? OR name LIKE ? OR price LIKE ? OR image LIKE ?');
$menuStatement->bind_param('isds', $id, $item_name, $price, $image);
$menuStatement->execute();
$items = $menuStatement->get_result()->fetch_all(MYSQLI_ASSOC);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beepbop database</title>
    <link rel="stylesheet" href="css/record.css">
    <link rel="icon" type="image/gif" href="images/petes-lunchbox-logo.svg" />
</head>

<body>

    <section class="title">
        <div class="bar"></div>
        <h1>BEEPBOP DATABASE</h1>
    </section>

    <div class="container">

    <section class="window">
        <div class="window-top">
            <h2>Users</h2>

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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo $user['firstname']; ?></td>
                            <td><?php echo $user['lastname']; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
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
            <h2>Menus</h2>

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
                <th>Name</th>
                <th>Price</th>
                <th>Image Link</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td>$<?php echo $item['price']; ?></td>
                        <td><?php echo $item['image']; ?></td>
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

