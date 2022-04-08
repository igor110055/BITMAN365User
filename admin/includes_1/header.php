<?php
    include_once '../php/config/Database.php';
    include_once '../php/class/AdminUsers.php';
    include_once '../php/class/Admin.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new AdminUser($db);
    $query = new Admin($db);

    if(!$user->is_logged_in()){
        $user->redirect('../');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Cache-control" content="no-cache">

        <!-- Bootstrap CSS -->
        <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="../plugins/summernote/summernote-bs4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../plugins/jquery-confirm-3.3.2/css/jquery-confirm.min.css">
        <link rel="stylesheet" href="../plugins/iziToast-master/dist/css/iziToast.min.css">
        <link rel="stylesheet" href="../assets/css/pagination.css">
        <link rel="stylesheet" href="../assets/css/pulsestate.css">
        <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
        
        <title>BITMAN365</title>
        <?php
            if (isset($linkcss) || is_array(@$linkcss)) {
                foreach ($linkcss as $css) {
                    echo "<link href='$css'  rel='stylesheet'>";
                }
            }
        ?>
        <style>
            body{
                background: #444444;
                padding-left: 240px;
                padding-right: 240px;
            }
            .container-fluid{
                background: #444444;
                border: 5px solid rgb(0,0,0,0.5);
                padding: 10px;
            }
            .top_header {
                display: grid;
                grid-template-columns: 14.28% 14.28% 14.28% 14.28% 14.28% 14.28% 14.28%;
                grid-gap: 0;
                grid-auto-flow: row dense;
            }
            .header_data{
                display: grid;
                grid-template-columns: 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33%;
                grid-gap: 0.3em 0.1em;
                grid-auto-flow: row dense;
            }
            .bcontent {
                display: grid;
                grid-template-columns: 35% 65%;
                grid-gap: 0;
                grid-auto-flow: row dense;
                text-align: center;
                font-size: 8px;
            }
            .data_content{
                display: grid;
                grid-template-columns: 20% 80%;
                grid-gap: 0.5em 0.5em;
                grid-auto-flow: row dense;
                padding-right: 8px;
            }
            .top_header{
                border: 1px solid rgb(0,0,0,0.5);
                box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.3);
                border-radius: 4px;
                width: 100%;
            }
            .content_title{
                text-align: center; 
                color: #FFFFFF; 
                border: 1px solid #333333; 
                background: #444444;
                font-size: 12px;
                height: 25px;
                padding: 3px;
            }
            .kcontent{
                background: #666666;
                border: 1px solid #333333;
                font-size: 12px; 
                color: #FFF200; 
                padding: 2px;
                height: 25px;
            }
            .kcontentp{
                background: #666666;
                border: 1px solid #333333; 
                font-size: 12px; 
                padding: 2px; 
                width: 100%; 
                color: #FFFFFF;
                text-align: right;
            }
            #admin{
                color: #FFFFFF;
                font-size: 18px;
                padding: 5px;
            }
            #display_date{
                color: #FFFFFF;
                font-size: 12px;
            }
            #display_time{
                color: #FFFFFF;
                font-size: 18px;
            }
            .body_content{
                padding: 0;
            }
            .header_list{
                color: #FFFFFF; 
                font-size: 14px; 
                text-align: center;
            }
            .btn_information{
                width: 100%;
                display: grid;
                grid-gap: 1rem;
                grid-template-columns: 70% 70% 70% 70% 70% 70%;
            }
            .info_content{
                width: 100%;
                color: #FFFFFF;
                border: 1px solid #FFFFFF;
                border-radius: 6px;
                position: relative;
                text-align: center;
            }
            .btn_text{
                color: #FFFFFF;
                width: 70%;
            }
            .mutesound{
                cursor: pointer;
            }
            .info_content span{
                font-size: 20px;
            }
            .header_list{
                margin: auto;
            }
            .header_list a{
                text-decoration: none;
                color: #FFFFFF;
            }
            .header_list a.active_s{
                color: #FFF200; 
                font-weight: 700;
            }
            .header_list a:hover{
                color: #FFF200; 
                font-weight: 700;
            }
            .header_details{
                padding: 10px; 
                background: #333333; 
                border-radius: 4px; 
                margin-bottom: 5px;
            }
            .data_list{
                background: #333333; 
                border-radius: 4px; 
                font-size: 12px;  
                color: #777777; 
                font-weight: 700; 
                height: 730px;
            }
            table th{
                border-top: 1px solid #222222;
                border-bottom: 1px solid #222222;
                border-left: 1px solid #222222;
                border-right: 1px solid #222222;
                text-align: center;
                color: #FFFFFF;
                font-size: 14px;
                background: #555555;
                font-weight: normal;
            }
            table td{
                border-top: 1px solid #222222;
                border-bottom: 1px solid #222222;
                border-left: 1px solid #222222;
                border-right: 1px solid #222222;
                text-align: center;
                color: #FFFFFF;
                font-size: 14px;
                background: #666666;
                font-weight: normal;
            }
            .data_list li{
                font-size: 16px;
            }
            a.logoff,a.lsidebar{
                color: #666666;
            }
            a.logoff:hover { 
                color: #ED5459; 
            }
            a.lsidebar.active, li.active{
                color: #FFF200;
            }
            a.lsidebar:hover{
                text-decoration: none;
                color: #FFF200;
            }
            /* .data_list table.guide_ad{
                height: 600px;
            } */
            .error{
                color: #ED5659;
            }
            .btn_accept,.btn_reject{
                padding: 2px 5px;
            }
            #pagination img{
                width: 20px;
                height: 20px;
            }
            #modal-logout_notif .modal-content{
                background: #333333;
                border: 4px solid #888888;
                box-sizing: border-box;
                border-radius: 10px;
            }
            #modal-logout_notif .modal-content{
                height: 250px;
                margin-top: 100px;
            }
            #modal-logout_notif .modal-header{
                border-bottom: none;
            }
            #modal-logout_notif .modal-footer{
                border-top: none;
                margin-top: 30px;
            }
            #modal-logout_notif .modal-footer .btn{
                border-radius: 5px;
                width: 100px;
                height: 40px;
                color: #FFFFFF;
                font-size: 16px;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
            }
            #modal-logout_notif .modal-footer .close{
                background: #555555;
                cursor: pointer;
            }
            #modal-logout_notif .modal-footer .btn_logout{
                background: #0093FF;
                color: #FFFFFF;
                cursor: pointer;
            }
            .modal_size_medium{
                max-width: 992px;
                margin-left: auto;
                margin-right: auto;
            }
            .modal_size_lenght{
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;
            }
            .modal_inquiry_template .btn-inquiry_save{
                background: #0093FF;
                border-radius: 5px;
                width: 80px;
                color: #FFFFFF;
            }
            .modal_inquiry_template .card-body, .modal_inquiry_template .m_footer{
                background: #666666;
            }
            .modal_inquiry_template .modal-content{
                background: #333333;
                border: 4px solid #888888;
                box-sizing: border-box;
                border-radius: 10px;
            }
            .modal_inquiry_template .modal-body .card-body{
                padding: 0;
            }
            .modal_inquiry_template .modal-body .card-header{
                background: #000000;
                border-radius: 5px 5px 0px 0px;
                color: #FF9300;
                font-size: 20px;
            }
            .modal_inquiry_template .modal-body tr td{
                background: #444444;
                border: 0.4px solid #000000;
                box-sizing: border-box;
                text-align: center;
                color: #FFFFFF;
            }
            .modal_inquiry_template .modal-body .noticeguide_input{
                background: #FFFFFF;
                border-radius: 5px;
                height: 35px;
                width: 100%;
                border: none;
                padding: 10px 10px;
            }
            .modal_inquiry_template .modal-body tr td select {
                -webkit-appearance: none;
                appearance: none;
            }
            .modal_inquiry_template .modal-body tr td .select-wrapper {
                position: relative;
            }

            .modal_inquiry_template .modal-body tr td .select-wrapper::after {
                content: "▼";
                font-size: 1rem;
                color: #444444;
                top: 10px;
                right: 16px;
                position: absolute;
            }
            .selectform{
                -webkit-appearance: none;
                -moz-appearance: none;
                background-image: url("../assets/icons/Adropdown24.png");
                background-repeat: no-repeat;
                background-position-x: 95%;
                background-position-y: 50%;
                background-size: 15px 15px !important;
                padding: 2px 10px;
                border: none; 
                height: 100%; 
                border-radius: 5px; 
                width: 100%;
                font-size: 14px;
            }
            .modal_inquiry_template .btn-noticeguide_save{
                background: #0093FF;
                border-radius: 5px;
                color: #FFFFFF;
                width: 120px;
                height: 40px;
            }
            .modal_inquiry_template .summer_body{
                padding: 5px 5px;
                background: #FFFFFF !important;
                height: 410px;
            }
            .modal_inquiry_template .card-header{
                height: 100% !important;
                padding: 5px 10px;
                margin-top: 3px;
            }
            .grid_column_inquiry{
                width: 100%;
                margin: 0 auto;
                display: grid;
                grid-gap: 0;
                grid-template-columns: 80% 20%; 
            }
            .inquiry_template{
                border: 0.4px solid #000000;
                background: #444444;
            }
            .user_inquiry_details{
                height: 190px;
                width: 100%;
                border: 0.4px solid #000000;
                box-sizing: border-box;
                padding: 20px 20px;
                overflow-y: scroll;
            }
            .modal::-webkit-scrollbar{
                display: none;
            }
            .display_user{
                border: 0.4px solid #000000;
                box-sizing: border-box;
                background: #FFFFFF;
                height: 40px;
                width: 100%;
                border-radius: 8px;
                cursor: pointer;
                color: #444444;
                padding: 7px 20px;
            }
            #modal-inquiry_user_display .btn{
                border-radius: 5px; 
                height: 32px;
                padding: 2px 5px;
                font-size: 16px;
            }
            .grid_column_inquiry_user table tr td{
                width: 10%;
                font-size: 12px;
                height: 35px !important;
            }
            .grid_column_inquiry_user table tr td.tdValue{
                background: #888888;
                font-size: 12px;
            }
            .grid_column_inquiry_holding table tr th,.grid_column_inquiry_trans table tr th{
                border: 0.4px solid #000000;
                text-align: center;
                color: #FFFFFF;
                font-style: normal;
                background: #444444;
                font-size: 14px;
            }
            .grid_column_inquiry_holding table tr th{
                width: 10%;
            }
            .grid_column_inquiry_holding table tr td,.grid_column_inquiry_trans table tr td{
                background: #666666;
                color: #FFFFFF;
            }
            .grid_column_inquiry_holding table tr td.tdcashtrans{
                background: #888888;
            }
            label {
                display: inline-block;
                border: 1px solid transparent;
                display: flex;
                width: 60px;
                border-radius: 6px;
                overflow: hidden;
                background-color: #FFF200;
                align-items: center;
                cursor: pointer;
                padding: 5px 5px;
                color: #000000;
            }
            @media only screen  and (min-width : 1200px) {
                body{
                    background: #444444;
                    padding-left: 100px;
                    padding-right: 100px;
                }
                .kcontent,.kcontentp{
                    font-size: 9px;
                }
            }
            @media only screen  and (min-width : 1920px) {
                body{
                    background: #444444;
                    padding-left: 240px;
                    padding-right: 240px;
                }
                .kcontent,.kcontentp{
                    font-size: 12px;
                }
            }
        </style>
    </head>
    <body>