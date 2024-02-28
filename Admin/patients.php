<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Patients</title>
    <meta http-equiv="refresh" content="100">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
      body {
            font-family: "Arial", "Helvetica Neue", "Helvetica", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .content header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-bar {
            display: flex;
            position: relative;
            top: 10px;
        }

        .search-bar input[type="text"] {
            margin-right: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            
            border: 1px solid #ddd;
            padding-top: 10px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            text-align: left;
        }

        th {
            background-color: #234E70;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-create {
            background-color: #008000;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-create:hover {
            background-color: darkgreen;
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
            position: relative;
            left: 5px;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
        .btn-Complete {
            background-color: green;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .btn-Complete:hover {
            background-color: darkgreen;
        }
        #patient-search {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        
        ::placeholder {
            color: #999; 
        }

        
        #patient-search:focus {
            border-color: #007bff; 
        }
        .search-button {
        padding: 10px 20px;
        background-color: #0072bc; /* Blue background color */
        color: #fff; /* White text color */
        border: none;
        border-radius: 5px; /* Rounded corners */
        font-size: 16px; /* Font size */
        cursor: pointer; /* Hover effect */
        }

        .search-button:hover {
            background-color: #0056b3; /* Darker blue color on hover */
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
        h1 {
            font-family: 'Times New Roman', Times, serif;
            margin-top: 20px;
            color: #234E70;
        }
        .apply{
        padding: 10px 20px;
        background-color: #0072bc;
        color: #fff; 
        border: none;
        border-radius: 5px; /* Rounded corners */
        font-size: 16px; /* Font size */
        cursor: pointer; /* Hover effect */
        }
        .limit{
            font-family: 'Times New Roman', Times, serif;
            color: black;
        }
    </style>
</head>
<body>
    <?php 
    include("db_connection.php");
    include('sidebar.php');
    ?>

    <div class="content">
        <header>
            <h1>Client</h1>
            <div class="search-bar">
                <form method="get" action="patients.php">
                    <input type="text" name="query" id="patient-search" placeholder="Search Patients">
                    <button type="submit" class="search-button">Search</button>
                </form>
            </div>
            <a href="create_patient.php" class="btn-create">Create New Patients data</a>
        </header>
        <hr>
        <div>
            <form method="get" action="patients.php">
                <label for="limit" class="limit">Select Number of Entries to Display:</label>
                <select name="limit" id="limit">
                    <option value="10" <?php echo (isset($_GET['limit']) && $_GET['limit'] == 10) ? 'selected' : ''; ?>>10</option>
                    <option value="20" <?php echo (isset($_GET['limit']) && $_GET['limit'] == 20) ? 'selected' : ''; ?>>20</option>
                    <option value="30" <?php echo (isset($_GET['limit']) && $_GET['limit'] == 30) ? 'selected' : ''; ?>>30</option>
                    <option value="all" <?php echo (isset($_GET['limit']) && $_GET['limit'] == 'all') ? 'selected' : ''; ?>>All</option>
                </select>
                <button type="submit" class="apply">Apply</button>
            </form>
        </div>
        <main>
            <?php
            // Check if a search query is provided in the URL
            $query = isset($_GET['query']) ? $_GET['query'] : '';

            // Check if a limit is provided in the URL, default to 10 if not.
            $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

            // Create an SQL query to search for patients with names that match the query
            $sql = "SELECT * FROM patients";
            if (!empty($query)) {
                $sql .= " WHERE name LIKE '%$query%'";
            }
            $sql .= " ORDER BY date_created DESC";

            if ($limit !== 'all') {
                $sql .= " LIMIT $limit";
            }

            $result = $conn->query($sql);
            echo "<table border='1' width='100%'>";
            echo "<tr>";
            echo "<th class='v1'><font style='Franklin Gothic' size='5cm'>Name</th>";
            echo "<th class='v1'><font style='Franklin Gothic' size='5cm'>Date Created</th>";
            echo "<th class='v1'><font style='Franklin Gothic' size='5cm'>Action</th>";
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='v2'><font style='Franklin Gothic' '>" . $row['name'] . "</td>";
                    echo "<td class='v2'><font style='Franklin Gothic' '>" . $row['date_created'] . "</td>";
                    echo "<td>";
                    echo "<a class='btn-edit' href='view_patients.php?id=" . $row['ID'] . "'>View</a>";
                    echo "<a class='btn-Complete' href='javascript:void(0);' onclick='completePatient(" . $row['ID'] . ")'>Complete</a>";
                    echo "<a class='btn-delete' href='javascript:void(0);' onclick='archivePatient(" . $row['ID'] . ")'>Archive</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<tr><td colspan='6'>No Client Found.</td></tr>";
            }

            $conn->close();
            ?>
        </main>
    </div>

    <script>
        function completePatient(patientId) {
    if (confirm("Are you sure you want to mark this patient as complete?")) {
        console.log("Completing patient with ID: " + patientId);

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "complete_patient.php?id=" + patientId, true);

        xhr.onreadystatechange = function () {
            console.log("ReadyState: " + xhr.readyState + ", Status: " + xhr.status);

            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    console.log("Response: " + xhr.responseText);
                    // Refresh the page after successful completion
                    window.location.reload();
                } else {
                    console.error("Error: " + xhr.status + " - " + xhr.statusText);
                }
            }
        };

        xhr.onerror = function () {
            console.error("Network error occurred");
        };

        xhr.send();
    }
}

        
function archivePatient(patientId) {
    if (confirm("Are you sure you want to archive this patient?")) {
        console.log("Archiving patient with ID: " + patientId);

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "archive_patients.php?id=" + patientId, true);

        xhr.onreadystatechange = function () {
            console.log("ReadyState: " + xhr.readyState + ", Status: " + xhr.status);

            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    console.log("Response: " + xhr.responseText);
                    // Refresh the page after successful archiving
                    window.location.reload();
                } else {
                    console.error("Error: " + xhr.status + " - " + xhr.statusText);
                }
            }
        };

        xhr.onerror = function () {
            console.error("Network error occurred");
        };

        xhr.send();
    }
}
</script>

</body>
</html>
