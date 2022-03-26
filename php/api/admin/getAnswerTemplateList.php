<?php  
    include_once '../../config/Database.php';
	include_once '../../class/Pagination.class.php';
	include_once '../../class/Admininfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Admininfo($db);

	$sql = $query->getAnswerTemplateList();
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

	$output = '';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 610px;">';
	$output .= '<table style="width: 100%;" id="answer_table">';
    if($sql->rowCount() > 0){
        foreach($data as $key => $val){
            $output .= '<tr>';
            $output .= '<td style="cursor: pointer; font-size: 11px; text-align: left; padding: 5px 5px; text-transform: uppercase;" data-details="'.$val["a_Answer_Details"].'">&raquo; '.$val["a_Title"].'</td>';
            $output .= '</tr>';
        }
    }else{
        $output .= '<tr style="text-align: center; padding: 5px 5px;">';
        $output .= '<td style="font-size: 12px;">기록을 찾을 수 없습니다.</td>';
        $output .= '</tr>';
    }
	$output .= '</table>';
	$output .= '</div>';
	
    print $output;
?>
<script>
    var table1 = document.getElementById('answer_table');
    for(var i = 0; i < table1.rows.length; i++){
        var tr = table1.rows[i];
        var td = table1.rows[i].cells[0];
        $(td).click(function(){
            var details = $(this).data('details');
            $('#summernote_inquiry_edit').summernote('code',details);
            $('#answer_table tr td').removeClass('td');
            $(this).addClass('td');
        })
    }
</script>