<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);

	$sql = $query->getResultHistoryList();
    $sql1 = $query->getResultHistoryListRowCount();
				
	$paginationlink = "../php/api/admin/getResultHistoryList.php?page=";
					
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
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 770px; text-align: center;">';
	$output .= '<table style="width: 100%;" class="btcusd_history_ad">';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th>No</th>';
	$output .= '<th>종목</th>';
	$output .= '<th>계약시간</th>';
	$output .= '<th>배당</th>';
	$output .= '<th>결과</th>';
	$output .= '<th>결과값</th>';
	$output .= '<th>확정시간</th>';
    $output .= '<th>변경여부</th>';
	$output .= '<th>매수배팅금액<br>매수당첨</th>';
	$output .= '<th>매도배팅금액<br>매도당첨</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';

	
	if($sql1->rowCount() > 0){
		foreach($data as $key => $val){
			$json = json_decode($val["JsonDataResult"]);
			$output .= '<tr style="text-align: center;">';
			$output .= '<td>'.$sNum.'</td>';
			$output .= '<td>'.$val["r_Game_Type"].'</td>';
			$output .= '<td>'.substr($val["Date_Time"],0,16).'</td>';
			$output .= '<td>1.95</td>';
			($val["r_Game_Result"] == '매수') ? $output .= '<td style="color: #FF787B;">'.$val["r_Game_Result"].'</td>' : $output .= '<td style="color: #78A6FF;">'.$val["r_Game_Result"].'</td>';
			$output .= '<td>'.$json->lastresult->w_Current_Price.'</td>';
			$output .= '<td>'.$json->lastresult->w_Time_Kor.'</td>';
			($val["resTime"]) ? $output .= '<td>Y</td>' : $output .= '<td>N</td>';
			$output .= '<td>--</td>';
			$output .= '<td>--</td>';
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