<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';

function displayImage($imageData, $imageType) {
    header('Content-Type: ' . $imageType); // Dynamic content type based on the image
    echo $imageData;
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $petId = $_GET['id'];

    // Check if we're just displaying the image
    if (isset($_GET['image'])) {
        $query = "SELECT pet_picture, image_type FROM pets WHERE id = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            echo "Error in query preparation: " . $conn->error;
            exit;
        }

        $stmt->bind_param("i", $petId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($imageData, $imageType);
            $stmt->fetch();

            if ($imageData !== null) {
                displayImage($imageData, $imageType);
            } else {
                echo "No image available.";
            }
        } else {
            echo "No pet found for this ID.";
        }

        $stmt->close();
        $conn->close();
        exit();
    }
    // Normal page rendering
    $query = "SELECT * FROM pets WHERE id = ?";
    $stmt = $conn->prepare($query);
if ($stmt) {
$stmt->bind_param("i", $petId);
$stmt->execute();
$result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $pet = $result->fetch_assoc();

        // Display pet details
        echo "<p>Name: " . htmlspecialchars($pet['pet_name']) . "</p>";
        echo "<p>Type: " . htmlspecialchars($pet['pet_type']) . "</p>";
        echo "<p>Breed: " . htmlspecialchars($pet['pet_breed']) . "</p>";

        // Check if birthdate is null and set a default value
        $birthdate = ($pet['pet_bday'] !== null) ? htmlspecialchars($pet['pet_bday']) : "Unknown";
        echo "<p>Birth Date: " . $birthdate . "</p>";

        echo "<p>Color: " . htmlspecialchars($pet['pet_color']) . "</p>";
        echo "<p>Neutered: " . htmlspecialchars($pet['neutered']) . "</p>";
        echo "<p>History: " . $pet['pet_history'] . "</p>";

        // Display image if available
        if (!empty($pet['pet_picture'])) {
            // Use a separate PHP script to display the image
            echo "<img src='" . $pet['pet_picture'] . "' alt='Pet Image' style='max-width: 300px; height: auto;'>";
        } else {
            echo "No image available.";
        }
    } else {
        echo "<p>No pet found for this ID.</p>";
    }
    $stmt->close();
} else {
    echo "<p>Error in query preparation.</p>";
}
} else {
echo "<p>Invalid Pet ID.</p>";
}

$conn->close();
?>