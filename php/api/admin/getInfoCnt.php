<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $stmt = $query->getInfoCnt();

    $stmt1 = $query->getNotification();
    $notifcnt = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $stmt2 = $query->checkCategoryRequest();
    $notif = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    $sql = $stmt->rowCount();
    if($sql > 0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $array = array(
            "Cnt" => $data,
            "NotifCnt" => count($notifcnt),
            "Notif" => $notif
        );
        echo json_encode($array);
    }else{
        http_response_code(404);
        echo json_encode('No Record Found.');
    }
?>