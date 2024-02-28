<?php
include_once('db_connection.php');

// Function to recover an archived patient
function recoverPatient($conn, $ID) {
    $selectQuery = "SELECT * FROM archive_patients WHERE ID = $ID";
    $result = mysqli_query($conn, $selectQuery);

    if (!$result) {
        echo "<script>alert('Error retrieving patient: " . mysqli_error($conn) . "');</script>";
        return;
    }

    $row = mysqli_fetch_assoc($result);

    $columns = implode(', ', array_map(function ($col) use ($conn, $row) {
        return "$col = '" . mysqli_real_escape_string($conn, $row[$col]) . "'";
    }, array_keys($row)));

    $insertQuery = "INSERT INTO patients SET $columns";
    if (mysqli_query($conn, $insertQuery)) {
        $deleteQuery = "DELETE FROM archive_patients WHERE ID = $ID";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "<script>alert('Patient successfully recovered and moved to active patients.');</script>";
        } else {
            echo "<script>alert('Error deleting patient from archive: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error inserting patient into active patients: " . mysqli_error($conn) . "');</script>";
    }
}

// Function to permanently delete an archived patient
function deletePatientPermanently($conn, $ID) {
    $deleteQuery = "DELETE FROM archive_patients WHERE ID = $ID";

    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Patient permanently deleted.');</script>";
    } else {
        echo "<script>alert('Error deleting patient permanently: " . mysqli_error($conn) . "');</script>";
    }
}

// Check if the request is made using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['recover'])) {
        $ID = $_POST['ID'];
        recoverPatient($conn, $ID);
    }
    if (isset($_POST['delete'])) {
        $ID = $_POST['ID'];
        deletePatientPermanently($conn, $ID);
    }
}

// Fetch data from archive_patients
$query = "SELECT * FROM archive_patients";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Patient List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

.content {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

header h1 {
    font-size: 2.5rem;
    color: #343a40;
}

main {
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 1.5rem;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

th {
    background-color: #f8f9fa;
    font-weight: bold;
    color: #495057;
    text-align: center;
}

tr:hover {
    background-color: #e2e6ea;
}

/* Adjusted column widths */
th:nth-child(1),
td:nth-child(1) {
    width: 5%; /* ID column width */
}

th:nth-child(2),
td:nth-child(2) {
    width: 20%; /* Name column width */
}

.back-button {
    display: inline-block;
    padding: 10px 15px;
    background-color: #007bff;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.back-button:hover {
    background-color: #0056b3;
}

.recover-button {
    background-color: #28a745; /* Green */
    color: #fff;
    border: none;
    padding: 15px 25px;
    cursor: pointer;
    border-radius: 4px;
}

.delete-button {
    background-color: #dc3545; /* Red */
    color: #fff;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 4px;
}
</style>
<body>
    <h1>Archived Patient List</h1>
    <hr>
    <table class='content'>
        <!-- Table header -->
        <thead>
            <tr>
                <!-- Add table headers for patient details -->
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Pet Name</th>
                <th>Pet Gender</th>
                <th>Pet Breed</th>
                <th>Pet Color</th>
                <th>Pet Type</th>
                <th>Pet Birthdate</th>
                <th>Neutered</th>
                <th>History</th>
                <th>Service</th>
                <th>Total</th>
                <th>Date</th>
                <th>Time</th>
                <th>Date Created</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Date Ended</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display archived patient records
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                // Display patient details in table cells
                echo "<td>{$row['ID']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['contact']}</td>";
                echo "<td>{$row['address']}</td>";
                echo "<td>{$row['pet_name']}</td>";
                echo "<td>{$row['pet_gender']}</td>";
                echo "<td>{$row['pet_breed']}</td>";
                echo "<td>{$row['pet_color']}</td>";
                echo "<td>{$row['pet_type']}</td>";
                echo "<td>{$row['pet_bday']}</td>";
                echo "<td>{$row['neutered']}</td>";
                echo "<td>{$row['history']}</td>";
                echo "<td>{$row['service']}</td>";
                echo "<td>{$row['total']}</td>";
                echo "<td>{$row['date']}</td>";
                echo "<td>{$row['time']}</td>";
                echo "<td>{$row['date_created']}</td>";
                echo "<td>{$row['action']}</td>";
                echo "<td>{$row['notes']}</td>";
                echo "<td>{$row['datetime_ended']}</td>";
                // Display buttons for recovering and permanently deleting patients
                echo "<td><button class=\"recover-button\" onclick=\"recoverPatient({$row['ID']})\">Recover</button></td>";
                echo "<td><button class=\"delete-button\" onclick=\"deletePatientPermanently({$row['ID']})\">Permanently Delete</button></td>";
                echo "</tr>";
            }

            // Free result set
            mysqli_free_result($result);

            // Close the database connection
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    <!-- Go back button -->
    <a href="archive.php" class="back-button">Go Back</a>
    <script>
function recoverPatient(ID) {
    if (confirm("Are you sure you want to recover this patient?")) {
        // Send an AJAX request to the server
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "archive_viewPatients.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
                // Reload the page after successful recovery
                location.reload();
            }
        };
        xhr.send("recover=1&ID=" + ID);
    }
}

function deletePatientPermanently(ID) {
    if (confirm("Are you sure you want to permanently delete this patient?")) {
        // Send an AJAX request to the server
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "archive_viewPatients.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
                // Reload the page after successful deletion
                location.reload();
            }
        };
        xhr.send("delete=1&ID=" + ID);
    }
}
</script>
</body>
</html>