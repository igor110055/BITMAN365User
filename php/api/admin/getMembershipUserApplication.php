<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $sql = $query->getMembershipList();
    $sql1 = $query->getMembershipUserListRowCount();
			
	$paginationlink = "../php/api/admin/getMembershipList.php?page=";
					
	$page = 1;
	if(!empty($_GET["page"])) {
		$page = $_GET["page"];
	}

    

	$start = ($page-1)*$perPage->perpage;
	if($start < 0) $start = 0;
    if(@$_GET['sort']){
        $query =  $sql . " AND u_isAdminUser IN(0) AND u_Status_Id IN(1) ORDER BY U.u_Entry_Date ".$_GET['sort']." limit " . $start . "," . $perPage->perpage; 
    }else{
        $query =  $sql . " AND u_isAdminUser IN(0) AND u_Status_Id IN(1) ORDER BY U.u_Entry_Date DESC limit " . $start . "," . $perPage->perpage; 
    }
	$faq = $db->prepare($query);
    $faq->execute();

	if(empty($_GET["rowcount"])) {
	    $_GET["rowcount"] = $sql1->rowCount();
	}
	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink);

    $data = $faq->fetchAll(PDO::FETCH_ASSOC);
	$counter = ($_GET["page"] > 1) ? ($_GET["page"] * COUNT($data)) - COUNT($data) : 0;
	$sNum = $counter + 1;

    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';

	$output = '';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 580px;">';
	$output .= '<table style="width: 100%;" class="mem_ad">';
	$output .= '<thea>';
	$output .= '<tr>';
	$output .= '<th>No</th>';
	$output .= '<th>지점</th>';
	$output .= '<th>아이디<br>닉네임</th>';
	$output .= '<th>예금주<br><span style="color: #FFF200;">[중복건수]</span></th>';
	$output .= '<th>은행</th>';
	$output .= '<th>계좌번호<br><span style="color: #FFF200;">[중복건수]</span></th>';
	$output .= '<th>연락처<br><span style="color: #FFF200;">[중복건수]</span></th>';
	$output .= '<th>가입기기<br>가입브라우저</th>';
	$output .= '<th style="width: 50px;">
                가입일자<img class="asc" src="../assets/icons/sort3.png"><img class="desc" src="../assets/icons/sort1.png">
                <br>
                가입IP<img src="../assets/icons/sort3.png"><img src="../assets/icons/sort1.png">  
                </th>';
	$output .= '<th>비고</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';

	if($sql1->rowCount() > 0){
		foreach($data as $key => $val){
			$output .= '<tr>';
            $output .= '<td style="width: 50px;">'.$sNum.'</td>';
            $output .= '<td style="width: 50px;">'.$val["u_Recommended_Point"].'</td>';
            $output .= '<td style="width: 100px" class="modal-inquiry_template_show" data-id="'.$val["u_Id"].'">'.$val["u_Account_Code"].'<br>'.$val["u_Nickname"].'</td>';
            $output .= '<td style="width: 100px">'.$val["u_Bank_Holder_Name"].'<br><span style="color: #FFF200;">[0]</span></td>';
           	$output .= '<td style="width: 100px">'.$val["m_Bank_Name"].'</td>';
            $output .= '<td style="width: 100px">'.$val["u_Account_Number"].'<br><span style="color: #FFF200;">[0]</span></td>';
            $output .= '<td style="width: 100px">'.$val["u_Mobile_Number"].'<br><span style="color: #FFF200;">[0]</span></td>';
           	$output .= '<td style="width: 100px">'.$val["DeviceName"].'<br>'.$val["BrowserName"].'</td>';
            ($val["u_Entry_Date"]) ? $output .= '<td style="width: 130px">'.substr($val["u_Entry_Date"], 0,16).'<br>'.$val["u_Ip_Address"].'</td>' : $output .= '<td style="width: 130px">-<br>'.$val["u_Ip_Address"].'</td>';
            
            $output .= '<td style="width: 210px;">
					<button type="button" class="btn btn_approve" data-id="'.$val["u_Id"].'">승인</button>
					<button type="button" class="btn btn_cancel" data-id="'.$val["u_Id"].'">거절</button>
				</td>';
            $output .= '</tr>';
			$sNum ++;
		}
	}else{

		$output .= '<tr style="text-align: center; height: 40px;">';
        $output .= '<td colspan="10">기록을 찾을 수 없습니다.</td>';
        $output .= '</tr>';
	}
	$output .= '</tbody>';
	$output .= '</table>';
	$output .= '</div>';
    if(!empty($perpageresult)) {
		$output .= '<span style="text-align: center !important;"><div id="pagination">' . $perpageresult . '</div></span>';
	}
	
    print $output;
?>
<script>
    $('.asc').click(function(){
        $.ajax({
            url: '../php/api/admin/getMembershipUserApplication.php?sort=ASC',
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
    });
    $('.desc').click(function(){
        $.ajax({
            url: '../php/api/admin/getMembershipUserApplication.php?sort=DESC',
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
    });
	$('.btn_approve').click(function(){
		var id = $(this).data('id');
		$.confirm({
            title: '삭제하려고 합니다!',
            content: '제목: 승인대기',
            type: 'blue',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-blue',
                    action: function(){
                        $.ajax({
                            type: 'POST',
                            url: '../php/api/admin/postInformation.php?id='+id+'&category_title=membership_status_update&status=2',
                            cache: false,
                            success: function(response){
                                izitoast('공지사항!','성공적으로 업데이트되었습니다.','fa fa-check-circle-o','#1072BA','./membership_user_application.php');
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./membership_user_application.php"
                }
            }
        });
	});
    $('.btn_cancel').click(function(){
		var id = $(this).data('id');
		$.confirm({
            title: '삭제하려고 합니다!',
            content: '제목: 승인대기',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            type: 'POST',
                            url: '../php/api/admin/postInformation.php?id='+id+'&category_title=membership_status_update&status=3',
                            cache: false,
                            success: function(response){
                                izitoast('공지사항!','성공적으로 삭제되었습니다.','fa fa-check-circle-o','#1072BA','./membership_user_application.php');
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./membership_user_application.php"
                }
            }
        });
	});

    $(".modal-inquiry_template_show").click(function(){
		var id = $(this).data('id');
		$.ajax({
			type: 'GET',
			url: '../php/api/admin/getUserPerId.php?id='+id,
			cache: false,
			success: function(res){
				
                var formatter = new Intl.NumberFormat();
                var date = new Date();
                var year = date.getFullYear();
                var month = date.getMonth() + 1;
                if(res){
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
	});
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
    
</script>