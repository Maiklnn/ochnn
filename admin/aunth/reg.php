<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ( "../../admin/bloks/bd.php");
	session_start();
	if ($_POST["modal"] == 1) {
		echo '
			<script src="/admin/func/js/valid.js" type="text/javascript"></script>
			<script src="/admin/aunth/reg5.js" type="text/javascript"></script>
			
			
			<link href="/admin/aunth/reg.css" rel="stylesheet" type="text/css">
			<div id = "form_data">
				<a href = "clouse">X</a>
				<h1>Регистрация</h1>
				<div id = "main_f">
					<label><span>Логин:</span><div><INPUT valid = "Логин" TYPE="TEXT" NAME="user_name" ></div></label>
					<label><span>Имя:</span><div><INPUT   valid = "Имя" TYPE="TEXT" NAME="first_name" ></div></label>
					<label><span>Email:</span><div><INPUT  valid = "Email" TYPE="TEXT" NAME="email" ></div></label>
					<label><span>Пароль:</span><div><INPUT valid = "Пароль"  TYPE="password" NAME="password" ></div></label>
					<label><span>Подтверждение пароля:</span><div><INPUT valid = "Подтверждение пароля"  TYPE="password" NAME="password2" ></div></label>
					<div id = "submit">Регистрация</div>
				</div>
			</div>			
		';
	} 
}
?>