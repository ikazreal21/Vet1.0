<?php
include('db_connection.php');

// Function to recover an archived service
// Function to recover an archived service
function recoverService($conn, $serviceID) {
    // Retrieve service details from archive_services
    $selectQuery = "SELECT * FROM archive_services WHERE id = $serviceID";
    $result = mysqli_query($conn, $selectQuery);

    if (!$result) {
        echo "<script>alert('Error retrieving service: " . mysqli_error($conn) . "');</script>";
        return;
    }

    // Fetch the service details
    $row = mysqli_fetch_assoc($result);
    $title = mysqli_real_escape_string($conn, $row['title']);
    $description = mysqli_real_escape_string($conn, $row['description']);
    $time = mysqli_real_escape_string($conn, $row['time_consume']); // Change 'duration' to 'time_consume'
    $price = mysqli_real_escape_string($conn, $row['price']);
    $status = mysqli_real_escape_string($conn, $row['status']);

    // Insert the service into active_services
    $insertQuery = "INSERT INTO services (title, description, price, time_consume, status) 
                    VALUES ('$title', '$description', '$price', '$time' ,'$status')";
    if (mysqli_query($conn, $insertQuery)) {
        // Delete the recovered service from archive_services
        $deleteQuery = "DELETE FROM archive_services WHERE id = $serviceID";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "<script>alert('Service successfully recovered and moved to active services.');</script>";
        } else {
            echo "<script>alert('Error deleting service from archive: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error inserting service into active services: " . mysqli_error($conn) . "');</script>";
    }
}


// Function to permanently delete an archived service
function deleteServicePermanently($conn, $serviceID) {
    // Delete the service from archive_services
    $deleteQuery = "DELETE FROM archive_services WHERE id = $serviceID";

    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Service permanently deleted.');</script>";
    } else {
        echo "<script>alert('Error deleting service permanently: " . mysqli_error($conn) . "');</script>";
    }
}

// Check if the request is made using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['recover'])) {
        $serviceID = $_POST['serviceID'];
        recoverService($conn, $serviceID);
    }
    if(isset($_POST['delete'])) {
        $serviceID = $_POST['serviceID'];
        deleteServicePermanently($conn, $serviceID);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service View</title>
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

h1 {
    font-size: 30px;
    text-align: center;
    margin: 20px 0;
    color: #343a40;
}

hr {
    border: 1px solid #dee2e6;
    margin: 20px 0;
}

.table-container {
    max-width: 100%;
    margin: 0 auto;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

th {
    background-color: #f8f9fa;
    font-weight: bold;
    color: #495057;
}

tr:hover {
    background-color: #e2e6ea;
}

.recover-button, .delete-button {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.recover-button {
    background-color: #28a745;
    color: #fff;
}

.delete-button {
    background-color: #dc3545;
    color: #fff;
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

</style>
<body>
    <?php
    // Fetch data from archive_services
    $query = "SELECT * FROM archive_services";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    ?>

    <h1>Archived Service List</h1>
    <hr>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['title']}</td>";
                    echo "<td>{$row['description']}</td>";
                    echo "<td>{$row['time_consume']}</td>";
                    echo "<td>{$row['price']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td>
                            <form method='post'>
                                <input type='hidden' name='serviceID' value='{$row['id']}'>
                                <button class='recover-button' type='submit' name='recover'>Recover</button>
                            </form>
                        </td>";
                    echo "<td>
                            <form method='post'>
                                <input type='hidden' name='serviceID' value='{$row['id']}'>
                                <button class='delete-button' type='submit' name='delete'>Permanently Delete</button>
                            </form>
                        </td>";
                    echo "</tr>";
                }

                mysqli_free_result($result);
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <a href="archive.php" class="back-button">Go Back</a>
</body>
</html>
