<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_simple";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use a constant-time comparison to mitigate timing attacks
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Check if the execute statement succeeded
    if ($stmt === false) {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->bind_result($id, $fetchedUsername, $hashed_password);

  if ($stmt->fetch() && password_verify($password, $hashed_password)) {
    // Set session variables
    session_start();
    $_SESSION['admin'] = true;
    $_SESSION['username'] = $fetchedUsername;

    // Get user ID and set it in the session
    $_SESSION['user_id'] = $id;

    echo "Login successful. Redirecting to dashboard..."; // Debugging statement
    header("Location: dashboard.php");
    exit();
} else {
    echo "Invalid username or password."; // Debugging statement
}

$stmt->close();
}

$conn->close();
?>
