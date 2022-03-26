<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $auth = new Authentication($db);
    $pass = $auth->encrypt_decrypt('encrypt', $_GET["admin_pass"]);

    $stmt = $query->checkAdminUserPass($pass);
    echo json_encode($stmt->rowCount());