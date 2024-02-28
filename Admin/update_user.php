<?php
// Include your database connection file
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID and sanitized inputs
    $user_id = $_POST["user_id"];
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $position = mysqli_real_escape_string($conn, $_POST["position"]);

    // Update user information including the password
    $sql = "UPDATE register SET Name = '$name', Username = '$username', Password = '$password', Position = '$position' WHERE ID = $user_id";

    // Execute the SQL query to update user information
    if ($conn->query($sql) === TRUE) {
        header("Location: users.php");
        exit; // Make sure to exit to prevent further execution of the script

    } else {
        echo "Error updating user information: " . $conn->error;
    }

    // Close the database connection
    mysqli_close($conn);
}
?>