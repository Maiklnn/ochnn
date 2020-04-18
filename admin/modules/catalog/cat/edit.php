<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
	$head =  '
		<script type="text/javascript" src="/admin/func/js/ajaxupload.js" ></script>		
		<script src="/admin/func/js/valid.js" type="text/javascript"></script>
		<script src="'.$_POST[links].'js.js" type="text/javascript"></script>
	';
	$table = 'cat';
	if ($_POST[id]) {
		$id = $_POST[id]; $_SESSION[id] = $id; $_SESSION[table] = $table; 
		$where = $_POST['parent']; 
		$result = mysqli_query($db,"SELECT * FROM $table WHERE id = $id");
		$myrow = mysqli_fetch_array($result);
		$name = $myrow['name'];
		$namber = $myrow["namber"];
		$add_date = $myrow['add_date'];
		if ($add_date == 0){
			$title_str = 'Добавить';
		} else {
			$title_str = 'Изменить';
			$id = $myrow['id'];
			$edit_date = $myrow['edit_date'];
			if ($edit_date == $add_date  or $edit_date == 0 ) {$edit_date = 'Изменений не было';}
			$date_pole = '<label><span id = "text">Изменние:</span><span id = "pole"><INPUT class = "data" disabled type="text" value = "'.$edit_date.'"></span></label>
						  <label><span id = "text">Добавление:</span><span id = "pole"><INPUT class = "data" disabled type="text" value = '.$add_date.' ></span></label>	
						 ';
			$enabled = $myrow["enabled"];
			if ($enabled == 1) { $checked_class = ' add_chekced';}
		$result_f = mysqli_query($db,"SELECT system FROM filters WHERE id = 1");
		$myrow_f = mysqli_fetch_array($result_f);
			if ($myrow_f['system'] != 1) { 
				$filter_inp = '
					<label>
						<span id = "text">Фильтры:</span>
						<span id = "pole">
							<div ids = "'.$row[id].'" class = "select">Фильтры</div>
						</span>
					</label>';
			} 
		}
		$pic = $myrow['pic'];
		if (!empty($pic)) {
			$pic = '<img url = "'.$pic.'" class = "delimg" src="/img/files/'.$table.'/'.$id.'/'.$pic.'" ><li style = "display:none" id = "upload_s">Добавить картинку</li>';
			$info = '<p>Для удаления картинки кликните по ней.</p>';
		} else { 
			$pic = '<li  id = "upload_s">Добавить картинку</li>';
		}
		$img_g = $myrow['img_slide'];
				echo $head.'
								<div id = "clous" href = "clous" >X</div>
								<h3>'.$title_str.' категорию</h3>
								<label>
									<span id = "text">Название:</span>
									<span id = "pole">
										<input type="text" names="name" value = "'.$name.'">
									</span>
								</label>
								'.$adm.'
								<label>
									<div id ="link" link = "admin/modules/pages/seo">Seo настройки</div>
								</label>
								'.$filter_inp.'
								<label>
									<span id = "text">Номер:</span>
									<span id = "pole">
										<input names="namber" class = "num" type="text"  value="'.$namber.'">
									</span>
								</label>
								<label>
									<span id = "text">Включена:</span>
									<span id = "pole">
										<div names="enabled" class = "chekced'.$checked_class.'" value='.$enabled.' ></div>
									</span>
								</label>
								'.$date_pole.'
								<div id = "links"><li class = "submit" href = "" >'.$title_str.'</li><li href="clous" >Закрыть</li></div>';

		} elseif ($_POST[update]) {
			$names = str_s($_POST[names]);
			$names = str_replace("@", '"', $names);
			$query = "UPDATE ".$table." SET edit_date='".date('d-m-Y')."',".$names;
			$result = mysqli_query($db,$query);
			echo $query;
			if (!$result) {
				echo 'err';
	         }
			 
	} 
} 

?>