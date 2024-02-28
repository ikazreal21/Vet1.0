<?php
include("db_connection.php");

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Assuming you have a column named 'status' to represent the appointment status in the database
    $status = 'DECLINED';

    $sql = "UPDATE appointments SET status = '$status' WHERE id = $appointmentId";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the list of appointments
        header("Location: appointments.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
