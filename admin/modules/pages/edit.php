<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
	$head =  '
		<script type="text/javascript" src="/admin/func/js/ajaxupload.js" ></script>
		<script src="/admin/func/js/valid.js" type="text/javascript"></script>
		<script src="'.$_POST[links].'js.js" type="text/javascript"></script>
	';
	$table = 'pages';
	if ($_POST[id]) {
		$id = $_POST[id]; $_SESSION[id] = $id; $_SESSION[table] = $table; 
		$result = mysqli_query($db,"SELECT * FROM $table WHERE id = $id");
		$myrow = mysqli_fetch_array($result);
		$name = $myrow['name'];
		$namber = $myrow["namber"];
		$add_date = $myrow['add_date'];
		$edit_date = $myrow['edit_date'];
		if ($edit_date == 0){
			$title_str = 'Добавить';
		} else {
			$title_str = 'Изменить';
			$text = $myrow['text'];
			if ($edit_date == $add_date  or $edit_date == 0 ) {$edit_date = 'Изменений не было';}
			$date_pole = '<label><span id = "text">Изменние:</span><span id = "pole"><INPUT class = "data" disabled type="text" value = "'.$edit_date.'"></span></label>
						  <label><span id = "text">Добавление:</span><span id = "pole"><INPUT class = "data" disabled type="text" value = '.$add_date.' ></span></label>	
						 ';
			$enabled = $myrow["enabled"];
			if ($enabled == 1) { $checked_class = ' add_chekced';}
		}
		

		if ($_SESSION[top_a] == 1) {
					$adm = '
								<label>
									<div id ="link" link = "admin/modules/pages/top_admin">Top_admin настройки</div>
								</label>
					';}
				echo $head.'
								<div id = "clous" href = "clous" >X</div>
								<h3>'.$title_str.' страничку</h3>
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
								<label>
								<div class = "cen">Краткое описание:</div>
								<textarea id="editor1" name="editor1" names="text">'.$text.'</textarea>
								<script type="text/javascript">
								';
								?>
								CKEDITOR.replace( 'editor1' );
								<?
								echo '
								</script>
								</label>
								<label>
									<span id = "text">Номер:</span>
									<span id = "pole">
										<input class = "num" int="1" type="text" names="namber" value="'.$namber.'">
									</span>
								</label>
								<label>
									<span id = "text">Включена:</span>
									<span id = "pole">
										<div names="enabled" class = "chekced'.$checked_class.'" value="'.$enabled.'"></div>
									</span>
								</label>
								'.$date_pole.'
								<div id = "links"><li class = "submit" href = "" >'.$title_str.'</li><li href="clous" >Закрыть</li></div>	
				';			
	} elseif ($_POST[update]) {
			$names = str_s($_POST[names]);
			$names = str_replace("@", '"', $names);
			$query = "UPDATE ".$table." SET edit_date='".date('d-m-Y')."',".$names;
			$result = mysqli_query($db,$query);
			if (!$result) {
				echo 'err';
            } 
	} 
} 

?>