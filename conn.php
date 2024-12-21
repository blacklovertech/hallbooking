<?php
// Database credentials
$dbHost = "localhost"; 
$dbUser = "your_db_user";
$dbPass = "your_db_password";
$dbName = "your_database_name";

// Start session
session_start();

// Connect to the database
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user information from session
$userId = $_SESSION['user_id'];
?>
