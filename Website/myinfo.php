<?php
session_start();

include("db_connection.php"); // Include your database connection file
include("sidebar.php");

$userID = $_SESSION['user_id'] ?? null; // Replace 'user_id' with the actual session variable name

if (!$userID) {
    echo "User is not logged in.";
    exit;
}

// Fetch user information from the database
$query = "SELECT name,username, email, phone, address, password FROM clientregister WHERE id = ?"; // Adjust column names and table name as per your database schema
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No user information found.";
    exit;
}

$userInfo = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Information</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4; /* Light Grey Background */
    }
    .info-container {
        width: 100%;
        margin-left:220px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        background-color: #ffffff; /* White Background */
    }
    .info-container h2 {
        color: #ff6600; /* Orangered */
        text-align: left;
        font-size: 36px;
    }
    .info-item {
        margin: 10px 0;
        padding: 10px;
        font-size: 18px;
    }
    .edit-button {
        background-color: #0056b3; /* Blue */
        color: white;
        padding: 10px 20px;
        margin-top: 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
    }
    .edit-button:hover {
        background-color: #004494; /* Darker Blue */
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 10;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        width: 1000px;
        transform: scale(0.9);
        transition: transform 0.3s ease-in-out;
    }
    .modal.show .modal-content {
        transform: scale(1);
    }
    .close {
        color: #555;
        float: right;
        font-size: 28px;
        margin-left: 10px;
        cursor: pointer;
    }
    .close:hover {
        color: #000;
    }
    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }
    input[type=text], input[type=email], input[type=password] {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 18px;
    }
    input[type=submit] {
        background-color: #ff6600; /* Orangered */
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }
    input[type=submit]:hover {
        background-color: #e55b00; /* Darker Orangered */
    }
</style>

</head>
<?php include("sidebar.php");?>
<body>

<div class="info-container">
    <h2>My Information</h2>
    <hr>
    <div class="info-item"><strong>Name:</strong> <?php echo htmlspecialchars($userInfo['name']); ?></div>
    <div class="info-item"><strong>Username:</strong> <?php echo htmlspecialchars($userInfo['username']); ?></div>
    <div class="info-item"><strong>Address:</strong> <?php echo htmlspecialchars($userInfo['address']); ?></div>
    <div class="info-item"><strong>Email:</strong> <?php echo htmlspecialchars($userInfo['email']); ?></div>
    <div class="info-item"><strong>Phone:</strong> <?php echo htmlspecialchars($userInfo['phone']); ?></div>
    <div class="info-item"><strong>Password:</strong> <?php echo '*****'; ?></div>

    <button id="editProfileBtn" class="edit-button">Edit Profile</button>
    </div>

 <!-- The Modal -->
<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Profile</h2>
        <form action="update_profile.php" method="POST">
        <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userInfo['name']); ?>" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($userInfo['username']); ?>" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($userInfo['address']); ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userInfo['email']); ?>" required>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($userInfo['phone']); ?>">
            <!-- Password field can be added if you want to allow password changes -->
            <label for="password">Password (leave blank if not changing):</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Update Profile">
        </form>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("editProfileModal");
    var btn = document.getElementById("editProfileBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    };

    span.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
</script>
</body>
</html>