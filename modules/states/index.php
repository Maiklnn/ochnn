<? 
	if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
		include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/bd.php");
		$_SESSION[page] = $_POST['page'];
	}
	$select = 'SELECT  id,name,links,text';
	$table = ' FROM pages';
	$where = ' WHERE enabled="1" and cat_id = "8"';
	$order = ' ORDER BY namber';
	$up_url = $add."modules/states/view.php";
	$num = 10;
	include ($add."/modules/nav.php");
?>
