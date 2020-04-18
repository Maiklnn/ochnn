<? 
include ( "../../admin/bloks/bd.php");
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
 	function pereshet(){
 		session_start(); 
		global $db;  
		/* ===Сумма заказа в корзине + атрибуты товара===*/
		$_SESSION['total_sum'] = 0;
		$str_goods = implode(',',array_keys($_SESSION['cart']));
		$query = "SELECT id, name, price, artikul FROM products WHERE id IN ($str_goods)";
		$res = mysqli_query($db,$query);

		
		while($row = mysqli_fetch_assoc($res)){
			$sum_one = $_SESSION['cart'][$row['id']]['price'];
			$_SESSION['cart'][$row['id']]['name'] = $row['name'];
			$_SESSION['cart'][$row['id']]['art'] = $row['artikul'];
			$_SESSION['cart'][$row['id']]['price'] = $row['price'];
			$_SESSION['cart'][$row['id']]['img'] = $row['img'];
			$_SESSION['total_sum'] += $_SESSION['cart'][$row['id']]['qty'] * $row['price'];
		}
		/* ===кол-во товара в корзине + защита от ввода несуществующего ID товара=== */
		$_SESSION['total_quantity'] = 0;
		foreach($_SESSION['cart'] as $key => $value){
			if(isset($value['price']) and $value['price'] != 0){
				$_SESSION['total_quantity'] += $value['qty'];
			}else{
				unset($_SESSION['cart'][$key]);
			}
		}

		$col = $_SESSION['total_quantity'];
		if ($col > 0) {
				if ($col == 1) { $num = 'товар'; } if ($col > 1) { $num = 'товара';} if ($col > 4) { $num = 'товаров';}
				$basket = $col.' '.$num.'<span>'.$_SESSION['total_sum'].'</span> руб.';
						$basket = '
						<p>У вас в корзине<br/>
						<span class = "col" >'.$_SESSION['total_quantity'].'</span> '.$num.' на <span class = "sum" >'.$_SESSION['total_sum'].'</span> руб.</p>
						<a href="/basket"><img src="/img/oformit.jpg" alt="" /></a>';
			   $res = array("basket" => $basket, "col" => $col, "sum" => $_SESSION['total_sum'], "sum_one" => $sum_one);	
			   return 	$res;
		} 
	}
	
	
	
	
	if ($_POST["dei"] == 'add') {
		/* ===Добавление в корзину=== */
		$goods_id = (int)$_POST[id];
		$qty = (int)$_POST[count];
		// echo $qty;
		if(isset($_SESSION['cart'][$goods_id])){
			$_SESSION['cart'][$goods_id]['qty'] += $qty;
		}else{
			$_SESSION['cart'][$goods_id]['qty'] = $qty;
		}
		$basket = pereshet();
		exit(json_encode($basket));

		
	} elseif ($_POST["dei"] == 'delete') {
		$id = (int)$_POST["id"];
		unset($_SESSION['cart'][$id]);
		if 	(count($_SESSION['cart']) != 0) {
			$basket = pereshet();
			exit(json_encode($basket));
		} else { echo 'no';}
		
	} elseif ($_POST["dei"] == 'arr') {
		$id = (int)$_POST[id];
		$kol = (int)$_POST[kol];
		$_SESSION['cart'][$id]["qty"] = $kol;
		$basket = pereshet();
		exit(json_encode($basket));
	} elseif ($_POST["dei"] == 'zakaz') {
		if(!$_SESSION['auth']['user']){
			$name = str_s($_POST['name']);
			$email = str_s($_POST['email']);
			$phone = str_s($_POST['phone']);
			$address = str_s($_POST['address']);
			$query = "INSERT INTO customers (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
			$res = mysqli_query($db,$query);
			if(mysqli_affected_rows($db) > 0){
				$customer_id = mysqli_insert_id($db);
			}else{
				echo 'Произошла ошибка при регистрации товара';
				return false;
			}
		} 

		$dostavka_id = (int)$_POST['dost'];
		$prim = str_s($_POST["prim"]); 
		$query = "INSERT INTO orders (`customer_id`, `date`, `dostavka_id`, `prim`) VALUES ($customer_id, NOW(), $dostavka_id, '$prim')";
		mysqli_query($db,$query);
		if(mysqli_affected_rows($db) == -1){
			mysqli_query($db,"DELETE FROM customers WHERE customer_id = $customer_id  AND login = ''");
			echo 'Произошла ошибка при регистрации товара';
			return false;
		}
		$order_id = mysqli_insert_id($db);
		foreach($_SESSION['cart'] as $goods_id => $value){
			$val .= "($order_id, $goods_id, {$value['qty']}, '{$value['name']}', '{$value['art']}', {$value['price']}),";    
		}
		$val = substr($val, 0, -1); 
		$query = "INSERT INTO zakaz_tovar (orders_id, goods_id, quantity, name, art, price) VALUES $val";
		mysqli_query($db,$query);

	    if(mysqli_affected_rows($db) == -1){
			mysqli_query($db,"DELETE FROM orders WHERE id = $order_id");
			mysqli_query($db,"DELETE FROM customers WHERE id = $customer_id AND login = ''");
			echo 'Произошла ошибка при регистрации товара';
			return false;
		}


		$header = "Content-type:text/html; Charset=utf-8\r\n";
		$header.="From: ".$email;
		$title ='=?UTF-8?B?'.base64_encode("Заказ в интернет магазине: ").'?='.$http;

		
		date_default_timezone_set("Europe/Moscow");
		$date = date("d-y-m, время отправки G-i");
		$name_comp = $const_r['name'];
		foreach($_SESSION['cart'] as $goods_id => $value){
			$tovar = $tovar."<tr><td>Наименование: ".$value['name'].", Цена: ".$value['price'].", Количество: ".$value['qty']." шт.</td></tr>";
		}
		$mail_body = '<html>
		<body>
		  <table cellspacing="15" width="600" >
			<tr>
			  <td>Благодарим Вас за заказ! Номер Вашего заказа - '.$order_id.' </td>
			</tr>
			<tr>
			  <td>Вы Заказали:</td>
			</tr>
			'.$tovar.'
			<tr>
				<td>Итого: '.$_SESSION['total_quantity'].' на сумму: '.$_SESSION['total_sum'].'</td>";
			</tr>
			<tr>
			  <td>Дата отправки: '.$date.'</td>
			</tr>
		</table>
		</body>
		</html>';
		if($_SESSION['auth']['email']) { $email = $_SESSION['auth']['email']; } else { $email = $_POST['email']; }
		$email_admin = $const_r['mail'];
		mail($email, $title, $mail_body, $header);
		mail($email_admin, $title, $mail_body, $header);	
		unset($_SESSION['cart']);
		$_SESSION['total_sum'] = 0;
		$_SESSION['total_quantity'] = 0;
		echo 'Спасибо за Ваш заказ. В ближайшее время с Вами свяжется менеджер для согласования заказа.';
		return true;
	}
	

}
?>
