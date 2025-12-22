<?php
// config.php

// Database credentials
define('DB_SERVER', 'db');
define('DB_USERNAME', 'root'); // CHANGE THIS
define('DB_PASSWORD', 'root_password'); // CHANGE THIS
define('DB_NAME', 'my_database');   // CHANGE THIS

try {
    // Create DSN (Data Source Name) string for connection
    $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    // Create a new PDO instance
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    
    // Set the PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // If connection fails, output the error and stop the script
    die("ERROR: Could not connect. " . $e->getMessage());
}

// $pdo variable now holds the database connection object
?>