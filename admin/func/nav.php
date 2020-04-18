 <?

	if (!$num) { $num = 20; }
	$page = (int)$page;
	if (!$query_count) { $query1 = "SELECT COUNT(id) FROM $table WHERE $where"; }
	$result00 = mysqli_query($db,$query1);
	$temp = mysqli_fetch_array($result00);
	if($temp[0] > $num ) {
		$pages_count = ceil($temp[0] / $num);
		$start = ($page - 1) * $num;
		$limit = 'LIMIT '.$start.', '.$num; 
		if($page > 6){ $startpage = "<a page = '1' href=''><<</a>"; }
		if($page < ($pages_count - 5)){ $endpage = "<a page = '".$pages_count."' href='return'>>></a>"; }
		if($page - 5 > 0) $page5left = ' <a page="'.($page - 5) .'" href = "return" >'.($page - 5).'</a>';
		if($page - 4 > 0) $page4left = ' <a page="'.($page - 4) .'" href = "return" >'.($page - 4) .'</a>';
		if($page - 3 > 0) $page3left = ' <a page="'.($page - 3) .'" href = "return" >'.($page - 3) .'</a>';
		if($page - 2 > 0) $page2left = ' <a page="'.($page - 2) .'" href = "return" >'.($page - 2) .'</a>';
		if($page - 1 > 0) $page1left = '<a page="'.($page - 1) .'" href = "return" >'.($page - 1) .'</a>';
		if($page + 5 <= $pages_count) $page5right = '<a page="'. ($page + 5) .'" href = "return" >'. ($page + 5) .'</a>';
		if($page + 4 <= $pages_count) $page4right = '<a page="'. ($page + 2) .'" href = "return" >'. ($page + 4) .'</a>';
		if($page + 3 <= $pages_count) $page3right = '<a page="'. ($page + 3) .'" href = "return" >'. ($page + 3) .'</a>';
		if($page + 2 <= $pages_count) $page2right = '<a page="'. ($page + 2) .'" href = "return" >'. ($page + 2) .'</a>';
		if($page + 1 <= $pages_count) $page1right = '<a page="'. ($page + 1) .'" href = "return" >'. ($page + 1) .'</a>';
		$nav = "<div class = 'nav'>".$startpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right.$page3right.$page4right.$page5right.$endpage."</div>";
	}
?>