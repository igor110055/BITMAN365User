<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);

	$sql = $query->getDepositCanceledList();
    $sql1 = $query->getDepositCanceledRowCount();
				
	$paginationlink = "../php/api/admin/getDepositCanceledList.php?page=";
					
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
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 760px;">';
	$output .= '<table style="width: 100%;" class="deposit_reject_ad">';
	$output .= '<thea>';
	$output .= '<tr>';
	$output .= '<th>No</th>';
	$output .= '<th>지점</th>';
	$output .= '<th>아이디<br>닉네임</th>';
	$output .= '<th>입금금액</th>';
	$output .= '<th>입금자명</th>';
	$output .= '<th>신청시간<br>접속IP</th>';
    $output .= '<th>처리시간</th>';
	$output .= '<th>관리자</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
	if($sql1->rowCount() > 0){
		foreach($data as $key => $val){
			$output .= '<tr style="text-align: center;">';
			$output .= '<td>'.$sNum.'</td>';
			$output .= '<td>'.$val["u_Recommended_Point"].'</td>';
			$output .= '<td>
				'.$val["u_Account_Code"].'<br>
				'.$val["u_Nickname"].'
			</td>';
			$output .= '<td style="text-align: center; padding: 5px 5px; color: #FFFFFF; background: #0093FF;">'.number_format($val["t_Total_Amount_Cash_In"], 2, '.', ',').'</td>';
			$output .= '<td>'.$val["u_Bank_Holder_Name"].'</td>';
			$output .= '<td>
				'.$val["t_Cashin_Date"].'<br>
				'.$val["u_Ip_Address"].'
			</td>';
			$output .= '<td>'.$val["t_Cashin_Date"].'</td>';
			$output .= '<td>--</td>';
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