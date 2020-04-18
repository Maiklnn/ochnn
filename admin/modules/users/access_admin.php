<?
$add_a = $_SERVER['DOCUMENT_ROOT']."/admin/";
include ($add_a."bloks/bd.php");
if (isset($_COOKIE['user_name']) && isset($_COOKIE['id_hash'])) {
   if ($_COOKIE['user_name'] == 'top_admin') { $_SESSION[top_a] = 1;} else {$_SESSION[top_a] = 0;}
	$hash = md5($_COOKIE['user_name'].$const_r[str]);
	if ($hash == $_COOKIE['id_hash']) {
		return true;
		
	} else {
		return false;
		header("Location: $http/adm");
	}
} else {
   header("Location: $http/adm");
}
?>