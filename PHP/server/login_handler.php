<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: ../view/dashboard.php");
    exit;
}

require_once 'config.php';
// 1. Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "Please enter both username and password.";
        exit;
    }

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    
    $sql = "SELECT id, email, password FROM users WHERE email = :username";
        
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                //session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $user['id'];

                header("Location: ../view/dashboard.php"); 
                exit; 
            } else {
                echo "<h2>Login Failed</h2>";
                echo "<p>Invalid username or password.</p>";
                echo "<p><a href='../index.php'>Try again</a></p>";
            }
        } catch (PDOException $e) {
            die("ERROR: Could not execute query: $sql. " . $e->getMessage());

        }
        

    } else {
    header("Location: ../index.php");
    exit;
    }

?>