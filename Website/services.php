<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="100">
    <link rel="stylesheet" href="services.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <title>Services - VetCare</title>
</head>
<style>
        .service {
            cursor: pointer;
            border: 1px solid #ccc;
            margin: 20px;
            padding: 15px;
        }

        .service-details {
            display: none;
            margin: 10px;
            padding: 10px;
            background-color: #f0f0f0;
        }
    </style>
   
<body>
<?php include("navbar.php"); ?>
    <section id="landing__area" class="container__center">
    <h1>Our Services!</h1>
    <p>We offer a wide variety of professional dog training services as well as customized programs to meet your individual needs.</p>
    </section>
<?php
include('db_connection.php');
$sql="Select * from services";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="service" onclick="toggleDetails(' . $row['ID'] . ')">' . $row['title'] . '</div>';
        echo '<div id="details_' . $row['ID'] . '" class="service-details">';
        echo '<p>' . $row['description'] . '</p>';
        echo '<p>Price: P' . $row['price'] . ' (Price may vary) </p>';
        echo '<p>Duration: ' . $row['time_consume'] . '</p>'; // Display time duration
        echo '</div>';
    }
} else {
    echo "<p>No Services Available!</p>";
}?>
     <?php include('footer.php');?>
     <script>
        function toggleDetails(serviceId) {
            var details = document.getElementById('details_' + serviceId);
            if (details.style.display === 'none' || details.style.display === '') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        }
    </script>
</body>
</html>