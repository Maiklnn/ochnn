<?
			do {
				$id = $myrow1['id'];
				if ($myrow1['status'] == 1) {  } else { $status = '<td class = "red">Необработан</td>';}
				$statu = $myrow1['status'];
				if ($statu == 0) { $status = '<td class = "red">Необработан</td>';  } 
				if  ($statu == 1) { $status = '<td class = "green">Обработан</td>'; }
				if  ($statu == 2) { $status = '<td class = "green">В архиве</td>';}
				$tab_1 = $tab_1."<tr id = '$id'>
						<td><a href = 'edit_el' ids = ".$id."  >".$id."</a></td>
						<td><div enab = '1' td = 'delete' class = 'chekced' ></div></td>
						".$status."
						<td>".$myrow1['name']."</td>
						<td>".$myrow1['date']."</td>
						<td><a href = 'edit_el' ids = ".$id."  >Просмотр</a></td>
					  </tr>";
			}while ($myrow1 = mysqli_fetch_array($result1));
		$table = "<tr id = 'title_prod' >
					<th>№</th>
					<th>Удал</th>
					<th>Статус:</th>
					<th>Покупатель:</th>
					<th>Дата заказа:</th>
					<th>Просмотр:</th>
				</tr>".$tab_1;

?>