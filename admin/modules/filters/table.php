<?
		do {
			$id = $myrow1['id'];
			$enabled = $myrow1['enabled'];
			$namber = $myrow1['namber'];
			$cat_id = $myrow1['cat_id'];
			$name = $myrow1['name'];
			$sis = $myrow1['sus'];
			$link = "<a ids = ".$id." href = 'edit_el'>$name</a>";
			if ($cat_id == 1 and $_SESSION[top_a] == 1) { $name = $link; } else { $name = $name; }
			if ($cat_id != 1) { $name = $link; }
			if ($enabled == 1) { $checked_class = 'chekced add_chekced'; } else { $checked_class = 'chekced'; }
			if ($sis > 0)  { $sis_td = 'Сист-ая'; } else { $sis_td = "<div enab = '1' td = 'delete' class = 'chekced' ></div>"; }
			if ($cat_id == 0) {
				$td_name = '<th>Фильтры:</th><th>Параметры:</th>';
				$result_cat = mysqli_query($db,"SELECT id FROM $table WHERE cat_id='$id'");
				$count_cat = mysqli_num_rows($result_cat);
				$link1 = '<td class = "td_abb"><li>
						 <a href = "return" where = "cat_id='.$id.'" categ = "'.$id.'" >Кол-во<span id = "count_cat" >'.$count_cat.'</span></a>
						 <a href = "new_el" parent = "cat_id='.$id.'" >Добавить</a>
						 </li></td>';
			} else {
				$td_name = '<th>Параметры:</th>';
			}


			
			$tab_1 = $tab_1."<tr id = '".$id."'>
						<td ><div enab = '1' td = 'enabled' class = '".$checked_class."'></div></td>
						<td >".$id."</td>
						<td >".$sis_td."</td>
						<td ><input td = 'number' int='1'  type='text' value='".$namber."'></td>
						<td>".$name."</td>
						".$link1."
					</tr>";
		}while ($myrow1 = mysqli_fetch_array($result1)); 
		
		
		if ($add_cat == 1) { $add_title = '<th>Вложеные странички</th>';} 
		$table = "<tr>
					<th> Вкл.</th>
					<th>Удал.</th>
					<th>Номер.</th>
					".$td_name."
				</tr>".$tab_1;	
				
				
		
?>