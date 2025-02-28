<?php 
session_start();

$totalQuantity = 0;
if (!empty($_SESSION['cart'])) {
    $totalQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
}

echo json_encode(["totalQuantity" => $totalQuantity]);
exit;
?>