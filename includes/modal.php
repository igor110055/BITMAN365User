<!-- signup notification -->
<div class="modal fade" id="modal-notif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h4 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">회원가입 신청</h4>
            <div class="modal-body">
                <div class="container">
                    <h3 class="text-center text-white modal-notif-body">신청이 완료되었습니다.</h3>
                    <h3 class="text-center text-white modal-notif-body">회원가입이 승인되면 이용가능합니다.</h3>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary"><a href="./">확인</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login modal popup -->
<div class="modal fade" id="modal-login" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h1 class="modal-title text-white mb-2">BITMAN365</h1>
                    <form method="POST" class="form_login">
                        <div class="form-group text-left">
                            <label for="accountid"><h4 class="text-yellow">아이디</h4></label>
                            <input type="text" class="form-control textinput" id="account_code" name="account_code" placeholder="아이디를 입력해 주세요." autofocus>
                        </div>
                        <div class="form-group text-left">
                            <label for="password"><h4 class="text-yellow">비밀번호</h4></label>
                            <input type="password" class="form-control textinput" id="password" name="password" placeholder="비밀번호를 입력해 주세요.">
                        </div>
                        <div class="display_error text-center"></div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-user-gray" data-dismiss="modal">취소</button>
                            <button type="submit" class="btn btn-user-orange">로그인</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display binance 1m result -->
<div class="modal fade" id="modal-bi_1m_result" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #000000; text-align: center;">
                <span style="color: #FFF200; font-size: 20px;"><center>실현데이터</center></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    body
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display new record for notice -->
<div class="modal fade modal_notice_template" id="modal-notice_add" tabindex="-1">
    <div class="modal-dialog modal-lg" style="height: 300px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 20px;">공지사항</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        공지사항
                    </div>
                    <div class="card-body">
                        <form id="formNotice" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="category_title" value="notice">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">제목</td>
                                    <td colspan="3">
                                        <input type="text" name="title" id="title" class="noticeguide_input" placeholder="공지......">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">사용</td>
                                    <td style="width: 30%;">
                                        <div class="select-wrapper">
                                            <select name="use_nonuse" class="form-control">
                                                <option selected disabled>-</option>
                                                <option value="1">사용</option>
                                                <option value="0">미사용</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">공지일자</td>
                                    <td style="width: 30%;">
                                        <div class="form-inline">
                                            <input type="text" name="register_date" class="form-control datepicker" style="width: 80%; margin-right: 6px; text-align: center;" value="<?=date('Y-m-d h:i:s')?>">
                                            <img src="<?= "http://" . $_SERVER["HTTP_HOST"] . "/BITMAN365_admin/assets/icons/calendar.png"?>" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <textarea id="summernote_notice_add" name="notice_details"></textarea>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-noticeguide_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- edit notice -->
<div class="modal fade modal_notice_template" id="modal-notice_edit" tabindex="-1">
    <div class="modal-dialog modal-lg" style="height: 300px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 20px;">공지사항</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        공지사항
                    </div>
                    <div class="card-body">
                        <form id="formNotice_Edit" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="id_e" id="id_e">
                            <input type="hidden" name="category_title" value="notice_edit">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">제목</td>
                                    <td colspan="3">
                                        <input type="text" name="title_e" id="title_e" class="noticeguide_input" placeholder="공지......">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">사용</td>
                                    <td style="width: 30%;">
                                        <div class="select-wrapper">
                                            <select name="use_nonuse_e" id="use_nonuse_e" class="form-control">
                                                <option selected disabled>-</option>
                                                <option value="1">사용</option>
                                                <option value="0">미사용</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">공지일자</td>
                                    <td style="width: 30%;">
                                        <div class="form-inline">
                                            <input type="text" name="register_date_e" id="register_date_e" class="form-control datepicker" style="width: 80%; margin-right: 6px; text-align: center;">
                                            <img src="<?= "http://" . $_SERVER["HTTP_HOST"] . "/BITMAN365_admin/assets/icons/calendar.png"?>" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <textarea id="summernote_notice_edit" name="notice_details_e"></textarea>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-noticeguide_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display new record for guide -->
