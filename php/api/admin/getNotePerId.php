<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $stmt = $query->getNotePerId($_GET["id"]);

    $sql = $stmt->rowCount();
    if($sql > 0){
        $output = '';
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }else{
        http_response_code(404);
        echo json_encode('No Record Found.');
    }
?>