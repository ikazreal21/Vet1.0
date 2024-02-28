<?php
include("db_connection.php");

if (isset($_GET['product_id']) && isset($_GET['quantity'])) {
    $product_id = $_GET['product_id'];
    $new_quantity = $_GET['quantity'];

    // Perform the database update
    $update_query = "UPDATE `inventory` SET `item_stocks`='$new_quantity' WHERE `ID`='$product_id'";
    mysqli_query($conn, $update_query);
}
?>
