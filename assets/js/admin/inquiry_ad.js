function getresult(url) {
    $.ajax({
        url: url,
        type: "GET",
        data:  {rowcount:$("#rowcount").val()},
        //beforeSend: function(){$("#overlay").show();},
        success: function(data){
        $("#pagination-result").html(data);
        setInterval(function() {$("#overlay").hide(); },500);
        },
        error: function() 
        {} 	        
   });
} 
function getresult_mini(url,code) {
    $.ajax({
        url: url,
        type: "GET",
        data:  {rowcount:$("#rowcount").val()},
        //beforeSend: function(){$("#overlay").show();},
        success: function(data){
        $("#pagination-result_mini").html(data);
        setInterval(function() {$("#overlay").hide(); },500);
        },
        error: function() 
        {} 	        
   });
} 
$("form[id='formInquiryTemplate']").validate({
    ignore: ".note-editor *",
    rules: {
        inquiry_answer_title: {
            required: true
        },
        inquiry_answer_details: {
            required: true
        }
    },
    messages: {
        inquiry_answer_title: {
            required: "필드는 필수 항목입니다."
        },
        inquiry_answer_details: {
            required: "필드는 필수 항목입니다."
        }
    },
    submitHandler: function() {
        let formData = $('#formInquiryTemplate').serialize();
        let title = $('#inquiry_answer_title').val();
        $.confirm({
            title: '게시하려고 합니다!',
            content: '제목: <span style="color: #1072BA;">'+title+'</span> <br>범주: <span style="color: #1072BA;">문의</span>',
            type: 'blue',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-blue',
                    action: function(){
                        $.ajax({
                            type: 'POST',
                            url: '../php/api/admin/postInformation.php',
                            data: { formData},
                            cache: false,
                            success: function(response){
                                $("#modal-inquiry_answer_template").modal('hide');
                                if(response == 1){
                                    izitoast('이용안내!','성공적으로 추가됨.','fa fa-bullhorn','#1072BA','./inquiry.php');
                                }
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./inquiry.php"
                }
            }
        });
    }
})
$("form[id='formInquiryEdit']").validate({
    ignore: ".note-editor *",
    rules: {
        i_id_e: {
            required: true
        },
        i_inquiry_details_e: {
            required: true
        }
    },
    messages: {
        i_id_e: {
            required: "필드는 필수 항목입니다."
        },
        i_inquiry_details_e: {
            required: "필드는 필수 항목입니다."
        }
    },
    submitHandler: function() {
        let formData = $('#formInquiryEdit').serialize();
        let title = $('#i_title_e').val();
        $.confirm({
            title: '게시하려고 합니다!',
            content: '제목: <span style="color: #1072BA;">'+title+'</span> <br>범주: <span style="color: #1072BA;">문의</span>',
            type: 'blue',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-blue',
                    action: function(){
                        $.ajax({
                            type: 'POST',
                            url: '../php/api/admin/postInformation.php',
                            data: { formData},
                            cache: false,
                            success: function(response){
                                $("#modal-inquiry_template_edit").modal('hide');
                                if(response == 1){
                                    izitoast('이용안내!','성공적으로 추가됨.','fa fa-bullhorn','#1072BA','./inquiry.php');
                                }
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./inquiry.php"
                }
            }
        });
    }
})
$("#userbtnsubmit").click(function(){
    let formData = $('#formUserUpdateByAdmin').serialize();
    var adminPass = $('#admin_pwd').val();
    var userPass = $('#user_pass').val();
    $.post('../php/api/admin/checkAdminUserPass.php?admin_pass='+adminPass, function(response){
        if(response == 0){
            izitoastmsg('알리다!','비밀번호가 일치하지 않습니다.','fa fa-ban','#ED5659');
            return false;
        }else{
            if (!(/^(.{4,12}$)/.test(userPass))) {
                return izitoastmsg('알리다!','숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.','fa fa-ban','#ED5659');
            }
            else if (!(/^(?=.*[A-Z])/.test(userPass))) {
                return izitoastmsg('알리다!','숫자, 영어대/소문자, 특수문자를 포함하여 A~Z자까지 가능합니다.','fa fa-ban','#ED5659');
            }
            else if (!(/^(?=.*[a-z])/.test(userPass))) {
                return izitoastmsg('알리다!','숫자, 영어대/소문자, 특수문자를 포함하여 a~z자까지 가능합니다.','fa fa-ban','#ED5659');
            }
            else if (!(/^(?=.*[0-9])/.test(userPass))) {
                return izitoastmsg('알리다!','숫자, 영어대/소문자, 특수문자를 포함하여 0~9자까지 가능합니다.','fa fa-ban','#ED5659');
            }
            else if (!(/^(?=.*[@#$%&!])/.test(userPass))) {
                return izitoastmsg('알리다!','숫자, 영어대/소문자, 특수문자를 포함하여 @#$%&!자까지 가능합니다.','fa fa-ban','#ED5659');
            }
            postuserUpdateByAdmin(formData);
        }
    })
})
function postuserUpdateByAdmin(formData){
    let accountid = $('#accountid').text();
    $.ajax({
        type: 'POST',
        url: '../php/api/admin/postInformation.php',
        data: { formData},
        cache: false,
        success: function(response){
            if(response == 1){
                izitoastmsg('알리다!','ID '+accountid+' 에 대해 성공적으로 업데이트되었습니다.','fa fa-check-circle-o','#1072BA');
                return false; 
            }else{
                izitoastmsg('알리다!','오류 발생, 세부 사항 확인.','fa fa-ban','#ED5659');
                return false; 
            }
        }
    })
}
$("#btn_stop_site").click(function(){
    if (this.checked) {
        $('.btn_stop_site').each(function () {
            this.checked = true;
            $('#usenouse').text('이용');
        });
    } else {
        $('.btn_stop_site').each(function () {
            this.checked = false;
            $('#usenouse').text('멈추다');
        });
    }
    var ctitle = 'stop_usage';
    var code = $('#accountid').text();
    var onoff = (this.checked == true) ? 1 : 0;
    $.ajax({
        type: 'POST',
        url: '../php/api/admin/postInformation.php?category_title='+ctitle+'&code='+code+'&usenoneuse='+onoff,
        cache: false,
        success: function(response){
            if(response == 1){
                izitoastmsg('알리다!','ID '+code+' 에 대해 성공적으로 업데이트되었습니다.','fa fa-check-circle-o','#1072BA');
                return false; 
            }else{
                izitoastmsg('알리다!','오류 발생, 세부 사항 확인.','fa fa-ban','#ED5659');
                return false; 
            }
        }
    })
})
function getUserList(url){
    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        success: function(response){
            var html = '';
            response.forEach(function(el){
                html += '<option value='+el.u_Nickname+' class="display_user_perid">'+el.u_Nickname+'</option>';
            })
            $('#i_nickname_e').html(html);
        }
    })
}
$(document).on('change','#i_nickname_e', function(){
    var nname = $(this).val();
    $.ajax({
        type: 'POST',
        url: '../php/api/admin/getUserPerNickname.php?nickname='+nname,
        cache: false,
        success: function(response){
            var formatter = new Intl.NumberFormat();
            var date = new Date();
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var res = response;
            if(response){
                $("#modal-inquiry_user_display").modal('show');
                $('#accountid').text(res.Account_Code);
                $('#accountid_s').val(res.Account_Code);
                $('#nname').text(res.Nickname);
                $('#user_pass').val(res.Password);
                $('#domain').text(res.Domain);
                $('#slate').html((res.isActive == 1) ? '<span style="color: #FF9300;">접속중</span>' : '<span style="color: #000000;">미접속</span>');
                $('#aholder').text(res.Bank_Holder_Name);
                $('#rpoint').text(res.Recommended_Point);
                $('#regdate').text(res.Entry_Date);
                $('#device').text(res.Device_Use);
                $('#logindate').text(res.LogInDateTime);
                $('#bankid').val(res.BankName);
                $('#accountno').text(res.Account_Number);
                $('#ip').text(res.Current_Ip);
                $('#browser').text(res.Browser_Use);
                $('#server_ip').text(res.ServerIp);
                $('#usenouse').text((res.UseNoUse == 0) ? '멈추다' : '이용');
                $('#totalcash').text(formatter.format(res.TotalCashAmount));
                $('#totaldeposit').text(formatter.format(res.TotalDepositAmount));
                $('#totaldepositdaily').text(formatter.format(res.TotalDepositDailyAmount));
                $('#totalwithdraw').text(formatter.format(res.TotalWithdrawAmount));
                $('#totalwithdrawdaily').text(formatter.format(res.TotalWithdrawDailyAmount));
                $('#totaltradingdaily').text(formatter.format(res.TotalTradingDailyAmount));
                $('#totalprofitdaily').text(formatter.format(res.TotalProfitDailyAmount));
                $('#totalprofitdaily').text(formatter.format(res.TotalDisqualifytDailyAmount));
                getBanklist(res.Bank_Code,res.BankName);
                getresult_mini("../php/api/admin/getUserTransactionList.php?code="+res.Account_Code+'&year='+year+'&month='+month);
            }
        }
    })
})
$(document).on('change','#current_year', function(){
    var year = $(this).val();
    var month = $('#current_month').val();
    var code = $('#accountid').text();
    getresult_mini("../php/api/admin/getUserTransactionList.php?code="+code+'&year='+year+'&month='+month);
})
$(document).on('change','#current_month', function(){
    var month = $(this).val();
    var year = $('#current_year').val();
    var code = $('#accountid').text();
    getresult_mini("../php/api/admin/getUserTransactionList.php?code="+code+'&year='+year+'&month='+month);
})
function getBanklist(bankid,bankname){
    $.ajax({
        type: 'GET',
        url: '../php/api/getBankList.php',
        cache: false,
        success: function(response){
            var html = '';
            html += '<option value='+bankid+' class="display_user_perid">'+bankname+'</option>';
            response.forEach(function(el){
                html += '<option value='+el.m_BankId+' class="display_user_perid">'+el.m_Bank_Name+'</option>';
            })
            $('#bankid').html(html);
        }
    })
}
function getAnswerTemplateList(url){
    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        success: function(response){
            $('#display_answer').html(response);
        }
    })
}
$(".modal-answer_template").click(function(){
    $("#modal-inquiry_answer_template").modal('show');
})
getAnswerTemplateList("../php/api/admin/getAnswerTemplateList.php");
getUserList("../php/api/admin/getUserList.php");
getresult("../php/api/admin/getInquiryList.php");