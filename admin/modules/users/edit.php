<?
include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php"); 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	$table = 'user'; 
	if ($_POST[id]) {
		$id = $_POST[id]; $_SESSION[id] = $id;
		$result = mysqli_query($db,"SELECT * FROM $table WHERE id = $id");
		$myrow = mysqli_fetch_array($result);
		$add_date = $myrow['add_date'];
		if ($add_date == 0){
			$submit = 'Добавить';
			$edit = '
				<label>
					<span id = "text">Пароль:</span>
					<span id = "pole">
							<input type="password" name="password1" >
					</span>
				</label>
				<label>
					<span id = "text">Подтверждение пароля:</span>
					<span id = "pole">
							<input type="password" name="password2" >
					</span>
				</label>
			 ';
		} else {
			$submit = 'Изменить';
			$edit_date = $myrow['edit_date'];
			if ($edit_date == 0 or $edit_date == $add_date) {$edit_date = 'Изменений не было';}
			$edit = '
					<label><a href = "1" >Сменить пароль</a></label>
					<label><span id = "text">Изменён:</span><span id = "pole"><INPUT class = "data" disabled type="text" NAME="date_edit" value = "'.$edit_date.'"></span></label>
					<label><span id = "text">Добавлен:</span><span id = "pole"><INPUT class = "data" disabled type="text" NAME="add_date" value = '.$add_date.' ></span></label>
					';
			$enabled = $myrow["enabled"];
			if ($enabled == 1) { $checked_class = 'add_chekced';}	
		}
		
		
		echo '
			<script src="/admin/func/js/valid.js" type="text/javascript"></script>
			<script src="/admin/modules/users/js.js" type="text/javascript"></script>
			<div id = "form_data">
				<div id = "clous" href = "clous" >X</div>
				<form>
				<h3>'.$submit.'</h3>
				<label>
					<span id = "text">Логин:</span>
					<span id = "pole">
							<input param = "'.$myrow['login'].'" type="text" name="login" value = '.$myrow['login'].' >
					</span>
				</label>
				<label>
					<span id = "text">Имя:</span>
					<span id = "pole">
							<input type="text" name="name" value = '.$myrow['name'].'>
					</span>
				</label>
				<label>
					<span id = "text">Email:</span>
					<span id = "pole">
							<input param = "'.$myrow['email'].'" type="text" name="email" value = '.$myrow['email'].'>
					</span>
				</label>
								<label>
									<span id = "text">Авторизован:</span>
									<span id = "pole">
										<div enab = "1" name="enabled" class = "chekced '.$checked_class.'" chek='.$enabled.'></div>
									</span>
								</label>
					'.$edit.'
					<div id = "links">
						<li class = "submit" href = "update" >'.$submit.'</li>
						<li href="clous" >Закрыть</li>
					</div>	
				</form>
			</div>	
		';
	} elseif ($_POST[add_date] == 0 and $_POST[login]){
			// Регистрация
			$login = str_s($_POST[login]);
			$name = str_s($_POST[name]);
			$email = str_s($_POST[email]);
			$pass = str_s($_POST[pass]);
			$ref = str_s($_POST[ref]);
			$enabled = $_POST[enabled];
			$query0 = "SELECT login FROM $table WHERE login = '$login'";
            $result0 = mysqli_query($db,$query0);
			if (mysqli_num_rows($result0) == 0) {	
				$result1 = mysqli_query($db,"SELECT id FROM $table WHERE email = '$email'");
				$myrow1 = mysqli_fetch_array($result1);
					if (mysqli_num_rows($result1) == 0) {
						      $password = md5($pass);
							  $user_ip = $_SERVER['REMOTE_ADDR'];
							  $hash = md5($login.$const_r[str]);
							  $add_date = date("Y-m-d");
				$result3 = mysqli_query($db,"UPDATE $table SET
				login='$login',name='$name',email='$email',password='$password',confirm_hash='$hash',status = '1',enabled='$enabled',remote_addr='$user_ip',add_date='$add_date'
				WHERE id='$_SESSION[id]'");
								 
							 if (!$result3) {
									echo 'Ошибка сервера';
                             } else {
									$encoded_email = urlencode($_POST['email']);
									$date = date("d-y-m, время отправки G-i");
									$name_comp = $const_r['name']; 
									$header = "Content-type:text/plain; Charset=utf-8\r\n";
									$header.="From: ".$const_r['mail'];
									$title ='=?UTF-8?B?'.base64_encode("Вы успешно зарегистрированы в ").'?='.$name_comp;
									$mes = '
									  Вы прошли успешную регистрацию на сайте '.$name_comp.'  
									  Для подтверждения регистрации перейдите по ссылке:
									  http://'.$_SERVER['SERVER_NAME'].'/modules/cab/confirm.php?hash='.$hash.'&email='.$encoded_email.'
									  ---------------
									  Письмо отправлено '.$date.'';
									  mail($email, $title, $mes, $header);
									  echo 'Пользователь успешнно зарегистрирован!';	
							 }
					} else {
						echo 'Пользователь с электроным адресом '.$email.' уже существует!';
					}
			} else {
				echo 'Пользователь с логином '.$login.' уже существует!';
			}
	} elseif ($_POST[update]){
		 // Edit
		$login = str_s($_POST[login]);
		$name = str_s($_POST[name]);
		$enabled = $_POST[enabled];
		$email = $_POST[email];
		$hash = md5($login.$const_r[str]);
		$add_date = date("d-m-Y");
		$result = mysqli_query($db,"UPDATE $table SET login='$login',name='$name',email='$email',confirm_hash='$hash',admin_global = '1',enabled=$enabled,edit_date='$add_date' WHERE id='$_SESSION[id]'") ;
		if (!$result) {
			echo 'error';
		} else {
			echo 'Изменения успешно внесены';
		}
	} elseif ($_POST[arr]) {
		foreach ($_POST[arr] as $key => $val){
			include ($add_a."func/update.php");
		}
	}
}
?>
