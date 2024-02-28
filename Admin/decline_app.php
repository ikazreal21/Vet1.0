<?php $filter = null; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Declined Appointments</title>
    <meta http-equiv="refresh" content="100">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #234E70;
    margin: 0;
    padding: 0;
}

.content {
    max-width: 1200px;
    margin: 40px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

header {
    text-align: center;
    margin-bottom: 20px;
}

main {
    margin-top: 20px;
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
    color: #555;
}

select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

button {
    background-color: #007bff;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px;
}

button:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    text-align: center;
}

a {
    text-decoration: none;
}

button[type="button"] {
    background-color: #28a745;
    color: #fff;
}

button[type="button"]:hover {
    background-color: #218838;
}

p{
    font-size: 20px;
}

</style>
<body>
    <div class="content">
        <header>
            <h1>DECLINED APPOINTMENTS</h1>
        </header>
        <hr>
        <main>
        <form method="post" action="" onsubmit="return saveSelectedFilter()">
                <label for="filter">Select Filter:</label>
                <select name="filter" id="filter">
                    <option value="today" <?php if ($filter === 'today') echo 'selected'; ?>>Today's Patients</option>
                    <option value="week" <?php if ($filter === 'week') echo 'selected'; ?>>Past Week Patients</option>
                    <option value="all" <?php if ($filter === 'all') echo 'selected'; ?>>All Patients</option>
                </select>

                <button type="submit" name="submit">Apply</button>
            </form>

            <?php
include("db_connection.php");

// Set the default limit
$defaultLimit = 50;

$filter = isset($_POST['filter']) ? $_POST['filter'] : 'all';

switch ($filter) {
    case 'today':
        $dateCondition = "datetime_ended >= CURDATE()";
        break;
    case 'week':
        $dateCondition = "datetime_ended >= CURDATE() - INTERVAL 1 WEEK";
        break;
    default:
        $dateCondition = "1"; // Show all
        break;
}

$sql = "SELECT * FROM `declined_app` 
        WHERE $dateCondition
        ORDER BY datetime_ended DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' width='100%'>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Phone No.</th>";
    echo "<th>Pet Name</th>";
    echo "<th>Service Requested</th>";
    echo "<th>Date Created</th>";
    echo "<th>Date Declined</th>";

    $totalAppointments = 0; // Initialize the total appointments counter

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['contact'] . "</td>";
        echo "<td>" . $row['pet_name'] . "</td>";
        echo "<td>" . $row['service'] . "</td>";
        echo "<td>" . $row['date_created'] . "</td>";
        echo "<td>" . $row['date_declined'] . "</td>";
        echo "</tr>";

        $totalAppointments++; // Increment the total appointments counter
    }

    echo "</table>";
    echo "<p>Total Appointments: $totalAppointments</p>";
} else {
    echo "<p>No declined appointments found.</p>";
}
?>

            <br>
            <!-- Button to go back to dashboard.php -->
            <a href="dashboard.php"><button type="button">Go Back to Dashboard</button></a>
        </main>
    </div>
</body>
</html>
