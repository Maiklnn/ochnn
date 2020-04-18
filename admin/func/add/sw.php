<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
		include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
		echo '
			<div class="title_form" >Изменения успешно внесены</div>
			<div id = "links1"> 
				<a href="new_el" parent = "'.$_SESSION['parent'].'" >Добавить ещё</a>
				<a href="edit_el" >Вернуться к редактированию</a>
				<a href = "clous" >Вернуться к списку</a>
			</div>	
		';
} 
?>