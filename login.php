<?php
session_start(); // Start the session

if (isset($_POST['guest'])) {
    // id for guest
    $_SESSION['guest_id'] = uniqid('guest_'); 

    // empty cart
    $_SESSION['cart'] = []; 

    // when click on continue as guest, redirect to step 1 (menu screen)
    header("Location: step1.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <form method="post">
        <button type="submit" name="guest">Continue as Guest</button>
    </form>

</body>
</html>
