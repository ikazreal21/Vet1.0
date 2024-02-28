<?php 
include("sidebar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Link your CSS file if you have one -->
    <title>Clients and Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin-left:18%;
            padding: 20px;
        }

        h2 {
            color: #234E70;
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
    </style>
</head>
<body>

<div class="container">

    <h2>Clients and Services Taken:</h2>
    <hr>
    <?php
    include("db_connection.php");

    $query = "SELECT * FROM `patients`";

    $result = mysqli_query($conn, $query);

        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Pet Name</th>";
        echo "<th>Phone No.</th>";
        echo "<th>Services Taken</th>";
        echo "</tr>";
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
    
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['pet_name'] . "</td>";
                    echo "<td>" . $row['contact'] . "</td>";
                    echo "<td>" . $row['service'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
        }else {
            echo "<tr><td colspan='6'>No clients and services taken</td></tr>";
        }  
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>

</div>

</body>
</html>
