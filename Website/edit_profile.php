<?php
session_start();
include("db_connection.php");

$userID = $_SESSION['user_id'] ?? null;
if (!$userID) {
    echo "User is not logged in.";
    exit;
}

// Fetch user information
$query = "SELECT name, username, email, phone, address FROM clientregister WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No user information found.";
    exit;
}

$userInfo = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content -->
</head>
<body>
<div class="info-container">
    <h2>Edit Profile</h2>
    <form action="update_profile.php" method="POST">

    <label for="username">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userInfo['name']); ?>" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($userInfo['username']); ?>" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($userInfo['address']); ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userInfo['email']); ?>" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($userInfo['phone']); ?>">
    <!-- Password field can be added if you want to allow password changes -->
    <label for="password">Password (leave blank if not changing):</label>
    <input type="password" id="password" name="password">

    <input type="submit" value="Update Profile">
</form>

       
