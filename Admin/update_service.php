<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the service_id is provided
    if (isset($_POST['service_id'])) {
        $service_id = $_POST['service_id'];

        // Include your database connection file
        include("db_connection.php");

        // Retrieve the updated service information from the form
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $duration = $_POST['duration']; // Corrected variable name
        $status = $_POST['status'];

        // Use prepared statements to prevent SQL injection
        $sql = "UPDATE services SET title=?, description=?, price=?, time_consume=?, status=? WHERE ID=?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ssdssi", $title, $description, $price, $duration, $status, $service_id); // Corrected binding parameter

            // Execute the statement
            if ($stmt->execute()) {
                // Successful update, redirect back to the services page
                header("Location: services.php");
                exit();
            } else {
                // Error in the execution of the prepared statement
                echo "Error updating service: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            // Error in preparing the statement
            echo "Error updating service: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "<p>Service ID not provided.</p>";
    }
} else {
    // Redirect to the services page if the form is not submitted
    header("Location: services.php");
    exit();
}
?>
