<?php
session_start();
unset($_SESSION['cart']);
header("Location: step3.php");
exit();
?>
