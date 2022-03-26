<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);

	$sql = $query->getNoticeList();
    $sql1 = $query->getNoticeRowCount();
				
	$paginationlink = "../php/api/admin/getNoticeList.php?page=";
					
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
	$output .= '<table style="width: 100%;" class="notice_ad">';
	$output .= '<thea>';
	$output .= '<tr>';
	$output .= '<th><input type="checkbox" id="chkAll"</th>';
	$output .= '<th>No</th>';
	$output .= '<th>번호</th>';
	$output .= '<th>사용</th>';
	$output .= '<th>등록일</th>';
	$output .= '<th>작성자</th>';
	$output .= '<th>비고</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
	if($sql1->rowCount() > 0){
		foreach($data as $key => $val){
			if($val["n_IsPublic"] == 1){
				$output .= '<tr>';
				$output .= '<td style="background-color: #555555;"><input type="checkbox" id="chk" name="chks_not" class="chkb" data-id="'.$val["n_Id"].'"></td>';
				$output .= '<td style="background-color: #555555;">'.$sNum.'</td>';
				$output .= '<td style="text-align: left; background-color: #555555;">'.$val["n_Title"].'</td>';
				$output .= '<td style="background-color: #555555;">사용</td>';
				$output .= '<td style="background-color: #555555;">'.$val["n_Registration_Time"].'</td>';
				$output .= '<td style="background-color: #555555;">'.$val["n_Writer"].'</td>';
				$output .= '<td style="width: 210px; background-color: #555555;">
					<button type="button" class="btn btn_edit modal-notice_edit_show" data-id="'.$val["n_Id"].'">수정</button>
					<button type="button" class="btn btn_delete" data-id="'.$val["n_Id"].'">삭제</button>
				</td>';
				$output .= '</tr>';
			}else{
				$output .= '<tr>';
				$output .= '<td><input type="checkbox" id="chk" name="chks_not" data-id="'.$val["n_Id"].'" class="chkb"></td>';
				$output .= '<td>'.$sNum.'</td>';
				$output .= '<td style="text-align: left;">'.$val["n_Title"].'</td>';
				$output .= '<td>미사용</td>';
				$output .= '<td>'.$val["n_Registration_Time"].'</td>';
				$output .= '<td>'.$val["n_Writer"].'</td>';
				$output .= '<td style="width: 210px;">
					<button type="button" class="btn btn_edit modal-notice_edit_show" data-id="'.$val["n_Id"].'">수정</button>
					<button type="button" class="btn btn_delete" data-id="'.$val["n_Id"].'" data-title="'.$val["n_Title"].'">삭제</button>
				</td>';
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
		$output .= '<span style="text-align: center !important;"><div id="pagination">' . $perpageresult . '</div></span>';
	}
	
    print $output;
?>
<script>
	$('#summernote_notice_edit').summernote({
		height: 340,
		placeholder: '당신의 글은 여기에.....',
		lang: 'ko-KR', 
		dialogsInBody: true,
		dialogsFade: false
	});
	$('.chkb').click(function(event) {
		if(this.checked) {
			// Iterate each checkbox
			$(':checkbox').each(function() {
				$('.btn_delete_all').removeAttr('disabled');            
			});
		} else {
			$(':checkbox').each(function() {
				$('.btn_delete_all').attr('disabled', true);                        
			});
		}
	})
	$('#chkAll').click(function(event) {
		if(this.checked) {
			// Iterate each checkbox
			$(':checkbox').each(function() {
				this.checked = true;
				$('.btn_delete_all').removeAttr('disabled');            
			});
		} else {
			$(':checkbox').each(function() {
				this.checked = false;
				$('.btn_delete_all').attr('disabled', true);                        
			});
		}
	});
	$('.modal-notice_edit_show').click(function(){
		var id = $(this).data('id');
		$.ajax({
			type: 'GET',
			url: '../php/api/admin/getNoticePerId.php?id='+id,
			cache: false,
			success: function(response){
				$("#modal-notice_edit").modal('show');
				$("#id_e").val(response[0].n_Id);
				$("#title_e").val(response[0].n_Title);
				$("#use_nonuse_e").val(response[0].n_IsPublic);
				$("#register_date_e").val(response[0].n_Registration_Time);
				$("#summernote_notice_edit").summernote("code", response[0].n_Details);
			}
		})
	})
	$('.btn_delete').click(function(){
		var id = $(this).data('id');
		var title = $(this).data('title');
		$.confirm({
            title: '삭제하려고 합니다!',
            content: '제목: <span style="color: #ED5659;">'+title+'</span> <br>범주: <span style="color: #ED5659;">공지사항</span>',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            type: 'POST',
                            url: '../php/api/admin/postInformationDelete.php?id='+id+'&category_title=notice_delete',
                            cache: false,
                            success: function(response){
                                izitoast('공지사항!','성공적으로 삭제되었습니다.','fa fa-times-circle-o','#ED5659','./notice.php');
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./notice.php"
                }
            }
        });
	})
</script>