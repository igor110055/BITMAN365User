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
                                            <input type="text" name="register_date" class="form-control datepicker" style="width: 80%; margin-right: 6px; text-align: center;" value="<?=date('Y-m-d')?>">
                                            <img src="../assets/icons/calendar.png" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="summer_body">
                            <textarea class="summernote" name="message"></textarea>
                            </div>
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
                                            <img src="../assets/icons/calendar.png" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="summer_body">
                            <textarea class="summernote_e" name="message_e" id="message_e"></textarea>
                            </div>
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
                                            <input type="text" name="register_date" class="form-control datepicker" style="width: 80%; margin-right: 6px; text-align: center;" value="<?=date('Y-m-d')?>">
                                            <img src="../assets/icons/calendar.png" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="summer_body">
                            <textarea class="summernote" name="message"></textarea>
                            </div>
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
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="card">
                    <div class="card-header">
                        이용안내
                    </div>
                    <div class="card-body">
                        <form id="formGuide_Edit" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="id_e" id="g_id_e">
                            <input type="hidden" name="category_title" value="guide_edit">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;">제목</td>
                                    <td colspan="3">
                                        <input type="text" name="title_e" id="g_title_e" class="noticeguide_input" placeholder="공지......">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">사용</td>
                                    <td style="width: 30%;">
                                        <div class="select-wrapper">
                                            <select name="use_nonuse_e" id="g_use_nonuse_e" class="form-control">
                                                <option selected disabled>-</option>
                                                <option value="1">사용</option>
                                                <option value="0">미사용</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">공지일자</td>
                                    <td style="width: 30%;">
                                        <div class="form-inline">
                                            <input type="text" name="register_date_e" id="g_register_date_e" class="form-control datepicker" style="width: 80%; margin-right: 6px; text-align: center;">
                                            <img src="../assets/icons/calendar.png" alt="cal">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="summer_body">
                            <textarea class="g_summernote_e" name="message_e" id="g_message_e"></textarea>
                            </div>
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
<div class="modal fade modal_inquiry_template" id="modal-inquiry_template" tabindex="-1">
    <div class="modal-dialog modal-lg" style="height: 300px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #333333;">
                <span style="color: #FFFFFF; font-size: 25px; font-weight: 700;">1:1 문의</span>
            </div>
            <div class="modal-body" style="padding: 0;">
                
                <div class="card">
                    <div class="card-header">
                        1:1 문의
                    </div>
                    <div class="card-body">
                        <form id="formInquiry" enctype="multipart/form-data" method="POST">
                            <div class="grid_column_inquiry">
                                <div>
                                    <input type="hidden" name="category_title" value="inquiry">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="width: 20%;">제목</td>
                                            <td colspan="3">
                                                <input type="text" id="t_title" class="noticeguide_input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;">닉네임</td>
                                            <td style="width: 30%;">
                                                <input list="nickname"  id="s_nickname" class="noticeguide_input">
                                                <div id="display_user"></div>
                                            </td>
                                            <td style="width: 20%;">문의일자</td>
                                            <td style="width: 30%;">
                                                <input type="text" id="t_inquiry_date" class="noticeguide_input">
                                            </td>
                                        </tr>
                                    </table>
                                    <textarea class="user_inquiry_details"></textarea>
                                    <div class="summer_body">
                                        <textarea class="summernote" name="message"></textarea>
                                    </div>
                                </div>
                                <div class="inquiry_template">
                                    <table class="table">
                                        <tr>
                                            <td>est</td>
                                        </tr>
                                    </table>
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
            </div>
            <div class="modal-body" style="padding: 0;">
                
                <div class="card">
                    <div class="card-header">
                        <span style="color: #FF9300; font-size: 20px;">기본정보</span>
                        <div class="pull-right" style="padding: 0;">
                            <button type="button" class="btn" style="background: #FF9300; color: #FFFFFF;">쪽지발송</button>
                            <button type="button" class="btn" style="background: #ED5659; color: #FFFFFF;">로그아웃</button>
                            <input type="text" class="btn" style="background: #FFFFFF; width: 120px; border-radius: 5px;">
                            <button type="button" class="btn" style="background: #FFF200; color: #000;">이용</button>
                            <button type="button" class="btn" style="background: #0093FF; color: #FFFFFF;">수정</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid_column_inquiry_user">
                            <div>
                                <table style="width: 100%;">
                                    <tr>
                                        <td>아이디</td>
                                        <td id="accountid" class="tdValue"></td>
                                        <td>닉네임</td>
                                        <td id="nname" class="tdValue"></td>
                                        <td>비밀번호</td>
                                        <td class="tdValue"><input type="text" id="pass" class="noticeguide_input"></td>
                                        <td>접속도메인</td>
                                        <td id="domain" class="tdValue"></td>
                                        <td>상태</td>
                                        <td id="" class="tdValue" style="color: #FF9300;">접속중</td>
                                    </tr>
                                    <tr>
                                        <td>예금주</td>
                                        <td class="tdValue">abcdefghijkl</td>
                                        <td>추천지점</td>
                                        <td class="tdValue">abcdefghijkl</td>
                                        <td>가입일자</td>
                                        <td class="tdValue"></td>
                                        <td>접속기기</td>
                                        <td class="tdValue">ctx365.com</td>
                                        <td>접속일자</td>
                                        <td class="tdValue">접속중</td>
                                    </tr>
                                    <tr>
                                        <td>은행</td>
                                        <td class="tdValue">
                                            <input list="banklist"  id="bankid" class="noticeguide_input">
                                            <div id="display_bank"></div>
                                        </td>
                                        <td colspan="2"></td>
                                        <td>가입IP</td>
                                        <td class="tdValue"></td>
                                        <td>접속브라우저</td>
                                        <td class="tdValue">ctx365.com</td>
                                        <td>접속IP</td>
                                        <td class="tdValue">접속중</td>
                                    </tr>
                                </table>
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>