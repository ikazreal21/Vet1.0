<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$hostName = 'localhost';
$userName = "root";
$password = "";
$databaseName = "db_vet";
$conn = mysqli_connect($hostName, $userName, $password, $databaseName);

if (mysqli_connect_errno()) {
 echo "Failed to connect";
 exit();
}
//echo "Connection success!";
?>