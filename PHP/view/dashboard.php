<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
} else{
    header("Location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../static/css/dashboard.css">
</head>
<body>
    <div class="container">
        <div id="photo-container">


            


        </div>

        <header class="main-header">
            <div class="logo">My App</div>
            <button class="logout-btn" onclick="handleLogout()">Logout</button>
        </header>

        <label for="file-upload" class="floating-plus-btn" title="Upload Photo">
            +
        </label>
        <input type="file" id="file-upload" accept="image/*" style="display: none;" multiple>


    </div>
</body>
<script src="../scripts/dashboard.js"></script>
</html>