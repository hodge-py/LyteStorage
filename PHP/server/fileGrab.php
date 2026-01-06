<?php
session_start();
header('Content-Type: application/json');

require_once 'config.php';

//$sql = "SELECT filepath FROM photos WHERE user_id = :username order by capture_date desc";

//$stmt = $pdo->prepare($sql);

//$data = ['username' => $_SESSION['id']];
//$stmt->execute($data);

//$filePath = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dir = "./allUsers/" . $_SESSION['username'] . "/root";

$contents = scandir($dir);

$filesAndFolders = array_diff($contents, array('.', '..'));

$data = array(
    "files" => $filesAndFolders,
    "dir" => $dir
);

echo json_encode($data);


?>