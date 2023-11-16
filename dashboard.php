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

// Function to get all items for a user
function getItems($conn) {
    // Adjusted query to exclude the cart table
    $query = "SELECT items.id, items.name, items.price
              FROM items";

    // Use prepared statement to bind parameters
    $stmt = $conn->prepare($query);
    // Note: Since there are no parameters, there's no need for binding in this case
    $stmt->execute();

    $result = $stmt->get_result();
    $items = array();

    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    $stmt->close();

    return $items;
}

// Check if an item ID is provided for "Add to Cart"
if (isset($_GET['add_to_cart'])) {
    $item_id = $_GET['add_to_cart'];

    // Add the item to the cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $quantity = isset($_GET['quantity']) ? max(1, min(100, $_GET['quantity'])) : 1; // Quantity should be between 1 and 10
    $_SESSION['cart'][$item_id] = $quantity;

    // Redirect back to the page after adding to cart
    header("Location: dashboard.php");
    exit();
}

// Items
$items = getItems($conn);

// Calculate the total number of items in the cart
$totalCartItems = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        /* Style for the shopping cart icon in the corner */
        .shopping-cart-icon {
            position: fixed;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5 table-container">
        <!-- Dark Mode Toggle -->
        <label class="switch">
            <input type="checkbox" id="darkModeToggle">
            <span class="slider round"></span>
        </label>
        <label class="switch">
            <input type="checkbox" id="blackModeToggle">
            <span class="slider round"></span>
        </label>

       <!-- Shopping Cart Icon -->
<div class="shopping-cart-icon-container">
    <div class="shopping-cart-icon" onclick="location.href='cart/cart.php'">
        <i class="fas fa-shopping-cart"></i>
        <span class="badge badge-danger"><?php echo $totalCartItems; ?></span>
    </div>
</div>

        <h2>Dashboard <?php echo $_SESSION['username']; ?>!</h2>
        <p>Data Barang Tersedia</p>

        <!-- Items -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($items as $item) {
                    echo "<tr>";
                    echo "<td>{$item['name']}</td>";

                    // Format the price as IDR
                    $formatted_price = "Rp " . number_format($item['price'], 0, ',', '.');
                    echo "<td>{$formatted_price}</td>";

                    // Adding a form to select the quantity for each item
                    echo "<td>
                            <form action='dashboard.php' method='GET'>
                                <input type='number' name='quantity' value='1' min='1' max='100'> <!-- Quantity input -->
                                <input type='hidden' name='add_to_cart' value='{$item['id']}'>
                                <button type='submit' class='btn btn-primary btn-sm'>Add to Cart</button>
                            </form>
                        </td>";
                    echo "<td>
                            <a href='update_item.php?id={$item['id']}' class='btn btn-warning btn-sm'>Update</a>
                            <a href='delete_item.php?id={$item['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Add New Item Form -->
        <div class="mt-4">
            <h3>Tambah Barang</h3>
            <form action="add_item.php" method="post" class="form-inline">
                <div class="form-group mr-2">
                    <label for="item_name" class="sr-only">Nama Barang:</label>
                    <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Nama Barang" required>
                </div>

                <div class="form-group mr-2">
                    <label for="item_price" class="sr-only">Harga Barang:</label>
                    <input type="number" id="item_price" name="item_price" class="form-control" step="0.01" placeholder="Harga Barang" required>
                </div>

                <button type="submit" class="btn btn-primary">Tambahkan Barang</button>
            </form>
        </div>

        <p class="mt-4">
            <a href="logout.php" class="btn btn-secondary">Keluar</a>
            <a href="user_list.php" class="btn btn-info ml-2">List Admin</a>
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <script>
    const darkModeToggle = document.getElementById('darkModeToggle');
    const blackModeToggle = document.getElementById('blackModeToggle');
    const body = document.body;

    // Function to toggle dark mode
    function toggleDarkMode() {
        body.classList.remove('black-mode');
        body.classList.toggle('dark-mode');
        
        // Store user preference in localStorage
        const darkModePreference = body.classList.contains('dark-mode') ? 'enabled' : 'disabled';
        localStorage.setItem('darkMode', darkModePreference);
    }

    // Function to toggle black mode
    function toggleBlackMode() {
        body.classList.remove('dark-mode');
        body.classList.toggle('black-mode');
        
        // Store user preference in localStorage
        const blackModePreference = body.classList.contains('black-mode') ? 'enabled' : 'disabled';
        localStorage.setItem('blackMode', blackModePreference);
    }

    // Function to update the shopping cart icon
    function updateCartIcon() {
        fetch('get_cart_count.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const totalCartItems = parseInt(data.cartCount);
                if (!isNaN(totalCartItems)) {
                    // Update the shopping cart icon
                    const cartIcon = document.querySelector('.shopping-cart-icon');
                    const badge = cartIcon.querySelector('.badge');
                    badge.innerText = totalCartItems;
                } else {
                    console.error('Invalid cart count:', data.cartCount);
                }
            })
            .catch(error => {
                console.error('Error fetching cart count:', error);
            });
    }

    // Event listeners for the toggle switches
    darkModeToggle.addEventListener('change', toggleDarkMode);
    blackModeToggle.addEventListener('change', toggleBlackMode);

    // Check the user's preference from localStorage
    const darkModePreference = localStorage.getItem('darkMode');
    const blackModePreference = localStorage.getItem('blackMode');

    if (darkModePreference === 'enabled') {
        body.classList.add('dark-mode');
        darkModeToggle.checked = true;
    }

    if (blackModePreference === 'enabled') {
        body.classList.add('black-mode');
        blackModeToggle.checked = true;
    }

    // Update the shopping cart icon on page load
    updateCartIcon();
</script>

</body>
</html>
