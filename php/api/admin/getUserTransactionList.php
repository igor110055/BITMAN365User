<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.mini.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);

	$sql = $query->getUserTransactionList($_GET["code"],$_GET["year"],$_GET["month"]);
    $sql1 = $query->getUserTransactionRowCount($_GET["code"],$_GET["year"],$_GET["month"]);
				
	$paginationlink = "../php/api/admin/getUserTransactionList.php?page=";
					
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
	$output .= '<table style="width: 100%;">';
	$output .= '<thead>';
	$output .= '<tr style="height: 40px;">';
	$output .= '<th>No</th>';
	$output .= '<th>종목</th>';
	$output .= '<th>계약시간</th>';
	$output .= '<th>구분</th>';
	$output .= '<th>+</th>';
	$output .= '<th>-</th>';
	$output .= '<th>보유</th>';
	$output .= '<th>거래시간</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
	if($sql1->rowCount() > 0){
		foreach($data as $key => $val){
			$output .= '<tr style="height: 35px;">';
            $output .= '<td style="background: #666666; width: 5%;">'.$sNum.'</td>';
            $output .= '<td style="background: #666666; width: 10%;">BTCUSDT</td>';
            $output .= '<td style="background: #666666; width: 10%;">'.$val["h_Contract_Time"].'</td>';
            if($val["h_Transaction_type"] == 'Deposit'){
                $output .= '<td style="background: #666666; color: #78A6FF; width: 10%;">'.$val["h_Event"].'</td>';
            }else if($val["h_Transaction_type"] == 'Withdraw'){
                $output .= '<td style="background: #666666; color: #FF787B; width: 10%;">'.$val["h_Event"].'</td>';
            }
            $output .= '<td style="background: #666666; text-align: right; color: #78A6FF; padding: 0 3px; width: 15%;">'.number_format($val["h_Plus"], 0, ".", ",").'</td>';
            $output .= '<td style="background: #666666; text-align: right; color: #ED5659; padding: 0 3px; width: 15%;">'.number_format($val["h_Minus"], 0, ".", ",").'</td>';
            $output .= '<td style="background: #666666; text-align: right; padding: 0 3px; width: 15%;">'.number_format($val["h_Current_Balance"], 0, ".", ",").'</td>';
            $output .= '<td style="background: #666666; padding: 0 3px; width: 15%;">'.$val["h_Processing_Time"].'</td>';
            $output .= '</tr>';
			$sNum ++;
		}
	}else{
		$output .= '<tr style="text-align: center; height: 40px;">';
        $output .= '<td colspan="8" style="background: #666666;">기록을 찾을 수 없습니다.</td>';
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