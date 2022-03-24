<?php
class PerPage {
	public $perpage;
	
	function __construct() {
		$this->perpage = 50;
	}
	
	public function getAllPageLinks($count,$href) {
		$output = '';
		if(!isset($_GET["page"])) $_GET["page"] = 1;
		if($this->perpage != 0)
			$pages  = ceil($count/$this->perpage);
		if($pages > 0) {
			if($_GET["page"] == 1) 
				$output = $output . '<span class="link first disabled"><img src="../assets/icons/arrow-backward.png" class="page_icons"></span><span class="link disabled"><img src="../assets/icons/arrow-prev.png"></span>';
			else	
				$output = $output . '<a class="link first" onclick="getresult_mini(\'' . $href . (1) . '\')" ><img src="../assets/icons/arrow-backward.png"></a><a class="link" onclick="getresult_mini(\'' . $href . ($_GET["page"]-1) . '\')" ><img src="../assets/icons/arrow-prev.png"></a>';
			
			
			if(($_GET["page"]-3)>0) {
				if($_GET["page"] == 1)
					$output = $output . '<span id=1 class="link current">1</span>';
				else				
					$output = $output . '<a class="link" onclick="getresult_mini(\'' . $href . '1\')" >1</a>';
			}
			if(($_GET["page"]-3)>1) {
					$output = $output . '<span class="dot">...</span>';
			}
			
			for($i=($_GET["page"]-2); $i<=($_GET["page"]+2); $i++)	{
				if($i<1) continue;
				if($i>$pages) break;
				if($_GET["page"] == $i)
					$output = $output . '<span id='.$i.' class="link current">'.$i.'</span>';
				else				
					$output = $output . '<a class="link" onclick="getresult_mini(\'' . $href . $i . '\')" >'.$i.'</a>';
			}
			
			if(($pages-($_GET["page"]+2))>1) {
				$output = $output . '<span class="dot">...</span>';
			}
			if(($pages-($_GET["page"]+2))>0) {
				if($_GET["page"] == $pages)
					$output = $output . '<span id=' . ($pages) .' class="link current">' . ($pages) .'</span>';
				else				
					$output = $output . '<a class="link" onclick="getresult_mini(\'' . $href .  ($pages) .'\')" >' . ($pages) .'</a>';
			}
			
			if($_GET["page"] < $pages)
				$output = $output . '<a  class="link" onclick="getresult_mini(\'' . $href . ($_GET["page"]+1) . '\')" ><img src="../assets/icons/arrow-next.png"></a><a  class="link" onclick="getresult_mini(\'' . $href . ($pages) . '\')" ><img src="../assets/icons/arrow-forward.png"></a>';
			else				
				$output = $output . '<span class="link disabled"><img src="../assets/icons/arrow-next.png"></span><span class="link disabled"><img src="../assets/icons/arrow-forward.png"></span>';
			
			
		}
		return $output;
	}
}
?>