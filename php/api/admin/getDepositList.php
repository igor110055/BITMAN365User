<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);

	$sql = $query->getDepositList();
    $sql1 = $query->getDepositRowCount();
				
	$paginationlink = "../php/api/admin/getDepositList.php?page=";
					
	$page = 1;
	if(!empty($_GET["page"])) {
	$page = $_GET["page"];
	}

	$start = ($page-1)*$perPage->perpage;
	if($start < 0) $start = 0;

	$query =  $sql . " limit " . $start . "," . $perPage->perpage; 
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
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 610px;">';
	$output .= '<table style="width: 100%;" class="deposit_ad">';
	$output .= '<thea>';
	$output .= '<tr>';
	$output .= '<th>No</th>';
	$output .= '<th>지점</th>';
	$output .= '<th>아이디<br>닉네임</th>';
	$output .= '<th>보유금액</th>';
	$output .= '<th>입금신청금액</th>';
	$output .= '<th>입금자명</th>';
	$output .= '<th>신청시간<br>접속IP</th>';
	$output .= '<th>비고</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
    if($sql1->rowCount() > 0){
        foreach($data as $key => $val){
            $totalAmount = $val["t_Amount_in_Total"] + $val["t_Total_Amount_Cash_In"];
            $cashinamount = $val["t_Total_Amount_Cash_In"];
            $output .= '<tr style="text-align: center;">';
            $output .= '<td>'.$sNum.'</td>';
            $output .= '<td>'.$val["u_Recommended_Point"].'</td>';
            $output .= '<td>
                '.$val["u_Account_Code"].'<br>
                '.$val["u_Nickname"].'
            </td>';
            $output .= '<td style="text-align: right; padding: 5px 5px;">'.number_format($val["t_Amount_in_Total"], 2, '.', ',').'</td>';
            $output .= '<td style="text-align: right; padding: 5px 5px; color: #78A6FF;">'.number_format($val["t_Total_Amount_Cash_In"], 2, '.', ',').'</td>';
            $output .= '<td>'.$val["u_Bank_Holder_Name"].'</td>';
            $output .= '<td>
                '.$val["t_Cashin_Date"].'<br>
                '.$val["u_Ip_Address"].'
            </td>';
            $output .= '<td style="width: 180px;">
                <button type="button" class="btn btn_accept" data-id="'.$val["UniqueId"].'" data-code="'.$val["u_Account_Code"].'" data-cashin="'.$cashinamount.'" data-total_amount="'.$totalAmount.'">승인</button>
                <button type="button" class="btn btn_reject" data-id="'.$val["UniqueId"].'" data-code="'.$val["u_Account_Code"].'">거절</button>
            </td>';
            $output .= '</tr>';
            $sNum ++;
        }
    }else{
        $output .= '<tr style="text-align: center; height: 40px;">';
        $output .= '<td colspan="8">기록을 찾을 수 없습니다.</td>';
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
    $('.btn_accept').click(function(){
		var id = $(this).data('id');
		var code = $(this).data('code');
		var cashin = $(this).data('cashin');
		var total_amount = $(this).data('total_amount');
		$.confirm({
            title: 'You are about to accept deposit request!',
            content: 'Account Holder ID: <span style="color: #1072BA;">'+code + '</span>.',
            type: 'blue',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-blue',
                    action: function(){
                        $.ajax({
                            type: 'POST',
                            url: '../php/api/admin/postInformation.php?id='+id+'&cashin='+cashin+'&total_amount='+total_amount+'&code='+code+'&category_title=deposit_accept',
                            cache: false,
                            success: function(response){
                                if(response == 1){
                                    izitoast('Request Accepted!','move to accepted page.','fa fa-check-square-o','#1072BA','./deposit.php');
                                }
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./deposit.php"
                }
            }
        });
	})
	$('.btn_reject').click(function(){
		var id = $(this).data('id');
		var code = $(this).data('code');
		$.confirm({
            title: 'You are about to reject!',
            content: 'Account Holder ID: <span style="color: #ED5659;">'+code+'</span>',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            type: 'POST',
                            url: '../php/api/admin/postInformationDelete.php?id='+id+'&category_title=deposit_delete',
                            cache: false,
                            success: function(response){
                                if(response == 1){
                                    izitoast('Request rejected!','move to rejected page.','fa fa-times-circle-o','#ED5659','./deposit.php');
                                }
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./deposit.php"
                }
            }
        });
	})
</script>