<?php
session_start();
unset($_SESSION['cart']);
header("Location: ../bag.php");
exit();
?>
