<?php
// db_connection.php

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost'; // Your database host
$username = 'root'; // Your database username
$password = ''; // Your database password (default is empty for XAMPP)
$database = 'hotel_management'; // Your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
