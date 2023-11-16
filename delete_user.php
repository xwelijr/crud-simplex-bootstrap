<?php
// delete_user.php
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
    $user_id = $_GET["id"];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        
        // Display a success alert using JavaScript
        echo '<script>alert("Data Berhasil Di Hapus!");</script>';
        echo '<script>window.location.href = "user_list.php";</script>';
        exit();
    } else {
        echo "Error deleting user.";
    }

    $stmt->close();
}

$conn->close();
?>
