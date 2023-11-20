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
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $user_id = $_GET["id"];
    $stmt = $conn->prepare("SELECT id, username, age, address, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($id, $username, $age, $address, $email);

    if ($stmt->fetch()) {
        // Display the update form
        include 'header.php'; // Include the common header
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="container mt-5">
                <h2>Update User</h2>
                <form action="update_user_process.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="updated_username">Username:</label>
                        <input type="text" id="updated_username" name="updated_username" class="form-control" value="<?php echo $username; ?>" required>
                    </div>

                <div class="form-group">
    <label for="updated_age">Age:</label>
    <input type="text" id="updated_age" name="updated_age" class="form-control" value="<?php echo $age; ?>" required>
</div>

<div class="form-group">
    <label for="updated_address">Address:</label>
    <input type="text" id="updated_address" name="updated_address" class="form-control" value="<?php echo $address; ?>" required>
</div>

<div class="form-group">
    <label for="updated_email">Email:</label>
    <input type="email" id="updated_email" name="updated_email" class="form-control" value="<?php echo $email; ?>" required>
</div>


                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
                <p class="mt-3"><a href="dashboard.php" class="btn btn-secondary">Go back to Dashboard</a></p>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
        include 'footer.php'; // Include the common footer
    } else {
        echo "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>
