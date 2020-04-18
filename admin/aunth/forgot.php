<?php
include ("../bloks/bd.php");
$form_str = <<< EOFORMSTR
	<div id = 'login_f'>
		<form method="post">
				<h1>Востановить пароль</h1>
				<div id = 'left_f'>
					<label>
						<span>Email:</span> <input type="text" name="email" val = "inp">
					</label>
					<label>
				        <span>&nbsp</span><input  type="submit" name="submit" id="submit" error = "1" value="Востановить" >
					</label>
				</div>
				
		</form>
	</div>
EOFORMSTR;
$meta = 'Востановить пароль';
$myrow0["title"] = $meta;
$myrow0["meta_k"] = $meta;
$myrow0["meta_d"] = $meta;
$head = '
	<link href="/css/lk.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/modules/js/abb.js"></script>
	<script type="text/javascript" src="/modules/js/lk/valid.js"></script>
	<script type="text/javascript" src="/modules/js/lk/email.js"></script>
';
include ("../../bloks/header.php");
echo $form_str;
include ("../../bloks/footer.php");
?>