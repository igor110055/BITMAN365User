<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $users = $query->getInfoCntUser();
    $user = $users->fetchAll(PDO::FETCH_ASSOC);

    $deps = $query->getInfoCntDep();
    $dep = $deps->fetchAll(PDO::FETCH_ASSOC);

    $wids = $query->getInfoCntWid();
    $wid = $wids->fetchAll(PDO::FETCH_ASSOC);

    $inqs = $query->getInfoCntInq();
    $inq = $inqs->fetchAll(PDO::FETCH_ASSOC);

    $stmt1 = $query->getNotification();
    $notifcnt = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $stmt2 = $query->checkCategoryRequest();
    $notif = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    $array = array(
        "UserApplication" => ($user[0]["Cnt"] > 0) ? $user[0]["Cnt"] : 0,
        "DepositApplication" => ($dep[0]["Cnt"] > 0) ? $dep[0]["Cnt"] : 0,
        "WithdrawApplication" => ($wid[0]["Cnt"] > 0) ? $wid[0]["Cnt"] : 0,
        "InquiryApplication" => ($inq[0]["Cnt"] > 0) ? $inq[0]["Cnt"] : 0,
        "NotifCnt" => count($notifcnt),
        "Notif" => $notif
    );
    echo json_encode($array);
?>