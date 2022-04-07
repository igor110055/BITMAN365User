function display_time() {
    counter();
}
function counter(){
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_time()',refresh)
    reserve = setTimeout('btcusdt()',refresh)
}
function btcusdt(){
    var array1 = [];
    var array2 = [];
    var select = [];
    var lasttime = convertUnixtoUnix(moment().subtract(1, 'minutes'));
    var mydate1 = convertUnixtoUnix(moment());
    var mydate2 = convertUnixtoUnix(moment().add(1, 'minutes'));
    var mydate3 = convertUnixtoUnix(moment().add(2, 'minutes'));
    var mydate4 = convertUnixtoUnix(moment().add(3, 'minutes'))
    array1.push(mydate4,mydate3,mydate2,mydate1,lasttime);
    var html = '';
    $.post( "../php/api/admin/getReservedGameResult.php",JSON.stringify(array1), function( response ) {
        response.forEach(function(el){
            array2.push(parseFloat(el.r_Time_Unix));
            select.push({time: parseFloat(el.r_Time_Unix), select: el.r_Game_Selected});
        })
        
        var sel = select[select.length - 1];
        var chk1 = array1.filter(function(val) {
            html += '<tr>';
            if(array2.indexOf(val) != -1){
                html += '<td>BTC/USD 1분</td>';
                html += '<td>'+convertUnixtoTime(val)+'</td>';
                html += '<td>1.95</td>';
                html += '<td style="padding:5px;"><button type="button" class="btn btn-sm btn_text" data-type="BTCUSDT" style="background: #ED5659; border: none;" disabled>매수실현</button></td>';
                html += '<td style="padding:5px;"><button type="button" class="btn btn-sm btn_text" data-type="BTCUSDT" style="background: #0093FF; border: none;" disabled>매도실현</button></td>';
                select.forEach(function(element){
                    if(element.time == val){
                        if(element.select == '매도'){
                            html += '<td style="color: #78A6FF;">매도실현</td>';
                        }else if(element.select == '매수'){
                            html += '<td style="color: #ED5659;">매수실현</td>';
                        }
                    }
                });
                html += '<td style="padding:5px;"><button type="button" class="btn btn-sm btn_text btn_canceled" data-type="BTCUSDT" style="background: #555555; border: none; color: #222222;" disabled>예약취소</button></td>';
                
            }else{
                html += '<td>BTC/USD 1분</td>';
                html += '<td>'+convertUnixtoTime(val)+'</td>';
                html += '<td>1.95</td>';
                html += '<td style="padding:5px;"><button type="button" class="btn btn-sm btn_text btn_mydate_sell'+val+'" onclick="reservedTime('+val+')" data-type="BTCUSDT" style="background: #ED5659; border: none;">매수실현</button></td>';
                html += '<td style="padding:5px;"><button type="button" class="btn btn-sm btn_text btn_mydate_buy'+val+'" onclick="reservedTime('+val+')" data-type="BTCUSDT" style="background: #0093FF; border: none;">매도실현</button></td>';
                html += '<td>-</td>';
                html += '<td style="padding:5px;"><button type="button" class="btn btn-sm btn_text btn_canceled" data-type="BTCUSDT" style="background: #555555; border: none; color: #222222;" disabled>예약취소</button></td>';
                
            }
            html += '</tr>';
            $('#tbody_data').html(html)
        });
    })
}
//date add 3 minutes
function reservedTime(dtime){
    $(document).on('click','.btn_mydate_sell'+dtime, function(){
        var mydate = moment.unix(dtime).format('YYYY-MM-DD HH:mm');
        //var mydate = moment.tz(moment().add(3, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
        var unixtime = Math.floor(new Date(mydate).getTime());
        var unixseconds = unixtime / 1000;
        var selected = '매수';
        var type = $(this).data('type');
        var result = [{unixseconds: unixseconds, datetime: mydate, selected: selected, type: type}];
        $.confirm({
            title: 'Time to reserved: <span style="font-size: 14px; font-style: italic; color: #ED5659;">'+ mydate+'</span>',
            content: 'Click <span style="color: #ED5659; font-weight: 700;">제한된</span> to submit.',
            type: 'red',
            typeAnimated: true,
            buttons: {
                reserved: {
                    text: '제한된',
                    btnClass: 'btn-red',
                    action: function(){
                        $.post( "../php/api/admin/postReservedGameResult.php", JSON.stringify(result), function( response ) {
                            if(response == true){
                                iziToast.error({
                                    title: '제한된',
                                    message: 'Time Reserved: '+ mydate,
                                    timeout: 2000,
                                    onClosing: function(){
                                        location.reload(true);
                                    }
                                });
                            }
                        })
                    }
                },
                close: function () {
                    location.reload(true);
                }
            }
        });
    })
    $(document).on('click','.btn_mydate_buy'+dtime, function(){
        var mydate = moment.unix(dtime).format('YYYY-MM-DD HH:mm');
        //var mydate = moment.tz(moment().add(3, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
        var unixtime = Math.floor(new Date(mydate).getTime());
        var unixseconds = unixtime / 1000;
        var selected = '매도';
        var type = $(this).data('type');
        var result = [{unixseconds: unixseconds, datetime: mydate, selected: selected, type: type}];
        $.confirm({
            title: 'Time to reserved: <span style="font-size: 14px; font-style: italic; color: #1072BA;">'+ mydate+'</span>',
            content: 'Click <span style="color: #1072BA; font-weight: 700;">제한된</span> to submit.',
            type: 'blue',
            typeAnimated: true,
            buttons: {
                reserved: {
                    text: '제한된',
                    btnClass: 'btn-blue',
                    action: function(){
                        $.post( "../php/api/admin/postReservedGameResult.php", JSON.stringify(result), function( response ) {
                            if(response == true){
                                iziToast.info({
                                    title: '제한된',
                                    message: 'Time Reserved: '+ mydate,
                                    timeout: 2000,
                                    onClosing: function(){
                                        location.reload(true);
                                    }
                                });
                            }
                        })
                    }
                },
                close: function () {
                    location.reload(true);
                }
            }
        });
    })
}
function getTotalBetPerMin(timeunix){
    $.ajax({
        "url": "../php/api/admin/getTotalBetPerMin.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            response.forEach(function(el){
                if(el.b_time == timeunix){
                    return el
                }
            })
        }
    })
}
$('.btn_mydate4_buy').click(function(){
    var mydate4 = moment.tz(moment().add(3, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
    var unixtime = Math.floor(new Date(mydate4).getTime());
    var unixseconds = unixtime / 1000;
    var selected = '매도';
    var result = [{unixseconds: unixseconds, datetime: mydate4, selected: selected}];
    $.post("php/api/admin/postReservedGameResult.php", JSON.stringify(result), function(json_buy) {})
})
function convertUnixtoUnix(format){
    var mytime = moment.tz(format,'Asia/Seoul').format("YYYY-MM-DD HH:mm");
    var conunix = Math.floor(new Date(mytime).getTime());
    var mytimeunix = conunix / 1000;
    return mytimeunix;
}
function datetime(format,date,time){
    var mytime = moment.tz(format,'Asia/Seoul').format(''+date+' '+time+'');
    return mytime;
}
function convertUnixtoTime(unix){
    let unix_timestamp = unix
    var date = new Date(unix_timestamp * 1000);
    var today = date.getFullYear() +'-'+ ("0" + date.getMonth()).substr(-2) +'-'+ ("0" + date.getDay()).substr(-2);
    var hours = ("0" + date.getHours()).substr(-2);
    var minutes = ("0" + date.getMinutes()).substr(-2);

    var formattedTime = today +' <span style="color: #FFF200;">'+ hours +':'+ minutes+'</span>';

    return formattedTime;
}
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
getresult("../php/api/admin/getResultHistoryList.php");
counter();
btcusdt();
getTotalBetPerMin();