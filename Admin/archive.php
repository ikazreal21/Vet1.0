<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Archives</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        text-align: center;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin: 20px;
    }

    .dashboard-card {
        background-color: #ffffff;
        padding: 20px;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 30%; /* Adjust width for larger screens */
        margin-bottom: 20px;
        box-sizing: border-box;
        border-radius: 8px;
        transition: transform 0.3s ease-in-out;
    }

    .dashboard-card:hover {
        transform: scale(1.05);
    }

    .dashboard-card h2 {
        background-color: #234E70;
        color: #fff;
        padding: 10px;
        margin-top: 0;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    h1 {
        font-family: 'Times New Roman', Times, serif;
        text-align: center;
        margin-top: 20px;
        color: #2c3e50;
    }

    p {
        font-size: 18px;
        color: #666666;
    }

    .actions {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    }

    .action-view{
        padding: 15px;
        width: 100%;
        background-color: #408EC6;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }
    .action-recover{
        padding: 15px;
        width: 60px;
        background-color: #2BAE66;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }

    .action-delete{
        padding: 15px;
        width: 60px;
        background-color: red;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }

    /* Responsive Styling */
    @media (min-width: 769px) {
        .dashboard-card {
            width: 48%; /* Two cards per row with a small gap */
            margin-right: 1%; /* Add a small gap between cards */
        }
    }

    @media (max-width: 768px) {
        .dashboard-card {
            width: 100%; /* Full width for smaller screens */
            margin-right: 0; /* No gap between cards */
            margin-bottom: 20px; /* Add margin to separate cards */
        }
    }
</style>
<?php 
include_once('sidebar.php');
?>
<body>
    <div class="content">
        <header>
            <center><h1>Archives</h1></center>
            <hr>
        </header>
        <main>
            <div class="container">
                
                <div class="dashboard-card">
                    <h2>Inventory</h2>
                    <p>View, recover, and delete inventory records.</p>
                    <div class="actions">
                        <a href="archive_viewInvetory.php" class="action-view">View</a>
                        

                    </div>
                </div>

                
                <div class="dashboard-card">
                    <h2>Services</h2>
                    <p>Manage and perform actions on services data.</p>
                    <div class="actions">
                        <a href="archive_viewServices.php" class="action-view">View</a>
                    </div>
                </div>
                
                <div class="dashboard-card">
                    <h2>Patients</h2>
                    <p>Access and perform actions on patient records.</p>
                    <div class="actions">
                        <a href="archive_viewPatients.php" class="action-view">View</a>
                    </div>
                </div>
                
                <div class="dashboard-card">
                    <h2>Users</h2>
                    <p>View and manage user for your system.</p>
                    <div class="actions">
                        <a href="archive_viewUser.php" class="action-view">View</a>
                    </div>
                </div>
        
            </div>
        </main>
    </div>
</body>
</html>
