$(".modal-guide_add_show").click(function(){
    $("#modal-guide_add").modal('show');
});
$('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
});
$("form[id='formGuide']").validate({
    ignore: ".note-editor *",
    rules: {
        title: {
            required: true
        },
        use_nonuse: {
            required: true
        },
        register_date: {
            required: true
        },
        guide_details: {
            required: true
        }
    },
    messages: {
        title: {
            required: "가치를 제공하다"
        },
        use_nonuse: {
            required: "가치를 제공하다"
        },
        register_date: {
            required: "가치를 제공하다"
        },
        guide_details: {
            required: "가치를 제공하다"
        },
    },
    submitHandler: function() {
        let formData = $('#formGuide').serialize();
        let title = $('#g_title').val();
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
                    location.href="./guide.php"
                }
            }
        });
    }
})
$("form[id='formGuide_Edit']").validate({
    ignore: ".note-editor *",
    rules: {
        g_title_e: {
            required: true
        },
        g_use_nonuse_e: {
            required: true
        },
        g_register_date_e: {
            required: true
        },
        g_guide_details_e: {
            required: true
        }
    },
    messages: {
        g_title_e: {
            required: "가치를 제공하다"
        },
        g_use_nonuse_e: {
            required: "가치를 제공하다"
        },
        g_register_date_e: {
            required: "가치를 제공하다"
        },
        g_guide_details_e: {
            required: "가치를 제공하다"
        },
    },
    submitHandler: function() {
        let formData = $('#formGuide_Edit').serialize();
        let title = $('#g_title_e').val();
        $.confirm({
            title: '업데이트하려고 합니다!',
            content: '제목: <span style="color: #458B00;">'+title+'</span> <br>범주: <span style="color: #458B00;">이용안내</span>',
            type: 'green',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-green',
                    action: function(){
                        $.ajax({
                            type: 'POST',
                            url: '../php/api/admin/postInformation.php',
                            data: { formData},
                            cache: false,
                            success: function(response){
                                if(response == 1){
                                    izitoast('이용안내!','성공적으로 추가됨.','fa fa-bullhorn','#1072BA','./guide.php');
                                }
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./guide.php"
                }
            }
        });
    }
})
$('.btn_delete_all').on('click', function() {
    //get all the checked checboxex
    var  arr = [];
    $("input:checkbox[name=chks]:checked").each(function () {
        arr.push($(this).data("id"));
    });
    $.confirm({
        title: '여러 개 삭제!',
        content: '범주: <span style="color: #ED5659;">이용안내</span>',
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Yes',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        type: 'POST',
                        url: '../php/api/admin/postInformationDelete.php?category_title=guide_delete_multiple',
                        cache: false,
                        data: JSON.stringify(arr),
                        success: function(response){
                            izitoast('이용안내!','성공적으로 삭제되었습니다.','fa fa-times-circle-o','#ED5659','./guide.php');
                        }
                    })
                }
            },
            close: function () {
                location.href="./guide.php"
            }
        }
    });
});
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
getresult("../php/api/admin/getGuideList.php");