<?php
session_start();

// Check if the cart is set
if (isset($_SESSION['cart'])) {
    // Calculate the total quantity of items in the cart
    $totalQuantity = array_sum($_SESSION['cart']);
    echo json_encode(['cartCount' => $totalQuantity]);
} else {
    // If the cart is not set, return 0
    echo json_encode(['cartCount' => 0]);
}
?>
