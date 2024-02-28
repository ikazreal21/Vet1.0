<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="100">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-left: 250px; /* Adjust for the sidebar width */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        p {
            font-size: 20px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        hr {
            border: 1px solid #ccc;
            margin: 20px 0;
        }

        a {
            display: block;
            text-align: center;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<?php
include("sidebar.php");
?>
    <div class="container">
        <?php
        // Include your database connection
        include("db_connection.php");

        // Check if the "id" parameter is set in the URL
        if (isset($_GET['id'])) {
            $patientId = $_GET['id'];

            // Query to fetch patient details by ID
            $query = "SELECT * FROM patients WHERE ID = $patientId";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $patientName = $row['name'];
                $patientEmail = $row['email'];
                $patientContact = $row['contact'];
                $patientAddress = $row['address'];
                $petName = $row['pet_name'];
                $petGender = $row['pet_gender'];
                $petBreed = $row['pet_breed'];
                $petColor = $row['pet_color'];
                $petSpecies = $row['pet_breed'];
                $petBday = $row['pet_bday'];
                $neutered = $row['neutered'];
                $petHistory = $row['history'];
                $DateCreated = $row['date_created']; 
                $service =$row['service'];
                $appointment_time = $row['time']; 
                $appointment_date = $row['date'];
                $status = $row['action'];
        
                // Output the patient details
                echo "<h1>Owner Details</h1>";
                echo "<hr>";
                echo "<p><strong>Date Created:</strong> $DateCreated</p>";
                echo "<p><strong>Name:</strong> $patientName</p>";
                echo "<p><strong>Email:</strong> $patientEmail</p>";
                echo "<p><strong>Phone No.:</strong> $patientContact</p>";
                echo "<p><strong>Address:</strong> $patientAddress</p>";
                echo "<p><strong>Appointment Time:</strong> $appointment_time</p>";
                echo "<p><strong>Appointment date:</strong> $appointment_date</p>";
                echo "<p><strong>Status:</strong> $status</p>";
                echo "<hr>";
                echo "<h1>Pet Details</h1>";
                echo "<p><strong>Name:</strong> $petName</p>";
                echo "<p><strong>Gender:</strong> $petGender</p>";
                echo "<p><strong>Breed:</strong> $petBreed</p>";
                echo "<p><strong>Color:</strong> $petColor</p>";
                echo "<p><strong>Species:</strong> $petSpecies</p>";
                echo "<p><strong>Birthdate:</strong> $petBday</p>";
                echo "<p><strong>Neutered:</strong> $neutered</p>";
                echo "<p><strong>Medical History:</strong> $petHistory</p>";
                echo "<p><strong>Services:</strong> $service</p>";
                
                // Add more fields as needed

                // You can also add a button or link to go back to the patient list page
                echo "<a href='patients.php'>Back to Patients List</a>";
            } else {
                echo "<h2><p>No Patients Found.</p></h2>";
            }
        } else {
            echo "Patient ID not provided.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
