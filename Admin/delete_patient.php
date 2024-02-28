<?php

// Include the database connection code
include_once('db_connection.php');

// Check if the ID parameter exists in the POST request
if (isset($_POST['ID'])) {
    // Sanitize the input to prevent SQL injection
    $patientId = intval($_POST['ID']);

    // Prepare a deletion query using a prepared statement
    $stmt = $conn->prepare("DELETE FROM archive_patients WHERE ID = ?");
    $stmt->bind_param("i", $patientId);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Return a success message
        http_response_code(200);
        echo "Patient with ID $patientId deleted successfully.";
    } else {
        // Return an error message
        http_response_code(500);
        echo "Error deleting patient: " . $conn->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If the ID parameter is not provided, return an error response
    http_response_code(400);
    echo "ID parameter is missing.";
}
?>
