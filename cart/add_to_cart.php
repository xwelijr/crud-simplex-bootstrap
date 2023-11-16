<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the item ID is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect to an error page or handle the error in your preferred way
    header("Location: error.php");
    exit();
}

// Get the item ID from the URL
$item_id = $_GET['id'];

// Check if the item ID is valid (you may want to validate it further)
if (!is_numeric($item_id) || $item_id <= 0) {
    // Redirect to an error page or handle the error in your preferred way
    header("Location: error.php");
    exit();
}

// Add the item to the cart (you may want to validate and sanitize the input)
$_SESSION['cart'][$item_id] = 1; // You can use quantity instead of 1 if needed

// Redirect back to the page where the user clicked "Add to Cart"
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>
