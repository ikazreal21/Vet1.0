<?php
// Start the session
session_start();

// Include your database connection code
include_once("db_connection.php");

if (isset($_SESSION["adminUsername"]) && !empty($_SESSION["adminUsername"])) {
    // User is already logged in, redirect them to the appropriate dashboard
    $adminRole = $_SESSION["adminRole"];
    if ($adminRole === "Admin") {
        header("Location: dashboard.php");
    } elseif ($adminRole === "Staff") {
        header("Location: staff_dashboard.php");
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminUsername = $_POST["adminUsername"];
    $adminPassword = $_POST["adminPassword"];

    // Authenticate the user and retrieve their role from the database
    $query = "SELECT Position, password FROM register WHERE username = '$adminUsername'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row["password"];
        $userRole = $row["Position"];

        if ($adminPassword === $storedPassword) {
            // Store user information in session variables
            $_SESSION["adminUsername"] = $adminUsername;
            $_SESSION["adminRole"] = $userRole;

            // Log the login action to the database
            $loginAction = "Logged in";
            $insertQuery = "INSERT INTO login_logs (username, position, action, log_datetime) VALUES ('$adminUsername', '$userRole', '$loginAction', NOW())";
            mysqli_query($conn, $insertQuery);

            // Redirect based on user's role
            if ($userRole === "Admin") {
                header("Location: dashboard.php");
            } elseif ($userRole === "Staff") {
                header("Location: staff_dashboard.php");
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Admin username not found. Please check your credentials.');</script>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="100">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="Login.css">
</head>
<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #234E70;
    background-size: cover;
}

.container {
    background: white;
    padding: 20px;
    border-radius: 50px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.form-container {
    margin: 0 auto;
    text-align: center;
}

.form-container h2 {
    margin-bottom: 20px;
}

.form-group {
    position: relative;
    margin-bottom: 20px;
}

.form-group input {
    width: 90%;
    padding: 10px;
    padding-left: 40px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.form-group .icon {
    position: absolute;
    top: 10px;
    left: 10px;
    color: #777;
}

.show-password {
    display: inline-flex;
    margin-top: 10px;
}

button {
    width: 100%;
    padding: 10px;
    background: #0055A4;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background: #003366;
}

a {
    color: #0055A4;
}

a:hover {
    text-decoration: none;
}
</style>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Welcome to VetCare: Animal Clinic & Grooming Center</h2>
            <hr>
            <form action="Login.php" method="POST">
                <div class="form-group">
                    <i class="fas fa-user icon"></i>
                    <input type="text" id="adminUsername" name="adminUsername" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock icon"></i>
                    <input type="password" id="adminPassword" name="adminPassword" placeholder="Password" required>
                    <label class="show-password">
                        <input type="checkbox" id="showPassword">Show Password
                    </label>
                </div>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
    <script>
        const showPasswordCheckbox = document.getElementById("showPassword");
        const adminPasswordInput = document.getElementById("adminPassword");

        showPasswordCheckbox.addEventListener("change", function () {
            if (showPasswordCheckbox.checked) {
                adminPasswordInput.type = "text";
            } else {
                adminPasswordInput.type = "password";
            }
        });
    </script>
</body>
</html>


