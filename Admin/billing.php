<?php
include('sidebar.php');
include('db_connection.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize variables
$selectedClientId = isset($_POST['client']) ? $_POST['client'] : '';
$selectedServices = array(); // Initialize an empty array for selected services
$totalPrice = 0; // Initialize total price to 0
$doctorFee = isset($_POST['doctor_fee']) ? $_POST['doctor_fee'] : 0; // Default doctor fee to 0
$additionalFee = isset($_POST['additional_fee']) ? $_POST['additional_fee'] : 0; // Default additional fee to 0
$notes = isset($_POST['notes']) ? $_POST['notes'] : '';

// Function to get the item name from the database based on its price
function getItemName($conn, $price) {
    $itemNameQuery = "SELECT item_name FROM inventory WHERE price = $price";
    $itemNameResult = $conn->query($itemNameQuery);
    if ($itemNameResult && $itemNameResult->num_rows > 0) {
        $itemNameRow = $itemNameResult->fetch_assoc();
        return $itemNameRow['item_name'];
    }
    return "";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compute'])) {
    // Form submitted, update the database
    if ($selectedClientId) {
        // Fetch the selected client's services and their titles
        $serviceQuery = "SELECT p.service, s.title, s.price FROM patients p
        INNER JOIN services s ON FIND_IN_SET(s.title, p.service) > 0
        WHERE p.ID = $selectedClientId";

        $serviceResult = $conn->query($serviceQuery);
        if ($serviceResult) {
            // Fetch all the selected services
            while ($row = $serviceResult->fetch_assoc()) {
                $selectedServices[] = $row;
                // Add service price to total price
                $totalPrice += $row['price'];
            }
        } else {
            echo "Error fetching services: " . $conn->error;
        }

        // Fetch the total price based on the selected client
        $totalPriceQuery = "SELECT total FROM patients WHERE id = $selectedClientId";
        $totalPriceResult = $conn->query($totalPriceQuery);
        if ($totalPriceResult && $totalPriceResult->num_rows > 0) {
            $totalPriceRow = $totalPriceResult->fetch_assoc();
            $totalPrice = $totalPriceRow['total'];
        } else {
            echo "Error fetching total price: " . $conn->error;
        }

        // Add doctor fee to the total price
        $totalPrice += $doctorFee;

        // Add additional fee to the total price
        $totalPrice += $additionalFee;

        // Process selected product items
        if (!empty($_POST['inventory_item'])) {
            foreach ($_POST['inventory_item'] as $itemPrice) {
                $itemName = getItemName($conn, $itemPrice);
                if (!empty($itemName)) {
                    // Add the item price to the total price
                    $totalPrice += $itemPrice;
                    // Deduct the quantity of the selected item from the inventory
                    $updateInventoryQuery = "UPDATE inventory SET item_stocks = item_stocks - 1 WHERE item_name = '$itemName'";
                    $conn->query($updateInventoryQuery);
                }
            }
        }

        // Extract service titles from selected services
        $serviceTitles = array_column($selectedServices, 'title');
        $serviceString = implode(',', $serviceTitles);

        // Extract selected product items into a string
        $selectedItemsString = '';
        if (!empty($_POST['inventory_item'])) {
            $selectedItems = array();
            foreach ($_POST['inventory_item'] as $itemPrice) {
                $itemName = getItemName($conn, $itemPrice);
                if (!empty($itemName)) {
                    $selectedItems[] = "$itemName ($itemPrice)";
                }
            }
            $selectedItemsString = implode(', ', $selectedItems);
        }

        // Insert data into the billing database
        $insertQuery = "INSERT INTO billing (client, service, doctor, addfee, notes, total_price, product_item) 
                        VALUES ('$selectedClientId', '$serviceString', '$doctorFee', '$additionalFee', '$notes', '$totalPrice', '$selectedItemsString')";

        if ($conn->query($insertQuery)) {
            echo "Billing information successfully inserted into the database.";
        } else {
            echo "Error inserting billing information: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="100">
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Make sure to link your CSS file -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <title>Admin Dashboard - Billing</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .content {
            margin-top: -20px;
            margin-left: 250px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #234E70;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        select, input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        .service-list {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        .service-list li {
            background-color: #f0f0f0;
            padding: 8px;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        .notes-section {
            margin-top: 10px;
        }

        .notes {
            color: #555;
            font-style: italic;
        }

        .total-price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
<body>
    <br>    
    <div class="content">
        <h1 class="h1">Billing</h1>
        <hr>

        <form id="invoiceForm" action="billing.php" method="post">
            <input type="hidden" name="client" value="<?php echo $selectedClientId; ?>">
            <label for="client">Client:</label>
            <select name="client" id="client">
                <?php
                $clientQuery = "SELECT ID, NAME, service FROM patients";
                $clientResult = $conn->query($clientQuery);

                if ($clientResult->num_rows > 0) {
                    while ($row = $clientResult->fetch_assoc()) {
                        $clientId = $row['ID'];
                        $clientName = $row['NAME'];
                        $selected = ($selectedClientId == $clientId) ? 'selected' : '';

                        echo "<option value='$clientId' $selected>$clientName</option>";
                    }
                } else {
                    echo "<option value='' disabled>No clients found</option>";
                }
                ?>
            </select>
            <br>
            <br>

            <!-- New input field for doctor fee -->
            <label for="doctor_fee">Doctor Fee:</label>
            <input type="text" name="doctor_fee" id="doctor_fee" value="<?php echo $doctorFee; ?>" placeholder="Enter doctor fee">
            <br>

            <!-- New input field for additional fee -->
            <label for="additional_fee">Additional Fee:</label>
            <input type="text" name="additional_fee" id="additional_fee" value="<?php echo $additionalFee; ?>" placeholder="Enter additional fee">
            <br>

            <label for="inventory_item">Product Item:</label>
<select name="inventory_item[]" id="inventory_item" multiple>
    <?php
    // Query to fetch items and prices from the inventory table
    $inventoryQuery = "SELECT item_name, price FROM inventory";
    $inventoryResult = $conn->query($inventoryQuery);

    // Check if there are items in the inventory
    if ($inventoryResult->num_rows > 0) {
        // Loop through each row of the result set
        while ($row = $inventoryResult->fetch_assoc()) {
            $itemName = $row['item_name'];
            $price = $row['price'];

            // Output an option element for each item
            echo "<option value='$price'>$itemName - $price</option>";
        }
    } else {
        // Output a default option if no items are found
        echo "<option value='' disabled>No items found</option>";
    }
    ?>
</select>
<input type="number" name="item_quantity[]" placeholder="Quantity" min="1" value="1">
<br>

            <!-- New input field for notes -->
            <label for="notes">Notes:</label>
            <textarea name="notes" id="notes" rows="4" placeholder="Enter notes"><?php echo $notes; ?></textarea>
            <br>

            <!-- Display services and doctor's fee -->
            <label>Description and Prices:</label>
            <ul class="service-list">
                <?php
                // Display services taken
                if (!empty($selectedServices)) {
                    echo "<div style='margin-top: 10px;'>";
                    echo "<b>Services Taken:</b>";
                    echo "<ul style='list-style-type: none; padding-left: 0;'>";
                    foreach ($selectedServices as $service) {
                        echo "<li style='margin-top: 5px;'>";
                        echo "<span style='font-weight: bold;'>{$service['title']}</span> - <span style='color: #007bff;'>{$service['price']}</span>";
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                }

                // Display doctor's fee
                if (!empty($doctorFee)) {
                    echo "<div style='margin-top: 10px;'>";
                    echo "<b>Doctor's Fee:</b>";
                    echo "<ul style='list-style-type: none; padding-left: 0;'>";
                    echo "<li style='margin-top: 5px;'>Doctor's Fee - <span style='color: #007bff;'>$doctorFee</span></li>";
                    echo "</ul>";
                    echo "</div>";
                }

                // Display additional fee
                if (!empty($additionalFee)) {
                    echo "<div style='margin-top: 10px;'>";
                    echo "<b>Additional Fee:</b>";
                    echo "<ul style='list-style-type: none; padding-left: 0;'>";
                    echo "<li style='margin-top: 5px;'>Additional Fee - <span style='color: #007bff;'>$additionalFee</span></li>";
                    echo "</ul>";
                    echo "</div>";
                }

                // Display selected product items if any
                if (!empty($_POST['inventory_item'])) {
                    echo "<div style='margin-top: 10px;'>";
                    echo "<b>Selected Product Item(s):</b>";
                    echo "<ul style='list-style-type: none; padding-left: 0;'>";
                    foreach ($_POST['inventory_item'] as $itemPrice) {
                        // Query to fetch the item name based on the selected item's price
                        $itemNameQuery = "SELECT item_name FROM inventory WHERE price = $itemPrice";
                        $itemNameResult = $conn->query($itemNameQuery);

                        if ($itemNameResult->num_rows > 0) {
                            $itemNameRow = $itemNameResult->fetch_assoc();
                            $itemName = $itemNameRow['item_name'];
                            echo "<li style='margin-top: 5px;'>";
                            echo "<span style='font-weight: bold;'>$itemName</span> - <span style='color: #007bff;'>$itemPrice</span>";
                            echo "</li>";
                            // No need to add the price again to the total since it's already added before
                        }
                    }
                    echo "</ul>";
                    echo "</div>";
                }
                ?>
            </ul>

            <!-- Display the note alongside the services -->
            <div class="notes-section">
                <p class="notes">Notes: <?php echo $notes; ?></p>
            </div>

            <p class="total-price">Total Price: <?php echo $totalPrice; ?></p>
            <input type="submit" name="compute" value="Compute" onclick="submitForm();">
        </form>
    </div>
    <script>
        // Function to submit the form when the "Compute" button is clicked
        function submitForm() {
            document.getElementById('invoiceForm').submit();
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
