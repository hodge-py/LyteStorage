<?php

session_start();

header('Content-Type: application/json');

require_once 'config.php';
// 1. Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $directory = 'images/';
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
    
    
    $sql = "INSERT INTO photos (user_id, filename, filepath, filesize, capture_date) values (:id, :filename, :filepath, :filesize, :capture_date)";
    
    $uploaded = [];
    $errors = [];
    $fileCount = count($_FILES['files']['name']);
    $capture_date = '';

    for ($i = 0; $i < $fileCount; $i++) {
        if ($_FILES['files']['error'][$i] === UPLOAD_ERR_OK) {
            
            $sqlFile = "SELECT * FROM photos WHERE user_id = :id AND filename = :filename";
            $stmtFile = $pdo->prepare($sqlFile);
            $dataFile = [
                'id' => $_SESSION['id'],
                'filename' => $_FILES['files']['name'][$i]
            ];
            $stmtFile->execute($dataFile);
            $existingFile = $stmtFile->fetch(PDO::FETCH_ASSOC);

            if ($existingFile) {
                $errors[] = "File already exists: " . $_FILES['files']['name'][$i];
                continue; // Skip to the next file
            }
            else{

            try{
                $tmpPath = $_FILES['files']['tmp_name'][$i];
                $newName = "images/" .  basename($_FILES['files']['name'][$i]);
                
                $image_type = exif_imagetype($tmpPath);

                if ($image_type !== false) {
                    if ($image_type == IMAGETYPE_JPEG || $image_type == IMAGETYPE_TIFF_II || $image_type == IMAGETYPE_TIFF_MM) {
                    $exif_data = exif_read_data($tmpPath, 'ANY_TAG', true);
                    $capture_date = isset($exif_data['IFD0']['DateTime']) ? $exif_data['IFD0']['DateTime'] : date('Y-m-d H:i:s');
                    } else {
                    $capture_date = date('Y-m-d H:i:s');
                    }
                } else {
                    $capture_date = date('Y-m-d H:i:s');
                }

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
                    'filesize' => $_FILES['files']['size'][$i],
                    'capture_date' => $capture_date
                ];

                $stmt->execute($data);


        }
        catch (PDOException $e) {
            $errors[] = "Database error for file: " . $_FILES['files']['name'][$i] . " - " . $e->getMessage();
        }

    }
        }
    }

    echo json_encode(['uploaded' => $uploaded, 'errors' => $errors]);
}






?>