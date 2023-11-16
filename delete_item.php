<?php
// delete_item.php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_simple";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $item_id = $_GET["id"];

    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $item_id);

    if ($stmt->execute()) {
        $stmt->close();
        
        // Display a success alert using JavaScript
        echo '<script>alert("Data berhasil dihapus!");</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
        exit();
    } else {
        echo "Error deleting item.";
    }

    $stmt->close();
}

$conn->close();
?>
