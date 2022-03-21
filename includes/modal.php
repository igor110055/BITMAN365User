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
<div class="modal fade" id="modal-notice_add" tabindex="-1">
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
<div class="modal fade" id="modal-notice_edit" tabindex="-1">
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
<div class="modal fade" id="modal-guide_add" tabindex="-1">
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
<div class="modal fade" id="modal-guide_edit" tabindex="-1">
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