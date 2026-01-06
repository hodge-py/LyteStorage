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
    
    <div class="header">
        <h1 id="title">LyteStorage</h1>
        <a id="logoutButton" onclick="handleLogout()" class="logout-button">Logout</a>
    </div>

    <div class="container">
        <div id="fileSystem">
            <div id="fileHeader">
                <button><</button>
                <button>></button>
                <button id="addFolder">&plus; Folder</button>
                <div id="CurrentDirectory">
                    C:/root
                </div>
            </div>

            <div id="tableContainer">
                <table id="mainTable">
                    <tr>
                        <th class="column" id="nameColumn">Name</th>
                        <th class="column" id="typeColumn">Type</th>
                        <th class="column" id="sizeColumn">Size</th>
                    </tr>


                </table>
            </div>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js" integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../scripts/dashboard.js"></script>
</html>