    <?php
        $scriptjs = array(
            "../assets/js/admin/btcusd_history_ad.js"
        );
    ?>
    <style>
        table tr td{
            padding: 10px 10px;
        }
    </style>
    <?php include __DIR__ . '/includes_1/header.php';?>
        <div class="container-fluid">
            <?php include __DIR__ . '/includes_1/middle_header.php';?>
            <div class="header_details">
                <div class="header_data">
                    <div class="header_list"><a href="./membership_mngt.php">회원관리</a></div>
                    <div class="header_list"><a href="./bet_mngt.php">배팅관리</a></div>
                    <div class="header_list"><a href="./btcusd_close_mngt.php" class="active_s">마감관리</a></div>
                    <div class="header_list"><a href="./deposit.php">입출금관리</a></div>
                    <div class="header_list"><a href="./settlement_mngt.php">정산관리</a></div>
                    <div class="header_list"><a href="./notice.php">고객센터</a></div>
                    <div class="header_list"><a href="./preferences.php">환경설정</a></div>
                    <<?php include __DIR__ . '/includes_1/notify_info.php';?>
                </div>    
            </div>
            <div class="data_content">
                <?php include __DIR__ . '/includes_1/sidebarlist_close_mngt.php';?>
                <div class="data_list">
                    <div style="padding: 7px 7px;">
                        <span style="color: #FF9300; font-size: 18px;">리스트</span>
                    </div>
                    <div id="pagination-result">
                        <input type="hidden" name="rowcount" id="rowcount" />
                    </div><br>
                </div>
            </div>
        </div>
    <?php include __DIR__ . '/includes_1/script.php';?>
    <script ></script>
    </body>
</html>