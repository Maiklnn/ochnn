<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include ( "../../admin/bloks/bd.php");
	echo	'<script type="text/javascript"  src="/modules/search/search_slider.js"></script>
			<script type="text/javascript"  src="/modules/search/search.js"></script>';
	if (isset($_POST[slider])) {
		echo '
			<p>Возраст:</p>
			<div id="inp-rang">
				от <input class="podbor-price" type="text" id="amount" name = "amount" value="0" />
				до <input class="podbor-price" type="text" name="end-price" id="amount2" name = "amount2" value="18" /> лет.
			</div>	
			<div id="slider-rang"></div>
			<p>Цена:</p>
			<div id="inp-rang">
				от <input class="podbor-price" type="text" id="price" name = "price" value="50" />
				до <input class="podbor-price" type="text" id="price2" name = "price2" value="8000" /> руб.
			</div>	
			<div id="slider-price"></div>
			<div id="submit" page="0" num="8" >Найти</div>
		';
	} elseif (isset($_POST[for1])) {
	    if ($_POST[for1] != 2) {
			$for = ' and for1 = '.$_POST['for1'];
		}
		$min_pr = ' and price > '.$_POST['price_min'];
		$max_pr = ' and price < '.$_POST['price_max'];		
		
		
		$min_p = ' and age > '.$_POST['age_min'];
		$max_p = ' and age_max < '.$_POST['age_max'];
	    $where = $min_pr.$max_pr.$min_p.$max_p.$for;
		$num = $_POST['num'];
		@$page = $_POST['page'];
		$result00 = mysqli_query($db,"SELECT COUNT(*) FROM products WHERE enabled='1' $where");
		if ($result00) {
			$temp = mysqli_fetch_array($result00);
		}
    $posts = $temp[0];
    $total = (($posts - 1) / $num) + 1;
    $total =  intval($total);
    $page = intval($page);
    if(empty($page) or $page < 0) $page = 1;
    if($page > $total) 
		$page = $total;
		$start = $page * $num - $num;
	   
	   
	   if ($page != $total) $nextpage = '<a href ="#" page='.$total.' all = '.$posts.' >...</a>';
       if($page - 5 > 0) $page5left = ' <a href ="#" page='.($page - 5).' num = '.$num.' >'.($page - 5) .'</a>';
       if($page - 4 > 0) $page4left = ' <a href ="#" page='.($page - 4).' num = '.$num.' >'.($page - 4) .'</a>';
       if($page - 3 > 0) $page3left = ' <a href ="#" page='.($page - 3).' num = '.$num.' >'.($page - 3) .'</a>';
       if($page - 2 > 0) $page2left = ' <a href ="#" page='.($page - 2).' num = '.$num.' >'.($page - 2) .'</a>';
       if($page - 1 > 0) $page1left = '<a href ="#" page='.($page - 1).' num = '.$num.' >'.($page - 1) .'</a>';
       if($page + 5 <= $total) $page5right = '<a href ="#" page='.($page + 5).' num = '.$num.' >'. ($page + 5) .'</a>';
       if($page + 4 <= $total) $page4right = '<a href ="#" page='.($page + 4).' num = '.$num.' >'. ($page + 4) .'</a>';
       if($page + 3 <= $total) $page3right = '<a href ="#" page='.($page + 3).' num = '.$num.' >'. ($page + 3) .'</a>';
       if($page + 2 <= $total) $page2right = '<a href ="#" page='.($page + 2).' num = '.$num.' >'. ($page + 2) .'</a>';
       if($page + 1 <= $total) $page1right = '<a href ="#" page='.($page + 1).' num = '.$num.' >'. ($page + 1) .'</a>';

		
	$result1 = mysqli_query($db,"SELECT * FROM products WHERE enabled='1' $where LIMIT $start, $num");
 
	if ($result1) {
		$myrow1 = mysqli_fetch_array($result1);
		$zac = '<span>Найдены следующие товары:</span>';
	} else {
		$zac = 'По Вашему запросу ничего не найдено';
	}  

	

	if ($myrow1 > 0 ){
	echo '<p>'.$zac.'</p>';
	if ($total > 1){
		   Error_Reporting(E_ALL & ~E_NOTICE);
		   echo "<div class='nav' >";
		   echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.       $page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
		   echo "</div>";}	


	do {

	   $price = $myrow1['price']; 
	  


	   if (isset($_SESSION['order_id'])) {
			if (in_array($myrow1["id"], $_SESSION['order_id'])) {
			$order = 'Товар добавлен в корзину';
			$order_spes = 'Товар добавлен в корзину';
			}  else {
			if ($myrow1['zac'] == 0) {$order = 'Купить'; $order_spes = 'Купить по спец цене';} else { $order_spes = 'Заказать по спец цене'.$myrow1['price_two'].' руб.'; $order = 'Заказать';}
			
			} 
	   } else {
	   if ($myrow1['zac'] == 0) {$order = 'Купить'; $order_spes = 'Купить по спец цене';} else { $order_spes = 'Заказать по спец цене'; $order = 'Заказать';}
	   }	
									   
	echo "<div class =  'prod_small '>
	<a href = 'http://".$_SERVER['SERVER_NAME']."/catalog/view_products.php?id=".$myrow1['id']."'><img src='../products_pictures/".$myrow1['pic']."' alt = '' ></a>
	<div class =  'name_pos' >".$myrow1['name']."</div>
	<p>Артикул:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$myrow1['art']."</p>
	<p>Цена:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$price."&nbsp;руб.</p>
	<p>Спец Цена:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$myrow1['price_two']."&nbsp;руб.</p>
	<p><a style = 'border-right : none;	'   href = 'http://".$_SERVER['SERVER_NAME']."/catalog/view_products.php?id=".$myrow1['id']."'>Подробнее...</a></p>";


	if ($order != 'Товар добавлен в корзину' or $order_spes != 'Товар добавлен в корзину') {
	echo "<p>
	<a style = 'width : 101px; float: left;' href = 'view_cat.php?id=".$id_cat."&price=".$price."&page=".$page."&num=".$num."&prod=".$myrow1['id']."'>".$order."</a>
	<a href = 'view_cat.php?price= ".$myrow1['price_two']."&page=".$page."&num=".$num."&id=".$id_cat."&prod=".$myrow1['id']."'>".$order_spes." </a>
	</p>";
	} else { 
	echo "<p style='font-weight : bold; text-align : center; background-color: Aqua;' >".$order."</p>";
	};
	 



	echo "</div>";




	}
	while ($myrow1 = mysqli_fetch_array($result1));




	 echo "<div class = ' nav'><br>";
		   Error_Reporting(E_ALL & ~E_NOTICE);
		   echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.       $page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
		   echo "</div>"; }





	}
}	
?>