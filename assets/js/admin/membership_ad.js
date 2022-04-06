var datetoday = moment.tz(moment(),'Asia/Seoul').format("YYYY-MM-DD");
// $('.datepicker_start').val(datetoday);
// $('.datepicker_end').val(datetoday);
$('.datepicker_start,.datepicker_end').datepicker({
    dateFormat: 'yy-mm-dd',
    showOn: 'button',
    buttonImageOnly: true,
    buttonImage: '../assets/icons/calendar.png',
});
function getresult(url,arr) {
    $.ajax({
        url: url,
        type: "GET",
        data:  (arr) ? arr : {rowcount:$("#rowcount").val()},
        //beforeSend: function(){$("#overlay").show();},
        success: function(data){
        $("#pagination-result").html(data);
        setInterval(function() {$("#overlay").hide(); },500);
        },
        error: function() 
        {} 	        
   });
}
function getPoint(url){
    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        success: function(response){
            var html = '';
            html += '<option selected disabled>- 지점 -</option>';
            html += '<option value="">모두 표시</option>';
            response.forEach(function(el){
                html += '<option value='+el.u_Recommended_Point+'>'+el.u_Recommended_Point+'</option>';
            })
            $('#s_point').html(html);
        }
    })
}
// function getUserList(url){
//     $.ajax({
//         type: 'GET',
//         url: url,
//         cache: false,
//         success: function(response){
//             var html = '';
//             html += '<option selected disabled>- 닉네임 -</option>';
//             html += '<option value="">모두 표시</option>';
//             response.forEach(function(el){
//                 html += '<option value='+el.u_Nickname+'>'+el.u_Nickname+'</option>';
//             })
//             $('#s_nickname').html(html);
//         }
//     })
// }
// function getAccessDate(url){
//     $.ajax({
//         type: 'GET',
//         url: url,
//         cache: false,
//         success: function(response){
//             var html = '';
//             html += '<option selected disabled>- 접속일자 -</option>';
//             html += '<option value="">모두 표시</option>';
//             response.forEach(function(el){
//                 html += '<option value='+el.l_LogInDateTime+'>'+el.l_LogInDateTime+'</option>';
//             })
//             $('#s_accessdate').html(html);
//         }
//     })
// }
// function getSubscriptionDate(url){
//     $.ajax({
//         type: 'GET',
//         url: url,
//         cache: false,
//         success: function(response){
//             var html = '';
//             html += '<option selected disabled>- 가입일자 -</option>';
//             html += '<option value="">모두 표시</option>';
//             response.forEach(function(el){
//                 html += '<option value='+el.u_Entry_Date+'>'+el.u_Entry_Date+'</option>';
//             })
//             $('#s_subscriptiondate').html(html);
//         }
//     })
// }
// $('.btn_search').click(function(){
//     var state = $('#s_state').val();
//     var point = $('#s_point').val();
//     var nickname = $('#s_nickname').val();
//     var search_input = $('#search_input').val();
//     var accessdate = $('#s_accessdate').val();
//     var subscriptiondate = $('#s_subscriptiondate').val();
//     var datepicker_start = $('#datepicker_start').val();
//     var datepicker_end = $('#datepicker_end').val();
//     getresult("../php/api/admin/getMembershipList.php");
// })
// $('.datepicker_start').change(function(){
//     var start = $(this).val();
//     var end = $('.datepicker_end').val();
//     var state = $('#s_state').val();
//     var point = $('#s_point').val();
//     var nickname = $('#s_nickname').val();
//     var search_input = $('#search_input').val();
//     var accessdate = $('#s_accessdate').val();
//     var subscriptiondate = $('#s_subscriptiondate').val();
//     var arr = {rowcount:$("#rowcount").val(),start:start,end:end,state:state,point:point,nickname:nickname,search_input:search_input,accessdate:accessdate,subscriptiondate:subscriptiondate}
//     getresult("../php/api/admin/getMembershipList.php",arr);
// })
// $('.datepicker_end').change(function(){
//     var start = $('.datepicker_start').val();
//     var end = $(this).val();
//     var state = $('#s_state').val();
//     var point = $('#s_point').val();
//     var nickname = $('#s_nickname').val();
//     var search_input = $('#search_input').val();
//     var accessdate = $('#s_accessdate').val();
//     var subscriptiondate = $('#s_subscriptiondate').val();
//     var arr = {rowcount:$("#rowcount").val(),start:start,end:end,state:state,point:point,nickname:nickname,search_input:search_input,accessdate:accessdate,subscriptiondate:subscriptiondate}
//     getresult("../php/api/admin/getMembershipList.php",arr);
// })
$('#s_state').change(function(){
    var start = $('.datepicker_start').val();
    var end = $('.datepicker_end').val();
    var state = $(this).val();
    var point = $('#s_point').val();
    var nickname = $('#s_nickname').val();
    var search_input = $('#search_input').val();
    var accessdate = $('#s_accessdate').val();
    var subscriptiondate = $('#s_subscriptiondate').val();
    var arr = {rowcount:$("#rowcount").val(),start:start,end:end,state:state,point:point,nickname:nickname,search_input:search_input,accessdate:accessdate,subscriptiondate:subscriptiondate}
    getresult("../php/api/admin/getMembershipList.php",arr);
})
$('#s_point').change(function(){
    var start = $('.datepicker_start').val();
    var end = $('.datepicker_end').val();
    var state = $('#s_state').val();
    var point = $(this).val();
    var nickname = $('#s_nickname').val();
    var search_input = $('#search_input').val();
    var accessdate = $('#s_accessdate').val();
    var subscriptiondate = $('#s_subscriptiondate').val();
    var arr = {rowcount:$("#rowcount").val(),start:start,end:end,state:state,point:point,nickname:nickname,search_input:search_input,accessdate:accessdate,subscriptiondate:subscriptiondate}
    getresult("../php/api/admin/getMembershipList.php",arr);
})
$('#s_field_list').change(function(){
    var field = $(this).val();
    var searchfield = $('#search_input').val();
    var arr = {rowcount:$("#rowcount").val(),field:field,searchfield:searchfield}
    getresult("../php/api/admin/getMembershipList.php",arr);
})
$('#search_input').keyup(function(){
    var field = $('#s_field_list').val();
    var searchfield = $(this).val();
    var arr = {rowcount:$("#rowcount").val(),field:field,searchfield:searchfield}
    getresult("../php/api/admin/getMembershipList.php",arr);
})
function getNickname(){
    var nick = $('#s_field_list').val();
    var searchfield = $('#search_input').val();
    var arr = {rowcount:$("#rowcount").val(),nick:nick,searchfield:searchfield}
    getresult("../php/api/admin/getMembershipList.php",arr);
}
$('#s_field_list_date').change(function(){
    var field = $(this).val();
    var start = $('.datepicker_start').val();
    var end = $('.datepicker_end').val();
    var arr = {rowcount:$("#rowcount").val(),field:field,start:start,end:end}
    getresult("../php/api/admin/getMembershipList.php",arr);
})
$('#datepicker_start').change(function(){
    var field = $('#s_field_list_date').val();
    var start = $(this).val();
    var end = $('.datepicker_end').val();
    var arr = {rowcount:$("#rowcount").val(),field:field,start:start,end:end}
    getresult("../php/api/admin/getMembershipList.php",arr);
})
$('#datepicker_end').change(function(){
    var field = $('#s_field_list_date').val();
    var start = $('#datepicker_start').val();
    var end = $('#datepicker_end').val();
    var arr = {rowcount:$("#rowcount").val(),field:field,start:start,end:end}
    getresult("../php/api/admin/getMembershipList.php",arr);
})
function getDateAccess(){
    var field = $('#s_field_list_date').val();
    var start = $().val();
    var end = $('.datepicker_end').val();
    var arr = {rowcount:$("#rowcount").val(),field:field,start:start,end:end}
    getresult("../php/api/admin/getMembershipList.php",arr);
}
// $('#s_accessdate').change(function(){
//     var start = $('.datepicker_start').val();
//     var end = $('.datepicker_end').val();
//     var state = $('#s_state').val();
//     var point = $('#s_point').val();
//     var nickname = $('#s_nickname').val();
//     var search_input = $('#search_input').val();
//     var accessdate = $(this).val();
//     var subscriptiondate = $('#s_subscriptiondate').val();
//     var arr = {rowcount:$("#rowcount").val(),start:start,end:end,state:state,point:point,nickname:nickname,search_input:search_input,accessdate:accessdate,subscriptiondate:subscriptiondate}
//     getresult("../php/api/admin/getMembershipList.php",arr);
// })
// $('#s_subscriptiondate').change(function(){
//     var start = $('.datepicker_start').val();
//     var end = $('.datepicker_end').val();
//     var state = $('#s_state').val();
//     var point = $('#s_point').val();
//     var nickname = $('#s_nickname').val();
//     var search_input = $('#search_input').val();
//     var accessdate = $('#s_accessdate').val();
//     var subscriptiondate = $(this).val();
//     var arr = {rowcount:$("#rowcount").val(),start:start,end:end,state:state,point:point,nickname:nickname,search_input:search_input,accessdate:accessdate,subscriptiondate:subscriptiondate}
//     getresult("../php/api/admin/getMembershipList.php",arr);
// })
// $('#datepicker_start').change(function(){
//     var start = $(this).val();
//     var end = $('.datepicker_end').val();
//     var state = $('#s_state').val();
//     var point = $('#s_point').val();
//     var nickname = $('#s_nickname').val();
//     var search_input = $('#search_input').val();
//     var accessdate = $('#s_accessdate').val();
//     var subscriptiondate = $('#s_subscriptiondate').val();
//     var arr = {rowcount:$("#rowcount").val(),start:start,end:end,state:state,point:point,nickname:nickname,search_input:search_input,accessdate:accessdate,subscriptiondate:subscriptiondate}
//     getresult("../php/api/admin/getMembershipList.php",arr);
// })
// $('#datepicker_end').change(function(){
//     var start = $('.datepicker_start').val();
//     var end = $(this).val();
//     var state = $('#s_state').val();
//     var point = $('#s_point').val();
//     var nickname = $('#s_nickname').val();
//     var search_input = $('#search_input').val();
//     var accessdate = $('#s_accessdate').val();
//     var subscriptiondate = $('#s_subscriptiondate').val();
//     var arr = {rowcount:$("#rowcount").val(),start:start,end:end,state:state,point:point,nickname:nickname,search_input:search_input,accessdate:accessdate,subscriptiondate:subscriptiondate}
//     getresult("../php/api/admin/getMembershipList.php",arr);
// })
//getSubscriptionDate("../php/api/admin/getSubscriptionDate.php");
//getAccessDate("../php/api/admin/getAccessDate.php");
//getUserList("../php/api/admin/getUserList.php");
getPoint("../php/api/admin/getPointList.php")
//getresult("../php/api/admin/getMembershipList.php");
getNickname();
getDateAccess();