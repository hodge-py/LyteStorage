<?php

session_start();

header('Content-Type: application/json');

require_once 'config.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($data['filepath'])) {
        $filepath = $data['filepath'];

        $fileName = basename($filepath);

        if (file_exists($filepath)) {
            unlink($filepath);
        }

        $sql = "DELETE FROM photos WHERE user_id = :id AND filename = :filename";
        $stmt = $pdo->prepare($sql);

        $data = [
            'id' => $_SESSION['id'],
            'filename' => $filepath
        ];

        $records = $stmt->rowCount();

        if ($stmt->execute($data)) {
            echo json_encode(['status' => 'success', 'message' => json_encode($records). $fileName . $_SESSION['id'] . ' deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete photo from database.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Filepath not provided.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}





?>