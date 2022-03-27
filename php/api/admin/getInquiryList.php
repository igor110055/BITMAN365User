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
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 610px;">';
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
			if($val["t_Response_Time"]){
				$output .= '<tr>';
				$output .= '<td style="background: #666666;">'.$sNum.'</td>';
				$output .= '<td class="modal-inquiry_template_show" style="background: #666666; width: 410px; text-align: left; cursor: pointer;" data-id="'.$val["t_Id"].'">'.$val["t_Inquiry_Title"].'</td>';
				($val["t_Inquiry_Status_Id"] == 0) ? $output .= '<td style="background: #666666; width: 90px;">대기</td>' : $output .= '<td style="background: #666666; width: 90px;">완료</td>';
				$output .= '<td style="background: #666666;">'.$val["u_Nickname"].'</td>';
				$output .= '<td style="background: #666666;">'.$val["t_Inquiry_Date"].'</td>';
				$output .= '<td style="background: #666666;">'.$_SESSION["admin_session"]["u_Account_Code"].'</td>';
				($val["t_Response_Time"]) ? $output .= '<td style="background: #666666;">'.$val["t_Response_Time"].'</td>' : $output .= '<td style="background: #666666;">-</td>';
				$output .= '</tr>';
			}else{
				$output .= '<tr>';
				$output .= '<td style="background: #555555;">'.$sNum.'</td>';
				$output .= '<td class="modal-inquiry_template_show" style="background: #555555; width: 410px; text-align: left; cursor: pointer;" data-id="'.$val["t_Id"].'">'.$val["t_Inquiry_Title"].'</td>';
				($val["t_Inquiry_Status_Id"] == 0) ? $output .= '<td style="background: #555555; width: 90px;">대기</td>' : $output .= '<td style="background: #555555; width: 90px;">완료</td>';
				$output .= '<td style="background: #555555;">'.$val["u_Nickname"].'</td>';
				$output .= '<td style="background: #555555;">'.$val["t_Inquiry_Date"].'</td>';
				$output .= '<td style="background: #555555;">'.$_SESSION["admin_session"]["u_Account_Code"].'</td>';
				($val["t_Response_Time"]) ? $output .= '<td style="background: #555555;">'.$val["t_Response_Time"].'</td>' : $output .= '<td style="background: #555555;">-</td>';
				$output .= '</tr>';
			}
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
	$('#summernote_inquiry_edit').summernote({
		height: 340,
		placeholder: '당신의 글은 여기에.....',
		lang: 'ko-KR', 
		dialogsInBody: true,
		dialogsFade: false
	});
	$(".modal-inquiry_template_show").click(function(){
		var id = $(this).data('id');
		$.ajax({
			type: 'GET',
			url: '../php/api/admin/getInquiryPerId.php?id='+id,
			cache: false,
			success: function(response){
				$("#modal-inquiry_template_edit").modal('show');
				$('#i_id_e').val(response[0].t_Id);
				$('#i_title_e').val(response[0].t_Inquiry_Title);
				$('#i_nickname_e').val(response[0].u_Nickname);
				$('#i_inquiry_date_e').val(response[0].t_Inquiry_Date);
				$('#i_user_inquiry_details_e').val(response[0].t_Inquiry_Details);
				$("#summernote_inquiry_edit").summernote("code", response[0].t_Manager_Reply);
			}
		})
	});
</script>