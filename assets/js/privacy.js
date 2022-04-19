$('.btn_changepassword').click(function(){
    // var current_password = $('#current_password');
    $('#modal-change_password').modal('show')

  })

//fetching user bank info
  $.ajax({
    "url": "./php/api/user/getUserPrivacyInfo.php",
    "type": "GET",
    "contentType": "application/json",
    "async": false,
    success: function(response) {
        $('#bank').val(response[0].m_Bank_Name);
        $('#accountno').val(response[0].u_Account_Number);
        $('#accountholder').val(response[0].u_Bank_Holder_Name);
        $('#recommendedpoint').val(response[0].u_Recommended_Point);
        $('#current_password').val(response[0].u_Password);
        $('#accountid').val(response[0].u_Id);
        $('#account_currentpassword').val(response[0].u_Password);
        $('#accountnickname').val(response[0].u_Nickname);
    }
  })
  numberFormat();
  