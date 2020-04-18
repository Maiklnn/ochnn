<?
	$table = 'products'; 
	if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {	
		include ( "../admin/bloks/bd.php");
		// $page = $_POST['page'];
		$page = 1;
		$where = "enabled=1 and name LIKE '%Пирамидка с наклейками%'";
	}	
	include ($add."admin/func/nav.php");


	if ($temp[0] > 0) {
			$result1 = mysqli_query($db,"SELECT id,name,pic,price,artikul,ves,razmer FROM $table WHERE $where ORDER BY namber $limit ");
			$myrow1 = mysqli_fetch_array($result1);
			
			do {
				if ($myrow1[artikul] != '' ) { $artikul = '<div><p>Артикул:</p> <p>'.$myrow1[artikul].'</p></div>';  } else { $artikul = ''; } 
				if ($myrow1[ves] != '' ) { $ves = '<div><p>Вес:</p><p>'.$myrow1[ves].'</p></div>';  } else { $ves = ''; }
				if ($myrow1[razmer] != '' ) { $razmer = '<div><p>Размер:</p> <p>'.$myrow1[razmer].'</p></div>';  } else { $razmer = ''; }
				$str = $str.'<div class="prod-line">					
										<div class="prod-line-img">
											<a href="/catalog/products.php?id='.$myrow1[id].'"><img src="/img/files/products/'.$myrow1[pic].'" alt="" /></a>
										</div>
										<div class="prod-line-price">
											<p>Цена :  <span class = "price">'.$myrow1[price].'</span> руб.</p>
											<div class="z_kol">  
												<span class = "arr_minus"></span>
												<input  class="kolvo" type="text" value="1" name="" />
												<span class = "arr_plus"></span>
											</div>
											
											<div class="addtocard-index" zakaz = '.$myrow1[id].'></div>
											<p class="prod-line-more"><a href="/catalog/products.php?id='.$myrow1[id].'">подробнее...</a></p>
										</div>	
										
										<div class="prod-line-opis">
											<h2><a href="/catalog/products.php?id='.$myrow1[id].'">'.$myrow1[name].'</a></h2>
											'.$artikul.$ves.$razmer.'
										</div>
				</div>'; 
			} while ($myrow1 = mysqli_fetch_array($result1));
	} else {
			$str = $str.'<div class = "err"  >Категория <span>'.$myrow2[2].'</span> находится в стадии наполнения!</div>';
	}
	echo '<div class = "conteiner-prod-center">'.$nav.$str.$nav.'</div>';
?>
