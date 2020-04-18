<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
	$head =  '
		<script type="text/javascript" src="/admin/func/js/ajaxupload.js" ></script>		
		<script src="/admin/func/js/valid.js" type="text/javascript"></script>
		<script src="'.$_POST[links].'js.js" type="text/javascript"></script>
	';
	$table = 'products';
	if ($_POST[id]) {
		$id = $_POST[id]; $_SESSION[id] = $id; $_SESSION[table] = $table;
		$result = mysqli_query($db,"SELECT * FROM $table WHERE id = $id");
		$myrow = mysqli_fetch_array($result);
		$name = $myrow['name'];
		$namber = $myrow["namber"];
		$add_date = $myrow['add_date'];
		if ($add_date == 0){
			$title_str = 'Добавить';
		} else {
			$title_str = 'Изменить';
			$edit_date = $myrow['edit_date'];
			if ($edit_date == $add_date  or $edit_date == 0 ) {$edit_date = 'Изменений не было';}
			$pole_date = '<label><span id = "text">Изменние:</span><span id = "pole"><INPUT class = "data" disabled type="text" value = "'.$edit_date.'"></span></label>
						  <label><span id = "text">Добавление:</span><span id = "pole"><INPUT class = "data" disabled type="text" value = '.$add_date.' ></span></label>	
						 ';
			$enabled = $myrow["enabled"];
			if ($enabled == 1) { $checked_class = ' add_chekced';}
			if ($myrow["sale"] == 1) { $checked_sale = ' add_chekced';}
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
								<h3>'.$title_str.' продукт</h3>
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
								<h6>Описание:</h6>
								<label>
									<textarea id="anons" names="anons">'.$myrow['anons'].'</textarea>
									<script type="text/javascript">
									';
									?>
									CKEDITOR.replace( 'anons' );
									<?
									echo '
									</script>
								</label>
								
								<label>
									<span id = "text">Цена:</span>
									<span id = "pole">
										<input class="price" type="text" names="price" value = "'.$myrow['price'].'">
									</span>
								</label>

								<label>
									<span id = "text">Артикул:</span>
									<span id = "pole">
										<input type="text" names="artikul" value = "'.$myrow['artikul'].'">
									</span>
								</label>
								<label>
									<span id = "text">Размер:</span>
									<span id = "pole">
										<input type="text" names="razmer" value = "'.$myrow['razmer'].'">
									</span>
								</label>								
								<label>
									<span id = "text">Вес:</span>
									<span id = "pole">
										<input type="text" names="ves" value = "'.$myrow['ves'].'">
									</span>
								</label>
							
						
								<label>
									<span id = "text">Номер:</span>
									<span id = "pole">
										<input names="namber" class = "num" type="text"  value="'.$namber.'">
									</span>
								</label>
								<label>
									<span id = "text">Cпецпредложение:</span>
									<span id = "pole">
										<div names="sale" class = "chekced'.$checked_sale.'" value='.$sale.' ></div>
									</span>
								</label>
								<label>
									<span id = "text">Включена:</span>
									<span id = "pole">
										<div names="enabled" class = "chekced'.$checked_class.'" value='.$enabled.' ></div>
									</span>
								</label>
								<div id = "t_leb" ids="'.$id.'" table="'.$table.'" td="pic" w = "400" h = "300" sm_w = "200" sm_h = "150" >
									<span id = "text">
										Картинка:
										<p>'.$p_text.'</p>
									</span>
									<span id = "pole">'.$pic.'</span>
								</div>
								
								'.$pole_date.'
								<div id = "links"><li class = "submit" href = "" >'.$title_str.'</li><li href="clous" >Закрыть</li></div>';

		} elseif ($_POST[update]) {
			$names = str_s($_POST[names]);
			$names = str_replace("@", '"', $names);
			$query = "UPDATE ".$table." SET edit_date='".date('d-m-Y')."',".$names;
			$result = mysqli_query($db,$query);
	
			if (!$result) {
				echo $names; 
				echo 'err';
             }
			 
	} 
} 

?>