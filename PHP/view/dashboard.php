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
            <div class="logo">
                <div id="title-app"><b>LyteStorage</b></div>
                <img id="icon" src="../static/icon/lytestorageicon.png"></img>
            </div>

            <div class="view-toggle">
                <button id="view-photos" class="toggle-btn active" onclick="switchView('photos')">Photos</button>
                <button id="view-videos" class="toggle-btn" onclick="switchView('videos')">Videos</button>
            </div>
            <div class="logout-wrapper">
            <button class="logout-btn" onclick="handleLogout()">Logout</button>
            </div>
        </header>

        
        <label id="sync" for="sync-upload" class="floating-sync" title="Upload Photo">
            <b>Sync</b>
        </label>
        <input type="file" id="sync-upload" accept="image/*, video/*" style="display: none;" webkitdirectory directory>


        <label id="multi-btn" for="file-upload" class="floating-plus-btn" title="Upload Photo">
            <b>+</b>
        </label>
        <input type="file" id="file-upload" accept="image/*, video/*" style="display: none;" multiple>



        <label id="delete-multi" for="button-delete-select" class="delete-select" title="">
            <b>DEL</b>
        </label>
        <input type="button" id="button-delete-select" accept="image/*, video/*" style="display: none;">


        <label id="download-multi" for="button-download-select" class="download-select" title="Download Selected">
            <b>D/L</b>
        </label>
        <input type="button" id="button-download-select" accept="image/*, video/*" style="display: none;" >


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