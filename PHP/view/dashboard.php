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

         <div id="video-container">
           

        </div>

       <header class="main-header">
            <div class="logo"><b>LyteStorage</b></div>

            <div class="view-toggle">
                <button id="view-photos" class="toggle-btn active" onclick="switchView('photos')">Photos</button>
                <button id="view-videos" class="toggle-btn" onclick="switchView('videos')">Videos</button>
            </div>

            <button class="logout-btn" onclick="handleLogout()">Logout</button>
        </header>

        <label for="sync-upload" class="floating-sync" title="Upload Photo">
            <b>Sync</b>
        </label>
        <input type="file" id="sync-upload" accept="image/*, video/*" style="display: none;" webkitdirectory directory multiple>


        <label for="file-upload" class="floating-plus-btn" title="Upload Photo">
            <b>+</b>
        </label>
        <input type="file" id="file-upload" accept="image/*, video/*" style="display: none;" multiple>


    </div>

    
       <div id="uploadStatus" class="status-msg"></div>


       <div id="photo-viewer" class="modal">
            <span class="close-viewer">&times;</span>
            <img class="modal-content" id="full-image">
            <video style="display: none;" class="modal-content" id="full-video" controls></video>
            <div id="caption"></div>
            <div class="modal-toolbar">
                <button id="btn-download" class="action-btn">Download</button>
                <button id="btn-delete" class="action-btn delete">Delete</button>
            </div>
        </div>



        



</body>
<script src="../scripts/dashboard.js"></script>
</html>