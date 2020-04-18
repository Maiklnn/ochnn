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
echo  '<script src="/admin/func/js/table.js" type="text/javascript"></script>';
include ($add_a."/func/nav.php");
include ($add_a."bloks/left.php");
		$result1 = mysqli_query($db,"SELECT orders.id, orders.date, orders.status, customers.name, orders.status FROM ".$table." 
		LEFT JOIN customers ON customers.id = orders.customer_id WHERE $where ORDER BY orders.id $limit ");
		$myrow1 = mysqli_fetch_array($result1);
		if (!$myrow1) {
			echo "<h2>Нет заказов!</h2>";
		} else {
			include ($up_url);
			echo '<div class = "kroshka">Показать заказы: <a href = "return" where = "status=0" >Необработанные</a> | <a href = "return" where = "status=1" >Обработанные</a> | <a href = "return" where = "status=2" >В архиве</a></div>
				<table>'.$table."</table>".$nav."<a href = 'update' id='update' update = '1'>Сохранить изменения</a>";
		}
if(!$_POST) { include ($add_a."bloks/down.php"); }
?>
