<?php
include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
if ($_POST['table']) { $_SESSION[table] = $_POST['table']; } $table = $_SESSION[table];
if ($_POST['where']) { $_SESSION[where] = $_POST['where']; } $where = $_SESSION[where];
if ($_POST['up_url']) { $_SESSION[up_url] = $_POST['up_url']; } $up_url = $_SESSION[up_url];
if ($_POST['cat']) { $_SESSION[cat] = $_POST['cat']; } $cat = $_SESSION[cat];
if ($_POST['page']) { $_SESSION[page] = $_POST['page']; } $page = $_SESSION[page];
if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
	include ($add_a."bloks/top.php");		
}

	include ($add_a."/func/nav.php");
	$link_l = "<a href = 'new_el'>Добавить</a>";
	include ($add_a."bloks/left.php");
	$query = "SELECT id,login,name,enabled,status FROM ".$table." WHERE ".$where;
	$result1 = mysqli_query($db,$query);
	$myrow1 = mysqli_fetch_array($result1);
	if (!$myrow1) {
			echo "<h2>Нет пользователей!</h2>";
	} else {
		include ($up_url);
		echo '<table>'.$table."</table>".$nav."<a href = 'update' id='update'>Сохранить изменения</a>";
	}
if(!$_POST) { include ($add_a."bloks/down.php"); }
?>
