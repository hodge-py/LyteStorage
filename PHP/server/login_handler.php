<?php
session_start();
require_once 'config.php';
// 1. Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    
    $correct_username = "admin";
    $correct_password = "password123"; // In reality, this is a password hash!

    if ($username === $correct_username && $password === $correct_password) {
        
        // 4. Successful login: Start a session and redirect
        session_start(); // Start a session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        
        // Redirect the user to a secure dashboard or home page
        header("Location: dashboard.php"); 
        exit; // Always call exit after a header redirect
        
    } else {
        
        // 5. Failed login: Display an error
        echo "<h2>Login Failed</h2>";
        echo "<p>Invalid username or password.</p>";
        echo "<p><a href='../index.php'>Try again</a></p>";
        
    }
    
} else {
    // If the user tries to access this script directly without submitting the form
    header("Location: ../index.php");
    exit;
}

?>