<div class="modal fade modal_guide_template" id="modal-guide_add" tabindex="-1">
    <div class="modal-dialog modal-lg" style="height: 300px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 20px;">이용안내</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        이용안내
                    </div>
                    <div class="card-body">
                        <form id="formGuide" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="category_title" value="guide">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">제목</td>
                                    <td colspan="3">
                                        <input type="text" name="title" id="g_title" class="noticeguide_input" placeholder="공지......">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">사용</td>
                                    <td style="width: 30%;">
                                        <div class="select-wrapper">
                                            <select name="use_nonuse" class="form-control">
                                                <option selected disabled>-</option>
                                                <option value="1">사용</option>
                                                <option value="0">미사용</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">공지일자</td>
                                    <td style="width: 30%;">
                                        <div class="form-inline">
                                            <input type="text" name="register_date" class="form-control datepicker" style="width: 80%; margin-right: 6px; text-align: center;" value="<?=date('Y-m-d h:i:s')?>">
                                            <img src="<?= "http://" . $_SERVER["HTTP_HOST"] . "/BITMAN365_admin/assets/icons/calendar.png"?>" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <textarea id="summernote_guide_add" name="guide_details"></textarea>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-noticeguide_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- edit notice -->
<div class="modal fade modal_guide_template" id="modal-guide_edit" tabindex="-1">
    <div class="modal-dialog modal-lg" style="height: 300px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 20px;">이용안내</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        이용안내
                    </div>
                    <div class="card-body">
                        <form id="formGuide_Edit" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="g_id_e" id="g_id_e">
                            <input type="hidden" name="category_title" value="guide_edit">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">제목</td>
                                    <td colspan="3">
                                        <input type="text" name="g_title_e" id="g_title_e" class="noticeguide_input" placeholder="공지......">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">사용</td>
                                    <td style="width: 30%;">
                                        <div class="select-wrapper">
                                            <select name="g_use_nonuse_e" id="g_use_nonuse_e" class="form-control">
                                                <option selected disabled>-</option>
                                                <option value="1">사용</option>
                                                <option value="0">미사용</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">공지일자</td>
                                    <td style="width: 30%;">
                                        <div class="form-inline">
                                            <input type="text" name="g_register_date_e" id="g_register_date_e" class="form-control datepicker" style="width: 80%; margin-right: 6px; text-align: center;">
                                            <img src="<?= "http://" . $_SERVER["HTTP_HOST"] . "/BITMAN365_admin/assets/icons/calendar.png"?>" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <textarea id="summernote_guide_edit" name="g_guide_details_e"></textarea>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-noticeguide_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display new record for faq -->
<div class="modal fade modal_faq_template" id="modal-faq_add" tabindex="-1">
    <div class="modal-dialog modal-lg" style="height: 300px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 20px;">공지사항</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        공지사항
                    </div>
                    <div class="card-body">
                        <form id="formFAQ" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="category_title" value="faq">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">제목</td>
                                    <td colspan="3">
                                        <input type="text" name="f_title" id="f_title" class="noticeguide_input" placeholder="공지......">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">사용</td>
                                    <td style="width: 30%;">
                                        <div class="select-wrapper">
                                            <select name="f_use_nonuse" class="form-control">
                                                <option selected disabled>-</option>
                                                <option value="1">사용</option>
                                                <option value="0">미사용</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">공지일자</td>
                                    <td style="width: 30%;">
                                        <div class="form-inline">
                                            <input type="text" name="f_register_date" class="form-control datepicker" style="width: 80%; margin-right: 6px; text-align: center;" value="<?=date('Y-m-d h:i:s')?>">
                                            <img src="<?= "http://" . $_SERVER["HTTP_HOST"] . "/BITMAN365_admin/assets/icons/calendar.png"?>" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <textarea id="summernote_faq_add" name="faq_details"></textarea>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-noticeguide_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- edit faq -->
