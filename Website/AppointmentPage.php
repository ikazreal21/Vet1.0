<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="100">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        /* Reset some default styles */
        /* Your CSS styles here */

        .container {
            max-width: 90%;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden; /* Prevent scrolling */
        }

        header {
            text-align: center;
            padding: 10px 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 15px;
            width: 100%;
        }

        .form-section {
            flex: 1;
            margin: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .owner-details, .pet-details {
            flex: 1;
            padding: 15px;
            background-color: whitesmoke;
            border-radius: 10px;
    
        }

        h2 {
            margin-bottom: 10px;
            font-size: 1.5em;
        }

        .form-group {
            margin-bottom: 10px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

/* Increase the width of the input fields */
input[type="text"],
input[type="email"],
input[type="tel"],
input[type="time"],
textarea,
select,
input[type="date"],
input[type="time"] {
    width: 100%; /* Change this to adjust the width as needed */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
}

textarea {
    resize: vertical;
}

select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}

button {
    background-color: dodgerblue ;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2em;
    margin-left: 400px;
    
}

button:hover {
    background-color: darkblue;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

.social-icons a {
    color: #fff;
    margin: 0 10px;
    font-size: 1.2em;
    text-decoration: none;
}

/* Responsive design for smaller screens (e.g., mobile devices) */
@media (max-width: 768px) {
    .form-section {
        flex: 1;
        margin: 10px 0;
    }
}

.terms-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            text-align: center; /* Center-align the content within the container */
        }
        
        .terms-text {
            font-size: 14px;
        }
        
        .terms-checkbox {
            display: flex;
            align-items: center;
            justify-content: center; /* Center-align the checkbox and label horizontally */
        }
        
        .checkbox-label {
            margin-left: 10px;
        }
    </style>
    
    <link rel="stylesheet" href="Appointment.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <title>Appointment - VetCare</title>
    <!-- Landing Area -->
    <?php include("navbar.php"); ?>
</head>
<body>
    <div class="container">
    <header>
            <h1>Pet Owner Application Form</h1>
        </header>   
        <form action="process_form.php" method="POST">
            <div class="form-section owner-details">
                
                <h2>Owner Details</h2>
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
                    <label for="calendar">Appointment Date:</label>
                    <input type="date" id="calendar" name="calendar" min="" required>
                </div>
                <div class="form-group">
                <label for="appointment_time">Appointment Time:</label>
                <select id="appointment_time" name="appointment_time" required>
                    <option value="09:00:00">09:00 AM</option>
                    <option value="10:00:00">10:00 AM</option>
                    <option value="11:00:00">11:00 AM</option>
                    <option value="14:00:00">02:00 PM</option>
                    <option value="15:00:00">03:00 PM</option>
                    <!-- Add more time slots as needed -->
                </select>
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
</div>

            <div class="form-section pet-details">
                <h2>Pet Details</h2>
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
                    <input type="text" id="pet_breed" name="pet_breed"required>
                </div>
                <div class="form-group">
                    <label for="pet_bday">Date of Birth:</label>
                    <input type="date" id="pet_bday" name="pet_bday" required>
                </div>
                <div class="form-group">
                    <label for="pet_color">Color:</label>
                    <input type="text" id="pet_color" name="pet_color" required>
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
                <div class="button">
                <button type="submit" class="button" id="book-now" onclick="return checkTermsAndBook()">Book Now</button>
            </div>
            </div>
        </form>
    </div>
            </div>
            </div>
            <div class="terms-container">
        <h3>Terms and Conditions</h3>
        <div class="terms-text">
            
            By checking the box below, you agree to the Terms and Conditions.
        </div>
        <div class="terms-checkbox">
            <input type="checkbox" id="accept-terms" name="accept-terms" >
            <label class="checkbox-label" for="accept-terms">I have read and accept the <u><a href="terms-condition.php" target="_blank">Terms and Conditions</a></label></u>
        </div>
        </div>
    <?php include('footer.php');?>

    <script>
        function checkTermsAndBook() {
        const acceptTermsCheckbox = document.getElementById("accept-terms");
        
        if (acceptTermsCheckbox.checked) {
            // Checkbox is checked; proceed to book now
            // You can put the booking functionality here
            alert("Booking successful!");
            return true; // Allow form submission
        } else {
            // Checkbox is not checked; show an error message
            alert("Please read and accept the terms and conditions.");
            return false;
        }
        }
        // Set the minimum date to today
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('calendar').min = today;
    </script>
</body>
</html>
