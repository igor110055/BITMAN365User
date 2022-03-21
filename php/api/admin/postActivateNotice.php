<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);

    $id = json_decode(file_get_contents("php://input"));
    $act = $query->postActivateNotice($id);
    echo json_encode($act);