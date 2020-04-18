<?php
include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
if ($_POST['table']) { $_SESSION[table] = $_POST['table']; } $table = $_SESSION[table];
if ($_POST['where']) { $_SESSION[where] = $_POST['where']; } $where = $_SESSION[where];
if ($_POST['up_url']) { $_SESSION[up_url] = $_POST['up_url']; } $up_url = $_SESSION[up_url];
if ($_POST['parent']) { $_SESSION['parent'] = $_POST['parent']; } else { $_SESSION['parent'] = 0;} $parent = $_SESSION['parent'];
if ($_POST['page']) { $_SESSION[page] = $_POST['page']; } $page = $_SESSION[page];
if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
	include ($add_a."bloks/top.php");		
}
$_POST['parent'];
echo  '<script src="/admin/func/js/table.js" type="text/javascript"></script>'; 
		include ($add_a."/func/nav.php");
		$col = 0;
		$cat_p = $parent;
		while ($cat_p != '') {
			$result0 = mysqli_query($db,"SELECT id,parent,name FROM $table WHERE id = '$cat_p'");
			$myrow0 = mysqli_fetch_array($result0);
			$cat_p = $myrow0["parent"];
			if ($cat_p != '') {
				$a = " -> <a  href = 'return' url = '/admin/modules/catalog/cat/' table = 'cat' where = 'parent=".$myrow0["id"]."' parent ='".$myrow0["id"]."' >".$myrow0["name"]."</a>";
				$path = $a.$path;
				$col++;
			}
		} 
		 
		if ($col > 0) {
			$_SESSION[path] = $path;
			$path = "<div class = 'kroshka'><a  href = 'return' where = 'parent=0' parent ='0' >Корень</a>".$path."</div>";
		}
		$link_l = "<a href = 'new_el' parent = '$parent' >Добавить</a>";
		include ($add_a."bloks/left.php");
		echo $path;
		$query = ""; 
		$result1 = mysqli_query($db,"SELECT id,name,enabled,namber,add_date FROM $table WHERE parent=$parent ORDER BY namber $limit");
		$myrow1 = mysqli_fetch_array($result1);
		

		if (!$myrow1) {
			
			echo "<h2>Позций не найдено!</h2>";
		} else {
			
			include ($up_url);
				echo '<table>'.$table."</table>".$nav."<a href = 'update' id='update'>Сохранить изменения</a>";
			}
if(!$_POST) { $down = include ($add_a."bloks/down.php"); }



		
?>
