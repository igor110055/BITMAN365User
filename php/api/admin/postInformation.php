<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $auth = new Authentication($db);
    parse_str(@$_POST['formData'], $_POST);
    $pass = $auth->encrypt_decrypt('encrypt', @$_POST["user_pass"]);
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
        case "inquiry_edit":
            $post = $query->postInquiryUpdate($_POST);
            echo $post;
            break;
        case "inquiry_answer_template":
            $post = $query->postInquiry($_POST);
            echo $post;
            break;
        case "user_update_by_admin":
            $post = $query->postuserUpdateByAdmin($_POST,$pass);
            echo $post;
            break;
        case "stop_usage":
            $post = $query->postforceStopUsingWebsite($_GET);
            echo $post;
            break;
    }
?>