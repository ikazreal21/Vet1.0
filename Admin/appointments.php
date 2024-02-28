<?php include('sidebar.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Appointments</title>
    <meta http-equiv="refresh" content="100">
    <link rel="stylesheet" type="text/css" href="style.css">
<style>
       body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
            background-color: #fff;
        }

        .content header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            
            border: 1px solid #ddd;
            padding-top: 10px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            text-align: left;
        }

        th {
            background-color: #234E70;
            color: white;
            font-size: 20px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-create {
            background-color: #333;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-create:hover {
            background-color: #555;
        }
        /* Add custom styles for the Edit and Delete buttons */

        .btn-view {
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
        }

        .btn-edit {
            background-color: green;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
        }

        .btn-edit:hover {
            background-color: darkgreen;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
        }

.btn-delete:hover {
        background-color: #c82333;
}
label {
        font-size: 20px; 
        margin-right: 10px;
}
select {
        padding: 10px;
        font-size: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
}
h1 {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            margin-top: 20px;
            color: #234E70;
        }
.limit{
            font-family: 'Times New Roman', Times, serif;
            color: #234E70;
}

button {
    background-color: #0072bc;
                    color: #fff;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                    position: relative;
                    left: 10px;
                }

button:hover {
            background-color: #0072bc;    
        }

</style>
</head>
<body>
    <div class="content">
        <header>
            <h1>Appointments</h1>
        </header>
        <hr>
        <main>
        <?php
        include("db_connection.php");

        // Set the default limit
        $defaultLimit = 10;

        // Check if the "limit" form has been submitted
        if (isset($_POST['submit']) && isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        } else {
            // Default limit
            $limit = $defaultLimit;
        }

        // Modify the SQL query based on the selected option
        $sql = "SELECT * FROM appointments";

        switch ($limit) {
            case 'today':
                $sql .= " WHERE DATE(date_created) = CURDATE()";
                break;
            case '7days':
                $sql .= " WHERE DATE(date_created) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()";
                break;
            // Add more cases as needed
        }

        $sql .= " ORDER BY date_created DESC LIMIT $defaultLimit";

        $result = $conn->query($sql);

        echo '<form method="post" action="">';
        echo '<label for="limit">Filter Appointments:</label>';
        echo '<select name="limit" id="limit">';
        echo '<option value="all" ' . ($limit == 'all' ? 'selected' : '') . '>All</option>';
        echo '<option value="today" ' . ($limit == 'today' ? 'selected' : '') . '>Today</option>';
        echo '<option value="7days" ' . ($limit == '7days' ? 'selected' : '') . '>7 Days</option>';
        // Add more options as needed
        echo '</select>';
        echo '<button type="submit" name="submit">Apply</button>';
        echo '</form>';

        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Phone No.</th>";
        echo "<th>Address</th>";
        echo "<th>Email</th>";
        echo "<th>Date Created</th>";
        echo "<th>Action</th>";
        echo "</tr>";

        if ($result && mysqli_num_rows($result) > 0) {
            // Loop through the results and display each appointment
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['date_created'] . "</td>";
                echo "<td>";
                echo "<a class='btn-view' href='viewApp.php?id=" . $row['id'] . "'>View</a>";
                echo "<a class='btn-edit' href='approvedApp.php?id=" . $row['id'] . "'>Accept</a>";
                echo "<a class='btn-delete' href='#' onclick='confirmDecline(" . $row['id'] . ")'>Decline</a>";
                echo "</td>"; // Close the <td> tag here
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No Appointments Found.</td></tr>";
        }
        

        echo "</table>";

        // Close the database connection
        mysqli_close($conn);
        ?>
        </main>
    </div>
    <script>
function confirmDecline(id) {
    if (confirm("Are you sure you want to decline this appointment?")) {
        window.location.href = 'declineApp.php?id=' + id;
    }
}
</script>

</body>
</html>
