<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $sql = $query->getMembershipList();
    $sql1 = $query->getMembershipRowCount();
	$where = '';
	switch(@$_GET["field"]){
		case "nickname":  
            $where .= " WHERE U.u_Nickname LIKE '".$_GET["searchfield"]."%'";
            break;
		case "accountcode":  
			$where .= " WHERE U.u_Account_Code LIKE '".$_GET["searchfield"]."%'";
			break;
		case "accholder":  
			$where .= " WHERE U.u_Bank_Holder_Name LIKE '".$_GET["searchfield"]."%'";
			break;
		case "accnumber":  
			$where .= " WHERE U.u_Account_Number LIKE '".$_GET["searchfield"]."%'";
			break;
		case "accessip":  
			$where .= " WHERE U.u_Ip_Address LIKE '".$_GET["searchfield"]."%'";
			break;
		case "subsip":  
			$where .= " WHERE H.l_Current_Ip LIKE '".$_GET["searchfield"]."%'";
			break;
		case "dateaccess":  
			if(@$_GET["end"]){
				$where .= " WHERE (DATE(H.l_LogInDateTime) BETWEEN '".@$_GET["start"]."' AND '".@$_GET["end"]."')";
			}else{
				$where .= " WHERE (DATE(H.l_LogInDateTime) BETWEEN '".@$_GET["start"]."' AND '".date('Y-m-d')."')";
			}
			break;
		case "subscribedate":  
			if(@$_GET["end"]){
				$where .= " WHERE (DATE(U.u_Entry_Date) BETWEEN '".@$_GET["start"]."' AND '".@$_GET["end"]."')";
			}else{
				$where .= " WHERE (DATE(U.u_Entry_Date) BETWEEN '".@$_GET["start"]."' AND '".date('Y-m-d')."')";
			}
			break;
	}
			
	$paginationlink = "../php/api/admin/getMembershipList.php?page=";
					
	$page = 1;
	if(!empty($_GET["page"])) {
		$page = $_GET["page"];
	}

	$start = ($page-1)*$perPage->perpage;
	if($start < 0) $start = 0;
	if($where){
		$query =  $sql . $where. " AND U.u_isAdminUser IN(0) ORDER BY U.u_Entry_Date DESC limit " . $start . "," . $perPage->perpage; 
	}else{
		$query =  $sql . " WHERE U.u_isAdminUser IN(0) ORDER BY U.u_Entry_Date DESC limit " . $start . "," . $perPage->perpage; 
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

	$output = '';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 560px;">';
	$output .= '<table style="width: 100%;" class="mem_ad">';
	$output .= '<thea>';
	$output .= '<tr>';
	$output .= '<th>No</th>';
	$output .= '<th>지점</th>';
	$output .= '<th>아이디Z<br>닉네임</th>';
	$output .= '<th>예금주</th>';
	$output .= '<th>보유금액<br>총입출차액</th>';
	$output .= '<th>금일입금<br>금일출금</th>';
	$output .= '<th>금일지급<br>금일회수</th>';
	$output .= '<th>가입일자<br>가입IP</th>';
	$output .= '<th>접속일자<br>접속IP</th>';
	$output .= '<th>접속수</th>';
	$output .= '<th>상태</th>';
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
            $output .= '<td style="width: 100px">'.$val["u_Bank_Holder_Name"].'</td>';
           	$output .= '<td style="width: 100px">'.number_format($val["Holding_amount"], 0, '.', ',').'</td>';
           	$output .= '<td style="width: 100px"><span style="color: #78A6FF;">'.$val["TotalDepositAmount"].'</span><br><span style="color: #FF787B;">'.$val["TotalWithdrawAmount"].'</span></td>';
           	$output .= '<td style="width: 100px"><span style="color: #78A6FF;">0</span><br><span style="color: #FF787B;">0</span></td>';
			   ($val["l_LogInDateTime"]) ? $output .= '<td style="width: 130px">'.substr($val["l_LogInDateTime"], 0,16).'<br>'.$val["l_Current_Ip"].'</td>' : $output .= '<td style="width: 130px">-<br>'.$val["l_Current_Ip"].'</td>';
            ($val["l_LogInDateTime"]) ? $output .= '<td style="width: 130px">'.substr($val["l_LogInDateTime"], 0,16).'<br>'.$val["u_Ip_Address"].'</td>' : $output .= '<td style="width: 130px">-<br>'.$val["u_Ip_Address"].'</td>';
            $output .= '<td style="width: 50px;">'.$val["ConnectionCnt"].'</td>';
            if($val["u_State"] == '정지'){
                $output .= '<td style="color: #FFFFFF;width: 80px;">'.$val["u_State"].'</td>';
            }else if($val["u_State"] == '이용'){
                $output .= '<td style="color: #FF787B;width: 80px;">'.$val["u_State"].'</td>';
            }else if($val["u_State"] == '접속중'){
                $output .= '<td style="color: #FF9300;width: 80px;">'.$val["u_State"].'</td>';
            }
            $output .= '<td style="width: 80px;">
                <button type="button" class="btn btn_delete" data-id="'.$val["u_Id"].'">접속</button>
            </td>';
            $output .= '</tr>';
			$sNum ++;
		}
	}else{
		$output .= '<tr style="text-align: center; height: 40px;">';
        $output .= '<td colspan="12">기록을 찾을 수 없습니다.</td>';
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