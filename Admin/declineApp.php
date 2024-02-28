<?php
include("db_connection.php");

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use Twilio\Rest\Client;

require "../vendor/autoload.php";


if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Fetch the details of the declined appointment
    $selectQuery = "SELECT * FROM appointments WHERE id = $appointmentId";
    $result = $conn->query($selectQuery);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Extract details of the declined appointment
        $full_name = $row["name"];
        $email = $row["email"];
        $phone = $row["phone"];
        $address = $row["address"];
        $calendar = $row["date"];
        $appointment_time = $row["time"];
        $pet_name = $row["pet_name"];
        $pet_gender = $row["pet_gender"];
        $pet_type = $row["pet_type"];
        $pet_breed = $row["pet_breed"];
        $pet_bday = $row["pet_bday"];
        $pet_color = $row["pet_color"];
        $service = $row["service_title"];
        $total = $row["service_price"];
        $neutered = $row["neutered"];
        $pet_medicalhistory = $row["history"];
        $date_created = $row['date_created'];

        // Insert the declined appointment into the patients table or another table
        $currentDateTime = date("Y-m-d H:i:s"); // Get the current date and time

        $insertQuery = "INSERT INTO declined_app (name, email, contact, address, pet_name, pet_gender, pet_type, pet_breed, pet_bday, pet_color, neutered, history, date, time, service, total, date_created, action, date_declined) 
                        VALUES ('$full_name', '$email', '$phone', '$address', '$pet_name', '$pet_gender', '$pet_type', '$pet_breed', '$pet_bday', '$pet_color', '$neutered', '$pet_medicalhistory', '$calendar', '$appointment_time', '$service', '$total', '$date_created', 'DECLINED', '$currentDateTime')";
                if ($conn->query($insertQuery) === TRUE) {
            // Delete the declined appointment data from the appointments table
            $deleteQuery = "DELETE FROM appointments WHERE id = $appointmentId";
            if ($conn->query($deleteQuery) === TRUE) {
                // Redirect back to the list of appointments

                // SMS Notification

                $number = $phone;
                $message = "Your appointment has been Declined";  

                $base_url = "https://1vwl9n.api.infobip.com";
                $api_key = "43d3f2fd937e1a9f7eca55de090857fa-50d7bbf2-6ca0-4183-b4ef-a21ca7cf2775";
            
                $configuration = new Configuration(host: $base_url, apiKey: $api_key);
            
                $api = new SmsApi(config: $configuration);
            
                $destination = new SmsDestination(to: $number);
            
                $message = new SmsTextualMessage(
                    destinations: [$destination],
                    text: $message,
                    from: "VetCare"
                );
            
                $request = new SmsAdvancedTextualRequest(messages: [$message]);
            
                $response = $api->sendSmsMessage($request);


                header("Location: appointments.php");
                exit();
            } else {
                echo "Error deleting the declined appointment: " . $conn->error;
            }
        } else {
            echo "Error inserting into patient list: " . $conn->error;
        }
    } else {
        echo "Error fetching the declined appointment details: " . $conn->error;
    }
} else {
    echo "Invalid appointment ID.";
}

$conn->close();
?>
