<?php
    $scriptjs = array(
        "../assets/js/admin/inquiry_ad.js"
    );
?>
<?php include __DIR__ . '/includes_2/header.php';?>
<style>
    body::-webkit-scrollbar{
        display: none;
    }
    table.inquiry_ad tr th{
        background: #444444;
        padding: 5px 5px;
        font-size: 16px;
    }
    table.inquiry_ad tr td{
        padding: 5px 5px;
        font-size: 16px;
    }
    .inquiry_template table tr td{
        padding: 5px 5px;
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
</style>
        <div class="container-fluid">
            <?php include __DIR__ . '/includes_2/middle_header.php';?>
            <div class="header_details">
                <div class="header_data">
                    <div class="header_list"><a href="./membership_mngt.php">회원관리</a></div>
                    <div class="header_list"><a href="./bet_mngt.php">배팅관리</a></div>
                    <div class="header_list"><a href="./btcusd_close_mngt.php">마감관리</a></div>
                    <div class="header_list"><a href="./deposit.php">입출금관리</a></div>
                    <div class="header_list"><a href="./settlement_mngt.php">정산관리</a></div>
                    <div class="header_list"><a href="./notice.php" class="active_s">고객센터</a></div>
                    <div class="header_list"><a href="./preferences.php">환경설정</a></div>
                    <?php include __DIR__ . '/includes_2/notify_info.php';?>
                </div>    
            </div>
            <div class="data_content">
                <?php include __DIR__ . '/includes_2/sidebarlist_service.php';?>
                <div class="data_list">
                    <div style="padding: 7px 7px;">
                        <span style="color: #FF9300; font-size: 25px;">리스트</span>
                        <div class="pull-right" style="padding-top: 0; padding-bottom: 0;">
                            <button type="button" class="btn modal-answer_template" style="background: #0093FF; color: #FFFFFF;">답변템플릿</button>
                        </div>
                    </div>
                    <div id="pagination-result">
                        <input type="hidden" name="rowcount" id="rowcount" />
                    </div>
                </div>
            </div>
        </div>
        <?php include __DIR__ . '/includes_2/script.php';?>
        <script>
            $('#summernote_inquiry_add').summernote({
                height: 340,
                placeholder: '당신의 글은 여기에.....',
                lang: 'ko-KR', 
                dialogsInBody: true,
                dialogsFade: false
            });
        </script>
    </body>
</html>