<?php
session_start(); // Start the session if not already started

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, you may choose to redirect them to the login page or take appropriate action
    echo "User not logged in";
    exit; // Stop further execution
}

// Check if pet_id is provided and is valid
if (isset($_POST['pet_id']) && is_numeric($_POST['pet_id'])) {
    $petId = $_POST['pet_id'];

    include("db_connection.php");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a statement to delete the pet
    $sql = "DELETE FROM pets WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $petId);

    // Execute the statement
    if ($stmt->execute()) {
        // Pet successfully deleted
        echo "Pet deleted successfully";
    } else {
        // Failed to delete pet
        echo "Error deleting pet: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Pet id is not provided or not valid
    echo "Invalid request";
}
?>
