<?
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
	
	$head =  '
		<script src="/admin/func/js/valid.js" type="text/javascript"></script>
		<script src="/admin/func/add/js.js" type="text/javascript"></script>
		<script src="/admin/modules/date/date.js" type="text/javascript"></script>
	';
	$table = $_POST[table];
	$fields = mysqli_query($db,"SHOW COLUMNS FROM $table");
	if ($_POST[url]) {
	while ($row = mysqli_fetch_assoc($fields)) {
			if ($row[Field] == 'namber') $n = 1;
	}
 	if ($n == '1') {
			if (!empty($_POST['parent'])) {
				$where = ' WHERE parent = '.$_POST['parent'];
			}
			$result_max = mysqli_query($db,"SELECT max(namber) FROM $table $where");
			$max = mysqli_fetch_array($result_max);
			$namber = $max[0]+'1';
			$namber = '<label>
							<span id = "text">Номер:</span>
							<span id = "pole">
								<input class = "num" int="1" type="text" name="namber" value="'.$namber.'">
							</span>
						</label>';

	}
		echo $head.'
								<div id = "clous" href = "clous" >X</div>
								<h3>Добавить</h3>
								<label>
									<span id = "text">Название:</span>
									<span id = "pole">
										<input type="text" name="name" '.$val.' >
									</span>
								</label>
								'.$input.$namber.'
								<div id = "links"><li class = "submit" >Добавить</li><li href="clous" >Закрыть</li></div>	
				';
			

		
	} elseif ($_POST[name]) {
			$name = str_s($_POST[name]);
			while ($row = mysqli_fetch_assoc($fields)) {
				if ($row[Field] == 'parent') { $parent = str_s($_POST['parent']); $names = $names.',parent'; $value = $value.",'".$parent."'"; } 
				if ($row[Field] == 'add_date') {  $date = date("d-m-Y");  $names = $names.',add_date';  $value = $value.",'".$date."'"; }
				if ($row[Field] == 'namber') { $namber = str_s($_POST['namber']); $names = $names.',namber'; $value = $value.",'".$namber."'"; }
				if ($row[Field] == 'meta_d')  { 
					include ($add_a."func/translation.php"); $url = translation($name); 
					$names = $names.',title,meta_k,meta_d,links';  
					$value = $value.",'".$name."','".$name."','".$name."','".$url."'"; 
				}  
			}
			$query = "INSERT INTO $table (name$names) VALUES ('$name'$value)";
			$result = mysqli_query($db,$query);
			if(mysqli_affected_rows($db) > 0){
				echo mysqli_insert_id($db);
			}else{
				echo 'error';
			}
			
	 } 
} 
?>