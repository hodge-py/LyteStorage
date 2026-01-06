<?php

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $unique = uniqid();

    $dir = "./allUsers/" . $data['dir'] . "/" . $unique;

    mkdir($dir,0777);

    echo json_encode($unique);


}