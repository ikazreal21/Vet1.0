<?php 
include_once('sidebar.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Service</title>
    <meta http-equiv="refresh" content="100">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
body {
    font-family: "Arial", "Helvetica Neue", "Helvetica", sans-serif;
    background-color: #f4f4f4;
}

h2 {
    color: #333;
}

.container {
    background-color: #fff;
    max-width: 1200px;
    margin: 0px auto;
    padding: 20px;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    position: relative;
    top: 20px;
    left: 8%;
}

form label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    color: #555;
}

form input[type="text"],
form textarea,
form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

form select {
    height: 40px;
}

form input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #2980b9;
}

a {
    color: #333;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
    font-weight: bold;
    transition: color 0.3s ease;
}

a:hover {
    color: #555;
}
</style>
<body>

    <div class="container">
    <h2>Create Service</h2>
    <hr>
        <form method="post" action="create_services.php">
            <label for="title">Title:</label>
            <input type="text" name="title" required><br>
            <label for="description">Description:</label>
            <textarea rows="10"name="description" required></textarea><br>
            <label for="price">Price:</label>
            <input type="text" name="price" required><br>
            <label for="status">Status:</label>
            <select name="status" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select><br>
            <label for="duration">Duration:</label> <!-- Changed label to "Duration" -->
            <input type="text" name="duration" placeholder="HH:MM" value=""><br><br>
            <input type="submit" value="Create">
        </form>
        <a href="services.php">Back to Services</a>
    </div>
</body>
<script>
document.getElementById("durationInput").addEventListener("input", function() {
    var input = this.value;
    if (!/^\d{1,2}:\d{1,2}$/.test(input)) {
        // If the input does not match the format HH:MM, clear the input
        this.value = "";
    }
});
</script>

</html>

<?php
// Include your database connection file
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];

    // Sanitize input
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $price = floatval($price); // Convert to float
    $status = mysqli_real_escape_string($conn, $status);

    // Insert the new service into the database
    $sql = "INSERT INTO services (title, description, price,time_consume, status) VALUES ('$title', '$description', $price, '$duration ' ,'$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: services.php");
    } else {
        echo "Error creating service: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

?>
