<?
		$result_prod = mysqli_query($db,"SELECT id FROM orders WHERE status = '0'");
		$count_new_orders = mysqli_num_rows($result_prod);
		if($count_new_orders > 0) { $new_zakaz_links = '<p href = "return" url = "/admin/modules/orders/" table = "orders" where = "status=0" >Есть новые заказы ( '.$count_new_orders.' ) шт.</p>'; }
?>
<div id="left">
    <div id="left_menu">
		<? 
		echo $new_zakaz_links."
			<div id = 'top_left_menu'>Меню</div> 
			<a href = '/'>В пользовательскую часть</a>
			<a href = '/admin/'>На главную админки</a>
			$link_l
			<a href = 'last_go'' >Назад</a>	
        </div>
		"; 
		?>
</div>
<div id="content">
