<?php
include("db_connection.php");

if (isset($_POST['add_product'])) {
    $productName = $_POST['product_name'];
    $purchaseDate = $_POST['purchase_date'];
    $expirationDate = $_POST['expiration_date'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Prepare the INSERT statement
    $insertQuery = "INSERT INTO inventory (item_name, item_date, item_expiration,price, item_stocks) VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($insertQuery);

    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param('ssssi', $productName, $purchaseDate, $expirationDate, $price, $quantity);
    $stmt->execute();

    // Redirect to the inventory.php page after inserting data
    header('Location: inventory.php');
    exit;
}
?>
