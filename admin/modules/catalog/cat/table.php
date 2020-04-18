<?

		function td_cat($id,$pod_categ,$col,$db,&$title_cat) { 
				if ($pod_categ != $col) {
					$result_cat = mysqli_query($db,"SELECT id FROM $_SESSION[table] WHERE parent='$id'");
					$count_cat = mysqli_num_rows($result_cat);
					 if ($count_cat > 0)  { $td_delete = 'Влож'; }
				
					$link = '<td class = "td_abb">
							 <li>
								<a href = "return" where = "parent='.$id.'" parent ="'.$id.'">Кол-во<span id = "count_cat" >'.$count_cat.'</span></a>
								<a href = "new_el" parent = "'.$id.'" >Добавить</a>
							 </li>';
					$title_cat = '<th>Под категории:</th>';		 
				} else {
						$result_prod = mysqli_query($db,"SELECT id FROM products WHERE parent='$id'");
						$count_prod = mysqli_num_rows($result_prod);
						if ($count_prod > 0)  { $td_delete = 'Влож'; }
						$link = '<td class = "td_abb">
										<li>
											<a href = "return" url = "/admin/modules/catalog/elem/" table = "products" sql = "id,cat_id,name,namber,enabled" order = "namber" where = "parent='.$id.'" parent = "'.$id.'" order = "namber" >Кол-во<span id = "count_cat" >'.$count_prod.'</span></a>
											<a href = "new_el" parent = "'.$id.'" url = "/admin/modules/catalog/elem/" table = "products" >Добавить</a>
										</li>
								  </td>';
						 $title_cat = '<th>Товары:</th>';		  
				}
				global $title_cat;
				return $link; 
		}
		
		

		
		do {
			$id = $myrow1['id'];
			$name = $myrow1['name'];
			$enabled = $myrow1['enabled'];
			$sql = 'id,cat_id,name';
			$link0 = "<a ids = ".$id." href = 'edit_el'>$name</a>";
			if ($enabled == 1) { $checked_class = 'chekced add_chekced'; } else { $checked_class = 'chekced'; }
			if ($sis > 0)  { $td_delete = 'Сист-ая'; } else { $td_delete = "<div enab = '1' td = 'delete' class = 'chekced' ></div>"; }

				
			$link = td_cat($id,$pod_categ = 1,$col,$db,$title_cat); 

			
			
			$tab_1 = $tab_1."
				<tr id = '$id'>
					<td ><div td = 'enabled' enab = '1' class = '".$checked_class."'></div></td>
					<td >".$td_delete."</td>
					<td ><input td = 'namber' type='text' value='".$myrow1['namber']."'></td>
					<td><a ids = ".$id." href = 'edit_el'>".$name."</a></td>
					".$link."
				</tr>";
		}while ($myrow1 = mysqli_fetch_array($result1)); 

	
		$table = "<tr>
					<th td = 'enabled' > Вкл.</th>
					<th td = 'delete' >Удал.</th>
					<th>Номер.</th>
					<th>Категория:</th>
					".$title_cat."
				</tr>".$tab_1;		
?>
