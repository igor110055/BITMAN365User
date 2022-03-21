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
    </body>
</html>