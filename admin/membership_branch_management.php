
<?php
        $scriptjs = array(
            "../assets/js/admin/membership_user_cancel_ad.js"
        );
    ?>
    <style>
        .table-responsive::-webkit-scrollbar{
            display: none;
        }
        .btn_delete{
            background: #555555;
            border-radius: 5px;
            height: 35px;
            color: #FFFFFF;
        }
        .search_field{
            background: #666666;
            border-radius: 0px 0px 5px 5px;
            padding: 10px 10px; 
        }
        .search_field select,.search_field input[type="text"]{
            width: 110px;
            height: 32px;
            background: #FFFFFF;
            border-radius: 5px;
            border: none;
            padding: 5px 10px;
        }
        .search_field input.search_input{
            width: 160px;
        }
        .search_field input.datepicker{
            width: 100px;
        }
        .search_field input[type="text"]::placeholder{
            color: #777777;
            padding: 5px 10px;
            text-align: right;
        }
        .btn_approve{
            background: #0093FF;
            border-radius: 5px;
            color: #FFFFFF;
            width: 80px;
            height: 32px;
            padding: 5px;
        }
        .btn_cancel{
            background: #ED5659;
            border-radius: 5px;
            color: #FFFFFF;
            width: 80px;
            height: 32px;
            padding: 5px 5px;
        }
    </style>
    <?php include __DIR__ . '/includes_1/header.php';?>
        <div class="container-fluid">
            <?php include __DIR__ . '/includes_1/middle_header.php';?>
            <div class="header_details">
                <div class="header_data">
                    <div class="header_list"><a href="./membership_mngt.php" class="active_s">회원관리</a></div>
                    <div class="header_list"><a href="./bet_mngt.php">배팅관리</a></div>
                    <div class="header_list"><a href="./btcusd_close_mngt.php">마감관리</a></div>
                    <div class="header_list"><a href="./deposit.php">입출금관리</a></div>
                    <div class="header_list"><a href="./settlement_mngt.php">정산관리</a></div>
                    <div class="header_list"><a href="./notice.php">고객센터</a></div>
                    <div class="header_list"><a href="./preferences.php">환경설정</a></div>
                    <?php include __DIR__ . '/includes_1/notify_info.php';?>
                </div>    
            </div>
            <div class="data_content">
                <?php include __DIR__ . '/includes_1/sidebarlist_membership.php';?>
                <div class="data_list">
                    <div style="padding: 7px 7px;" class="form-group">
                        <span style="color: #FF9300; font-size: 16px; font-style: normal;">리스트</span>
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