<?php
include("db_connection.php");

if (isset($_GET['ID'])) {
    $product_id = $_GET['ID'];

    // Fetch the product details from the inventory table
    $query = "SELECT * FROM `inventory` WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    // Bind the product_id parameter
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Perform archiving logic here
    // For example, you might insert the product into archive_inventory
    $archiveQuery = "INSERT INTO archive_inventory SELECT * FROM inventory WHERE ID = ?";
    $stmtArchive = mysqli_prepare($conn, $archiveQuery);

    // Bind the product_id parameter for archiving
    mysqli_stmt_bind_param($stmtArchive, "i", $product_id);

    if (mysqli_stmt_execute($stmtArchive)) {
        // Now, you can delete the product from the inventory table
        $deleteQuery = "DELETE FROM `inventory` WHERE ID = ?";
        $stmtDelete = mysqli_prepare($conn, $deleteQuery);

        // Bind the product_id parameter for deletion
        mysqli_stmt_bind_param($stmtDelete, "i", $product_id);

        if (mysqli_stmt_execute($stmtDelete)) {
            echo "Product archived successfully";
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    } else {
        echo "Error archiving product: " . mysqli_error($conn);
    }

    // Close prepared statements
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmtArchive);
    mysqli_stmt_close($stmtDelete);
} else {
    echo "Invalid request";
}

mysqli_close($conn);
?>
