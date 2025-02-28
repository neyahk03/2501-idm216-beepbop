<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$_SESSION['quantity'] = intval($data['quantity'] ?? 0);

echo json_encode(['success' => true, 'quantity' => $_SESSION['quantity']]);

?>