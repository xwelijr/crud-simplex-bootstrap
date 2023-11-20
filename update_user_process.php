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
    $updated_password = $_POST["new_password"];
    $updated_age = $_POST["updated_age"];
    $updated_email = $_POST["updated_email"];
    $updated_address = $_POST["updated_address"];

    // Check if the password is provided
    if (!empty($updated_password)) {
        $hashed_password = password_hash($updated_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, age = ?, email = ?, address = ? WHERE id = ?");
        $stmt->bind_param("ssissi", $updated_username, $hashed_password, $updated_age, $updated_email, $updated_address, $updated_id);
    } else {
        // If the password is not provided, update other fields excluding the password
        $stmt = $conn->prepare("UPDATE users SET username = ?, age = ?, email = ?, address = ? WHERE id = ?");
        $stmt->bind_param("sissi", $updated_username, $updated_age, $updated_email, $updated_address, $updated_id);
    }

    if ($stmt->execute()) {
        // Display a success alert using JavaScript
        echo '<script>alert("User information updated successfully!");</script>';
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating user.";
    }

    $stmt->close();
}

$conn->close();
?>
