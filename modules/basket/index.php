<?
// echo '<pre>';
// print_r($_SESSION['cart']);
// echo '<pre>';
if($_SESSION['cart']) {
	foreach($_SESSION['cart'] as $key => $item) {
	  $price = $item['price'] * $item['qty'];
	  $tov = $tov.'<tr id="'.$key.'">
				<td class="z_name">
					<a href="/catalog/products.php?id='.$key.'">'.$item['name'].'</a>
				</td>
				<td class="z_art">
					'.$item['art'].'
				</td>
				<td class="z_kol">
					<span class = "arr_minus"></span>
					<input  class="kolvo" type="text" value="'.$item['qty'].'" name="" />
					<span class = "arr_plus"></span>
				</td>
				<td class="z_price">'.$price.'</td>
				<td class="z_del"><img src="/img/delete.jpg" title="удалить товар из заказа" /></td>
			</tr>';
	}
	
	echo '	
		<script type="text/javascript" src="/admin/func/js/mask.js"></script>
		<script src="/admin/func/js/valid.js" type="text/javascript"></script>
		<div id="content-zakaz">
			<h2>Оформление заказа</h2>
			<table class="zakaz-maiin-table" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<th>наименование</th>
					<th>артикул</th>
					<th>количество</th>
					<th>стоимость</th>
					<th>&nbsp;</th>
				</tr>
				'.$tov.'
				<tr>
					<td class="z_bot">Итого:</td>
					<td class="z_bot"></td>
					<td class="z_bot" tot_col = "1">'.$_SESSION['total_quantity'].' шт</td>
					<td class="z_bot" tot_sum = "1" colspan="2" style = "text-align: left;">'.$_SESSION['total_sum'].' руб.</td>
				</tr>
			</table>
				
				
				
				<div class="sposob-dostavki">
					<h4>Способы доставки:</h4>
						<p><input checked type="radio" name="dostavka" value="1" /> Курьером, 200 руб</p> 
						<p><input type="radio" name="dostavka" value="2" /> Самовывоз, бесплатно</p> 
						<p><input type="radio" name="dostavka" value="3" /> В магазин, бесплатно</p> 
				</div>		
				<div id = "form_send">
					<h3>Информация для доставки:</h3>
					<label>
						<span id = "text">ФИО:</span>
						<span id = "pole"><input type="text" name="fio" ></span>
					</label>
					<label>
						<span id = "text">Е-маил:</span>
						<span id = "pole"><input type="text" name="email" ></span>
					</label>
					<label>
						<span id = "text">Телефон:</span>
						<span id = "pole"><input type="text" name="phone" ></span>
					</label>
					<label>
						<span id = "text">Адрес доставки:</span>
						<span id = "pole"><input type="text" name="address" ></span>
					</label>
					<label>
						<span id = "text">Примечание:</span>
						<span id = "pole"><textarea name="prim" ></textarea></span>
					</label>
					<div href="/modules/basket/" id="submit"></div>	
				</div>
			</div>';
	} else {
		echo '<h1>В корзине нет товаров!</h1>';
	}
?>