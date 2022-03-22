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
$(".display_user").click(function(){
    $.ajax({
        type: 'GET',
        url: '../php/api/admin/getUserList.php',
        cache: false,
        success: function(response){
            $("#modal-notice_add").modal('hide');
            if(response == 1){
                izitoast('이용안내!','성공적으로 추가됨.','fa fa-bullhorn','#1072BA','./guide.php');
            }
        }
    })
});
getresult("../php/api/admin/getInquiryList.php");