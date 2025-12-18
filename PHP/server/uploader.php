<?php

session_start();
header('Content-Type: application/json');

require_once 'config.php';
// 1. Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $uploaded = [];
    $errors = [];

    $fileCount = count($_FILES['files']['name']);

    for ($i = 0; $i < $fileCount; $i++) {
        if ($_FILES['files']['error'][$i] === UPLOAD_ERR_OK) {
            $tmpPath = $_FILES['files']['tmp_name'][$i];
            $newName = 'uploads/' . uniqid() . '-' . basename($_FILES['files']['name'][$i]);

            if (move_uploaded_file($tmpPath, $newName)) {
                $uploaded[] = $newName;
            } else {
                $errors[] = "Failed to move: " . $_FILES['files']['name'][$i];
            }
        }
    }

    echo json_encode(['uploaded' => $uploaded, 'errors' => $errors]);
}






?>