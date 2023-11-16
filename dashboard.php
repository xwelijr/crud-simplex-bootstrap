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

// Function to get all items
function getItems($conn) {
    $result = $conn->query("SELECT id, name, price FROM items");
    $items = array();

    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    return $items;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Dark Mode Toggle -->
        <label class="switch">
            <input type="checkbox" id="darkModeToggle">
            <span class="slider round"></span>
        </label>
        <label class="switch">
            <input type="checkbox" id="blackModeToggle">
            <span class="slider round"></span>
        </label>

        <h2>Menu Dashboard <?php echo $_SESSION['username']; ?>!</h2>
        <p>Barang yang sudah dimasukkan Keranjang</p>

        <!-- Items Cart -->
        <h3>Keranjang</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Keranjang</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $items = getItems($conn);

                foreach ($items as $item) {
                    echo "<tr>";
                    echo "<td>{$item['name']}</td>";

                    // Format the price as IDR
                    $formatted_price = "Rp " . number_format($item['price'], 0, ',', '.');
                    echo "<td>{$formatted_price}</td>";

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
    </script>
</body>
</html>
