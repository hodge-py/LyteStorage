<?php

session_start();
header('Content-Type: application/json');

require_once 'config.php';
// 1. Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $sql = "INSERT INTO photos (user_id, filename, filepath, filesize) values (:id, :filename, :filepath, :filesize)";
    
    $uploaded = [];
    $errors = [];
    $fileCount = count($_FILES['files']['name']);

    for ($i = 0; $i < $fileCount; $i++) {
        if ($_FILES['files']['error'][$i] === UPLOAD_ERR_OK) {

            try{
                
                $tmpPath = $_FILES['files']['tmp_name'][$i];
                $newName = "images/" . uniqid() . '-' . basename($_FILES['files']['name'][$i]);

                if (move_uploaded_file($tmpPath, $newName)) {
                    $uploaded[] = $newName;
                } else {
                    $errors[] = "Failed to move: " . $_FILES['files']['name'][$i];
                }

                $stmt = $pdo->prepare($sql);

                $data = [
                    'id' => $_SESSION['id'],
                    'filename' => $_FILES['files']['name'][$i],
                    'filepath' => $newName,
                    'filesize' => $_FILES['files']['size'][$i]
                ];

                $stmt->execute($data);


        }
        catch (PDOException $e) {
            $errors[] = "Database error for file: " . $_FILES['files']['name'][$i] . " - " . $e->getMessage();
        }


        }
    }

    echo json_encode(['uploaded' => $uploaded, 'errors' => $errors]);
}






?>