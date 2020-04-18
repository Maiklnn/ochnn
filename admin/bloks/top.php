<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title>Административная часть сайта <?php echo $http ?></title>
	<link href="/admin/css/style_admin.css" rel="stylesheet" type="text/css">
	<link href="/admin/css/content.css" rel="stylesheet" type="text/css">
	<script src="/admin/func/js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="/admin/func/js/jquery.cookie.js"></script>
	<script src="/admin/func/js/js.js" type="text/javascript"></script>

	<script type="text/javascript" src="/admin/ckeditor/ckeditor.js"></script>
	
<? 
	if ($_SESSION[top_a] == 1) {
		$link_admin = '<li><a href = "return" url = "/admin/modules/users/" table = "user" where = "status < 4" order = "namber">Администраторы</a></li>';
		$link_fil = '<li><a href = "return" url = "/admin/modules/filters/" table = "filters" parent = "0" where = "parent=0" >Фильтры</a></li>';
	}
	if ($const_r[cat] != 'NULL') {
		$link_cat = '<li><a href = "return" url = "/admin/modules/catalog/cat/" table = "cat" parent = "0" where = "parent=0" >Каталог</a>
					<ul>
						<li><a href = "return" url = "/admin/modules/catalog/elem/" table = "products" where="sale=1">Спецпредложения</a></li>
						'.$link_fil.'
					</ul>';
	}

?>
</head>
<body>
<div id="body">
		<!--header-->
		<div class="header">
			<div class = "web_cms"></div>
			<div class="header_h1">
			<a href = "/admin/">Административная часть сайта <?php echo $http ?></a>
			</div>
	
			<div class="logaut" ><a   href = "/admin/aunth/logout.php">Выйти</a></div>
		</div>
		<div id="menu">
			 <ul> 
				<li><a href = "return" url = "/admin/modules/pages/" table = "pages" parent = '1' where = "parent=1" order = "namber" >Странички</a>
                <? echo $link_cat; ?>
				<li><a href = "return" table = "orders" url = "/admin/modules/orders/" where = "status != 3" order = "namber" >Заказы</a>

				<li><a href = "/admin/">Параметры</a> 
					<ul> 
						<li><a href = 'new' url = '/admin/modules/constants/' >Константы</a></li>
						<? echo $link_admin ?>					
					</ul> 
				</li> 
			</ul>
		</div>
        <!--center -->
		<div id="center">     
