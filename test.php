<?php

session_start();
include 'includes/database.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = session_id();
}

echo  $_SESSION['user_id'];

if (!isset($_GET['id']) || !isset($_GET['table'])) {
    echo "No item ID or table provided.";
    exit;
}

$id = $_GET['id'];
$table_to_display = $_GET['table'];

$item_name = $_GET['item_name'] ?? '%';
$price = $_GET['price'] ?? '%';

$item_query = "SELECT * FROM $table_to_display WHERE id = ?";
$statement = $connection->prepare($item_query);
$statement->bind_param('i', $id);
$statement->execute();
$item_result = $statement->get_result();
$item = $item_result->fetch_assoc();
$statement->close();

if (!$item) {
    echo "Item not found.";
    exit;
}

$customization_tables_map = [
    'sandwiches' => ['bread', 'protein', 'condiments'],
    'cheesesteaks' => ['cheesesteak_bread'],
    'salads' => ['dressing'],
    'pastries' => ['pastry_option'],
    'drinks' => ['drink_option']
];

$customizations = [];

if (isset($customization_tables_map[$table_to_display])) {
    foreach ($customization_tables_map[$table_to_display] as $custom_table) {
        $query = "SELECT * FROM $custom_table WHERE id = ? OR item_name LIKE ? OR price LIKE ?";
        $statement = $connection->prepare($query);
        $statement->bind_param('isd', $id, $item_name, $price);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $customizations[$custom_table] = $result->fetch_all(MYSQLI_ASSOC);
        }
        $statement->close();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedOptions = [
        'id' => $_POST['id'] ?? '',
        'table' => $_POST['table'] ?? '',
        'item_name' => $_POST['item_name'] ?? '',
        'item_price' => $_POST['item_price'] ?? '',
        'customizations' => []
    ];

    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            $selectedOptions['customizations'][$key] = $value;
        }
    }
}
?>

<form action="" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="hidden" name="table" value="<?= $table_to_display ?>">
    <input type="hidden" name="item_name" value="<?= $item_name ?>">
    <input type="hidden" name="item_price" value="<?= $price ?>">

    <?php if (!empty($customizations)): ?>
        <?php foreach ($customizations as $custom_table => $options): ?>
            <div class="option">
                <h2><?= ucfirst(str_replace('_', ' ', $custom_table)) ?></h2>
                <?php foreach ($options as $option): ?>
                    <?php 
                    $option_name = $option['item_name'];
                    $option_price = $option['price'] ?? 0;
                    ?>
                    <?php if ($custom_table === 'protein' || $custom_table === 'condiments'): ?>
                        <div class="option-label">
                            <input type="checkbox" id="<?= str_replace(' ', '_', strtolower($option_name)) ?>" name="<?= $custom_table ?>[]" value="<?= $option_name ?>">
                            <input type="hidden" name="<?= $custom_table ?>_price[<?= $option_name ?>]" value="<?= $option_price ?>">
                            <label for="<?= str_replace(' ', '_', strtolower($option_name)) ?>">
                                <p><?= $option_name ?></p>
                                <p><?php if ($option_price > 0) echo "+$" . number_format($option_price, 2); ?></p>
                            </label>
                        </div>
                    <?php else: ?>
                        <div class="option-label">
                            <input type="radio" id="<?= str_replace(' ', '_', strtolower($option_name)) ?>" name="<?= $custom_table ?>" value="<?= $option_name ?>">
                            <input type="hidden" name="<?= $custom_table ?>_price" value="<?= $option_price ?>">
                            <label for="<?= str_replace(' ', '_', strtolower($option_name)) ?>">
                                <p><?= $option_name ?></p>
                                <p><?php if ($option_price > 0) echo "+$" . number_format($option_price, 2); ?></p>
                            </label>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <textarea class="note" id="note" name="note" placeholder="Add a note"></textarea>

    <button class="filled-button" type="submit">
        <h4>ADD TO BAG</h4>
    </button>
</form>

<?php if (!empty($selectedOptions)): ?>
    <div class="selected-options">
        <h3>Selected Options:</h3>
        <p>Item: <?= htmlspecialchars($selectedOptions['item_name']) ?> 
($<?= number_format((float)$selectedOptions['item_price'], 2) ?>)</p>

        <?php if (!empty($selectedOptions['customizations'])): ?>
            <ul>
                <?php foreach ($selectedOptions['customizations'] as $category => $values): ?>
                    <li><strong><?= ucfirst(str_replace('_', ' ', $category)) ?>:</strong> <?= implode(', ', $values) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <p><strong>Note:</strong> <?= htmlspecialchars($_POST['note'] ?? '') ?></p>
    </div>
<?php endif; ?>