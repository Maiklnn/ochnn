<?php 
include ( "../admin/bloks/bd.php");
$head = '<link href="/catalog/css.css" rel="stylesheet" type="text/css"><script src="/catalog/product/js.js" type="text/javascript"></script>';
if (isset($_GET['id'])) { (int)$id = $_GET['id'];}
$result0 = mysqli_query($db,"SELECT * FROM products WHERE id = '".$id."' and enabled = 1");
$myrow0 = mysqli_fetch_array($result0);
include ("../bloks/header.php");
	if ($myrow0) {
		$result1 = mysqli_query($db,"SELECT id,name FROM cat WHERE id = '".$myrow0[cat_id]."'");
		$myrow1 = mysqli_fetch_array($result1);
		if ($myrow0[price] != '' ) { $price = '<div><span>Цена:</span>'.$myrow0[price].' руб.</div>';  }
		if ($myrow0[artikul] != '' ) { $artikul = '<div><span>Артикул:</span>'.$myrow0[artikul].'</div>';  }
		if ($myrow0[ves] != '' ) { $ves = '<div><span>Вес:</span>'.$myrow0[ves].'</div>';  }
		if ($myrow0[razmer] != '' ) { $razmer = '<div><span>Размер:</span>'.$myrow0[razmer].'</div>';  }
		
		
		echo '
			<div class = "prod">
						<h1>'.$myrow0[name].'</h1>
						<div class = "blok">
							<img src="/img/files/products/'.$id.'/'.$myrow0[pic].'"></img>
							<div class = "text" >
								'.$price.$artikul.$ves.$razmer.'
							</div>
							
							<div class="z_kol">  
								<span class = "arr_minus"></span>
								<input  class="kolvo" type="text" value="1" name="" />
								<span class = "arr_plus"></span>
							</div>
							<div class = "add_cart" zakaz = '.$id.'></div>
						</div>
						
				<div class="tabs">
					<ul ids = '.$id.'>
						<li class = "active" tab = "opis">Описание</li>
						<li tab = "har">Харктеристики</li>
					</ul>
				</div> 
				<div class = "tabs_content">
					'.htmlspecialchars_decode($myrow0[anons]).'
				</div>
			</div>';
	} else {
		echo '<div class = "err">Товар отсутвует свяжитесь с нашим менеджером</div>';
	}	
include ("../bloks/footer.php")

?>
