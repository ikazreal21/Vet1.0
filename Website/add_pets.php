<?php
ob_start();
session_start(); // Add this at the top
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "User is not logged in.";
    exit; // Or redirect to the login page
}

include("db_connection.php");
require_once '../vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

Configuration::instance([
    'cloud' => [
      'cloud_name' => 'dmagk9gck', 
      'api_key' => '964986345641993', 
      'api_secret' => 'sDSJ1IXtdVjMrMAkGxABuvS2wmo'],
    'url' => [
      'secure' => true]]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $petName = $_POST['pet_name'];
    $petGender = $_POST['pet_gender'];
    $petType = $_POST['pet_type'];
    $petBreed = $_POST['pet_breed']; // Assuming you have this field in your form
    $petBday = $_POST['pet_bday'] ?: NULL; // Handling optional date
    $petColor = $_POST['pet_color'];
    $petHistory = $_POST['pet_medicalhistory'];
    $petNeutered = $_POST['neutered'];
    $userID = $_SESSION['user_id'];

    if (empty($userID)) {
        echo "User ID is not set in the session.";
        exit;
    }

    $petPicture = NULL;
    if (isset($_FILES['pet_picture']) && $_FILES['pet_picture']['error'] == 0) {
        $allowed = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
        $filename = $_FILES['pet_picture']['name'];
        $filetype = $_FILES['pet_picture']['type'];
        $filesize = $_FILES['pet_picture']['size'];

        // Verify file extension

        // echo var_dump($picture);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        if (in_array($filetype, $allowed)) {
            // Check whether file exists before uploading it
            $picture = (new UploadApi())->upload($_FILES["pet_picture"]["tmp_name"]);
        } else {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    }

    // Prepare an insert statement
    $stmt = $conn->prepare("INSERT INTO pets (pet_name, user_id, pet_type, pet_gender, pet_bday, pet_color, pet_history, pet_breed, neutered, pet_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssssss", $petName, $userID, $petType, $petGender, $petBday, $petColor, $petHistory, $petBreed, $petNeutered, $picture['secure_url']);


    if ($stmt->execute()) {
        // header("Location: dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
