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

// Registration process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        // Display a success alert using JavaScript
        echo '<script>alert("Registrasi Berhasil. Silahkan login.");</script>';
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    } else {
        echo "Error during registration.";
    }

    $stmt->close();
}

$conn->close();
?>
