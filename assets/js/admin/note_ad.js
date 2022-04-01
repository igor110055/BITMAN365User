$(".modal-note_add_show").click(function(){
    $("#modal-note_add").modal('show');
});
$('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
});
$("form[id='formNote']").validate({
    ignore: ".note-editor *",
    rules: {
        title: {
            required: true
        },
        note_details: {
            required: true
        }
    },
    messages: {
        title: {
            required: "가치를 제공하다"
        },
        note_details: {
            required: "가치를 제공하다"
        },
    },
    submitHandler: function() {
        let formData = $('#formNote').serialize();
        let title = $('#title').val();
        $.confirm({
            title: '게시하려고 합니다!',
            content: '제목: <span style="color: #1072BA;">'+title+'</span> <br>범주: <span style="color: #1072BA;">쪽지</span>',
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
                                    izitoast('공지사항!','성공적으로 추가됨.','fa fa-bullhorn','#1072BA','./note.php');
                                }
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./note.php"
                }
            }
        });
    }
})
$("form[id='formNote_Edit']").validate({
    ignore: ".note-editor *",
    rules: {
        e_title_note: {
            required: true
        },
        e_note_details: {
            required: true
        }
    },
    messages: {
        e_title_note: {
            required: "가치를 제공하다"
        },
        e_note_details: {
            required: "가치를 제공하다"
        },
    },
    submitHandler: function() {
        let formData = $('#formNote_Edit').serialize();
        let title = $('#e_title_note').val();
        $.confirm({
            title: '업데이트하려고 합니다!',
            content: '제목: <span style="color: #458B00;">'+title+'</span> <br>범주: <span style="color: #458B00;">쪽지</span>',
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
                                console.log(reponse)
                                if(response == 1){
                                    izitoast('공지사항!','성공적으로 업데이트되었습니다.','fa fa-bullhorn','#1072BA','./note.php');
                                }
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./note.php"
                }
            }
        });
    }
})
$('.btn_delete_all').on('click', function() {
    //get all the checked checboxex
    var  arr = [];
    $("input:checkbox[name=chks_not]:checked").each(function () {
        arr.push($(this).data("id")); 
    });
    $.confirm({
        title: '여러 개 삭제!',
        content: '범주: <span style="color: #ED5659;">공지사항</span>',
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Yes',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        type: 'POST',
                        url: '../php/api/admin/postInformationDelete.php?category_title=note_delete_multiple',
                        cache: false,
                        data: JSON.stringify(arr),
                        success: function(response){
                            izitoast('공지사항!','성공적으로 업데이트되었습니다.','fa fa-check-circle-o','#1072BA','./note.php');
                        }
                    })
                }
            },
            close: function () {
                location.href="./note.php"
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
getresult("../php/api/admin/getNoteList.php");