<?php
include("db_connection.php");

if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    // Perform archiving logic here
    // For example, you might insert the patient into archive_patients
    $archiveQuery = "INSERT INTO archive_patients SELECT * FROM patients WHERE ID = ?";
    $stmtArchive = mysqli_prepare($conn, $archiveQuery);

    // Bind the patient_id parameter for archiving
    mysqli_stmt_bind_param($stmtArchive, "i", $patient_id);

    if (mysqli_stmt_execute($stmtArchive)) {
        // Now, you can delete the patient from the patients table
        $deleteQuery = "DELETE FROM `patients` WHERE ID = ?";
        $stmtDelete = mysqli_prepare($conn, $deleteQuery);

        // Bind the patient_id parameter for deletion
        mysqli_stmt_bind_param($stmtDelete, "i", $patient_id);

        if (mysqli_stmt_execute($stmtDelete)) {
            echo "Patient archived successfully";
        } else {
            echo "Error deleting patient: " . mysqli_error($conn);
        }
    } else {
        echo "Error archiving patient: " . mysqli_error($conn);
    }

    // Close prepared statements
    mysqli_stmt_close($stmtArchive);
    mysqli_stmt_close($stmtDelete);
} else {
    echo "Invalid request";
}

mysqli_close($conn);
?>
