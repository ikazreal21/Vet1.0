<?php
session_start();

// Check if pet selection form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pet_id'])) {
    // Set the pet_id in session
    $_SESSION['pet_id'] = $_POST['pet_id'];
    // Redirect to view appointments page
    header("Location: schedApp.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Management</title> 
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
        }

        #main-content {
            margin-left: 220px;
            padding: 20px;
            flex-grow: 1;
            background-color: #ffffff;
        }

        /* Buttons */
        .add-pet-button {
            background-color: #ff6600; /* Orangered */
            color: white;
            padding: 10px 20px;
            margin: 4px 2px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .add-pet-button:hover {
            background-color: #e55b00; /* Darker Orangered */
        }

        /* Modals */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            position: relative;
        }

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* Form Styles */
        input[type=text], 
        input[type=date],
        select, 
        textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #0056b3; /* Blue */
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #004494; /* Darker Blue */
        }

        /* Table Styles */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 12px 15px; /* Increase padding for better spacing */
        }

        th {
            background-color: #0056b3; /* Blue */
            color: white;
            font-weight: bold; /* Make header text bold */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Hover effect for table rows */
        tr:hover {
            background-color: #ddd;
        }

        /* Button style for action links */
        .action-button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 8px 16px; /* Adjust padding */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 5px; /* Adjust margin */
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease; /* Add smooth transition */
        }

        .action-button.view-button {
            background-color: #007bff; /* Blue */
        }

        .action-button.delete-button {
            background-color: #dc3545; /* Red */
        }

        .action-button:hover {
            background-color: #45a049; /* Darker Green */
        }

        .action-button.view-button:hover {
            background-color: #0056b3; /* Darker Blue */
        }

        .action-button.delete-button:hover {
            background-color: #c82333; /* Darker Red */
        }

        .pet-image {
            max-width: 300px;
            height: auto;
            margin-bottom: 20px;
        }

        .pet-info {
            padding: 20px;
        }

        .pet-name {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .pet-info p {
            margin-bottom: 8px;
            font-weight: bold; /* Make details bold */
        }

        /* Responsive Design */
        @media screen and (max-width: 600px) {
            .modal-content {
                width: 95%;
                margin: 20% auto;
            }
        }
    </style>
</head>
<body>

<?php include("sidebar.php");?>
<div id="main-content">
    <h1>Welcome, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>!</h1>
    <hr>
    <button id="add-pet-btn" class="add-pet-button">Add Pet</button>
    <!-- Add pet modal -->
    <div id="petModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add a New Pet</h2>
            <form method="POST" action="add_pets.php" enctype="multipart/form-data">
                <input type="text" id="pet_name" placeholder="Enter pet's name" name="pet_name" required>
                <label for="pet_gender">Gender:</label>
                <select id="pet_gender" name="pet_gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <label for="pet_type">Pet Type:</label>
                <select id="pet_type" name="pet_type">
                    <option value="dog">Dog</option>
                    <option value="cat">Cat</option>
                    <option value="other">Other</option>
                </select>
                <label for="pet_breed">Breed:</label>
                <input type="text" id="pet_breed" name="pet_breed">
                <label for="pet_bday">Date of Birth:(OPTIONAL)</label>
                <input type="date" id="pet_bday" name="pet_bday">
                <label for="pet_color">Color:</label>
                <input type="text" id="pet_color" name="pet_color">
                <label for="neutered" class="radio-inline">Neutered:
                    <input type="radio" id="neutered-yes" name="neutered" value="yes">Yes
                    <input type="radio" id="neutered-no" name="neutered" value="no">No
                </label>
                <br>
                <label for="pet_medicalhistory">Pet Medical History:</label>
                <textarea id="pet_medicalhistory" name="pet_medicalhistory" rows="4" cols="50"></textarea>
                <label for="pet_picture">Pet Picture:</label>
                <input type="file" id="pet_picture" name="pet_picture">
                <input type="submit" value="Save Pet">
            </form>
        </div>
    </div>
    <!-- Pet Details Modal -->
    <div id="viewPetModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeViewPetModal()">&times;</span>
            <div id="petDetails" class="pet-details">
                <!-- Pet details will be loaded here -->
            </div>
        </div>
    </div>

    <div class="pet-list">
        <h1>Your Pets</h1>
        <?php include('list_pets.php'); ?>
        <table>
            <thead>
                <tr>
                    <th>Pet Name</th>
                    <th colspan=2>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pets as $pet): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pet['pet_name']); ?></td>
                        <td><a href="javascript:void(0)" onclick="viewPet(<?php echo htmlspecialchars($pet['id']); ?>)" class="action-button view-button">View</a></td>
                        <td><a href="javascript:void(0)" onclick="deletePet(<?php echo htmlspecialchars($pet['id']); ?>)" class="action-button delete-button">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    // Get modal elements
    var petModal = document.getElementById("petModal");
    var viewPetModal = document.getElementById("viewPetModal");

    // Get button that opens the pet modal
    var btn = document.getElementById("add-pet-btn");

    // Get the <span> elements that close the modals
    var spanClosePetModal = document.getElementsByClassName("close")[0]; // Adjust index if necessary
    var spanCloseViewPetModal = document.getElementsByClassName("close")[1]; // Adjust index if necessary

    // Open the pet modal
    btn.onclick = function() {
        petModal.style.display = "block";
    };

    // Close the pet modal
    spanClosePetModal.onclick = function() {
        petModal.style.display = "none";
    };

    // Close the view pet modal
    spanCloseViewPetModal.onclick = function() {
        viewPetModal.style.display = "none";
    };

    // Close modal if user clicks outside of it
    window.onclick = function(event) {
        if (event.target == petModal) {
            petModal.style.display = "none";
        } else if (event.target == viewPetModal) {
            viewPetModal.style.display = "none";
        }
    };

    // Function to view pet details
    function viewPet(petId) {
        // AJAX request to fetch pet details
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "view_pet.php?id=" + petId, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                document.getElementById("petDetails").innerHTML = xhr.responseText;
                viewPetModal.style.display = "block";
            } else {
                alert("Error loading pet details");
            }
        };
        xhr.send();
    }

    // Function to close view pet modal (can be used if needed)
    function closeViewPetModal() {
        viewPetModal.style.display = "none";
    }

    function deletePet(petId) {
        if (confirm('Are you sure you want to delete this pet?')) {
            // Send an AJAX request to delete the pet
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_pet.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle response from the server, maybe update the UI accordingly
                    location.reload(); // For simplicity, just reload the page after deletion
                }
            };
            xhr.send('pet_id=' + encodeURIComponent(petId));
        }
    }
</script>

</body>
</html>
