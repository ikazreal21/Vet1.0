<?php
include("db_connection.php");

// Check if the product_id parameter is set in the URL
if (isset($_GET['product_id'])) {
    $productIdToDelete = $_GET['product_id'];

    // Prepare the DELETE statement
    $deleteQuery = "DELETE FROM inventory WHERE ID = ?";
    $stmt = $conn->prepare($deleteQuery);

    // Check for errors in preparing the statement
    if (!$stmt) {
        die("Error preparing the DELETE statement: " . $conn->error);
    }

    // Bind the product ID parameter
    $stmt->bind_param('i', $productIdToDelete);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the inventory.php page after deleting the product
        header('Location: inventory.php');
        exit;
    } else {
        // Handle execution errors
        die("Error executing the DELETE statement: " . $stmt->error);
    }
} else {
    // If product_id parameter is not set, display an error message or redirect as needed
    echo "Product ID not provided for deletion.";
}
?>