<div class="modal fade modal_faq_template" id="modal-faq_edit" tabindex="-1">
    <div class="modal-dialog modal-lg" style="height: 300px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 20px;">공지사항</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        공지사항
                    </div>
                    <div class="card-body">
                        <form id="formFAQ_Edit" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="f_id_e" id="f_id_e">
                            <input type="hidden" name="category_title" value="faq_edit">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">제목</td>
                                    <td colspan="3">
                                        <input type="text" name="f_title_e" id="f_title_e" class="noticeguide_input" placeholder="공지......">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">사용</td>
                                    <td style="width: 30%;">
                                        <div class="select-wrapper">
                                            <select name="f_use_nonuse_e" id="f_use_nonuse_e" class="form-control">
                                                <option selected disabled>-</option>
                                                <option value="1">사용</option>
                                                <option value="0">미사용</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">공지일자</td>
                                    <td style="width: 30%;">
                                        <div class="form-inline">
                                            <input type="text" name="f_register_date_e" id="f_register_date_e" class="form-control datepicker" style="width: 80%; margin-right: 6px; text-align: center;">
                                            <img src="<?= "http://" . $_SERVER["HTTP_HOST"] . "/BITMAN365_admin/assets/icons/calendar.png"?>" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <textarea id="summernote_faq_edit" name="faq_details_e"></textarea>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-noticeguide_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display template answer for inquiry -->
<div class="modal fade modal_inquiry_template" id="modal-inquiry_template_edit" tabindex="-1">
    <div class="modal-dialog modal_size_medium">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 25px; font-weight: 700;">1:1 문의</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                
                <div class="card">
                    <div class="card-header">
                        1:1 문의
                    </div>
                    <div class="card-body">
                        <form id="formInquiryEdit" enctype="multipart/form-data" method="POST">
                            <div class="grid_column_inquiry">
                                <div class="inquiry_template_left">
                                    <input type="hidden" name="i_id_e" id="i_id_e">
                                    <input type="hidden" name="category_title" value="inquiry_edit">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="width: 20%;">제목</td>
                                            <td colspan="3">
                                                <input type="text" id="i_title_e" class="noticeguide_input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;">닉네임</td>
                                            <td style="width: 30%;">
                                                <select class="selectform" id="i_nickname_e" style="height: 35px;">
                                                </select>
                                            </td>
                                            <td style="width: 20%;">문의일자</td>
                                            <td style="width: 30%;">
                                                <input type="text" id="i_inquiry_date_e" class="noticeguide_input">
                                            </td>
                                        </tr>
                                    </table>
                                    <textarea class="user_inquiry_details" id="i_user_inquiry_details_e"></textarea>
                                    <textarea id="summernote_inquiry_edit" name="i_inquiry_details_e"></textarea>
                                </div>
                                <div class="inquiry_template">
                                    <style>
                                        #answer_table .td{
                                            background: rgb(0,0,0,0.3);
                                            color: #FF9300;
                                        }
                                    </style>
                                    <div id="display_answer"></div>
                                </div>
                            </div>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-inquiry_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display user per nickname -->
