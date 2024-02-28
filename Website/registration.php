<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <?php include("navbar.php")?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

</head>
<style>
        /* Fontawesome */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    display: flex;
    height: 80vh;
    align-items: stretch;
}

.left-section {
    background-image: url('bglog.png');
    background-repeat: no-repeat;
    background-position: center center;
    border-radius: 30%;
    position: relative;
    left: 5%;
    display: block; /* Change 'none' to 'block' if you want the element to be visible */
}


.right-section {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    
}

.login-container {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgb(10 75 90);
    width: 100%;
    max-width: 600px;
    position: relative;
    left: 6%;
    margin-top: 100px;
    
}

.login-form h2 {
    color: #ffb144;
    text-align: center;
    margin-bottom: 35px;
}

.login-title i {
    margin-right: 10px;
    color: #027186;
}

.form-control {
    position: relative;
    margin-bottom: 30px;
}

.form-control i {
    position: absolute;
    left: 15px;
    top: 14px;
    color: #32495e;
}

.form-control input {
    width: 100%;
    max-width: 95%;
    padding: 12px 0 12px 37px;
    border: 2px solid #00569f1c;
    background-color: rgb(232, 232, 232);
    color: rgb(50, 73, 94);
    border-radius: 6px;
    transition: all 0.3s ease-in-out 0s;
}

.form-control input:focus {
    outline: none;
    border: 2px solid #ffd8a1;
}

.form-control input:invalid:not(:focus):not(:placeholder-shown) {
    border: 2px solid #ff3860;
}

.remember-me {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.remember-me .checkbox-custom {
    width: 20px;
    height: 20px;
    margin-right: 10px;
    display: inline-block;
    vertical-align: middle;
    position: relative;
    border: 2px solid #027186;
    border-radius: 3px;
    cursor: pointer;
    background-color: #f7f7f7;
    transition: background-color 0.3s, border-color 0.3s;
    background-color: #f7f7f7;
    transition: background-color 0.3s, border-color 0.3s;
    pointer-events: none;
}

.remember-me .checkbox-custom::after {
    content: '';
    position: absolute;
    left: 5px;
    top: 1px;
    width: 6px;
    height: 11px;
    border: solid #027186;
    border-width: 0 3px 3px 0;
    transform: rotate(45deg);
    border: solid white;
    border-width: 0 2px 2px 0;
    display: none;
}

.remember-me label {
    color: #333;
    font-size: 0.95em;
    cursor: pointer;
}

.remember-me input[type="checkbox"] {
    display: none;
}

.remember-me input[type="checkbox"]:checked+.checkbox-custom::after {
    display: block;
}

.remember-me input[type="checkbox"]:checked+.checkbox-custom {
    background-color: #027186;
    border-color: #027186;
}

.social-login {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

.social-icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    line-height: 40px;
    text-align: center;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.fab.fa-google {
    background-color: #DB4437;
    color: white;
}

.fab.fa-facebook-f {
    background-color: #4267B2;
    color: white;
}

.fab.fa-twitter {
    background-color: #1DA1F2;
    color: white;
}

.fab.fa-google:hover {
    background-color: #e57373;
}

.fab.fa-facebook-f:hover {
    background-color: #5c7cfa;
}

.fab.fa-twitter:hover {
    background-color: #69c0ff;
}

button {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 12px;
    background-color: #ffaa33;
    color: white;
    font-size: 17px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: flex;
    justify-content: center;
    align-items: center;
}

button:hover {
    background-color: #405d7d;
}

/*Responsive*/
@media screen and (min-width: 768px) {
    .left-section {
        display: block;
        /* Show the left section on larger screens */
        flex: 1;
    }
}
    </style>
<body>
    <div class="container">
        <div class="left-section"></div>
        <div class="right-section">
            <div class="login-container">
            <form class="account-form" action="registration.php" method="post">
                    <h2 class="login-title"><i class="fas fa-user-plus"></i> Create an Account</h2>
                    <div class="form-control">
                        <i class="fas fa-user icon"></i>
                        <input type="text" placeholder="Username" name="newUsername" required>
                    </div>
                    <div class="form-control">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" placeholder="Email Address" name="email" required>
                    </div>
                    <div class="form-control">
                        <i class="fas fa-envelope icon"></i>
                        <input type="phone" placeholder="Phone No." name="phone" required>
                    </div>
                    <div class="form-control">
                        <i class="fas fa-lock icon"></i>
                        <input type="password" placeholder="Password" name="newPassword" required>
                    </div>
                    <div class="form-control">
                        <i class="fas fa-lock icon"></i>
                        <input type="password" placeholder="Confirm Password" name="confirmPassword" required>
                    </div>
                    <button type="submit">Create Account</button>
                </form>
                <center><p>Already have an account? <a href="login.php">Login here</a></p></center>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for additional functionality (if needed)
    </script>
</body>
<br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
<?php include('footer.php');?>
</html>
<?php
include_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["newUsername"];
    $email = $_POST["email"]; // Assuming you want to use email
    $phone = $_POST["phone"]; // Assuming you want to use phone
    $password = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM clientregister WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose a different one.";
    } else {
        // Insert the user data into the database
        $insertStmt = $conn->prepare("INSERT INTO clientregister (username, email, phone, password) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("ssss", $username, $email, $phone, $password); // Storing plain text password

        if ($insertStmt->execute()) {
            // Registration successful
            echo '<script>alert("Registration successful. Please proceed to login."); window.location.href = "login.php";</script>';
        } else {
            // Error occurred
            echo "Error: " . $conn->error;
        }
    }

    // Close the database connection
    $stmt->close();
    $insertStmt->close();
    $conn->close();
}
?>

