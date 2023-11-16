<?php
// cart.php

// Include the common header
include 'header.php';

// Database connection (already included in header.php)

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
    <title>Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Available Items</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $items = getItems($conn);

                foreach ($items as $item) {
                    echo "<tr>";
                    echo "<td>{$item['id']}</td>";
                    echo "<td>{$item['name']}</td>";
                    echo "<td>{$item['price']}</td>";
                    echo "<td><a href='add_to_cart.php?item_id={$item['id']}' class='btn btn-success btn-sm'>Add to Cart</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Your Cart</h2>
        <?php
        // Display user's cart items
        $cart_id = getCartId($conn, $_SESSION['user_id']);
        displayCartItems($conn, $cart_id);
        ?>
        
       <p class="mt-4"><a href="/scr/dashboard.php" class="btn btn-secondary">Back to Dashboard</a></p>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Include the common footer
include 'footer.php';
?>
