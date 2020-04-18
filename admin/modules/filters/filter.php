<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	$sel = $_POST[cat_id];
	if ($sel == 'pole') {
	echo 	'<span>X</span>
			<div val = "1">Input</div>
			<div val = "2">select</div>
			<div val = "3">checked</div>';
	}		

} 

?>