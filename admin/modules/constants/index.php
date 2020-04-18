<?php
include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
$table = 'settings';

if (!$_POST[name]) {
 	$head =  '
		<script src="/admin/func/js/valid.js" type="text/javascript"></script>
		<script src="/admin/modules/constants/js.js" type="text/javascript"></script>
	';
	$result = mysqli_query($db,"SELECT * FROM $table");
	$myrow = mysqli_fetch_array($result); 
	$name = $myrow['name'];
	$phone = $myrow['phone'];
	$phone2 = $myrow['phone2'];
	$adress = $myrow['adress'];
	$email = $myrow['mail'];
	$str = $myrow['str'];
	if ($_SESSION[top_a] == 1) {$large = '<label><span id = "text">Описание:</span><span id = "pole"><INPUT type="text" NAME="str" value = "'.$str.'"></span></label>';}
	$add_date = $myrow['add_date'];
	$edit_date = $myrow['edit_date'];
	if ($edit_date == $add_date) {$edit_date = 'Изменений не было';}
	$edit_date = '<label><span id = "text">Изменён:</span><span id = "pole"><INPUT class = "data" disabled type="text" NAME="date_edit" value = "'.$edit_date.'"></span></label>';
						echo $head.'<div id = "clous" class = "clous" >X</div>
									<h3>Изменить константы</h3>
									<label>
										<span id = "text">Название: | name_const:</span>
										<span id = "pole">
											<input type="text" name="name" value = "'.$name.'">
										</span>
									</label>
									<label>
										<span id = "text">Телефон: | phone_const</span>
										<span id = "pole">
											<input type="text" name="phone" value = "'.$phone.'">
										</span>
									</label>
									<label>
										<span id = "text">Телефон_2: | phone2_const</span>
										<span id = "pole">
											<input type="text" name="phone2" value = "'.$phone2.'">
										</span>
									</label>
									<label>
										<span id = "text">Адресс: | adress_const</span>
										<span id = "pole">
											<input type="text" name="adress" value = "'.$adress.'">
										</span>
									</label>
									<label>
										<span id = "text">Email: | email_const</span>
										<span id = "pole">
											<input type="text" name="email" value = "'.$email.'">
										</span>
									</label>

									'.$large.$edit_date.'
										<div id = "links"><li class = "submit" href = "update" >Изменить</li><li class="clous" >Закрыть</li></div>
					';			
} else {
		$name = str_s($_POST[name]); 
		$phone = str_s($_POST[phone]);
		$phone2 = str_s($_POST[phone2]);
		$adress = str_s($_POST[adress]); 
		$email = str_s($_POST[email]);
		$str = str_s($_POST[str]);
		if ($str != '') { $str1 = ",str='".$str."'";}
		$add_date = date("d-m-Y");
		$result = mysqli_query($db,"UPDATE $table SET name='$name',phone='$phone',phone2='$phone2',mail='$email',adress='$adress'$str1,edit_date='$add_date'") ;
		if(mysqli_affected_rows($db) < 0){
			echo 'error';
		} 
}

?>
