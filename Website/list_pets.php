<?php

require 'db_connection.php'; // Make sure this path is correct

$userID = $_SESSION['user_id'] ?? null;
if (!$userID) {
    echo "User is not logged in.";
    exit;
}

$pets = [];

$query = "SELECT id, pet_name FROM pets WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    $pets[] = $row;
}

$stmt->close();
$conn->close();
?>
