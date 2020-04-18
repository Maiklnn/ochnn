<?php
include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
$head = '<script type="text/javascript" src="/admin/ckeditor/ckeditor.js"></script>';
$table = 'filters'; $_SESSION[tablea] = $table;
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	$where = $_POST['where']; $_SESSION[wherea] = $where;
 	$up_url = $_POST['up_url']; $_SESSION[up_urla] = $up_url; 
	$cat = $_POST['cat']; $_SESSION[cata] = $cat;
	$page = $_POST['page']; $_SESSION[pagea] = $page;
} else {
	$up_url = $_SESSION[up_urla];
	$cat = $_SESSION[cata];
	$where = $_SESSION[wherea];
	$page = $_SESSION[pagea];
	include ($add_a."bloks/top.php");
}
		$num = 10;
		include ($add_a."/func/nav.php");
 
		$result = mysqli_query($db,"SELECT id,name FROM ".$table." WHERE id = $cat ");
		$myrow = mysqli_fetch_array($result);

		if ($cat != 0) {
			$path = "<div class = 'kroshka'><a  href = 'return' where = 'cat_id=0' categ ='0' >Фильтры</a> -> Параметры фильтра: <a  href = 'edit_el' ids = '$cat' >".$myrow['name']."</a></div>";
		}

		
		
		$link_l = "<a href = 'new_el' parent = 'cat_id=$cat' >Добавить</a>";
		include ($add_a."bloks/left.php");
		echo $path;

		$result1 = mysqli_query($db,"SELECT id,cat_id,name,enabled,namber FROM ".$table." WHERE ".$where." ORDER BY namber $limit");
		if (!$result1) {
			echo "<h2>Позций не найдено!</h2>";
		} else {
			$myrow1 = mysqli_fetch_array($result1);
			include ($up_url);
				echo '<table>'.$table."</table>".$nav."<a href = 'update' id='update' update = '1'>Сохранить изменения</a>";
			}
if(!$_POST) { $down = include ($add_a."bloks/down.php"); }
?>
