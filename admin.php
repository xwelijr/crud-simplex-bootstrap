<?php
// Start the session to check for admin login
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_simple";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get all users
function getUsers($conn) {
    $result = $conn->query("SELECT id, username FROM users");
    $users = array();

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    return $users;
}

// Display the admin page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome to the Admin Page, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Here you can manage users and perform administrative tasks.</p>

        <h3>User List</h3>
        <ul class="list-group">
            <?php
            $users = getUsers($conn);

            foreach ($users as $user) {
                echo "<li class='list-group-item'>{$user['username']} 
                    <a href='update_user.php?id={$user['id']}' class='btn btn-warning btn-sm ml-2'>Update</a>
                    <a href='delete_user.php?id={$user['id']}' class='btn btn-danger btn-sm ml-2'>Delete</a>
                </li>";
            }
            ?>
        </ul>

        <h3 class="mt-3">Add New User</h3>
        <form action="add_user.php" method="post">
            <div class="form-group">
                <label for="new_username">Username:</label>
                <input type="text" id="new_username" name="new_username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password">Password:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add User</button>
        </form>

        <p class="mt-3"><a href="logout.php">Logout</a></p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
