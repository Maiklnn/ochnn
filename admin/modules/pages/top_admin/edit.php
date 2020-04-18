<? if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
	$id = str_s($_POST['id']); 
	$table = str_s($_POST['table']);
	if (isset($_POST[update])) {
			$sis = str_s($_POST[sis]);
			$include = str_s($_POST[incl]);
			$date = date('d-m-Y');
			$result = mysqli_query($db,"UPDATE $table SET include='$include',sus = '$sis',edit_date = '$date'  WHERE id=$id") ;
			if (!$result) {
				echo 'Ошибка сервера';
            } else {
				echo 'Изменения успешно внесены';
			}
		} else {
		$fields = mysqli_query($db,"SHOW COLUMNS FROM $table");
		while ($row = mysqli_fetch_assoc($fields)) {
			if ($row[Field] == 'include') $n = 1;
		}
		
		if ($n) {
			$result = mysqli_query($db,"SELECT sus,include FROM $table WHERE id = $id");
			$myrow = mysqli_fetch_array($result);
			$sis = $myrow['sus'];
			if ($sis == 1) { $checked_sis = 'add_chekced'; }
			$pole = '
						<label>
							<span id = "text">Системная:</span>
							<span id = "pole"><div enab = "1" name="sis" class = "chekced '.$checked_sis.'" chek='.$sis.' ></div></span>
						</label>
						<label>
							<span id = "text">Include:</span>
							<span id = "pole"><input type="text" name="incl" value="'.$myrow['include'].'"></span>
						</label>
			
			';
		}	
		echo '<script src="'.$_POST[href].'js.js" type="text/javascript"></script>
				<div id = "edit_form">
						<script src="js.js" type="text/javascript"></script>
						<div id = "clous" class="clous" >X</div>
						<h3>Top admin настройки</h3>
						<label>
							<span id = "text">ID:</span>
							<span id = "pole"><input class = "num" int="1" type="text" name="id" value="'.$id.'"></span>
						</label>
						'.$pole.'
						<div id = "links">
							<li class = "submit_admin" href = "update" >Изменить</li>
							<li class="clous" >Закрыть</li>
						</div>	
				</div>';
	}
} ?>