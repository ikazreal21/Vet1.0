<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Users</title>
    <meta http-equiv="refresh" content="100">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
    table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding-top: 10px;
            padding-bottom: 20px;
            padding-left: 30px;
            padding-right: 40px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #234E70;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-edit {
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 4px;
    margin-right: 5px;
}

.btn-edit:hover {
    background-color: #0056b3;
}

.btn-delete {
    background-color: #dc3545;
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 4px;
}

.btn-delete:hover {
    background-color: #c82333;
}
/* Modal */
.modal {
    display: block;
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-content {
    background-color: #fefefe;
    margin: 15px auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    position: relative;
    top: 100px;
    border-radius: 20px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover {
    color: black;
    text-decoration: none;
}
.modal {
    display: none;
}

.update-form h1 {
    margin-bottom: 15px;
    font-size: 24px;
    color: #333;
}

/* Style form labels */
.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

/* Style form input fields */
.form-group input[type="text"],
.form-group input[type="password"],
.form-group select {
    width: 90%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 18px;
}

/* Style the select dropdown */
.form-group select {
    background-color: #fff;
}

/* Style submit button */
.btn-update {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-update:hover {
    background-color: #0056b3;
}
h1{
    color: #234E70;
}
    </style>
<body>
<?php 
include("sidebar.php");
?>
    <div class="content">
        <header>
            <h1>Users</h1>
            <hr>
        </header>
        <main>
        <?php
        include("db_connection.php");
        $sql = "SELECT * FROM register";
        $result = $conn->query($sql);
            echo "<table border='1' width='100%'>";
            echo "<tr>";
            echo "<th class='v1'><font style='Franklin Gothic' size='5cm'>ID</th>";
            echo "<th class='v1'><font style='Franklin Gothic' size='5cm'>Name</th>";
            echo "<th class='v1'><font style='Franklin Gothic' size='5cm'>Username</th>";
            echo "<th class='v1'><font style='Franklin Gothic' size='5cm'>Password</th>";
            echo "<th class='v1'><font style='Franklin Gothic' size='5cm'>Position</th>";
            echo "<th class='v1'><font style='Franklin Gothic' size='5cm'>Action</th>";

        if ($result->num_rows > 0) {
    
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='v2'><font style='Franklin Gothic' >" . $row['ID'] . "</td>";
                echo "<td class='v2'><font style='Franklin Gothic' >" . $row['Name'] . "</td>";
                echo "<td class='v2'><font style='Franklin Gothic' >" . $row['Username'] . "</td>";
                echo "<td class='v2'><font style='Franklin Gothic' >*****</td>"; // Replace actual password with asterisks
                echo "<td class='v2'><font style='Franklin Gothic' >" . $row['Position'] . "</td>";
                echo "<td>";
                echo "<a class='btn-edit' href='users.php?id=" . $row['ID'] . "' onclick='openModal(" . $row['ID'] . ")'>Edit</a>";
                echo "<a class='btn-delete' href='archive_user.php?id=" . $row['ID'] . "'>Archive</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No Users Found.</td></tr>";
        }
        ?>
        
        </main>
    </div>

    <div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <?php

        if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
            include("db_connection.php");
            $user_id = mysqli_real_escape_string($conn, $user_id);
            $sql = "SELECT * FROM register WHERE id = $user_id";
            $result = mysqli_query($conn, $sql);
    
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name = htmlentities($row['Name'], ENT_QUOTES, 'UTF-8');
                $username = htmlentities($row['Username'], ENT_QUOTES, 'UTF-8');
                $position = htmlentities($row['Position'], ENT_QUOTES, 'UTF-8');
                ?>
                <form method="post" action="update_user.php" class="update-form">
                    <h1>Update User Info</h1>
                    <hr>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php echo $name;?>">
                    </div>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password">
                    </div>

                    <div class="form-group">
                        <label for="position">Position:</label>
                        <select id="position" name="position" required>
                            <option value="Admin" <?php if ($position === 'Admin') echo 'selected'; ?>>Admin</option>
                            <option value="Staff" <?php if ($position === 'Staff') echo 'selected'; ?>>Staff</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-update">Update</button>
                </form>
                <?php
            } else {
                echo "<p>User not found.</p>";
            }

            // Close the database connection
            mysqli_close($conn);
        } else {
            echo "<p>User ID not provided.</p>";
        }
        ?>
    </div>
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
