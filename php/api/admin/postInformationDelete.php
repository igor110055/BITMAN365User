<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $arrMultiplDelete = json_decode(file_get_contents("php://input"));
    $cat = $_GET["category_title"];
    switch($cat){
        case "notice_delete":
            $del = $query->postNoticeDelete($_GET["id"]);
            echo $del;
            break;
        case "notice_delete_multiple":
            $del = $query->postNoticeDeleteMultiple($arrMultiplDelete);
            echo $del;
            break;
        case "guide_delete":
            $del = $query->postGuideDelete($_GET["id"]);
            echo $del;
            break;
        case "guide_delete_multiple":
            $del = $query->postGuideDeleteMultiple($arrMultiplDelete);
            echo $del;
            break;
        case "deposit_delete":
            $del = $query->postDepositDelete($_GET["id"]);
            echo $del;
            break;
        case "withdraw_delete":
            $del = $query->postWithdrawDelete($_GET["id"]);
            echo $del;
            break;
        case "faq_delete":
            $del = $query->postFAQDelete($_GET["id"]);
            echo $del;
            break;
        case "faq_delete_multiple":
            $del = $query->postFAQDeleteMultiple($arrMultiplDelete);
            echo $del;
            break;
    }
?>