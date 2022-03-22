<?php
    include_once '../php/config/Database.php';
    include_once '../php/class/Users.php';
    include_once '../php/class/Admin.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
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
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
            .info_content span{
                font-size: 20px;
            }
            .mutesound{
                cursor: pointer;
            }
            .header_list{
                padding-top: 5px;
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
                height: 880px;
            }
            .data_list table, .data_list table th{
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
            .data_list table, .data_list table td{
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
            .data_list li.active{
                color: #FFF200;
            }
            a.logoff,a.lsidebar{
                color: #666666;
            }
            a.logoff:hover { 
                color: #ED5459; 
            }
            a.lsidebar.active{
                color: #FFF200;
            }
            a.lsidebar:hover{
                text-decoration: none;
                color: #FFF200;
            }
            /* .data_list table.notice_ad{
                height: 600px;
            } */
            .btn_edit{
                background: #0093FF;
                border-radius: 5px;
                color: #FFFFFF;
                width: 80px;
                height: 32px;
                padding: 5px;
            }
            .btn_delete{
                background: #ED5659;
                border-radius: 5px;
                color: #FFFFFF;
                width: 80px;
                height: 32px;
                padding: 5px 5px;
            }
            .table-responsive::-webkit-scrollbar{
                display: none;
            }
            input[type="checkbox"]{
                border: 1px solid #FFFFFF;
                box-sizing: border-box;
                border-radius: 5px;
                width: 20px;
                height: 20px;
                left: 10px;
                top: 10px;
                cursor: pointer;
            }
            .error{
                color: #ED5659;
            }
            #pagination img{
                width: 20px;
                height: 20px;
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