<div class="modal fade modal_inquiry_template" id="modal-inquiry_user_display" tabindex="-1">
    <div class="modal-dialog modal_size_lenght">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 20px; font-weight: 700;">회원정보</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <form id="formUserUpdateByAdmin" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="category_title" value="user_update_by_admin">
                        <!-- 1st row -->
                        <div class="card-header">
                            <span style="color: #FF9300; font-size: 20px;">기본정보</span>
                            <div class="pull-right">
                                <button type="button" class="btn" style="margin-top: -8px; background: #FF9300; color: #FFFFFF; margin-bottom: 2px;">쪽지발송</button>
                                <button type="button" class="btn" style="margin-top: -8px; background: #ED5659; color: #FFFFFF;">로그아웃</button>
                                <input type="checkbox" id="btn_stop_site" class="btn_stop_site" hidden checked>
                                <label class="btn labelfortoggle" for="btn_stop_site">
                                    <span id="usenouse">이용</span>
                                </label>
                                <input type="password" name="admin_pwd" id="admin_pwd" class="btn" style="margin-top: -8px; border: none; height: 32px; border-radius: 5px; width: 140px; text-align: center;">
                                <button type="button" class="btn" id="userbtnsubmit" style="margin-top: -8px; background: #0093FF; color: #FFFFFF;">수정</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="grid_column_inquiry_user">
                                <table style="width: 100%;">
                                    <tr>
                                        <td>아이디</td>
                                        <td class="tdValue">
                                            <span id="accountid"></span>
                                            <input type="hidden" id="accountid_s" name="accountid">
                                        </td>
                                        <td>닉네임</td>
                                        <td id="nname" class="tdValue"></td>
                                        <td>비밀번호</td>
                                        <td class="tdValue"><input type="text" id="user_pass" name="user_pass" class="noticeguide_input" style="text-align: center;"></td>
                                        <td>접속도메인</td>
                                        <td id="domain" class="tdValue"></td>
                                        <td>상태</td>
                                        <td id="slate" class="tdValue">접속중</td>
                                    </tr>
                                    <tr>
                                        <td>예금주</td>
                                        <td id="aholder" class="tdValue"></td>
                                        <td>추천지점</td>
                                        <td id="rpoint" class="tdValue"></td>
                                        <td>가입일자</td>
                                        <td id="regdate" class="tdValue"></td>
                                        <td>접속기기</td>
                                        <td id="device" class="tdValue"></td>
                                        <td>접속일자</td>
                                        <td id="logindate" class="tdValue"></td>
                                    </tr>
                                    <tr>
                                        <td>은행</td>
                                        <td class="tdValue">
                                            <!-- <input list="banklist" id="bankid" class="noticeguide_input" style="text-align: center;"> -->
                                            <select class="selectform" id="bankid" name="bankid">
                                                <option value="" selected></option>
                                            </select>
                                        </td>
                                        <td id="accountno" class="tdValue" colspan="2"></td>
                                        <td>가입IP</td>
                                        <td id="ip" class="tdValue"></td>
                                        <td>접속브라우저</td>
                                        <td id="browser" class="tdValue"></td>
                                        <td>접속IP</td>
                                        <td id="server_ip" class="tdValue">접속중</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- 2nd row -->
                        <div class="card-header">
                            <span style="color: #FF9300; font-size: 20px;">게임관리</span>
                            <div class="pull-right" style="padding: 0;">
                                <button type="button" class="btn" style="background: #0093FF; color: #FFFFFF;">수정</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="grid_column_inquiry_user">
                                <table style="width: 100%;">
                                    <tr>
                                        <td>BTC/USD</td>
                                        <td class="tdValue">
                                            <select class="selectform" name="btcusd">
                                                <option value="Y">Y</option>
                                                <option value="N">N</option>
                                            </select>
                                        </td>
                                        <td>ETH/USD</td>
                                        <td class="tdValue">
                                            <select class="selectform" name="ethusd">
                                                <option value="Y">Y</option>
                                                <option value="N">N</option>
                                            </select>
                                        </td>
                                        <td>XRP/USD</td>
                                        <td class="tdValue">
                                            <select class="selectform" name="xrpusd">
                                                <option value="Y">Y</option>
                                                <option value="N">N</option>
                                            </select>
                                        </td>
                                        <td>-</td>
                                        <td id="domain" class="tdValue">-</td>
                                        <td>-</td>
                                        <td class="tdValue">-</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </form>
                    <!-- 3rd row -->
                    <div class="card-header">
                        <span style="color: #FF9300; font-size: 20px;">메모</span>
                    </div>
                    <div class="card-body">
                        <div class="grid_column_inquiry_user">
                            <table style="width: 100%;">
                                <tr>
                                    <td rowspan="2" style="width: 30%; background: #666666; text-align: left;">
                                        <textarea type="text" style="height: 100%; width: 100%; background: #666666; border: none; font-size: 18px;"></textarea>
                                    </td>
                                    <td style="width: 10%; background: #444444;">관리자1</td>
                                    <td style="width: 15%; background: #888888;">2022-01-22  15:55</td>
                                    <td style="width: 45%; background: #888888; text-align: left;">메모메모메모</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%; background: #444444;">관리자1</td>
                                    <td style="width: 15%; background: #888888;">2022-01-22  15:55</td>
                                    <td style="width: 45%; background: #888888; text-align: left;">메모메모메모</td>
                                </tr>
                                <!-- next line -->
                                <tr>
                                    <td rowspan="2" style="width: 30%; background: #666666; text-align: left;">
                                        <button class="btn" style="border: none; border-radius: none; height: 100%; width: 100%; background: #444444; color: #FFFFFF;">메모등록</button>
                                    </td>
                                    <td style="width: 10%; background: #444444;">관리자1</td>
                                    <td style="width: 15%; background: #888888;">2022-01-22  15:55</td>
                                    <td style="width: 45%; background: #888888; text-align: left;">메모메모메모</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%; background: #444444;">관리자1</td>
                                    <td style="width: 15%; background: #888888;">2022-01-22  15:55</td>
                                    <td style="width: 45%; background: #888888; text-align: left;">메모메모메모</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- 4th row -->
                    <div class="card-header">
                        <span style="color: #FF9300; font-size: 20px;">보유 및 거래금액</span>
                    </div>
                    <div class="card-body">
                        <div class="grid_column_inquiry_holding">
                            <table style="width: 100%;">
                                <tr>
                                    <th>보유머니</th>
                                    <th>총입금액<br>당일입금</th>
                                    <th>총출금액<br>당일출금</th>
                                    <th>총지급액<br>당일지급</th>
                                    <th>총회수액<br>당일회수</th>
                                    <th>당일거래<br>당일거래손익</th>
                                    <th>당일실현<br>당일실격</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                </tr>
                                <tr>
                                    <td id="totalcash" class="tdcashtrans"></td>
                                    <td class="tdcashtrans">
                                        <span id="totaldeposit" style="color: #78A6FF;"></span><br>
                                        <span id="totaldepositdaily" style="color: #78A6FF;"></span>
                                    </td>
                                    <td class="tdcashtrans">
                                        <span id="totalwithdraw" style="color: #FF787B;"></span><br>
                                        <span id="totalwithdrawdaily" style="color: #FF787B;"></span>
                                    </td>
                                    <td class="tdcashtrans">
                                        -
                                    </td>
                                    <td class="tdcashtrans">-</td>
                                    <td class="tdcashtrans">
                                        <span id="totaltradingdaily" style="color: #FFFFFF;"></span><br>
                                        <span id="totalprofitdaily" style="color: #FF787B;"></span>
                                    </td>
                                    <td class="tdcashtrans">-</td>
                                    <td class="tdcashtrans">-</td>
                                    <td class="tdcashtrans">-</td>
                                    <td class="tdcashtrans">-</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- 5th row -->
                    <div class="card-header">
                        <span style="color: #FF9300; font-size: 20px;">거래내역</span>
                        <div class="pull-right">
                            <button type="button" class="btn" style="background: #555555; color: #FFFFFF; margin-bottom: 6px;">1M</button>
                            <button type="button" class="btn" style="background: #3BDE42; color: #FFFFFF; margin-bottom: 6px;">접속</button>
                            <button type="button" class="btn" style="background: #3BDE42; color: #FFFFFF; margin-bottom: 6px;">메모</button>
                            <button type="button" class="btn" style="background: #3BDE42; color: #FFFFFF; margin-bottom: 6px;">쪽지</button>
                            <button type="button" class="btn" style="background: #3BDE42; color: #FFFFFF; margin-right: 150px; margin-bottom: 6px;">문의</button>
                            <button type="button" class="btn" style="background: #FFF200; color: #000000; margin-bottom: 6px;">머니</button>
                            <button type="button" class="btn" style="background: #FFF200; color: #000000; margin-bottom: 6px;">입금</button>
                            <button type="button" class="btn" style="background: #FFF200; color: #000000; margin-bottom: 6px;">출금</button>
                            <button type="button" class="btn" style="background: #FFF200; color: #000000; margin-bottom: 6px;">지급</button>
                            <button type="button" class="btn" style="background: #FFF200; color: #000000; margin-right: 50px; margin-bottom: 6px;">회수</button>
                            <select id="current_year" style="border: none; height: 35px; border-radius: 5px; width: 100px; text-align: center;">
                                <option value="<?=date('Y')?>"><?=date('Y')?>년</option>
                                <?php
                                    for($i = 2022; $i < 2030; $i++){
                                        echo '<option value='.$i.'>'.$i.'년</option>';
                                    }
                                ?>
                            </select>
                            <select id="current_month" style="border: none; height: 35px; border-radius: 5px; width: 100px; text-align: center;">
                                <option value="<?=date('m')?>"><?=date('m')?>월</option>
                                <?php
                                    for($i = 1; $i <= 12; $i++){
                                        if($i < 10){
                                            echo '<option value=0'.$i.'>0'.$i.'월</option>';
                                        }else{
                                            echo '<option value='.$i.'>'.$i.'월</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid_column_inquiry_trans">
                            <div id="pagination-result_mini">
                                <input type="hidden" name="rowcount" id="rowcount" />
                            </div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display template answer for inquiry -->
<div class="modal fade modal_inquiry_template" id="modal-inquiry_answer_template" tabindex="-1">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 25px; font-weight: 700;">답변 템플릿</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        답변 템플릿
                    </div>
                    <div class="card-body">
                        <form id="formInquiryTemplate" enctype="multipart/form-data" method="POST">
                            <div class="grid_column_inquiry_template">
                                <div>
                                    <input type="hidden" name="category_title" value="inquiry_answer_template">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="width: 20%;">제목</td>
                                            <td style="width: 80%;">
                                                <input type="text" class="noticeguide_input" name="inquiry_answer_title" placeholder="이용안내이용안내">
                                            </td>
                                        </tr>
                                    </table>
                                    <textarea id="summernote_inquiry_add" name="inquiry_answer_details"></textarea>
                                </div>
                            </div>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-inquiry_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display new record for note -->
<div class="modal fade modal_note_template" id="modal-note_add" tabindex="-1">
    <div class="modal-dialog modal-lg" style="height: 300px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 20px;">전체쪽지</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        전체쪽지
                    </div>
                    <div class="card-body">
                        <form id="formNote" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="category_title" value="note">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">제목</td>
                                    <td colspan="3">
                                        <input type="text" name="title_note" id="title_note" class="form-control" placeholder="전체쪽지전체쪽지......">
                                    </td>
                                </tr>
                            </table>
                            <textarea id="summernote_note_add" name="note_details"></textarea>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-note_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display edit for note -->
<div class="modal fade modal_note_template" id="modal-note_edit" tabindex="-1">
    <div class="modal-dialog modal-lg" style="height: 300px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 20px;">전체쪽지</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        전체쪽지
                    </div>
                    <div class="card-body">
                        <form id="formNote_Edit" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="category_title" value="note_edit">
                            <input type="hidden" id="id_note" name="id_note">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">제목</td>
                                    <td colspan="3">
                                        <input type="text" name="e_title_note" id="e_title_note" class="form-control" placeholder="전체쪽지전체쪽지......">
                                    </td>
                                </tr>
                            </table>
                            <textarea id="summernote_note_edit" name="e_note_details"></textarea>
                            <div style="padding: 10px 0;" class="m_footer">
                                <center><button type="submit" class="btn btn-note_save">등록</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display edit for note -->
<div class="modal fade modal_note_template" id="modal-delete_notif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="container">
                    <h3 class="text-center text-white modal-notif-body">모든 쪽지를 삭제하시겠습니까?</h3>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn close" data-dismiss="modal">아니요</button>
                        <button type="button" class="btn" id="btn_delete_all">예</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display edit for note -->
<div class="modal fade modal_note_template" id="modal-logout_notif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="container">
                    <h3 class="text-center text-white modal-notif-body">로그아웃 하시겠습니까?</h3>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn close" data-dismiss="modal">아니요</button>
                        <button type="button" class="btn btn_logout" data-code="<?=$_SESSION["admin_session"]["u_Account_Code"]?>">예</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>