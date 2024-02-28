<?php

$hostName = 's3lkt7lynu0uthj8.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$userName = "dyznxb7rp5vjock6";
$password = "jg4kvhegkcqiuhsk";
$databaseName = "u90gukapaglgwx54";
$conn = mysqli_connect($hostName, $userName, $password, $databaseName);

if (mysqli_connect_errno()) {
 echo "Failed to connect";
 exit();
}
//echo "Connection success!";
?>