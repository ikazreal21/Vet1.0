<?php
include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Perform archiving logic here
    // For example, you might insert the user into an archive_users table
    $archiveQuery = "INSERT INTO archive_users SELECT * FROM register WHERE id = $user_id";
    $result = $conn->query($archiveQuery);

    if ($result) {
        // Now, you can delete the user from the register table
        $deleteQuery = "DELETE FROM register WHERE id = $user_id";
        $resultDelete = $conn->query($deleteQuery);

        if ($resultDelete) {
            // Redirect back to the users page after successful archiving
            header("Location: users.php");
            exit();
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    } else {
        echo "Error archiving user: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

mysqli_close($conn);
?>
