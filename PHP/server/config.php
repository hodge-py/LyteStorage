<?php

$host = getenv('PMA_HOST');
$user = getenv('MYSQL_USER'); 
$password = getenv('MYSQL_PASSWORD'); 
$database = getenv('MYSQL_DATABASE');   

try {
    
    $dsn = "mysql:host=" . $host . ";dbname=" . $database . ";charset=utf8mb4";
    
    $pdo = new PDO($dsn, $user, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . "hey1 " . $host . $e->getMessage());
}

?>