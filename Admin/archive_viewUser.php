<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived User View</title>
    <!-- Include your CSS file if needed -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            margin: 20px 0;
            color: #343a40;
        }

        hr {
            border: 1px solid #dee2e6;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 1.5rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }

        tr:hover {
            background-color: #e2e6ea;
            transition: background-color 0.3s;
        }

        tbody td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .back-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .recover-button {
            background-color: #28a745; /* Green */
            color: #fff;
            border: none;
            padding: 15px 25px;
            cursor: pointer;
            border-radius: 4px;
        }

        .delete-button {
            background-color: #dc3545; /* Red */
            color: #fff;
            border: none;
            padding: 15px 25px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php
    // Include the database connection code
    include_once('db_connection.php');

    // Function to recover a user
    function recoverUser($userID, $conn) {
        // Fetch user details from the archive
        $query = "SELECT * FROM archive_users WHERE id = $userID";
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            echo "Error fetching user details: " . mysqli_error($conn);
            return;
        }
    
        $user = mysqli_fetch_assoc($result);
    
        // Insert user into the users table
        $insertQuery = "INSERT INTO register (name, username, password, position) 
                        VALUES ('{$user['name']}', '{$user['username']}', '{$user['password']}', '{$user['position']}')";
        $insertResult = mysqli_query($conn, $insertQuery);
    
        if (!$insertResult) {
            echo "Error restoring user to users database: " . mysqli_error($conn);
            return;
        }
    
        // Delete user from the archive
        $deleteQuery = "DELETE FROM archive_users WHERE id = $userID";
        $deleteResult = mysqli_query($conn, $deleteQuery);
    
        if ($deleteResult) {
            echo "User with ID $userID has been recovered and restored successfully.";
        } else {
            echo "Error deleting user from archive: " . mysqli_error($conn);
        }
    }
    

    // Function to permanently delete a user
    function deleteUserPermanently($userID, $conn) {
        $query = "DELETE FROM archive_users WHERE id = $userID";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "User with ID $userID has been permanently deleted.";
        } else {
            echo "Error deleting user with ID $userID: " . mysqli_error($conn);
        }
    }

    // Check if a recover or delete action is requested
    if (isset($_POST['action']) && isset($_POST['user_id'])) {
        $action = $_POST['action'];
        $userID = $_POST['user_id'];

        // Perform the requested action
        if ($action === 'recover') {
            recoverUser($userID, $conn);
        } elseif ($action === 'delete') {
            deleteUserPermanently($userID, $conn);
        }
    }

    // Fetch inventory data from the database
    $query = "SELECT * FROM archive_users";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    ?>

    <h1>Archived User List</h1>
    <hr>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Position</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display inventory records
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['password']}</td>";
                echo "<td>{$row['position']}</td>";
                echo "<td><button class=\"recover-button\" onclick=\"recoverUser({$row['id']})\">Recover</button>";
                echo "&nbsp;<button class=\"delete-button\" onclick=\"deleteUserPermanently({$row['id']})\">Permanently Delete</button></td>";
                echo "</tr>";
            }

            // Free result set
            mysqli_free_result($result);

            // Close the database connection
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    <a href="archive.php" class="back-button">Go Back</a>
    <script>
    function recoverUser(userID) {
        // Send AJAX request to recover user
        sendActionRequest('recover', userID);
    }

    function deleteUserPermanently(userID) {
        // Send AJAX request to permanently delete user
        sendActionRequest('delete', userID);
    }

    function sendActionRequest(action, userID) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'archive_viewUser.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
                // Refresh page after action is completed
                location.reload();
            }
        };
        xhr.send('action=' + action + '&user_id=' + userID);
    }
    </script>

</body>
</html>
