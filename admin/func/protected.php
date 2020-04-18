<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ("../bloks/bd.php");
	$el = str_s($_POST[el]);
	$table = str_s($_POST[table]);
	$col = str_s($_POST[col]);	
    $result = mysqli_query($db,"SELECT $col FROM $table WHERE $col='$el'");
	if (mysqli_num_rows($result) == 1) { echo 1; } 
} 
?>