<?php
session_start();
header('Content-Type: application/json');

require_once 'config.php';

$directory = 'images/';
if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
}

$sql = "SELECT filepath FROM photos WHERE user_id = :username order by capture_date desc";

$stmt = $pdo->prepare($sql);

$data = ['username' => $_SESSION['id']];
$stmt->execute($data);

$filePath = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($filePath);


?>