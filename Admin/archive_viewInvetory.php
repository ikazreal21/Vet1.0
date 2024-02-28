<?php
include("db_connection.php");

// Function to recover an archived item
function recoverItem($conn) {
    if(isset($_POST['itemId'])) {
        $itemId = $_POST['itemId'];
        $itemId = mysqli_real_escape_string($conn, $itemId);

        // Select the item from archive_inventory
        $selectQuery = "SELECT * FROM `archive_inventory` WHERE id = '$itemId'";
        $result = mysqli_query($conn, $selectQuery);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Fetch and process the item details
            $itemName = $row['item_name'];
            $itemDate = $row['item_date'];
            $itemExpiration = $row['item_expiration'];
            $itemStocks = $row['item_stocks'];

            // Delete the item from archive_inventory
            $deleteQuery = "DELETE FROM `archive_inventory` WHERE id = '$itemId'";
            if (mysqli_query($conn, $deleteQuery)) {
                // Insert the item into inventory
                $insertQuery = "INSERT INTO `inventory` (item_name, item_date, item_expiration, item_stocks) 
                                VALUES ('$itemName', '$itemDate', '$itemExpiration', '$itemStocks')";
                if (mysqli_query($conn, $insertQuery)) {
                    echo "<script>alert('Item successfully recovered and moved to inventory.');</script>";
                } else {
                    echo "<script>alert('Error inserting item into inventory: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                echo "<script>alert('Error deleting item from archive: " . mysqli_error($conn) . "');</script>";
            }
            // Free the result set
            mysqli_free_result($result);
        } else {
            echo "<script>alert('Item not found or error retrieving item.');</script>";
        }
    } else {
        echo "<script>alert('Item ID not provided.');</script>";
    }
}

// Function to permanently delete an archived item
function deleteItemPermanently($conn) {
    if(isset($_POST['itemId'])) {
        $itemId = $_POST['itemId'];
        $itemId = mysqli_real_escape_string($conn, $itemId);

        // Delete the item from archive_inventory
        $deleteQuery = "DELETE FROM `archive_inventory` WHERE id = '$itemId'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "<script>alert('Item permanently deleted.');</script>";
        } else {
            echo "<script>alert('Error deleting item: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Item ID not provided.');</script>";
    }
}

// Check if the request is made using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['recover'])) {
        recoverItem($conn);
    }
    if(isset($_POST['delete'])) {
        deleteItemPermanently($conn);
    }
}

// Fetch data from archive_viewInventory
$archiveQuery = "SELECT * FROM `archive_inventory`";
$archiveResult = mysqli_query($conn, $archiveQuery);

if (!$archiveResult) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Inventory View</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        header h1 {
            font-size: 2.5rem;
            color: #333;
        }

        main {
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f1f1f1;
            font-weight: bold;
            color: #666;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
        .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        position: inherit;
        transition: background-color 0.3s;
    }

    .back-button:hover {
        background-color: #0056b3;
    }
    .recover-button {
    background-color: #28a745; /* Green */
    color: #fff;
    border: none;
    padding: 10px 40px;
    cursor: pointer;
    border-radius: 4px;
}

.delete-button {
    background-color: #dc3545; /* Red */
    color: #fff;
    border: none;
    padding: 10px 40px;
    cursor: pointer;
    border-radius: 4px;
}

    </style>
<body>
    <h1>Archived Product List</h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Purchase Date</th>
                <th>Expiration Date</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($archiveRow = mysqli_fetch_assoc($archiveResult)) {
                echo "<tr>";
                echo "<td>{$archiveRow['item_name']}</td>";
                echo "<td>{$archiveRow['item_date']}</td>";
                echo "<td>{$archiveRow['item_expiration']}</td>";
                echo "<td>{$archiveRow['item_stocks']}</td>";
                echo "<td>
                        <form method=\"post\" action=\"\">
                            <input type=\"hidden\" name=\"itemId\" value=\"{$archiveRow['id']}\">
                            <button class=\"recover-button\" type=\"submit\" name=\"recover\">Recover</button>
                            <button class=\"delete-button\" type=\"submit\" name=\"delete\">Permanently Delete</button>
                        </form>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="archive.php" class="back-button">Go Back</a>
    <script>
        function recoverItem(itemId) {
            console.log('Recover item with ID:', itemId);
        }

        function deleteItemPermanently(itemId) {
            console.log('Permanently delete item with ID:', itemId);
        }
    </script>
</body>
</html>
