<? if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
	$id = str_s($_POST['id']); 
	$table = str_s($_POST['table']);
	if (isset($_POST[update])) {
			$title = str_s($_POST['title']); 
			$meta_d = str_s($_POST['meta_d']);
			$meta_k = str_s($_POST['meta_k']);
			$url_update = str_s($_POST['url_update']);
			$date = date('d-m-Y');
			$result = mysqli_query($db,"UPDATE $table SET title = '$title',links = '$url_update',meta_k = '$meta_k', meta_d = '$meta_d',edit_date = '$date' WHERE id = $id") ;
			if (!$result) {
				echo 'err';
            } else {
				echo 1;
			}
		} else {
			$result = mysqli_query($db,"SELECT title,meta_k,meta_d,links,add_date FROM $table WHERE id = $id");
			$myrow = mysqli_fetch_array($result);
			echo '<script src="'.$_POST[href].'js_seo.js" type="text/javascript"></script>
			<div id = "edit_form">
					<script src="js.js" type="text/javascript"></script>
					<div id = "clous" class="clous" >X</div>
					<h3>Seo настройки</h3>
					<label>
						<span id = "text">title:</span>
						<span id = "pole"><input type="text" name="title" value = "'.$myrow['title'].'"></span>
					</label>
					<label>
						<span id = "text">Url:</span>
						<span id = "pole"><input table = '.$table.' name="url" type="text" param = "'.$myrow['links'].'" value="'.$myrow['links'].'"></span>
					</label>
					<label>
						<span id = "text">Мета keywords:</span>
						<span id = "pole"><textarea name="meta_k" >'.$myrow['meta_k'].'</textarea></span>
					</label>
					<label>
						<span id = "text">Мета description:</span>
						<span id = "pole"><textarea valid = "Мета description" name="meta_d" >'.$myrow['meta_d'].'</textarea></span>
					</label>
					<div id = "links">
						<li class = "submit_seo" href = "update" >Изменить</li>
						<li class="clous" >Закрыть</li>
					</div>	
			</div>';
		}
} ?>