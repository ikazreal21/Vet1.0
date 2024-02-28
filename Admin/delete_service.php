<?php
// Include your database connection file
include("db_connection.php");

// Check if the service ID is provided in the URL (use 'id' instead of 'ID')
if (isset($_GET['id'])) {
    $service_id = $_GET['id'];
    
    // Sanitize the input (ensure it's an integer)
    $service_id = intval($service_id);
    
    // Check if the service ID is valid (greater than 0)
    if ($service_id > 0) {
        // Write SQL code to delete the service
        $sql = "DELETE FROM services WHERE ID = $service_id";
    
        // Execute the SQL query
        if ($conn->query($sql) === TRUE) {
            // Redirect to the services list page
            header("Location: services.php");
            exit; // Make sure to exit after redirection
        } else {
            echo "Error deleting service: " . $conn->error;
        }
    } else {
        echo "Invalid service ID.";
    }
} else {
    echo "Service ID not provided.";
}


// Close the database connection
$conn->close();
?>
