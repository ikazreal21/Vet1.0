<?php
// Start the session
session_start();

// Include your database connection code
include_once("db_connection.php");

// Retrieve username and role from session variables
$adminUsername = $_SESSION["adminUsername"];
$userRole = $_SESSION["adminRole"];

// Log the logout action to the database
$logoutAction = "Logged out";
$insertQuery = "INSERT INTO login_logs (username, position, action, log_datetime) VALUES ('$adminUsername', '$userRole', '$logoutAction', NOW())"; // Assuming MySQL

// Execute the query and handle errors
if (mysqli_query($conn, $insertQuery)) {
    // Destroy the session
    session_destroy();
    
    // Display alert and redirect after a short delay
    echo "<script>alert('Logged Out Successfully.');</script>";
    echo "<script>setTimeout(function(){ window.location.href = 'Login.php'; }, 500);</script>";
    exit();
} else {
    // Display error message and redirect after a short delay
    echo "<script>alert('Error inserting logout log: " . mysqli_error($conn) . "');</script>";
    echo "<script>setTimeout(function(){ window.location.href = 'Login.php'; }, 1000);</script>";
    exit();
}
?>
