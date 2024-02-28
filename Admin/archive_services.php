<?php
include("db_connection.php");

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];
    // Fetch the service details from the services table
    $query = "SELECT * FROM `services` WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    // Bind the service_id parameter
    mysqli_stmt_bind_param($stmt, "i", $service_id);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Perform archiving logic here
    // For example, you might insert the service into archive_services
    $archiveQuery = "INSERT INTO archive_services SELECT * FROM services WHERE ID = ?";
    $stmtArchive = mysqli_prepare($conn, $archiveQuery);

    // Bind the service_id parameter for archiving
    mysqli_stmt_bind_param($stmtArchive, "i", $service_id);

    if (mysqli_stmt_execute($stmtArchive)) {
        // Now, you can delete the service from the services table
        $deleteQuery = "DELETE FROM `services` WHERE ID = ?";
        $stmtDelete = mysqli_prepare($conn, $deleteQuery);

        // Bind the service_id parameter for deletion
        mysqli_stmt_bind_param($stmtDelete, "i", $service_id);

        if (mysqli_stmt_execute($stmtDelete)) {
            header("Location: services.php");
        } else {
            echo "Error deleting service: " . mysqli_error($conn);
        }
    } else {
        echo "Error archiving service: " . mysqli_error($conn);
    }

    // Close prepared statements
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmtArchive);
    mysqli_stmt_close($stmtDelete);

    // Redirect back to services.php
    
    exit(); // Make sure to include exit() to stop the script from continuing to execute
} else {
    echo "Invalid request: ID parameter not set"; // Add this line for debugging
}

mysqli_close($conn);
?>
