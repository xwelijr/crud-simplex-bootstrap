<?php
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

// Function to get item details by ID
function getItemDetails($conn, $itemId) {
    $stmt = $conn->prepare("SELECT name, price, image_url FROM items WHERE id = ?");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $stmt->close();
        return $row;
    }

    $stmt->close();
    return false;
}

// Function to get user details by ID
function getUserDetails($conn, $userId) {
    $stmt = $conn->prepare("SELECT username, address, email FROM users WHERE id = ?");
    
    if (!$stmt) {
        die("Error in user details query: " . $conn->error);
    }
    
    $stmt->bind_param("i", $userId);
    
    if (!$stmt->execute()) {
        die("Error executing user details query: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $stmt->close();
        return $row;
    } else {
        die("Error fetching user details: " . $stmt->error);
    }
}

// Check if the cart session variable is set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if an item ID is provided for updating quantity
if (isset($_POST['update_quantity'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the cart
    $_SESSION['cart'][$item_id] = $quantity;

    // Redirect back to the cart page
    header("Location: cart.php");
    exit();
}

// Check if an item ID is provided for deleting
if (isset($_GET['delete_item'])) {
    $item_id = $_GET['delete_item'];

    // Remove the item from the cart
    unset($_SESSION['cart'][$item_id]);

    // Redirect back to the cart page
    header("Location: cart.php");
    exit();
}

// Cart Items
$cartItems = array();
$totalPrice = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $itemId => $quantity) {
        $itemDetails = getItemDetails($conn, $itemId);

        if ($itemDetails) {
            $itemPrice = $itemDetails['price'] * $quantity;
            $totalPrice += $itemPrice;

            $cartItems[] = array(
                'id' => $itemId,
                'name' => $itemDetails['name'],
                'price' => $itemPrice,
                'quantity' => $quantity,
                'image_url' => $itemDetails['image_url'], // Added image URL
            );
        }
    }
}

// Get user details
$userDetails = getUserDetails($conn, $_SESSION['user_id']);

// Function to format price as IDR
function formatPriceIDR($price) {
    return "Rp " . number_format($price, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Keranjang Belanja <?php echo $userDetails['username']; ?>!</h2>
        <p></p>

        <!-- User Information -->
        <h4>Informasi Pengiriman</h4>
        <p><strong>Nama:</strong> <?php echo $userDetails['username']; ?></p>
        <p><strong>Alamat:</strong> <?php echo $userDetails['address']; ?></p>
        <p><strong>Email:</strong> <?php echo $userDetails['email']; ?></p>

        <!-- Shopping Cart -->
        <h3>Keranjang</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Gambar</th> <!-- Added column for image -->
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cartItems as $cartItem) {
                    echo "<tr>";
                    echo "<td>{$cartItem['name']}</td>";
                    echo "<td>" . formatPriceIDR($cartItem['price'] / $cartItem['quantity']) . "</td>"; // Display price per item
                    echo "<td>
                            <form method='post' class='form-inline'>
                                <div class='input-group input-group-sm'>
                                    <input type='number' id='quantity' name='quantity' class='form-control' value='{$cartItem['quantity']}' required>
                                    <input type='hidden' name='item_id' value='{$cartItem['id']}'>
                                    <div class='input-group-append'>
                                        <button type='submit' name='update_quantity' class='btn btn-primary btn-sm'>Update</button>
                                    </div>
                                </div>
                            </form>
                        </td>";
                    echo "<td>" . formatPriceIDR($cartItem['price']) . "</td>";
                    echo "<td><img src='../{$cartItem['image_url']}' alt='Item Image' style='max-width: 100px; max-height: 100px;'></td>";
                    echo "<td>
                            <a href='cart.php?delete_item={$cartItem['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Total Price -->
        <h4 class="text-right mt-4">Total Harga: <?php echo formatPriceIDR($totalPrice); ?></h4>

        <p class="mt-4">
            <a href="../dashboard.php" class="btn btn-secondary">Kembali ke Menu Utama</a>
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
