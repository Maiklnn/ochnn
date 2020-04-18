<? 
	include ( "../admin/bloks/bd.php");
	if (isset($_GET['id'])) { (int)$id = $_GET['id'];}
	$result0 = mysqli_query($db,"SELECT * FROM cat WHERE id = '".$id."' and enabled = 1");
	$myrow0 = mysqli_fetch_array($result0);

	$head = '<link href="/catalog/css.css" rel="stylesheet" type="text/css">
			 <script src="/catalog/js.js" type="text/javascript"></script>';
	include ("../bloks/header.php");
	// крошка
	echo "<div class = 'kroshka'>".$breadcrumbs."</div>";
	// продукты 
	echo "<div class = 'pagination'>".$pagination."</div>";
	echo '<div class = "conteiner-prod-center">'.$products.'</div><div id = "clear"></div>';
	echo "<div class = 'pagination'>".$pagination."</div>";
	include ("../bloks/footer.php") 
?>

