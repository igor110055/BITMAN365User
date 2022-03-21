<?php
    $scriptjs = array(
        "../assets/js/admin/admin.js"
    );
?>
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
                    <?php include __DIR__ . '/includes_1/notify_info.php';?>
                </div>    
            </div>
            <div class="data_content">
                <?php include __DIR__ . '/includes_1/sidebarlist_close_mngt.php';?>
                <div class="data_list">
                    <div style="color: #FF9300; padding: 7px; font-size: 16px;">리스트</div>
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="height: 10px;" rowspan="2">종목</th>
                                <th rowspan="2">계약시간</th>
                                <th rowspan="2">배당</th>
                                <th colspan="2">마감예약</th>
                                <th rowspan="2">마감예약결과</th>
                                <th rowspan="2">예약취소</th>
                            </tr>
                            <tr>
                                <th>매수</th>
                                <th>매도</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include __DIR__ . '/includes_1/script.php';?>
    </body>
</html>