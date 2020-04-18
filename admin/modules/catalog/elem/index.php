<?php
include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
if ($_POST['table']) { $_SESSION[table] = $_POST['table']; } $table = $_SESSION[table];
if ($_POST['where']) { $_SESSION[where] = $_POST['where']; } $where = $_SESSION[where];
if ($_POST['up_url']) { $_SESSION[up_url] = $_POST['up_url']; } $up_url = $_SESSION[up_url];
if ($_POST['parent']) { $_SESSION['parent'] = $_POST['parent']; } $parent = $_SESSION['parent'];
if ($_POST['page']) { $_SESSION[page] = $_POST['page']; } $page = $_SESSION[page];
if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
	include ($add_a."bloks/top.php");		
}
		include ($add_a."/func/nav.php");
		$result0 = mysqli_query($db,"SELECT id,name FROM cat WHERE id = '$parent'");
		$myrow0 = mysqli_fetch_array($result0);
		$query = "SELECT id,name,enabled,namber,sale FROM ".$table." WHERE $where ORDER BY namber $limit";
		$result1 = mysqli_query($db,$query);
		@$count = mysqli_num_rows($result1);
		if ($result0) {
			if ($temp[0] < 1) { 
				$path =  "<div class = 'kroshka'>В категории: <a  href = 'return' url = '/admin/modules/catalog/cat/' table = 'cat' parent = ".$parent." where = 'parent=".$parent."' order = 'namber' >".$myrow0['name']."</a> ".$temp[0]."</div>";
			} else {
				$path =  "<div class = 'kroshka'>".$_SESSION[path]." -> Количество позиции в категории: ".$myrow0['name']." ".$temp[0]."</div>
				";
				if ($where == 'sale=1') { $path =  "<div class = 'kroshka'>Количество спецпредложений: ".$temp[0]."</div>";
}

			}
			$link_l = "<a href = 'new_el' parent = '$parent' >Добавить</a>";
		} 
		include ($add_a."bloks/left.php");
		if ($count < 1) {
			echo "<h2>Позций не найдено!</h2>";
		} else {
			echo $path;
			$myrow1 = mysqli_fetch_array($result1);
			include ($up_url);
			echo '<table>'.$table."</table>".$nav."<a href = 'update' id='update'>Сохранить изменения</a>";
		}
if(!$_POST) { $down = include ($add_a."bloks/down.php"); }
?>
