<?php
        $scriptjs = array(
            "../assets/js/admin/membership_ad.js"
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
                        <span style="color: #FF9300; font-size: 16px; font-style: normal;">검색</span>
                        <div class="pull-right" style="padding-top: 0; padding-bottom: 0;">
                            <button type="button" class="btn btn_search" style="background: #FF9300; color: #FFFFFF;">검색</button>
                        </div>
                    </div>
                    <div class="search_field">
                        <select name="s_state" id="s_state">
                            <option selected disabled>- 상태 -</option>
                            <option value="">모두 표시</option>
                            <option value="1">이용</option>
                            <option value="3">정지</option>
                            <option value="2">접속중</option>
                        </select>
                        <select name="s_point" id="s_point"></select>
                        <select name="s_nickname" id="s_nickname"></select>
                        <input type="text" class="search_input" placeholder="검색어">
                        <select name="s_accessdate" id="s_accessdate"></select>
                        <select name="s_subscriptiondate" id="s_subscriptiondate"></select>
                        <input type="text" class="datepicker_start">
                        <img src="../assets/icons/tilde.png" alt="">
                        <input type="text" class="datepicker_end">
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