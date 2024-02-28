<?php
include("db_connection.php");

// Initialize variables
$notes = isset($_POST['notes']) ? $_POST['notes'] : '';
$totalPrice = 0;

// Define $selectedServices, $doctorFee, and $additionalFee or handle cases where they are not defined

// Assuming $selectedServices, $doctorFee, and $additionalFee are defined elsewhere in your code, or initialize them if not set
// Example initialization, replace with your actual initialization logic
$selectedServices = isset($selectedServices) ? $selectedServices : [];
$doctorFee = isset($doctorFee) ? $doctorFee : 0;
$additionalFee = isset($additionalFee) ? $additionalFee : 0;

// Calculate total price
// Add service prices
foreach ($selectedServices as $service) {
    $totalPrice += $service['price'];
}

// Add doctor fee
$totalPrice += $doctorFee;

// Add additional fee
$totalPrice += $additionalFee;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="100">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .invoice {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #234E70;
            font-size: 24px;
            margin-top: 0;
        }

        .header p {
            color: #555;
            font-size: 16px;
            margin-bottom: 0;
        }

        .content {
            margin-top: 0;
            margin-left: 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            font-size: 16px;
        }

        .table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
        }

        .payment-info {
            margin-top: 20px;
        }

        .payment-info label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .payment-info input[type="text"],
        .payment-info input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .payment-info input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 10px;
        }

        .payment-info input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .signature {
            margin-top: 20px;
            text-align: center;
        }

        .signature p {
            color: #555;
            font-style: italic;
            margin-bottom: 0;
        }

        .signature span {
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
    <title>Invoice</title>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <h1>Invoice</h1>
            <p>VetCare: Animal Clinic and Gromming Center</p>
            <p>2F Claveria Plaza, Circumferential Road, Brgy. Dalig Antipolo City</p>
            <p>Phone: 0935-783-3930</p>
            <p>Email: vetcare.aquino.ambe@gmail.com</p>
        </div>

        <div class="content">
            <form id="invoiceForm" action="invoice.php" method="post">
                <input type="hidden" name="client" value="<?php echo $selectedClientId; ?>">

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
                                $totalPrice += $itemPrice; // Add each selected item price to the total

                                // Deduct the quantity of the selected item from the inventory
                                $updateInventoryQuery = "UPDATE inventory SET item_stocks = item_stocks - 1 WHERE item_name = '$itemName'";
                                $conn->query($updateInventoryQuery);
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

                <div class="payment-info">
                    <label for="payment_method">Payment Method:</label>
                    <select name="payment_method" id="payment_method">
                        <option value="cash">Cash</option>
                        <option value="check">Check</option>
                        <option value="credit_card">Credit Card</option>
                    </select>

                    <label for="payment_amount">Payment Amount:</label>
                    <input type="text" name="payment_amount" id="payment_amount" placeholder="Enter payment amount">

                    <label for="payment_date">Payment Date:</label>
                    <input type="date" name="payment_date" id="payment_date" value="<?php echo date('Y-m-d'); ?>">

                    <input type="submit" name="submit_payment" value="Submit Payment">
                </div>
            </form>
        </div>

        <div class="signature">
            <p>Signature:</p>
            <span>______________________________</span>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
