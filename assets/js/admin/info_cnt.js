var rollSound = new Audio('https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3');

function display_time() {
    var myDate = moment.tz(moment(),'Asia/Seoul').format("M월 DD일");
    var time = moment.tz(moment(),'Asia/Seoul').format("HH:mm:ss");
    document.getElementById('display_date').innerHTML = myDate;
    document.getElementById('display_time').innerHTML = time;
    display_counter();
}
function display_counter(){
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_time()',refresh)
    //info = setTimeout('getInfoCnt()',refresh)
    req = setTimeout('checkCategoryReq()',refresh)
    soundeffect = setTimeout('playSound()',refresh)
}

function playsoundEffect(){
    rollSound.play();
    rollSound.loop = true;
}
function pausesoundEffect(){
    rollSound.pause();
    rollSound.loop = false;
}
function getInfoCnt(){
    $.ajax({
        "url": "../php/api/admin/getInfoCnt.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            $('.user_application').text(response.UserApplication);
            $('.deposit_application').text(response.DepositApplication);
            $('.withdraw_application').text(response.WithdrawApplication);
            $('.inquiry_application').text(response.InquiryApplication);
        }
    })
}
function playSound(){
    $.ajax({
        "url": "../php/api/admin/getInfoCnt.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            var notifcnt = response["NotifCnt"];
            var img = document.getElementById('mutesound');
            if(notifcnt <= 0){
                pausesoundEffect();
                img.setAttribute('src', "../assets/icons/akar-icons_sound-on.png");
            }else{
                playsoundEffect()
                //img.setAttribute('src', "../assets/icons/akar-icons_sound-on.png");
            }
        }
    })
}
function OnOff() {
    var img = document.querySelector('.mutesound');
    $('.mutesound').click(function(){
        if (img.getAttribute('src') === "../assets/icons/akar-icons_sound-on.png") {
            img.setAttribute('src', "../assets/icons/akar-icons_sound-off.png");
        }
        else {
            img.setAttribute('src', "../assets/icons/akar-icons_sound-on.png");
        }
    })
}

function checkCategoryReq(){
    $.ajax({
        "url": "../php/api/admin/getInfoCnt.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            var notif = response["Notif"];
            (notif[0].s_Notif_Type == 'UserApplication' && notif[0].s_TypeName == 'on') ? $('.user_application').addClass('pulsestate') : $('.user_application').removeClass('pulsestate');
            (notif[1].s_Notif_Type == 'DepositApplication' && notif[1].s_TypeName == 'on') ? $('.deposit_application').addClass('pulsestate') : $('.deposit_application').removeClass('pulsestate');
            (notif[2].s_Notif_Type == 'WithdrawApplication' && notif[2].s_TypeName == 'on') ? $('.withdraw_application').addClass('pulsestate') : $('.withdraw_application').removeClass('pulsestate');
            (notif[3].s_Notif_Type == 'InquiryApplication' && notif[3].s_TypeName == 'on') ? $('.inquiry_application').addClass('pulsestate') : $('.inquiry_application').removeClass('pulsestate');
        }
    })
}
$('.mutesound').click(function(){
    $.post('../php/api/admin/setToMute.php?setMute=1', function(req){})
})
// function soundEffectDep(){
//     $.ajax({
//         "url": "../php/api/admin/getInfoCnt.php",
//         "type": "GET",
//         "contentType": "application/json",
//         "async": false,
//         success: function(response) {
//             var notif = response["Notif"];
//             notif.forEach(function(nt){
//                 if(nt.s_Notif_Type == 'DepositApplication' && nt.s_TypeName == 'on'){
//                     playsoundEffect()
//                 }else{
//                     pausesoundEffect();
//                 }           
//             })
//         }
//     })
// }
// function soundEffectWid(){
//     $.ajax({
//         "url": "../php/api/admin/getInfoCnt.php",
//         "type": "GET",
//         "contentType": "application/json",
//         "async": false,
//         success: function(response) {
//             var notif = response["Notif"];
//             notif.forEach(function(nt){
//                 if(nt.s_Notif_Type == 'WithdrawApplication' && nt.s_TypeName == 'on'){
//                     playsoundEffect()
//                 }else{
//                     pausesoundEffect();
//                 }           
//             })
//         }
//     })
// }
// function soundEffectInq(){
//     $.ajax({
//         "url": "../php/api/admin/getInfoCnt.php",
//         "type": "GET",
//         "contentType": "application/json",
//         "async": false,
//         success: function(response) {
//             var notif = response["Notif"];
//             notif.forEach(function(nt){
//                 if(nt.s_Notif_Type == 'InquiryApplication' && nt.s_TypeName == 'on'){
//                     playsoundEffect()
//                 }else{
//                     pausesoundEffect();
//                 }           
//             })
//         }
//     })
// }
OnOff();
//display_counter();
getInfoCnt();