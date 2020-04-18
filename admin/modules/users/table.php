<?
		do {
			$id = $myrow1['id'];
			$name = $myrow1['login'];
			$avtor = $myrow1['enabled'];
			if ($avtor == 1) { $checked_class = 'chekced add_chekced'; } else { $checked_class = 'chekced'; }
			$status = $myrow1['status'];
			if ($status == 1) { $st_class = 'red';  $status1 = 'Топ админ';       } 
			if ($status == 2) { $st_class = 'red';  $status1 = 'Админ';    }
			if ($status == 3) { $st_class = 'green'; $status1 = 'Пользователь';}

			
			
			
			$tab_1 = $tab_1."<tr id = '$id' >
					<td><div enab = '1' td = 'enabled' class = '".$checked_class."'></div></td>
					<td><div enab = '1' td = 'delete' class = 'chekced' ></div></td>
					<td><a ids = '".$id."' href = 'edit_el'>".$name."</a></td>					
					<td class = '".$st_class."'>".$status1."</td>					
				</tr>"; 
		}while ($myrow1 = mysqli_fetch_array($result1)); 
		$table = "<tr id = 'title_prod'>
				<th>Автор.</th>
				<th>Удал.</th>
				<th>Логин:</th>
				<th>Статус:</th>
			</tr>".$tab_1;

  
?>