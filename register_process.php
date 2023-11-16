<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_simple";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Registration process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Check if the user already has a cart
    $cart_id = getCartId($conn, $username);

    if ($cart_id === null) {
        // If the user doesn't have a cart, create an empty cart
        $cart_id = createEmptyCart($conn);
    }

    // Check if cart_id and other parameters are correct
  //  echo "Username: $username, Password: $password, Cart ID: $cart_id";

    $stmt = $conn->prepare("INSERT INTO users (username, password, cart_id) VALUES (?, ?, ?)");

    // Check if the prepare statement is successful
    if ($stmt) {
        $stmt->bind_param("ssi", $username, $password, $cart_id);

        if ($stmt->execute()) {
            echo "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            echo "Error during execution: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error during preparation: " . $conn->error;
    }
}

// Function to create an empty cart and return its ID
function createEmptyCart($conn) {
    $stmt = $conn->prepare("INSERT INTO carts () VALUES ()");

    if ($stmt === false) {
        die("Error during preparation: " . $conn->error);
    }

    $success = $stmt->execute();

    if (!$success) {
        die("Error during execution: " . $stmt->error);
    }

    $stmt->close();

    return $conn->insert_id;
}

// Function to get the cart ID for a user
function getCartId($conn, $username) {
    $stmt = $conn->prepare("SELECT cart_id FROM users WHERE username = ?");
    
    // Check if the prepare statement is successful
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($cart_id);

        if ($stmt->fetch()) {
            // User already has a cart
            $stmt->close(); // Close the statement before returning
            return $cart_id;
        } else {
            // User doesn't have a cart
            $stmt->close(); // Close the statement before returning
            return null;
        }
    } else {
        echo "Error during preparation: " . $conn->error;
        return null;
    }
}

$conn->close();
?>
