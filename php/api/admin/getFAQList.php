<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);

	$sql = $query->getFAQList();
    $sql1 = $query->getFAQRowCount();
				
	$paginationlink = "../php/api/admin/getFAQList.php?page=";
					
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
	$output .= '<table style="width: 100%;" class="faq_ad">';
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
			$output .= '<tr>';
            $output .= '<td style="background-color: #555555;"><input type="checkbox" id="chk" name="chks_not" class="chkb" data-id="'.$val["f_Id"].'"></td>';
            $output .= '<td style="background-color: #555555;">'.$sNum.'</td>';
            $output .= '<td style="text-align: left; background-color: #555555;">'.$val["f_Title"].'</td>';
            ($val["f_UseUnUse"] == 1) ? $output .= '<td style="background-color: #555555;">사용</td>' : $output .= '<td style="background-color: #555555;">미사용</td>';
            $output .= '<td style="background-color: #555555;">'.$val["f_Registration_Date"].'</td>';
            $output .= '<td style="background-color: #555555;">'.$val["f_Writer"].'</td>';
            $output .= '<td style="width: 210px; background-color: #555555;">
                <button type="button" class="btn btn_edit modal-faq_edit_show" data-id="'.$val["f_Id"].'">수정</button>
                <button type="button" class="btn btn_delete" data-id="'.$val["f_Id"].'">삭제</button>
            </td>';
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
		$output .= '<span style="text-align: center !important;"><div id="pagination">' . $perpageresult . '</div></span>';
	}
	
    print $output;
?>
<script>
	$('#summernote_faq_edit').summernote({
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
	$('.modal-faq_edit_show').click(function(){
		var id = $(this).data('id');
		$.ajax({
			type: 'GET',
			url: '../php/api/admin/getFAQPerId.php?id='+id,
			cache: false,
			success: function(response){
				$("#modal-faq_edit").modal('show');
				$("#f_id_e").val(response[0].f_Id);
				$("#f_title_e").val(response[0].f_Title);
				$("#f_use_nonuse_e").val(response[0].f_UseUnUse);
				$("#f_register_date_e").val(response[0].f_Registration_Date);
				$("#summernote_faq_edit").summernote("code", response[0].f_Details);
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
                            url: '../php/api/admin/postInformationDelete.php?id='+id+'&category_title=faq_delete',
                            cache: false,
                            success: function(response){
                                izitoast('공지사항!','성공적으로 삭제되었습니다.','fa fa-times-circle-o','#ED5659','./faq.php');
                            }
                        })
                    }
                },
                close: function () {
                    location.href="./faq.php"
                }
            }
        });
	})
</script>