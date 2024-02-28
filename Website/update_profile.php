<?php
session_start();
include("db_connection.php");

$userID = $_SESSION['user_id'] ?? null;
if (!$userID) {
    echo "User is not logged in.";
    exit;
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password']; // Only update if not empty

    // Prepare SQL query
    $query = "UPDATE clientregister SET name=? ,username=?, email=?, phone=?, address=?".(!empty($password) ? ", password=?" : "")." WHERE id=?";
    $stmt = $conn->prepare($query);

    if (!empty($password)) {
        // If password field is not empty, include it in the update
        $stmt->bind_param("ssssssi", $name, $username, $email, $phone, $address, $password, $userID);
    } else {
        // If password field is empty, exclude it from the update
        $stmt->bind_param("sssssi", $name, $username, $email, $phone, $address, $userID);
    }

    // Execute query
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Profile updated successfully.";
    } else {
        echo "No changes made or error occurred.";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to profile page or another page
    header("Location: myinfo.php"); // Adjust the redirection as needed
    exit;
}

echo "Invalid request method.";
