<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);

	$sql = $query->getInquiryList();
    $sql1 = $query->getInquiryRowCount();
				
	$paginationlink = "../php/api/admin/getInquiryList.php?page=";
					
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
	$output .= '<table style="width: 100%;" class="inquiry_ad">';
	$output .= '<thea>';
	$output .= '<tr>';
	$output .= '<th>No</th>';
	$output .= '<th>제목</th>';
	$output .= '<th>상태</th>';
	$output .= '<th>닉네임</th>';
	$output .= '<th>문의신청일</th>';
	$output .= '<th>답변자</th>';
	$output .= '<th>답변시간</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
	if($sql1->rowCount() > 0){
		foreach($data as $key => $val){
			$output .= '<tr>';
            $output .= '<td>'.$sNum.'</td>';
            $output .= '<td>'.$val["t_Inquiry_Title"].'</td>';
            ($val["t_Inquiry_Status_Id"] == 0) ? $output .= '<td>대기</td>' : $output .= '<td>완료</td>';
            $output .= '<td>'.$val["u_Nickname"].'</td>';
            $output .= '<td>'.$val["t_Inquiry_Date"].'</td>';
            $output .= '<td>'.$_SESSION["user_session"]["u_Account_Code"].'</td>';
            ($val["t_Response_Time"]) ? $output .= '<td>'.$val["t_Response_Time"].'</td>' : $output .= '<td>-</td>';
            $output .= '</tr>';
			$sNum ++;
		}
	}else{
		$output .= '<tr style="text-align: center; height: 40px;">';
        $output .= '<td colspan="7">기록을 찾을 수 없습니다.</td>';
        $output .= '</tr>';
	}
	$output .= '</tbody>';
	$output .= '</table>';
	$output .= '</div>';
	if(!empty($perpageresult)) {
		$output .= '<span style="text-align: center !important; margin-bottom: 0 !important;"><div id="pagination">' . $perpageresult . '</div></span>';
	}
	
    print $output;
?>
<script>
	$('.summernote').summernote({
		height: 420,
		lang: 'ko-KR',
		dialogsInBody: true,
		dialogsFade: false,
		toolbar: [
			['style', ['style']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['insert', [ 'picture', 'link', 'video', 'table']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']]
		]
	});
</script>