<!-- html head -->
<?php include __DIR__ . '/includes/head_html.php';?>
    <style>
        body{
            background: #393E46;
            padding: 100px 743px;
        }
        #modal-login{
            margin-top: 100px;
            margin-right: auto;
            margin-left: auto;
        }
        #modal-login .modal-content {
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
        }
        #modal-login .modal-dialog{
            width: 600px;
            height: 350px;
        }
        #modal-login .modal-backdrop{
            background-color: transparent !important;
        }
        #modal-login .modal-backdrop.in {
            opacity: 0;
        }
        #modal-login .modal-title{
            text-align: center;
        }
        #modal-login .modal-header{
            border-bottom: none;
        }
        #modal-login .modal-body{
            padding: 10px 50px;
        }
        #modal-login .modal-footer{
            border-top: none;
        }
        #modal-login .textinput{
            height: 44px;
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 8px 16px;
            background: #F7F7F7;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
        }
        #modal-login .modal-body .text-yellow{
            color: #FFF200;
            font-size: 20px;
            font-weight: 700;
        }
        #modal-login .modal-footer .btn-user-gray, #modal-login .modal-footer .btn-user-orange{
            width: 150px;
            height: 44px;
            background: #888888;
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            font-size: 16px;
            color: #FFFFFF;
        }
        #modal-login .modal-footer .btn-user-gray{
            background: #888888;
        }
        #modal-login .modal-footer .btn-user-orange{
            background: #FF9300;
        }
        @media (max-width: 1528px){
            body{
                padding: 50px 480px;
            }
        }
        @media (max-width: 1200px){
            body{
                padding: 50px 350px;
            }
        }
        @media (max-width: 1140px){
            body{
                padding: 50px 300px;
            }
        }
        @media (max-width: 992px){
            body{
                padding: 50px 250px;
            }
        }
        @media (max-width: 768px){
            body{
                padding: 50px 100px;
            }
        }
        @media (max-width: 600px){
            body{
                padding: 50px 50px;
            }
        }
        @media (max-width: 479px){
            body{
                padding: 50px 30px;
            }
        }
    </style>
    <div class="div_container adminlog">
        <div id="modal-login">
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
                    <button type="submit" class="btn btn-user-orange">로그인</button>
                </div>
            </form>
        </div>
    </div>
    <!-- script js -->
    <?php include __DIR__ . '/includes/script.php';?>

    </body>
</html>