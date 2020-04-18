<?
if ($url1) { 
		if (strstr($val, "delete_")) {
				$val1 = str_replace("delete_","",$val);
				$pos = strpos($val1,'_');
				$zn = substr($val1,0,$pos);
				$val1 = str_replace($zn."_","",$val1);
				$result_fil = mysqli_query($db,"SELECT prod_name FROM $table WHERE id='$val1'");
				$m_fil = mysqli_fetch_array($result_fil);
				$name_t = substr($m_fil[prod_name], 0, -1);
				mysqli_query($db,"ALTER TABLE products DROP $name_t;");
		}
} else {
	if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
		include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
		$head =  '
			<script src="/admin/func/js/valid.js" type="text/javascript"></script>
			<script src="'.$_POST[links].'js.js" type="text/javascript"></script>
		';
		$table = 'filters';
		if ($_POST[id]) {
			$id = $_POST[id]; $_SESSION[id] = $id;
			$where = $_POST[parent_id]; 
			$result = mysqli_query($db,"SELECT filters.cat_id,filters.system,filters.enabled,filters.name,filters.prod_name,filters.namber,filters.add_date,filters2.id AS id2,filters2.prod_name AS prod_name2 FROM filters LEFT JOIN filters AS filters2 ON filters2.id = filters.cat_id WHERE filters.id = $id");
			$myrow = mysqli_fetch_array($result);
			$name = $myrow['name'];
			$namber = $myrow["namber"];
			$add_date = $myrow['add_date'];
			$date = date("Y-m-d");
			$cat_id = $myrow['cat_id']; $_SESSION[cat_id] = $cat_id;
			if ($add_date == 0){
				$title_str = 'Добавить';
				$_SESSION[dat] = "add_date = '".$date."'";
				if ($cat_id != 0) {
					$result1 = mysqli_query($db,"SELECT filters3.id,filters2.prod_name FROM filters LEFT JOIN filters AS filters2 ON filters2.id = filters.cat_id LEFT JOIN filters AS filters3 ON filters3.prod_name = filters2.prod_name WHERE filters.id = $id");
					$count_prod = mysqli_num_rows($result1);
					if ($count_prod > 1) {
						$myrow1 = mysqli_fetch_array($result1);
						$fil_id = "fil_id='$myrow1[0]'";
						$result_max = mysqli_query($db,"SELECT id FROM $table WHERE fil_id = $myrow1[0]");
						$max = mysqli_num_rows($result_max);
						$td_name = $max+1;
					} else {
						$fil_id = "fil_id='$cat_id'";
						$td_name = $namber;
					}
					$result = mysqli_query($db,"UPDATE $table SET $fil_id WHERE id = $id");
				} else {
					include ($add_a."func/translation.php"); $td_name = url($name); 
				}	
			} else {
				$title_str = 'Изменить';
				$_SESSION[dat] = "edit_date = '".$date."'";
				$id = $myrow['id'];
				if ($cat_id == 0) { $td_name = substr($myrow['prod_name'], 0, -1); } else { $td_name = $myrow['prod_name']; }
				$edit_date = $myrow['edit_date'];
				if ($edit_date == $add_date  or $edit_date == 0 ) {$edit_date = 'Изменений не было';}
				$edit_date = '<label><span id = "text">Изменние:</span><span id = "pole"><INPUT class = "data" disabled type="text" NAME="date_edit" value = "'.$edit_date.'"></span></label>
							  <label><span id = "text">Добавление:</span><span id = "pole"><INPUT class = "data" disabled type="text" NAME="add_date" value = '.$add_date.' ></span></label>	
							 ';
				$enabled = $myrow["enabled"];
				if ($enabled == 1) { $checked_class = 'add_chekced';}
				$system = $myrow["system"];
				if ($system > 1) {
					if ($system == 2) { $name_sys = 'select'; }
					if ($system == 3) { $name_sys = 'checked'; }	
				
				} else { $system = 1; $name_sys = 'input'; }
			}
			
			echo $id;
			if ($cat_id == 0) {
				$zn = substr($myrow['prod_name'], -1);
				if ($zn == 1) { $zn_class = 'add_chekced';} else { $zn = 0;}
				$psevdo = '
					<label>
						<span id = "text">Ячейка в таблице:</span>	<span id = "pole"><input type="text" name="prod_name" value = "'.$td_name.'"></span>
					</label>
					<label>
						<span id = "text">Одно значение:</span>	
						<span id = "pole">
							<div enab = "1" name="zn" class = "chekced '.$zn_class.'" chek='.$zn.'></div>
						</span>
					</label>';
			} else {
				$psevdo = '<label><span id = "text">Значение:</span><span id = "pole"><input class = "num" value="'.$td_name.'" type="text" name="prod_name" value = "'.$myrow['prod_name'].'"></span></label>';
			}	
			
					echo $head.'
									<div id = "clous" href = "clous" >X</div>
									<h3>'.$title_str.'</h3>
									<label>
										<span id = "text">Название:</span>
										<span id = "pole">
											<input type="text" name="name" value = "'.$name.'">
										</span>
									</label>
									'.$psevdo.'	
									<label>
										<span id = "text">Номер:</span>
										<span id = "pole">
											<input class = "num" int="1" type="text" name="namber" value="'.$namber.'">
										</span>
									</label>
									
									<label>
										<span id = "text">Поле:</span>
										<span id = "pole">
											<div ids = "pole" name = "pole" values = "'.$system.'" class = "select">'.$name_sys.'</div>
										</span>
									</label>

									<label>
										<span id = "text">Включена:</span>
										<span id = "pole">
											<div enab = "1" name="enabled" class = "chekced '.$checked_class.'" chek='.$enabled.'></div>
										</span>
									</label>
									'.$edit_date.'
									<div id = "links"><li class = "submit" href = "" >'.$title_str.'</li><li href="clous" >Закрыть</li></div>	
					';			
		} elseif ($_POST[update]) {
				$cat = str_s($_POST[cat]);
				$enabled = $_POST[enabled];
				$namber = str_s($_POST[namber]);
				$name = str_s($_POST[name1]);
				$prod_name = str_s($_POST[prod_name]).str_s($_POST[zn]);
				$new = substr($_SESSION[dat], 0, 3);
				$system = str_s($_POST[system]);
				$result = mysqli_query($db,"UPDATE $table SET enabled='$enabled'$fil_id,namber='$namber',name='$name',prod_name='$prod_name',system='$system',$_SESSION[dat] WHERE id='$_SESSION[id]'") ;
				if (!$result) {
					echo 'err';
					exit();
				}
				if ($new == 'add' and $_SESSION[cat_id] == 0) {
					$prod_name = substr($prod_name, 0, -1);
					$fields = mysqli_list_fields($db_name, $table, $db);
					$columns = mysqli_num_fields($fields);
					for ($i = 1; $i < $columns; $i++) {
						$td_sql = $name.mysqli_field_name($fields, $i).',';
					}
					$pole = strstr($td_sql,$prod_name);
					if (!$pole) {
						$result1 = mysqli_query($db,"ALTER TABLE products ADD $prod_name INT(8) NOT NULL");
					}
				}
		
		}
	} 
}
?>