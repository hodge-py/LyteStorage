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
        <div id='logout'>
            <form style="display:flex;" action="../server/logout_handler.php" method="POST">
                <button id="logoutButton" type="submit">Logout</button>
            </form>
        </div>


        <div id="photo-container">


            


        </div>



    </div>
</body>
<script src="../scripts/dashboard.js"></script>
</html>