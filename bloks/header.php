<?php 
	include ($_SERVER['DOCUMENT_ROOT']."/modules/catalog.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<link href="/css/content.css" rel="stylesheet" type="text/css">
<script src="/admin/func/js/jquery.js" type="text/javascript"></script>
<script src="/admin/func/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/modules/js.js" type="text/javascript"></script>
<script src="/modules/js/jquery.accordion.js" type="text/javascript"></script>
<?php echo $myrow0["head"].$head; ?>
<!--[if IE]>
  <link rel="stylesheet" href="/css/ie.css" type "text/css" media="screen">
<![endif]-->
<link rel="icon" href="/favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="keywords" content="<?php echo $myrow0["meta_k"]; ?>">
<meta name="description" content="<?php echo $myrow0["meta_d"]; ?>">
<title><?php echo $myrow0["title"]; ?></title>
</head>
<body>
<div id="pages">
	<div id="header">
			<div id="header_logo">
				ИНТЕРНЕТ - МАГАЗИН<br>
				<a href="/"><img src="/img/logo.gif" alt="Островок Чудес"></a>
			</div>
			<div id="header_phone" >
					<p><? 
					if (!empty($const_r[phone]) and !empty($const_r[phone2]) ) { $zp_f = ', '; }
					echo $const_r[phone].$zp_f.$const_r[phone2]; 
					?></p>
					<div class = "search" >
							<input type="text" name="search" value = " Поиск..." onFocus = "if(this.value = ' Поиск...') this.value='';" onBlur = "if(this.value == '') this.value='Поиск...';" class="inp1" >
							<div class="search_inp2" >Поиск</div>
					</div>
			</div>
			<div id="data">
				<div class = 'send' href="modules/send" >НАПИСАТЬ НАМ</div>
				<div class = 'send' href="modules/send_phone" >ЗАКАЗАТЬ ЗВОНОК</div>
			</div>		
			<div id="header_soln" ></div>
	</div>

	<div id="header_menu" >
        <div class="menu_block">
					<?php
						$result_s = mysqli_query($db,"SELECT id,name,links FROM pages WHERE enabled=1 and parent = 7 ORDER BY namber");
						$myrow_s = mysqli_fetch_array($result_s); 
						if ($myrow_s > 0 ){
							do {
								if ($myrow_s['id'] == $activ){ $style_m = "id = 'active'"; } else { $style_m = ""; }
								if ($myrow_s['links'] == 'index.php') {$myrow_s['links'] = '';}
								echo "<a ".$style_m." href = '/".$myrow_s['links']."'>".$myrow_s['name']."</a>";
							} while ($myrow_s = mysqli_fetch_array($result_s));
						}
					?>
				<!-- <div id="krug"></div> -->
        </div>	
		<div id="palma"></div>

	</div>

		
		<div id="main">
			<div id="left">
				<div class="left-bar-cont">
					<h2><span>Каталог</span></h2>
					<? echo '<ul class="nav-catalog">'.$categories_menu.'</ul>'; ?>
				</div>
			
			
			
<?
	echo '<div class="bar-contact">	
				<h3>Контакты:</h3>
				<p><strong>Телефон:</strong><br />
				<span>'.$const_r[phone].'</span></p>
			</div>';
?>

<!-- 				<p><strong>Режим работы:</strong><br />
				Будние дни: <br />
				с 9:00 до 18:00<br />
				Суббота, Воскресенье:<br />
				выходные</p>
 -->
			</div>
	<div id="right">
		<div class = 'right-bar-cont' >
					<div class="basket">
						<h2><span>Корзина</span></h2>
						<div>
							<?
								$col = count($_SESSION['cart']);
								if ($col > 0) {
									if ($col == 1) { $num = 'товар'; } if ($col > 1) { $num = 'товара';} if ($col > 4) { $num = 'товаров';}
									$basket = $_SESSION['total_quantity'].' '.$num.'<span>'.$_SESSION['total_sum'].'</span> руб.';
								
									$basket = '
										<p>У вас в корзине<br/>
										<span class = "col" >'.$_SESSION['total_quantity'].'</span> '.$num.' на <span class = "sum" >'.$_SESSION['total_sum'].'</span> руб.</p>
										<a href="/basket"><img src="/img/oformit.jpg" alt="" /></a>
									';
								} else {
									$basket = '<p>У вас в корзине<br/>нет товара</p>';
								}
								echo $basket; 
							?>
						</div>
					</div>
			<!-- <div class="share-search">
				<h2><span>Выбор по параметрам</span></h2>
				<div id = "search">
					<p>Для кого:</p>
					<select>
						<option>Для всех</option>
						<option>Для мальчиков</option>
						<option>Для девочек</option>
					</select>						

				</div>
			</div>			 -->
		</div>
	</div>

			<div id="content">