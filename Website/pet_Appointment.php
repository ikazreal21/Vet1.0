<?php
include("sidebar.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];

// Database connection
include("db_connection.php");

// Fetch the services from the database
try {
    $serviceStmt = $conn->prepare("SELECT id, title, price FROM services");
    $serviceStmt->execute();
    $services = $serviceStmt->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $e) {
    die("Error fetching services: " . $e->getMessage());
}

// Fetch the user's pets from the database
try {
    $stmt = $conn->prepare("SELECT id, pet_name FROM pets WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $pets = $result->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $e) {
    die("Error fetching pets: " . $e->getMessage());
}
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

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $petId = htmlspecialchars($_POST['pet_id']);
    $selectedServices = isset($_POST['selected_services']) ? $_POST['selected_services'] : [];
    $appointmentDate = htmlspecialchars($_POST['appointment_date']);
    $appointmentTime = htmlspecialchars($_POST['appointment_time']);

    try {
        // Fetch user details from the database
        $userDetailsQuery = $conn->prepare("SELECT name, username, email, phone, address FROM clientregister WHERE id = ?");
        $userDetailsQuery->bind_param("i", $userId);
        $userDetailsQuery->execute();
        $userResult = $userDetailsQuery->get_result();
        if ($userDetails = $userResult->fetch_assoc()) {
            $name = $userDetails['name'];
            $username = $userDetails['username'];
            $address = $userDetails['address'];
            $email = $userDetails['email'];
            $phone = $userDetails['phone'];
        } else {
            die("Error fetching user details.");
        }

        // Assuming you're allowing the user to set a status
        $status = 'pending';

        // Fetch pet details based on the selected pet ID
        $petDetailsQuery = $conn->prepare("SELECT * FROM pets WHERE id = ?");
        $petDetailsQuery->bind_param("i", $petId);
        $petDetailsQuery->execute();
        $petResult = $petDetailsQuery->get_result();
        $petDetails = $petResult->fetch_assoc();

        // Extract individual pet details
        $petName = $petDetails['pet_name'];
        $petGender = $petDetails['pet_gender'];
        $petType = $petDetails['pet_type'];
        $petBreed = $petDetails['pet_breed'];
        $petBday = $petDetails['pet_bday'];
        $petColor = $petDetails['pet_color'];
        $neutered = $petDetails['neutered'];
        $history = $petDetails['pet_history'];
        $services = isset($_POST["services"]) ? $_POST["services"] : array();
        $totalAmount = compute($conn, $services);
        $serviceTitlesString = implode(',', $services);

        $insertQuery = "INSERT INTO appointments (pet_id, user_id, service_id, date, time, name, username, phone, email, address, pet_name, pet_gender, pet_type, pet_breed, pet_bday, pet_color, neutered, history, service_title, service_price, status, date_created) 
        VALUES ('$petId', '$userId', '$serviceId', '$appointmentDate', '$appointmentTime', '$name', '$username', '$phone', '$email', '$address', '$petName', '$petGender', '$petType', '$petBreed', '$petBday', '$petColor', '$neutered', '$history', '$serviceTitlesString', '$totalAmount', '$status', NOW())";

        // Execute the multi-insert query
        if ($conn->query($insertQuery) === TRUE) {
            echo "<script>alert('Appointment(s) successfully scheduled.'); window.location.href = 'pet_Appointment.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } catch (mysqli_sql_exception $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Pet Appointment</title>
</head>
<style>
    /* Modern Form Design */

body {
    font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
}

h2 {
    color: #007bff; /* Blue color for headings */
    text-align: center;
    margin-top: 30px;
    font-size: 28px;
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

label {
    display: block;
    margin-bottom: 10px;
    color: #495057;
    font-size: 16px;
    font-weight: 600;
}

input[type="date"],
select {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 25px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 16px;
    color: #495057;
}

input[type="submit"] {
    display: block;
    width: 100%;
    padding: 12px 15px;
    border: none;
    background-color: #007bff; /* Blue color for submit button */
    color: white;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3; /* Darker blue for hover effect */
}

.alert {
padding: 15px;
background-color: #dc3545; /* Red color for error messages */
color: white;
margin-bottom: 20px;
border-radius: 4px;
text-align: center;
font-size: 16px;
}

/* Responsive design adjustments */
@media (max-width: 768px) {
form {
width: 90%;
padding: 20px;
}

h2 {
    margin-top: 10px;
    font-size: 24px;
}
}
.service-checkbox {
    display: inline-block;
    margin-right: 20px; /* Adjust spacing between checkboxes */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.service-checkbox label {
    margin-left: 5px; /* Adjust spacing between checkbox and label */
}


/* Enhancing the focus state for better accessibility */
input[type="date"]:focus,
select:focus {
border-color: #80bdff;
outline: 0;
box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
</style>
<body>
<form action="pet_appointment.php" method="post">
    <h2>Schedule Appointment for Your Pet</h2>
    <hr>
    <label for="pet_id">Choose a Pet:</label><br>
    <select id="pet_id" name="pet_id" required>
        <?php foreach ($pets as $pet): ?>
            <option value="<?= htmlspecialchars($pet['id']) ?>"><?= htmlspecialchars($pet['pet_name']) ?></option>
        <?php endforeach; ?>
    </select><br>

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
    <br>
    <label for="appointment_date">Appointment Date:</label><br>
    <input type="date" id="appointment_date" name="appointment_date" required><br>

    <label for="appointment_time">Appointment Time:</label><br>
    <select id="appointment_time" name="appointment_time" required>
        <option value="09:00">9:00 AM</option>
        <option value="10:00">10:00 AM</option>
        <option value="11:00">11:00 AM</option>
        <option value="12:00">12:00 PM</option>
        <option value="13:00">1:00 PM</option>
        <option value="14:00">2:00 PM</option>
        <option value="15:00">3:00 PM</option>
        <option value="16:00">4:00 PM</option>
    </select><br>

    <input type="submit" value="Schedule Appointment">
</form>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("appointment_date")[0].setAttribute('min', today);

        var checkboxes = document.querySelectorAll('input[name="selected_services[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var totalPrice = 0;
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        var price = parseFloat(checkbox.getAttribute('data-price'));
                        totalPrice += price;
                    }
                });
                document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
                document.getElementById('totalPriceInput').value = totalPrice.toFixed(2);
            });
        });
    });
</script>
</body>
</html>
