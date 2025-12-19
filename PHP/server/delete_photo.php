<?php

session_start();

header('Content-Type: application/json');

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['filepath'])) {
        $filepath = $_POST['filepath'];

        // First, delete the file from the filesystem
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        // Then, delete the record from the database
        $sql = "DELETE FROM photos WHERE user_id = :id AND filepath = :filepath";
        $stmt = $pdo->prepare($sql);

        $data = [
            'id' => $_SESSION['id'],
            'filepath' => $filepath
        ];

        if ($stmt->execute($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Photo deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete photo from database.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Filepath not provided.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}