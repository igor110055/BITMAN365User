<?php
    $scriptjs = array(
        "../assets/js/admin/guide_ad.js"
    );
?>
<?php include __DIR__ . '/includes_2/header.php';?>
<style>
    table.guide_ad tr th{
        background: #444444;
        padding: 12px 12px;
        font-size: 18px;
    }
    table.guide_ad tr td{
        padding: 5px 5px;
        font-size: 16px;
    }
    .modal_guide_template .btn-inquiry_save{
        background: #0093FF;
        border-radius: 5px;
        width: 80px;
        color: #FFFFFF;
    }
    .modal_guide_template .m_footer{
        background: #666666;
    }
    .modal_guide_template .modal-content{
        background: #333333;
        border: 4px solid #888888;
        box-sizing: border-box;
        border-radius: 10px;
    }
    .modal_guide_template .modal-body .card-body{
        padding: 0;
    }
    .modal_guide_template .modal-body .card-header{
        background: #000000;
        border-radius: 5px 5px 0px 0px;
        color: #FF9300;
        font-size: 20px;
    }
    .modal_guide_template .modal-body tr td{
        background: #444444;
        border: 0.4px solid #000000;
        box-sizing: border-box;
        text-align: center;
        color: #FFFFFF;
    }
    .modal_guide_template .modal-body .noticeguide_input{
        background: #FFFFFF;
        border-radius: 5px;
        height: 35px;
        width: 100%;
        border: none;
        padding: 10px 10px;
    }
    .modal_guide_template .modal-body tr td select {
        -webkit-appearance: none;
        appearance: none;
    }
    .modal_guide_template .modal-body tr td .select-wrapper {
        position: relative;
    }

    .modal_guide_template .modal-body tr td .select-wrapper::after {
        content: "▼";
        font-size: 1rem;
        color: #444444;
        top: 10px;
        right: 16px;
        position: absolute;
    }
    .modal_guide_template .btn-noticeguide_save{
        background: #0093FF;
        border-radius: 5px;
        color: #FFFFFF;
        width: 120px;
        height: 40px;
    }
    .modal_guide_template .summer_body{
        padding: 5px 5px;
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
                            <button type="button" class="btn modal-guide_add_show" style="background: #0093FF; color: #FFFFFF;">공지등록</button>
                            <button type="button" class="btn btn_delete_all" disabled style="background: #ED5659; color: #FFFFFF;">선택삭제</button>
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
            $('#summernote_guide_add').summernote({
                height: 340,
                placeholder: '당신의 글은 여기에.....',
                lang: 'ko-KR', 
                dialogsInBody: true,
                dialogsFade: false
            });
        </script>
    </body>
</html>