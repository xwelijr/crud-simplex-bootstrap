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

// Update user process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updated_id = $_POST["id"];
    $updated_username = $_POST["updated_username"];
    $updated_password = $_POST["new_password"]; // Corrected the field name

    // Check if the password is not empty before updating
    if (!empty($updated_password)) {
        $hashed_password = password_hash($updated_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $updated_username, $hashed_password, $updated_id);
    } else {
        // If the password is not provided, update only the username
        $stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
        $stmt->bind_param("si", $updated_username, $updated_id);
    }

    if ($stmt->execute()) {
        // Display a success alert using JavaScript
        echo '<script>alert("Username and Password updated successfully!");</script>';
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating user.";
    }

    $stmt->close();
}

$conn->close();
?>
