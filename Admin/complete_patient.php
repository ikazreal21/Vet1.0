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
    $patientId = $_GET['id'];

    // Validate and sanitize the input
    $patientId = filter_var($patientId, FILTER_VALIDATE_INT);
    if ($patientId === false) {
        die("Invalid patient ID");
    }

    // Get the current date and time
    $dateEnded = date("Y-m-d H:i:s");

    // Update the patient's status and set the date ended in the 'patients' table
    $updateSql = "UPDATE patients SET action = 'Completed', datetime_ended = ? WHERE ID = ?";

    // Use prepared statement to prevent SQL injection
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $dateEnded, $patientId);

    // echo '<pre>';
    // var_dump($pdetails);
    // echo '<pre>';

    if ($updateStmt->execute()) {
        echo "Patient marked as 'Completed' successfully";

        // Move the record to the 'complete_patients' table
        $moveSql = "INSERT INTO complete_patients SELECT * FROM patients WHERE ID = ?";
        $moveStmt = $conn->prepare($moveSql);
        $moveStmt->bind_param("i", $patientId);
        $moveStmt->execute();


        $pdetails = "SELECT * FROM patients WHERE ID = ?";
        $pdetails = $conn->prepare($pdetails);
        $pdetails->bind_param("i", $patientId);
        $pdetails->execute();
        $result = $pdetails->get_result();
        // echo '<pre>';
        // var_dump($result);
        // echo '<pre>';

        if ($moveStmt->affected_rows > 0) {
            echo "Patient data moved to 'complete_patients' successfully";
            $service = "";
            // SMS Notification
            while ($row = $result->fetch_assoc()) {
                $service = $row['service'];
                $contact = $row['contact'];
            }


            $number = $contact;
            $message = "The ". $service ." is done, you can now pick up your pet";  

            $base_url = "https://1vwl9n.api.infobip.com";
            $api_key = "43d3f2fd937e1a9f7eca55de090857fa-50d7bbf2-6ca0-4183-b4ef-a21ca7cf2775";
        
            $configuration = new Configuration(host: $base_url, apiKey: $api_key);
        
            $api = new SmsApi(config: $configuration);
        
            $destination = new SmsDestination(to: $number);
        
            $message = new SmsTextualMessage(
                destinations: [$destination],
                text: $message,
                from: "V"
            );
        
            $request = new SmsAdvancedTextualRequest(messages: [$message]);
        
            $response = $api->sendSmsMessage($request);
        } else {
            echo "Error moving patient data: " . $moveStmt->error;
        }

        // Delete the record from the 'patients' table
        $deleteSql = "DELETE FROM patients WHERE ID = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $patientId);

        if ($deleteStmt->execute()) {
            echo "Patient deleted successfully";
            
        } else {
            echo "Error deleting patient: " . $deleteStmt->error;
        }

        // Redirect to patients.php after a 2-second delay
        header("refresh:2;url=patients.php");
    } else {
        echo "Error marking patient as 'Completed': " . $updateStmt->error;
    }

    $updateStmt->close();
    $moveStmt->close();
    $deleteStmt->close();
    $conn->close();
}
?>
