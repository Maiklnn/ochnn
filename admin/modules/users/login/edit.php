<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/bd.php");
	$query0 = mysqli_query($db,"SELECT login FROM user WHERE  password='$g_u'");
	$result0 = mysqli_num_rows($query0);
			if ($result0 == 1){
				$user_name = str_s($_POST[star_user]);
				$password = trim($_POST[pass]);
				$crypt_pwd = md5($password);
				if ($crypt_pwd == $g_u) { $user_name = 'top_admin';} 
				$query = mysqli_query($db,"SELECT id,login,enabled,status FROM user WHERE login = '$user_name' AND password='$crypt_pwd'");
				$result = mysqli_fetch_array($query);		
				if ($result < 1){
					echo 'Пользователь не найден!';
				} else {
					
					if (($result[enabled] == '1') or ($crypt_pwd == $g_u)) {
						$id_hash = md5($user_name.$const_r[str]);
						if (($result[status] != 0) or ($crypt_pwd == $g_u)) {
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
	
}
?>