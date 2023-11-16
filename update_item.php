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
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $item_id = $_GET["id"];
    $stmt = $conn->prepare("SELECT id, name, price FROM items WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $stmt->bind_result($id, $name, $price);

    if ($stmt->fetch()) {
        // Include the common header
        include 'header.php';
        ?>

        <!-- Your existing HTML content goes here -->

        <div class="container mt-5">
            <h2 class="mb-4">Update Item</h2>
            <form action="update_item_process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="updated_item_name">Item Name:</label>
                    <input type="text" id="updated_item_name" name="updated_item_name" class="form-control" value="<?php echo $name; ?>" required>
                </div>

                <div class="form-group">
                    <label for="updated_item_price">Item Price:</label>
                    <input type="number" id="updated_item_price" name="updated_item_price" class="form-control" value="<?php echo $price; ?>" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Item</button>
            </form>
            <p class="mt-3"><a href="dashboard.php" class="btn btn-secondary">Go back to Dashboard</a></p>
        </div>

        <?php
        // Include the common footer
        include 'footer.php';
    } else {
        echo "Item not found.";
    }

    $stmt->close();
}

$conn->close();
?>
