<?php
// Function to compute the total amount based on selected services
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

    // Retrieve form data
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $calendar = $_POST["calendar"];
    $appointment_time = $_POST["appointment_time"];
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

    // Insert data into the "appointments" table
    $sql = "INSERT INTO appointments (date_created, name, email, phone, address, date, time, pet_name, pet_gender, pet_species, pet_breed, pet_bday, pet_color, neutered, history, service, total, action)
    VALUES (NOW(), '$full_name', '$email', '$phone', '$address', '$calendar', '$appointment_time', '$pet_name', '$pet_gender', '$pet_type', '$pet_breed', '$pet_bday', '$pet_color', '$neutered', '$pet_medicalhistory', '$serviceTitlesString', $totalAmount, 'PENDING')";


    if (mysqli_query($conn, $sql)) {
        // Successfully inserted data, you can redirect to another page if needed
        header("Location: homepage.php");
        exit();
    } else {
        // Display an error message if the insertion fails
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
