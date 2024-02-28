<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="100">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
       body {
    font-family: 'Arial', sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    margin-left: 250px; /* Adjust for the sidebar width */
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

h1 {
    text-align: center;
    color: #333;
}

p {
    font-size: 18px;
    line-height: 1.6;
    color: black;
    margin: 10px;
    padding: 0px;
    padding-left: 20px;
}

a {
    color: #007BFF;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
}

a:hover {
    text-decoration: underline;
}

hr {
    border: 1px solid #ccc;
    margin: 20px 0;
}

.ten-spaces {
        margin-right: 1%;
    }
    </style>
<body>
<?php
include("sidebar.php");
?>
<div class="container">
        <?php
        if (isset($_GET['id'])) {
            $serviceId = $_GET['id'];
            include("db_connection.php");
            $query = "SELECT * FROM appointments WHERE id = $serviceId";
            $result = $conn->query($query);
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $patientName = $row['name'];
                $patientEmail = $row['email'];
                $patientContact = $row['phone'];
                $patientAddress = $row['address'];
                $dateApp = $row['date'];
                $timeApp = $row['time'];
                $petName = $row['pet_name'];
                $petGender = $row['pet_gender'];
                $petBreed = $row['pet_breed'];
                $petColor = $row['pet_color'];
                $petType = $row['pet_type']; 
                $petBday = $row['pet_bday'];
                $neutered = $row['neutered'];
                $petHistory = $row['history'];
                $service = $row['service_title'];
                $status = $row['status'];
        
                echo "<h1>Owner Details</h1>";
                echo "<p><strong>Name:</strong><span class='ten-spaces'></span>$patientName</p>";
                echo "<p><strong>Email:</strong><span class='ten-spaces'></span>$patientEmail</p>";
                echo "<p><strong>Phone No.:</strong><span class='ten-spaces'></span>$patientContact</p>";
                echo "<p><strong>Address:</strong><span class='ten-spaces'></span>$patientAddress</p>";
                echo "<p><strong>Status:</strong><span class='ten-spaces'></span>$status</p>";
                echo "<p><strong>Date Appointment:</strong><span class='ten-spaces'></span>$dateApp</p>";
                echo "<p><strong>Time Appointment:</strong><span class='ten-spaces'></span>$timeApp</p>";
                echo "<hr>";
                echo "<h1>Pet Details</h1>";
                echo "<p><strong>Name:</strong><span class='ten-spaces'></span>$petName</p>";
                echo "<p><strong>Gender:</strong><span class='ten-spaces'></span>$petGender</p>";
                echo "<p><strong>Type:</strong><span class='ten-spaces'></span>$petType</p>";
                echo "<p><strong>Breed:</strong><span class='ten-spaces'></span>$petBreed</p>";
                echo "<p><strong>Color:</strong><span class='ten-spaces'></span>$petColor</p>";
                echo "<p><strong>Birthdate:</strong><span class='ten-spaces'></span>$petBday</p>";
                echo "<p><strong>Neutered:</strong><span class='ten-spaces'></span>$neutered</p>";
                echo "<p><strong>Medical History:</strong><span class='ten-spaces'></span>$petHistory</p>";
                echo "<p><strong>Services:</strong><span class='ten-spaces'></span>$service</p>";
                echo "<a href='appointments.php'>Back to Appointment List</a>";
            } else {
                echo "No appointments found for this service ID.";
            }
            $conn->close();
        } else {
            echo "Service ID not provided.";
        }
        
        ?>
    </div>
</body>
</html>