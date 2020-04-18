<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
	echo '
		<span>X</span>
		<div val="1">Для мальчиков</div>
		<div val="2">Для девочек</div>
		<div val="3">Для всех</div>
		';
} 

?>