<?php
if ($url1) { 
	mysqli_query($db,"DELETE FROM orders WHERE id IN ($id_del)");
	mysqli_query($db,"DELETE FROM zakaz_tovar WHERE orders_id IN ($id_del)");
} else {
	if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
		include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");
		$table = 'orders';
		if ($_POST[id]) {
			$id = (int)$_POST[id]; 
			$result = mysqli_query($db,"SELECT orders.date, orders.prim, orders.status,
					customers.name AS customer, customers.email, customers.phone, customers.address, dostavka.name AS sposob
						FROM orders
				LEFT JOIN customers ON customers.id = orders.customer_id
				LEFT JOIN dostavka ON dostavka.id = orders.dostavka_id
						WHERE orders.id = $id");
			$myrow = mysqli_fetch_array($result);
			
			$result1 = mysqli_query($db,"SELECT name, art, price, quantity FROM zakaz_tovar WHERE orders_id = $id");
			$myrow1 = mysqli_fetch_array($result1);
			do {
				$i++;
				$total_sum += $myrow1['price'] * $myrow1['quantity'];
				$quantity += $myrow1['quantity'];
				$tab_1 = $tab_1."<tr>
						<td>".$i."</td>
						<td>".$myrow1['name']."</td>
						<td>".$myrow1['art']."</td>
						<td>".$myrow1['price']." руб.</td>
						<td>".$myrow1['quantity']."</td>
				  </tr>";
			}while ($myrow1 = mysqli_fetch_array($result1));
			$statu = $myrow['status'];
			if ($statu == 0) { $st_class = 'red';	$status = 'Необработан';  $links = '<li status = "1" >Обработан</li>';     } 
			if ($statu == 1) { $st_class = 'green'; $status = 'Обработан';   $links = '<li status = "2" >В архив</li>'; }
			if ($statu == 2) { $st_class = 'green'; $status = 'В архиве';}
			
			echo '
				<script src="/admin/func/js/valid.js" type="text/javascript"></script>
				<script src="'.$_POST[links].'js.js" type="text/javascript"></script>
				<div id = "clous" href = "clous" >X</div>
				<h6>Заказ № '.$id.' (<span class = "'.$st_class.'">'.$status.'</span>) в нём заказаны следующие товары:</h6>
				<table class = "order" >
					<tr id = "title_prod" >
								<th>№</th>
								<th>Название</th>
								<th>Артикул</th>
								<th>Цена</th>
								<th>Шт</th>
					</tr>
					'.$tab_1.'
					<tr >
								<td colspan = 3>Итого</td>
								<td>'.$total_sum.' руб.</td>
								<td>'.$quantity.'</td>
					</tr>
				</table>
				<p>Информация о заказе:</p>
				<label>
					<span id = "text">Статус заказа:</span>
					<p class = "'.$st_class.'">'.$status.'</p>
				</label>
				<label>
					<span id = "text">Способ доставки:</span>
					<p>'.$myrow['sposob'].'</p>
				</label>
				<label>
					<span id = "text">Способ оплаты:</span>
					<p>Наличными</p>
				</label>
				<label>
					<span id = "text">Примечание:</span>
					<p>'.$myrow['prim'].'</p>
				</label>
				<label>
					<span id = "text">Дата заказа:</span>
					<p>'.$myrow['date'].'</p>
				</label>
				<p>Данные покупателя:</p>
				<label>
					<span id = "text">ФИО:</span>
					<p>'.$myrow['customer'].'</p>
				</label>
				<label>
					<span id = "text">Адрес:</span>
					<p>'.$myrow['address'].'</p>
				</label>
				<label>
					<span id = "text">Для связи:</span>
					<p>Телефон: '.$myrow['phone'].' Электронная почта: '.$myrow['email'].'</p>
				</label>
				<div id = "links" >'.$links.'<li href="clous" >Закрыть</li></div>';			
		} elseif ($_POST[status]) {
			$ids = (int)$_POST[ids];
			$status = (int)$_POST[status];
			$query = "UPDATE orders SET status = '$status' WHERE id = $ids";
			$res = mysqli_query($db,$query);
			if(mysqli_affected_rows($db) > 0) { 
				echo 'Статус закаказа изменён.';
			} else {
				echo 'Ошибка';
			}
			
		}
	}
}	

?>