<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    background-color: #f4f4f4;
}

#sidebar {
    height: 100vh;
    width: 220px;
    position: fixed;
    background-color: #003366;
    color: white;
    padding-top: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    border-radius: 0 15px 15px 0;
}

#sidebar h1 {
    text-align: center;
    margin-bottom: 20px;
    letter-spacing: 1px;
}

#sidebar a {
    padding: 12px 15px;
    text-decoration: none;
    font-size: 16px;
    color: white;
    display: block;
    transition: background-color 0.3s;
    text-align: left;
}

#sidebar a:hover {
    background-color: #0055A4;
}

#sidebar a.pets-link {
    font-weight: bold; /* Bold for emphasis */
    font-size: 18px; /* Slightly larger font */
    color: #FFD700; /* Gold color for emphasis */
}

#sidebar a i {
    margin-right: 5px;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<div id="sidebar">
    <h1>VetCare</h1>
    <a href="dashboard.php" class="pets-link"><i class="fas fa-paw"></i> My Pets</a>
    <a href="myinfo.php"><i class="fas fa-user"></i> My Information</a>
    <a href="pet_Appointment.php"><i class="fas fa-calendar-alt"></i>Schedule Apppointment</a>
    <a href="schedApp.php"><i class="fas fa-calendar-alt"></i> Appointments</a>
    <a href="historyPet.php"><i class="fas fa-calendar-alt"></i> Pets History</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>