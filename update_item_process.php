<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_simple";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update item process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updated_item_id = $_POST["id"];
    $updated_item_name = $_POST["updated_item_name"];
    $updated_item_price = $_POST["updated_item_price"];

    $stmt = $conn->prepare("UPDATE items SET name = ?, price = ? WHERE id = ?");
    $stmt->bind_param("sdi", $updated_item_name, $updated_item_price, $updated_item_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating item.";
    }

    $stmt->close();
}

$conn->close();
?>
