<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["index"], $_POST["quantity"])) {
    $index = intval($_POST["index"]);
    $newQuantity = intval($_POST["quantity"]);

    if (isset($_SESSION["cart"][$index]) && $newQuantity > 0) {
        $_SESSION["cart"][$index]["quantity"] = $newQuantity;
        $_SESSION["cart"][$index]["subtotal"] = $_SESSION["cart"][$index]["price"] * $newQuantity;
    }

    // Recalculate total subtotal
    $totalSubtotal = array_sum(array_column($_SESSION["cart"], "subtotal"));

    echo json_encode(["totalSubtotal" => number_format($totalSubtotal, 2)]);
    exit;
}

?>
