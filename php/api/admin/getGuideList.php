<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);

	$sql = $query->getGuideList();
    $sql1 = $query->getGuideRowCount();
				
	$paginationlink = "../php/api/admin/getGuideList.php?page=";
					
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
	$output .= '<table style="width: 100%;" class="guide_ad">';
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
			if($val["g_IsPublic"] == 1){
				$output .= '<tr>';
				$output .= '<td style="background-color: #555555;"><input type="checkbox" id="chk" name="chks" class="chkb" data-id="'.$val["g_Id"].'"></td>';
				$output .= '<td style="background-color: #555555;">'.$sNum.'</td>';
				$output .= '<td style="text-align: left; background-color: #555555;">'.$val["g_Title"].'</td>';
				$output .= '<td style="background-color: #555555;">사용</td>';
				$output .= '<td style="background-color: #555555;">'.$val["g_Registration_Time"].'</td>';
				$output .= '<td style="background-color: #555555;">'.$val["g_Writer"].'</td>';
				$output .= '<td style="width: 210px; background-color: #555555;">
					<button type="button" class="btn btn_edit modal-guide_edit_show" data-id="'.$val["g_Id"].'">수정</button>
					<button type="button" class="btn btn_delete" data-id="'.$val["g_Id"].'"data-title="'.$val["g_Title"].'">삭제</button>
				</td>';
				$output .= '</tr>';
			}else{
				$output .= '<tr>';
				$output .= '<td><input type="checkbox" id="chk" name="chks" class="chkb" data-id="'.$val["g_Id"].'"></td>';
				$output .= '<td>'.$sNum.'</td>';
				$output .= '<td style="text-align: left;">'.$val["g_Title"].'</td>';
				$output .= '<td>미사용</td>';
				$output .= '<td>'.$val["g_Registration_Time"].'</td>';
				$output .= '<td>'.$val["g_Writer"].'</td>';
				$output .= '<td style="width: 210px;">
					<button type="button" class="btn btn_edit modal-guide_edit_show" data-id="'.$val["g_Id"].'">수정</button>
					<button type="button" class="btn btn_delete" data-id="'.$val["g_Id"].'" data-title="'.$val["g_Title"].'">삭제</button>
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
		$output .= '<span style="text-align: center !important; margin-bottom: 0 !important;"><div id="pagination">' . $perpageresult . '</div></span>';
	}
	
    print $output;
?>
<script>
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
	$('.summernote, .summernote_e, .g_summernote_e').summernote({
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
	$('.modal-guide_edit_show').click(function(){
		var id = $(this).data('id');
		$.ajax({
			type: 'GET',
			url: '../php/api/admin/getGuidePerId.php?id='+id,
			cache: false,
			success: function(response){
				$("#modal-guide_edit").modal('show');
				$("#g_id_e").val(response[0].g_Id);
				$("#g_title_e").val(response[0].g_Title);
				$("#g_use_nonuse_e").val(response[0].g_IsPublic);
				$("#g_register_date_e").val(response[0].g_Registration_Time);
				$(".g_summernote_e").summernote("code", response[0].g_Details);
			}
		})
	})
	$('.btn_delete').click(function(){
		var id = $(this).data('id');
		var title = $(this).data('title');
		$.confirm({
            title: '삭제하려고 합니다!',
            content: '제목: <span style="color: #ED5659;">'+title+'</span> <br>범주: <span style="color: #ED5659;">이용안내</span>',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            type: 'POST',
                            url: '../php/api/admin/postInformationDelete.php?id='+id+'&category_title=guide_delete',
                            cache: false,
                            success: function(response){
								izitoast('이용안내!','성공적으로 삭제되었습니다.','fa fa-times-circle-o','#ED5659','./guide.php');
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./guide.php"
                }
            }
        });
	})
</script>