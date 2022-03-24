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
$(".modal-inquiry_template_show").click(function(){
    $("#modal-inquiry_template").modal('show');
});
$("form[id='formGuide']").validate({
    ignore: ".note-editor *",
    rules: {
        title: {
            required: true
        },
        nickname: {
            required: true
        },
        inquiry_date: {
            required: true
        },
        details: {
            required: true
        }
    },
    messages: {
        title: {
            required: "제목 제공"
        },
        nickname: {
            required: "별명 제공"
        },
        inquiry_date: {
            required: "문의 날짜 제공"
        },
        details: {
            required: "날짜 제공"
        },
    },
    submitHandler: function() {
        let formData = $('#formInquiry').serialize();
        let title = $('#t_title').val();
        $.confirm({
            title: '게시하려고 합니다!',
            content: '제목: <span style="color: #1072BA;">'+title+'</span> <br>범주: <span style="color: #1072BA;">이용안내</span>',
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
                                $("#modal-notice_add").modal('hide');
                                if(response == 1){
                                    izitoast('이용안내!','성공적으로 추가됨.','fa fa-bullhorn','#1072BA','./guide.php');
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
function getUserList(url){
    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        success: function(response){
            var html = '';
            html += '<datalist id="nickname">';
            response.forEach(function(el){
                html += '<option value='+el.u_Nickname+' class="display_user_perid">'+el.u_Nickname+'</option>';
            })  
            html += '</datalist>';
            $('#display_user').html(html);
        }
    })
}
$(document).on('change','#s_nickname', function(){
    var nname = $(this).val();
    $.ajax({
        type: 'POST',
        url: '../php/api/admin/getUserPerNickname.php?nickname='+nname,
        cache: false,
        success: function(response){
            var date = new Date();
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var res = response;
            if(response){
                $("#modal-inquiry_user_display").modal('show');
                $('#accountid').text(res.Account_Code);
                $('#nname').text(res.Nickname);
                $('#pass').val(res.Password);
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
                getresult_mini("../php/api/admin/getUserTransactionList.php?code="+res.Account_Code+'&year='+year+'&month='+month);
            }
        }
    })
})
$(document).on('change','#current_year', function(){
    var year = $(this).val();
    var month = $('.current_month').val();
    var code = $('#accountid').text();
    getresult_mini("../php/api/admin/getUserTransactionList.php?code="+code+'&year='+year+'&month='+month);
})
function getBanklist(url){
    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        success: function(response){
            var html = '';
            html += '<datalist id="banklist">';
            response.forEach(function(el){
                html += '<option data-value='+el.m_BankId+' class="display_user_perid">'+el.m_Bank_Name+'</option>';
            })  
            html += '</datalist>';
            $('#display_bank').html(html);
        }
    })
}
getBanklist("../php/api/getBankList.php");
getUserList("../php/api/admin/getUserList.php");
getresult("../php/api/admin/getInquiryList.php");