<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // JavaScript for popup confirmation
    echo '<script>
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = "login.php"; // Redirect to the login page if confirmed
        } else {
            history.back(); // Go back to the previous page if canceled
        }
    </script>';
} else {
    // If the user is not logged in, destroy the session and redirect to the login page
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
