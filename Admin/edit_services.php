<!DOCTYPE html>
<html>
<head>
    <title>Edit Service</title>
    <meta http-equiv="refresh" content="100">
    <link rel="stylesheet" type="text/css" href="style.css">
<style>
body {
    font-family: "Arial", "Helvetica Neue", "Helvetica", sans-serif;
    margin: 0;
    padding: 0;
    background-color: #234E70;
}

.container {
    max-width: 1200px;
    margin: 25px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h2 {
    text-align: center;
    color: #234E70;
    font-size: 30px;
}

hr {
    border: 1px solid #ccc;
    margin: 20px 0;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

input[type="text"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

select {
    height: 40px;
}

input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 4px;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

a {
    display: block;
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
    color: #007BFF;
}

a:hover {
    text-decoration: underline;
}
</style>

</head>
<body>

<div class="container">
    <h2>Edit Service</h2>
    <hr>
    <?php
    // Check if the service ID is provided in the URL (use 'id' instead of 'ID')
    if(isset($_GET['id'])) {
        $service_id = $_GET['id'];
        
        // Include your database connection file
        include("db_connection.php");

        // Retrieve the service details from the database
        $sql = "SELECT * FROM services WHERE ID = $service_id";
        $result = $conn->query($sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $duration = $row['time_consume']; // Changed variable name to $duration
            $status = $row['status'];
            ?>
        
            <form method="post" action="update_service.php">
                <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
                <label for="title">Title:</label>
                <input type="text" name="title" value="<?php echo $title; ?>"><br>
                <label for="description">Description:</label>
                <textarea name="description" rows="10" cols="103"><?php echo $description; ?></textarea><br>
                <label for="price">Price:</label>
                <input type="text" name="price" value="<?php echo $price; ?>"><br>
                <label for="status">Status:</label>
                <select name="status">
                    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Available </option>
                    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>Not Available</option>
                </select><br>
                <label for="duration">Duration:</label> <!-- Changed label to "Duration" -->
                <input type="text" name="duration" value="<?php echo $duration; ?>"><br><br> <!-- Changed name to "duration" -->
                <input type="submit" value="Update">
            </form>
        
            <?php
        } else {
            echo "<p>Service not found.</p>";
        }
        
        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "<p>Service ID not provided.</p>";
    }
    ?>
    <a href="services.php">Back to Services</a>
</div>
<script>
    // Function to open the modal and load edit form content (you can use AJAX to load content)
    function openModal(userId) {
            var modal = document.getElementById("editModal");
            modal.style.display = "block";
        }

        // Check if the "id" parameter is present in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const userId = urlParams.get("id");
        
        if (userId) {
            // If the "id" parameter is present, call openModal with the user ID
            openModal(userId);
        }

    // Function to close the modal
    function closeModal() {
        var modal = document.getElementById("editModal");
        modal.style.display = "none";
    }
</script>
</body>
</html>
