<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="100">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  </head>
  <style>
        /* Style for the welcome message */
        .welcome-message { 
            color: #001C85; 
            padding: 10px; 
            text-align: center; 
            font-family: 'Times New Roman', Times, serif;
            font-size: x-large;
            position: relative;
            bottom: 60px;
            font-family: 'Times New Roman', serif;
        }
        .logo{
            align-items: center;
            position: relative;
            left: 80px;
            top: 5px;
            border-radius: 100%;
        }
        .clickable {
            cursor: pointer;
            padding: 10px;
            background-color: #001C85 ;
            color: #fff;
            border: 1px solid #007bff;
            border-radius: 5px;
            align-items: center;
            margin: 5px;
            transition: background-color 0.2s;
        }

        .clickable:hover {
            background-color: #0056b3;
        }
        .settings-menu .submenu {
            display: none;
            list-style-type: none;
            padding-left: 20px;
        }

        .settings-menu:hover .submenu {
            display: block;
        }

        .submenu li {
            padding-top: 20px;
            margin-top: 10px;
        }

    </style>
    <body>
    <div class="sidebar">
    <img src="logo1.png" alt="Your Logo" class='logo'>
        <header><h2>Dashboard</h2></header>
        <ul>
            <li class="clickable" onclick="location.href='dashboard.php';">
                    <i class='bx bxs-home'></i> Home
            </li>
            <li class="clickable" onclick="location.href='appointments.php';">
                    <i class='bx bxs-calendar'></i> Appointments
            </li>
            <li class="clickable" onclick="location.href='patients.php';">
                    <i class='bx bxs-user'></i> Client
            </li>
            <li class="clickable" onclick="location.href='billing.php';">
                <i class='bx bxs-wallet'></i> Billings
            </li>
            <br>
            <li class="clickable" onclick="location.href='inventory.php';">
                    <i class='bx bxs-archive'></i> Monitoring
            </li>

            <li class="clickable" onclick="location.href='ServicesClient.php';">
                    <i class='bx bxs-archive'></i> Services
            </li>

            <!-- Settings Dropdown -->
    <li class="clickable settings-menu">
        <i class='bx bx-cog'></i> Settings
        <!-- Sub-menu -->
        <ul class="submenu">
            <li onclick="location.href='services.php';">
                <i class='bx bxs-briefcase'></i>Services
            </li>
            <li onclick="location.href='users.php';">
                <i class='bx bxs-user-circle'></i> Users
            </li>
            <li onclick="location.href='logs.php';">
                <i class='bx bx-history'></i>Logs
            </li>
            <li onclick="location.href='archive.php';">
                <i class='bx bxs-archive'></i> Archive
            </li>
        </ul>
    </li>

    <!-- Logout -->
    <li class="clickable" onclick="location.href='logout.php';">
        <i class='bx bxs-log-out'></i> Logout
    </li>
</ul>
        
    </div>
</body>
</html>
