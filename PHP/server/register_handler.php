<?php

session_start();

require_once 'config.php';

// 1. Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $hashed_password, PDO::PARAM_STR);

    if ($stmt->execute()) {
        //echo "Record inserted successfully! New user ID: " . $pdo->lastInsertId();
    } else {
        //echo "Error: Could not execute the insert statement.";
    }
    
    $stmt = null;

    header("Location: ../index.php",true,303); 
    exit; // Always call exit after a header redirect
    
} else {
    // If the user tries to access this script directly without submitting the form
    header("Location: ../index.php",true,303);
    exit;
}

?>