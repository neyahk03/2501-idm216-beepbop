<?php
// session_start();
// header('Content-Type: application/json'); // Ensure JSON response

// $response = ["success" => false, "bag_subtotal" => 0];

// if (isset($_POST['index'])) {
//     $index = intval($_POST['index']);
//     if (isset($_SESSION['cart'][$index])) {
//         unset($_SESSION['cart'][$index]);
//         $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array

//         // Recalculate subtotal
//         $subtotal = 0;
//         foreach ($_SESSION['cart'] as $item) {
//             $subtotal += $item['price'] * $item['quantity'];
//         }

//         $response["success"] = true;
//         $response["bag_subtotal"] = $subtotal;
//     }
// }

// echo json_encode($response); // Send JSON response
// exit();

// session_start();
// header('Content-Type: application/json'); // Ensure JSON response

// $response = ["success" => false, "bag_subtotal" => 0, "total_quantity" => 0];

// if (isset($_POST['index'])) {
//     $index = intval($_POST['index']);
    
//     if (isset($_SESSION['cart'][$index])) {
//         unset($_SESSION['cart'][$index]);
//         $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array

//         // Recalculate subtotal & total quantity
//         $subtotal = 0;
//         $totalQuantity = 0;

//         foreach ($_SESSION['cart'] as $item) {
//             $subtotal += $item['price'] * $item['quantity'];
//             $totalQuantity += $item['quantity'];
//         }

//         $response["success"] = true;
//         $response["bag_subtotal"] = $subtotal;
//         $response["total_quantity"] = $totalQuantity;
//     }
// }

// echo json_encode($response); // Send JSON response
// exit();

session_start();
header('Content-Type: application/json'); // Ensure JSON response

$response = ["success" => false, "bag_subtotal" => 0, "total_quantity" => 0];

if (isset($_POST['index'])) {
    $index = intval($_POST['index']);
    
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array

        // Recalculate subtotal & total quantity
        $subtotal = 0;
        $totalQuantity = 0;

        foreach ($_SESSION['cart'] as $item) {
            if (isset($item['price']) && isset($item['quantity'])) {
                $subtotal += $item['price'] * $item['quantity'];
                $totalQuantity += $item['quantity'];
            }
        }

        $response["success"] = true;
        $response["bag_subtotal"] = $subtotal;
        $response["total_quantity"] = $totalQuantity;
    }
}

echo json_encode($response); // Send JSON response
exit();




?>
