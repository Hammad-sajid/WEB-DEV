<?php
// Database connection details
$dbServername = "localhost";
$dbUsername = "Hammad";
$dbPassword = "hammad.hassan.anytime";
$dbName = "anytime_eats_db";

// Create a new mysqli object for database connection
$con = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($con->connect_error) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}
?>
