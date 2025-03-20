<?php
$options = ["ASAP", "12:20 PM", "12:50PM"];
$preselected = "ASAP"; // Set the preselected option
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radio Option Form</title>
</head>
<body>

    <form method="post">
        <?php foreach ($options as $option): ?>
            <label>
                <input type="radio" name="option" value="<?= htmlspecialchars($option) ?>" 
                    <?= ($option === $preselected) ? "checked" : "" ?>>
                <?= htmlspecialchars($option) ?>
            </label><br>
        <?php endforeach; ?>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
