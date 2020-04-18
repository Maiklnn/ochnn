<?
		do {
			$id = $myrow1['id'];
			$enabled = $myrow1['enabled'];
			$namber = $myrow1['namber'];
			$name = $myrow1['name'];
			$sis = $myrow1['sus'];
			$link = "<a ids = ".$id." href = 'edit_el'>$name</a>";
			if ($cat_id == 1 and $_SESSION[top_a] == 1) { $name = $link; } else { $name = $name; }
			if ($cat_id != 1) { $name = $link; }
			if ($enabled == 1) { $checked_class = 'chekced add_chekced'; } else { $checked_class = 'chekced'; }
			if ($sis > 0)  { $sis_td = 'Сист-ая'; } else { $sis_td = "<div enab = '1' td = 'delete' class = 'chekced' ></div>"; }
			
			if ($col != 1) {
				$result_cat = mysqli_query($db,"SELECT id FROM $table WHERE parent='$id'");
				$count_cat = mysqli_num_rows($result_cat);
				$link1 = '<td class = "td_abb"><li>
						 <a href = "return" where = "parent='.$id.'" parent = "'.$id.'" >Кол-во<span id = "count_cat" >'.$count_cat.'</span></a>
						 <a href = "new_el" parent = "'.$id.'" >Добавить</a>
						 </li></td>';
			}	
			$tab_1 = $tab_1."<tr id = '".$id."'>
						<td ><div enab = '1' td = 'enabled' class = '".$checked_class."'></div></td>
						<td >".$sis_td."</td>
						<td ><input td = 'namber' int='1'  type='text' value='".$namber."'></td>
						<td>".$name."</td>
						".$link1."
					</tr>";
		}while ($myrow1 = mysqli_fetch_array($result1)); 
		

		if ($col == 1) { $add_title = '<th>Вложеные странички</th>';} else { $add_title = '<th>Раздел</th><th>Кол-во страничек</th>';}
		$table = "<tr>
					<th td = 'enabled'> Вкл.</th>
					<th td = 'delete'>Удал.</th>
					<th>Номер.</th>
					".$add_title."
				</tr>".$tab_1;	
		
?>