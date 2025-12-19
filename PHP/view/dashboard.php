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
            <div class="logo"><b>LyteStorage</b></div>
            <button class="logout-btn" onclick="handleLogout()">Logout</button>
        </header>

        <label for="file-upload" class="floating-plus-btn" title="Upload Photo">
            +
        </label>
        <input type="file" id="file-upload" accept="image/*" style="display: none;" multiple>


    </div>

    
       <div id="uploadStatus" class="status-msg"></div>


       <div id="photo-viewer" class="modal">
            <span class="close-viewer">&times;</span>
            <img class="modal-content" id="full-image">
            <div id="caption"></div>
        </div>



</body>
<script src="../scripts/dashboard.js"></script>
</html>