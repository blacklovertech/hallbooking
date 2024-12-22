<?php
// Define a flag to switch between SQLite and MySQL
// Set this to 'sqlite' for SQLite, or 'mysql' for MySQL
$database_type = 'sqlite';  // Change this to 'mysql' for MySQL

if ($database_type === 'sqlite') {
    // SQLite database connection details
    $sqlite_db = 'database.db';  // Path to your SQLite database file

    try {
        // Create SQLite connection
        $conn = new PDO("sqlite:$sqlite_db");
        
        // Set error mode to exceptions
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Handle connection errors
        echo "Connection failed: " . $e->getMessage();
        exit();
    }

    // You can now use $conn for your SQLite operations

} elseif ($database_type === 'mysql') {
    // MySQL database connection details
    $host = 'localhost';
    $dbname = 'your_database_name';
    $username = 'your_mysql_username';
    $password = 'your_mysql_password';

    try {
        // Create MySQL connection using PDO
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Set error mode to exceptions
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Handle connection errors
        echo "Connection failed: " . $e->getMessage();
        exit();
    }

    // You can now use $conn for your MySQL operations

} else {
    echo "Invalid database type specified.";
    exit();
}
?>
