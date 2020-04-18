<?
			do {
				$id = $myrow1['id'];
				$namber = $myrow1['namber'];
				if ($myrow1['enabled'] == 1) { $checked_class = 'chekced add_chekced'; } else { $checked_class = 'chekced'; }
				if ($myrow1['sale'] == 1) { $checked_spec = 'chekced add_chekced'; } else { $checked_spec = 'chekced'; }
				
				$tab_1 = $tab_1."<tr id = '$id'>
						<td ><div enab = '1' td = 'delete' class = 'chekced' ></div></td>
						<td ><div enab = '1' td = 'enabled' class = '".$checked_class."'></div></td>
						<td ><div enab = '1' td = 'sale' class = '".$checked_spec."'></div></td>
						<td ><input td = 'namber' int='1'  type='text' value='".$namber."'></td>
						<td><a ids = ".$id." href = 'edit_el'>".$myrow1['name']."</a></td>
					  </tr>";
				
			}while ($myrow1 = mysqli_fetch_array($result1));

			$table = "<tr id = 'title_prod' >
					<th td = 'delete'>Удал.</th>
					<th td = 'enabled' >Вкл:</th>
					<th td = 'sale'>Спец.</th>
					<th>Номер:</th>
					<th>Название:</th>
				</tr>".$tab_1;

?>