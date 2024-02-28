<?php 
include("sidebar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Concerns</title>
    <meta http-equiv="refresh" content="100">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
   body {
            font-family: "Arial", "Helvetica Neue", "Helvetica", sans-serif;
            background-color: #fff;
            }

    .content header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #234E70;
            color: #fff;
        }

        h1{
            color: #234E70;
        }
        .limit{
            font-family: 'Times New Roman', Times, serif;
            color: black;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-delete {
            background-color: red;
            color: #fff;
            width: 5%;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            position: absolute;
            top: 40px; /* Adjust the top position */
            right: 50px; /* Adjust the right position */
            text-align: center;
        }

        .btn-delete:hover {
            background-color: maroon;
                    }
                    label {
            font-size: 20px;
            margin-right: 10px;
        }
        select {
            padding: 10px;
            font-size: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #6CADF7;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            position: relative;
            left: 10px;
        }

        button:hover {
            background-color: #5F98D8;
        }

</style>
</head>
<body>
    <div class="content">
        <header>
            <h1>Concerns</h1>
        </header>
        <hr>
        <main>
            <?php
            include("db_connection.php");

            // Check if the "limit" form has been submitted
            if (isset($_POST['submit']) && isset($_POST['limit'])) {
                $limit = $_POST['limit'];
            } else {
                // Default limit
                $limit = 10;
            }

            // Define options for the select dropdown
            $options = [
                'today' => 'Today',
                '7days' => 'Last 7 Days',
                'all' => 'All Entries'
            ];

            $selectedOption = isset($_POST['limit']) ? $_POST['limit'] : '10';

            echo '<form method="post" action="">';
            echo '<label for="limit">Select Number of Entries to Display:</label>';
            echo '<select name="limit" id="limit">';
            
            foreach ($options as $value => $label) {
                $selected = ($selectedOption == $value) ? 'selected' : '';
                echo "<option value=\"$value\" $selected>$label</option>";
            }
            
            echo '</select>';
            echo '<button type="submit" name="submit">Apply</button>';
            echo '</form>';

            // Modify the SQL query based on the selected option
            if ($selectedOption == 'today') {
                $sql = "SELECT * FROM contact WHERE DATE(datetime) = CURDATE() ORDER BY datetime DESC";
            } elseif ($selectedOption == '7days') {
                $sql = "SELECT * FROM contact WHERE datetime >= CURDATE() - INTERVAL 7 DAY ORDER BY datetime DESC";
            } elseif ($selectedOption == 'all') {
                $sql = "SELECT * FROM contact ORDER BY datetime DESC";
            } else {
                $sql = "SELECT * FROM contact ORDER BY datetime DESC LIMIT $selectedOption";
            }

            $result = $conn->query($sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Email</th>";
                    echo "<th>Message</th>";
                    echo "<th>DateTime</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['message'] . "</td>";
                        echo "<td>" . $row['datetime'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<h2>No Concerns Found.</h2>";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </main>
    </div>
</body>
</html>
