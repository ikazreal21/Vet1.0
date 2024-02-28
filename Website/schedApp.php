<?php 
session_start();
include('sidebar.php');
include("db_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
</head>
<style>
    /* Form Style */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    form {
        width: 100%;
        margin: 0px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        margin-left: 220px;
    }

    h2 {
        color: #000000; 
        text-align: left;
        margin-top: 30px;
        font-size: 28px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: white ;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

</style>
<body>
    <form>
        <h2>View Appointments</h2>
        <table>
            <tr>
                <th>Pet Name</th>
                <th>Date Created</th>
                <th>Status</th>
            </tr>
            <?php
            // Check if the user is logged in
            if(isset($_SESSION['user_id'])) {
                // Retrieve the user ID from the session
                $user_id = $_SESSION['user_id'];

                // Query to fetch the pet IDs associated with the user
                $sql = "SELECT id FROM pets WHERE user_id = ?";
                
                // Prepare the statement
                $stmt = $conn->prepare($sql);
                
                // Bind parameters
                $stmt->bind_param("i", $user_id);
                
                // Execute the statement
                $stmt->execute();
                
                // Get the result
                $result = $stmt->get_result();
                
                // Check if any pets are found for the user
                if($result->num_rows > 0) {
                    // Create an array to store pet IDs
                    $pet_ids = array();
                    
                    // Fetch and store pet IDs
                    while($row = $result->fetch_assoc()) {
                        $pet_ids[] = $row['id'];
                    }
                    
                    // Close the statement
                    $stmt->close();
                    
                    // Construct a comma-separated string of pet IDs for the SQL query
                    $pet_id_str = implode(',', $pet_ids);
                    
                    // Query to fetch appointments associated with the user's pets
                    $sql = "SELECT pet_name, date_created, status FROM appointments WHERE pet_id IN ($pet_id_str)";
                    
                    // Execute the query
                    $result = $conn->query($sql);
                    
                    // Check if appointments are found
                    if($result->num_rows > 0) {
                        // Fetch and display appointment details
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['pet_name'] . "</td>";
                            echo "<td>" . $row['date_created'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // No appointments found for the user's pets
                        echo "<tr><td colspan='3'>No appointments found for your pets.</td></tr>";
                    }
                } else {
                    // No pets found for the user
                    echo "<tr><td colspan='3'>You have no pets.</td></tr>";
                }
            } else {
                // User is not logged in
                echo "<tr><td colspan='3'>User is not logged in.</td></tr>";
            }

            // Close the connection
            $conn->close();
            ?>
        </table>
    </form>
</body>
</html>
