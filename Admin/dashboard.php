<?php
// Include your database connection file
include("db_connection.php");

// Query to count active services
$sqlCountActiveServices = "SELECT COUNT(*) AS activeServiceCount FROM services WHERE status = 'Active'";
$resultCountActiveServices = $conn->query($sqlCountActiveServices);

// Query to count inactive services
$sqlCountInactiveServices = "SELECT COUNT(*) AS inactiveServiceCount FROM services WHERE status = 'Inactive'";
$resultCountInactiveServices = $conn->query($sqlCountInactiveServices);

// Query to count pending appointments
$sqlCountPendingAppointments = "SELECT COUNT(*) AS pendingAppointmentCount FROM appointments WHERE status = 'pending'";
$resultCountPendingAppointments = $conn->query($sqlCountPendingAppointments);

// Query to count rejected appointments
$sqlCountRejectedAppointments = "SELECT COUNT(*) AS rejectedAppointmentCount FROM declined_app WHERE action = 'DECLINED'";
$resultCountRejectedAppointments = $conn->query($sqlCountRejectedAppointments);

// Query to count accepted appointments
$sqlCountAcceptedAppointments = "SELECT COUNT(*) AS acceptedAppointmentCount FROM patients WHERE action = 'ACCEPTED'";
$resultCountAcceptedAppointments = $conn->query($sqlCountAcceptedAppointments);

// Query to count completed patients
$sqlCountCompletedPatients = "SELECT COUNT(*) AS completedPatientCount FROM complete_patients WHERE action = 'completed'";
$resultCountCompletedPatients = $conn->query($sqlCountCompletedPatients);

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Home</title>
    <meta http-equiv="refresh" content="100">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
     body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }

    .container {
            text-align: center;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px;
        }

        .dashboard-card {
            background-color: #234E70;
            padding: 30px;
            border: 1px solid #ccc;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            width: 30%; /* Adjust width as needed */
            margin-bottom: 20px;
            box-sizing: border-box;
            border-radius: 2%;
        }

        .dashboard-card h2 {
            background-color: #408EC6;
            color: #fff;
            padding: 10px;
            margin-top: 0;
        }

        h1 {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            margin-top: 20px;
            color: #234E70;
        }
        p{
            font-size: 20px;
            color: #fff;
        }

</style>
<body>
<?php 
include_once('sidebar.php');
?>
<div class="content">
    <header>
        <center><h1>Welcome to the Admin Dashboard</h1></center>
        <hr>
    </header>
        <main>
            <div class="container">
                <!-- Active Services -->
                <div class="dashboard-card">
                <a href="services.php"><h2>Active Services</h2></a>
                    <?php
                    if ($resultCountActiveServices && $resultCountActiveServices->num_rows > 0) {
                        $rowActive = $resultCountActiveServices->fetch_assoc();
                        echo "<p>Number of Active: " . $rowActive['activeServiceCount'] . "</p>";
                    } else {
                        echo "<p>No active services found.</p>";
                    }
                    ?>
                </div>

                <!-- Inactive Services -->
                <div class="dashboard-card">
                <a href="services.php"><h2>Inactive Services</h2></a>
                    <?php
                    if ($resultCountInactiveServices && $resultCountInactiveServices->num_rows > 0) {
                        $rowInactive = $resultCountInactiveServices->fetch_assoc();
                        echo "<p>Number of Inactive: " . $rowInactive['inactiveServiceCount'] . "</p>";
                    } else {
                        echo "<p>No inactive services found.</p>";
                    }
                    ?>
                </div>

                <!-- Pending Appointments -->
                <div class="dashboard-card">
                    <h2>Pending Appointments</h2>
                    <?php
                    if ($resultCountPendingAppointments && $resultCountPendingAppointments->num_rows > 0) {
                        $rowPending = $resultCountPendingAppointments->fetch_assoc();
                        echo "<p>Number of Pending: " . $rowPending['pendingAppointmentCount'] . "</p>";
                    } else {
                        echo "<p>No pending appointments found.</p>";
                    }
                    ?>
                </div>

                <!-- Declined Appointments -->
                <div class="dashboard-card">
                <a href="decline_app.php"><h2>Declined Appointments</h2></a>
                    <?php
                    if ($resultCountRejectedAppointments && $resultCountRejectedAppointments->num_rows > 0) {
                        $rowRejected = $resultCountRejectedAppointments->fetch_assoc();
                        echo "<p>Number of Decline: " . $rowRejected['rejectedAppointmentCount'] . "</p>";
                    } else {
                        echo "<p>No declined appointments found.</p>";
                    }
                    ?>
                </div>

                <!-- Accepted Appointments -->
                <div class="dashboard-card">
                    <h2>Accepted Appointments</h2>
                    <?php
                    if ($resultCountAcceptedAppointments && $resultCountAcceptedAppointments->num_rows > 0) {
                        $rowAccepted = $resultCountAcceptedAppointments->fetch_assoc();
                        echo "<p>Number of Accepted: " . $rowAccepted['acceptedAppointmentCount'] . "</p>";
                    } else {
                        echo "<p>No accepted appointments found.</p>";
                    }
                    ?>
                </div>

                <!-- Completed Patients -->
                <div class="dashboard-card">
    
                    <a href="complete_patients.php"><h2>Completed Patients</h2></a>
                    <?php
                    if ($resultCountCompletedPatients && $resultCountCompletedPatients->num_rows > 0) {
                        $rowCompleted = $resultCountCompletedPatients->fetch_assoc();
                        echo "<p>Number of Completion: " . $rowCompleted['completedPatientCount'] . "</p>";
                    } else {
                        echo "<p>No completed patients found.</p>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>






