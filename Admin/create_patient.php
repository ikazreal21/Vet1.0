<?php 
include_once('sidebar.php');
function compute($conn, $services)
{
    // Ensure $services is an array and not empty
    if (is_array($services) && !empty($services)) {
        // Convert the array of service titles into a comma-separated string for the IN clause
        $serviceTitles = implode("','", $services);

        // Query to fetch prices for the selected services
        $sql = "SELECT SUM(price) AS total FROM services WHERE title IN ('$serviceTitles')";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["total"];
        }
    }

    return 0; // Return 0 if no services or an error occurred
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("db_connection.php");

    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $pet_name = $_POST["pet_name"];
    $pet_gender = $_POST["pet_gender"];
    $pet_type = $_POST["pet_type"];
    $pet_breed = $_POST["pet_breed"];
    $pet_bday = $_POST["pet_bday"];
    $pet_color = $_POST["pet_color"];
    $services = isset($_POST["services"]) ? $_POST["services"] : array();
    $neutered = $_POST["neutered"];
    $pet_medicalhistory = $_POST["pet_medicalhistory"];

    // Compute total amount based on selected services
    $totalAmount = compute($conn, $services);

    // Convert the array of selected services into a comma-separated string
    $serviceTitlesString = implode(',', $services);

    $sql = "INSERT INTO patients ( name, email, contact, address, pet_name, pet_gender, pet_breed, pet_color, pet_type, pet_bday, neutered, history,date,time, service, total,date_created,action)
    VALUES ('$full_name', '$email', '$phone', '$address', '$pet_name', '$pet_gender', '$pet_breed', '$pet_color', '$pet_type', '$pet_bday', '$neutered', '$pet_medicalhistory','00-00-0000','00:00:00', '$serviceTitlesString', $totalAmount, NOW() , 'Accepted')";
    if (mysqli_query($conn, $sql)) {
        // Patient creation successful
        echo '<script>';
        echo 'alert("Patient created successfully!");';
        echo 'window.location.href = "patients.php";'; // Redirect to success_page.php
        echo '</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Create Patients</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: "Arial", "Helvetica Neue", "Helvetica", sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .content {
            padding: 20px;
        }


        main {
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        h1, h2 {
            color: #333;
        }

        form {
            max-width: 1500px;
            margin: 0 auto;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select,
        textarea,
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding: 10px;
            background: transparent url('arrow-down.png') no-repeat right center;
            background-size: 25px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: dodgerblue;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: darkblue;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link a:hover {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="content">
        <header>
            <h1>Application Form</h1>
        </header>
        <hr>
        <main>
            <form action="create_patient.php" method="POST">
                <!-- Your form sections and fields go here -->
                <div class="form-section owner-details">
                    <div class="form-group">
                        <label for="full_name">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" placeholder="LastName, FirstName MI" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="e.g Example@gmail.com"required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" placeholder="+63 --- --- ----" maxlength="17" pattern="\+63 \d{3} \d{3} \d{4}" title="Please enter a valid phone number in the format: +63 xxx yyy zzzz" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea id="address" name="address" rows="4"placeholder="Full Address"></textarea>
                    </div>
                    <div class="form-group">
        <label>Services</label>
        <hr>
        <?php
        // Establish a database connection
        include("db_connection.php");
    
        // Query to retrieve services from the "services" table
        $query = "SELECT id, title FROM services";
        $result = mysqli_query($conn, $query);
    
        // Check if the query was successful
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $service_id = $row['id'];
                $service_name = $row['title'];
                // Create a checkbox for each service
                echo '<label>';
                echo '<input type="checkbox" name="services[]" value="' . $service_name . '">';
                echo $service_name;
                echo '</label><br>';
            }
        } else {
            echo "Failed to retrieve services from the database.";
        }
    
        // Close the database connection
        mysqli_close($conn);
    ?>
                </div>

                <div class="form-section pet-details">
                    <div class="form-group">
                        <label for="pet_name">Pet Name:</label>
                        <input type="text" id="pet_name" name="pet_name" required>
                    </div>
                    <div class="form-group">
                        <label for="pet_gender">Gender:</label>
                        <select id="pet_gender" name="pet_gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pet_type">Pet Type:</label>
                        <select id="pet_type" name="pet_type">
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pet_breed">Breed:</label>
                        <input type="text" id="pet_breed" name="pet_breed">
                    </div>
                    <div class="form-group">
                        <label for="pet_bday">Date of Birth:</label>
                        <input type="date" id="pet_bday" name="pet_bday" required>
                    </div>
                    <div class="form-group">
                        <label for="pet_color">Color:</label>
                        <input type="text" id="pet_color" name="pet_color">
                    </div>
                    <div class="form-group">
                        <label for="neutered">Neutered:</label>
                        <input type="radio" id="neutered-yes" name="neutered" value="yes">&nbsp;Yes &nbsp;
                        <input type="radio" id="neutered-no" name="neutered" value="no">&nbsp;No
                    </div>
                    <div class="form-group">
                        <label for="pet_medicalhistory">Pet Medical History:</label>
                        <textarea id="pet_medicalhistory" name="pet_medicalhistory" rows="4" cols="50"></textarea>
                </div>

                <input type="submit" value="Submit">
                <div class="back-link">
                    <a href="patients.php">Back to Patients List</a>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
