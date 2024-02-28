<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="100">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <!-- font awesome -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LcVL-0oAAAAACDOhHDg6OBeB2VUhnSYYBIIp3U8" async defer></script>    <title>Contact Us - VetCare</title>
</head>
<style>
/* Styles for the popup message */
.popup-message {
    display: none;
    position: fixed;
    top: 0;
    left: 50%; /* Center horizontally */
    transform: translateX(-50%); /* Center horizontally exactly */
    width: 50%; /* Adjust the width as needed */
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Add a box shadow for a subtle effect */
    border-radius: 10px;
}

</style>
<body>
<?php include("navbar.php"); ?>
    <main>
        <section>
            <center>
                <h2>Contact Us</h2>
                <p>Have questions or need assistance? Feel free to contact us by filling out the form below.</p>
            </center>
            <div class="section-header">
                <div class="container">
                        <div class="contact-info">
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                <i class='bx bxs-home'></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Address</h4>
                                    <p>2F Claveria Plaza,<br/> Circumferential Road, <br/>Brgy. Dalig Antipolo City</p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                <i class='bx bxs-phone' ></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Phone</h4>
                                    <p>0935-783-3930</p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                <i class='bx bxs-envelope' ></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Email</h4>
                                    <p>vetcare.aquino.ambe@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="2" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=660&amp;height=400&amp;hl=en&amp;q=2F Claveria Plaza, Circumferential Road, Brgy. Dalig Antipolo City&amp;t=&amp;z=18&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://connectionsgame.org/">Connections Unlimited</a></div>
                <style>.mapouter{position:relative;text-align:right;width:100%;height:200px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:600px;}.gmap_iframe {height:700px!important;}</style>
                </div>
                </div>
                <div class="contact-form">
                <form action="contact.php" id="contact-form" method="post">
                        <h2>Send Message</h2>
                        <div class="input-box">
                            <input type="text" required="true" name="full_name" id="full_name" placeholder="Your Name">
                        </div>
                        <div class="input-box">
                            
                            <input type="email" required="true" name="email" id="email"  placeholder="e.g Example@gmail.com">
                        </div>
                        <div class="input-box">
                            <textarea required="true" name="message" id="message" placeholder="Message"></textarea>
                        </div>
                        <!-- Add reCAPTCHA widget here -->
                        <div class="g-recaptcha" data-sitekey="6LcVL-0oAAAAACDOhHDg6OBeB2VUhnSYYBIIp3U8"></div>
                        <div id="captcha-error" style="color: red;"></div>
                        <div class="input-box">
                            <input type="submit" value="Send" name="submit">
                        </div>
                    </form>
                        </div>
                        
            </section>
        </main>
        
        <?php include('footer.php');?>
        <div id="popup-message" class="popup-message">
                        Message has been sent!
                        </div>

        <script>
        // Function to show the popup message
        function showPopupMessage() {
        var popup = document.getElementById("popup-message");
        popup.style.display = "block";

        // Hide the message after 3 seconds (adjust as needed)
        setTimeout(function() {
            popup.style.display = "none";
        }, 3000); // 3000 milliseconds = 3 seconds
    }
        function initMap() {
            // Define the coordinates for the map (latitude and longitude)
            var myLatLng = { lat: 12.9716, lng: 77.5946 };

            // Create a new map centered at the specified coordinates
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,          // Adjust the initial zoom level as needed
                center: myLatLng   // Center the map at the specified coordinates
            });

            // Create a marker to indicate the location
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Your Location'
            });
        }
    </script>
    </body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form submission contains a valid email address
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
        echo "Invalid email address. Please provide a valid email.";
        exit; // Terminate the script
    }

    // Check if a CAPTCHA was submitted and verified
    $captchaSecret = '6LcVL-0oAAAAAB2kO75oJDUudSZiVg2r73_5Vxz8'; // Replace with your CAPTCHA secret key
    $userResponse = $_POST['g-recaptcha-response'];

    $captchaVerify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$captchaSecret&response=$userResponse");
    $captchaResponse = json_decode($captchaVerify);

    if (!$captchaResponse->success){
        echo "<script>document.getElementById('captcha-error').innerHTML = 'reCAPTCHA verification failed. Please try again.';</script>";
        exit; // Terminate the script
    }

    // Include your database connection code here
    include("db_connection.php");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact (name, email, message, datetime) VALUES ('$full_name', '$email', '$message', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo '<script>showPopupMessage();</script>'; // Call the JavaScript function to display the popup
        exit(); // Terminate the script
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>


