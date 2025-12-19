<?php
session_start();
header('Content-Type: application/json');

require_once 'config.php';

$sql = "SELECT filepath FROM photos WHERE user_id = :username order by created_at desc";

$stmt = $pdo->prepare($sql);

$data = ['username' => $_SESSION['id']];
$stmt->execute($data);

$filePath = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($filePath);


?>