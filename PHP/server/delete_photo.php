<?php

session_start();

header('Content-Type: application/json');

require_once 'config.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($data['filepath'])) {
        $filepath = urldecode($data['filepath']);

        $fileName = basename($filepath);

        $stmt = $pdo->prepare("SELECT * FROM photos WHERE user_id = :id AND filename = :filename");
        $stmt->execute([
            'id' => $_SESSION['id'],
            'filename' => $fileName
        ]);
        
        $photo = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($photo) {

            $sql2 = "DELETE FROM photos WHERE user_id = :id AND filename = :filename";
            $stmt2 = $pdo->prepare($sql2);
            $data2 = [
                'id' => $_SESSION['id'],
                'filename' => $fileName
            ];

            if ($stmt2->execute($data2)) {
                if (file_exists($filepath)) {
                    unlink($filepath);
                }
                echo json_encode(['status' => 'success', 'message' => 'Photo deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete photo from database.']);
            }
           
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Photo not found.' . $fileName]);
        }
        
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

}




?>