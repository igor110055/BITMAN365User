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
            $output .= '<td>'.$sNum.'</td>';
            $output .= '<td style="width: 50px;">'.$val["u_Recommended_Point"].'</td>';
            $output .= '<td style="width: 100px">'.$val["u_Account_Code"].'<br>'.$val["u_Nickname"].'</td>';
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
	// $('#summernote_note_edit').summernote({
	// 	height: 340,
	// 	placeholder: '당신의 글은 여기에.....',
	// 	lang: 'ko-KR', 
	// 	dialogsInBody: true,
	// 	dialogsFade: false
	// });
	// $('.modal-note_edit_show').click(function(){
	// 	var id = $(this).data('id');
	// 	$.ajax({
	// 		type: 'GET',
	// 		url: '../php/api/admin/getNotePerId.php?id='+id,
	// 		cache: false,
	// 		success: function(response){
	// 			$("#modal-note_edit").modal('show');
	// 			$("#id_note").val(response[0].e_Id);
	// 			$("#e_title_note").val(response[0].e_Title);
	// 			$("#summernote_note_edit").summernote("code", response[0].e_Details);
	// 		}
	// 	})
	// })
	// $('.btn_delete').click(function(){
	// 	var id = $(this).data('id');
	// 	var title = $(this).data('title');
	// 	$.confirm({
    //         title: '삭제하려고 합니다!',
    //         content: '제목: <span style="color: #ED5659;">'+title+'</span> <br>쪽지: <span style="color: #ED5659;">공지사항</span>',
    //         type: 'red',
    //         typeAnimated: true,
    //         buttons: {
    //             tryAgain: {
    //                 text: 'Yes',
    //                 btnClass: 'btn-red',
    //                 action: function(){
    //                     $.ajax({
    //                         type: 'POST',
    //                         url: '../php/api/admin/postInformationDelete.php?id='+id+'&category_title=note_delete',
    //                         cache: false,
    //                         success: function(response){
    //                             izitoast('공지사항!','성공적으로 삭제되었습니다.','fa fa-times-circle-o','#ED5659','./note.php');
    //                         }
    //                     })
    //                 }
    //             },
    //             close: function () {
    //                 location.href="./note.php"
    //             }
    //         }
    //     });
	// })
</script>