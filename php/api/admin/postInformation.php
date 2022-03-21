<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    parse_str(@$_POST['formData'], $_POST);
    $cat = (@$_GET["category_title"]) ? @$_GET["category_title"] : @$_POST["category_title"];
    switch ($cat) {
        case "notice":  
            $post = $query->postNotice($_POST);
            echo $post;
            break;
        case "notice_edit":
            $post = $query->postNoticeUpdate($_POST);
            echo $post;
            break;
        case "guide":
            
            $post = $query->postGuide($_POST);
            echo $post;
            break;
        case "guide_edit":
            $post = $query->postGuideUpdate($_POST);
            echo $post;
            break;
        case "deposit_accept":
            $post = $query->postDepositUpdate($_GET);
            echo $post;
            break;
        case "withdraw_accept":
            $post = $query->postWithdrawUpdate($_GET);
            echo $post;
            break;
    }
?>