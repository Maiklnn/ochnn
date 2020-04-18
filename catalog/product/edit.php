<? 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
 	include ( "../../admin/bloks/bd.php");
	$id = (int)$_POST[id];
	$tab = str_s($_POST[tab]);
		$query = "SELECT price,artikul,ves,razmer,anons";
		$result0 = mysqli_query($db,$query." FROM products WHERE id = '".$id."'");
		$myrow0 = mysqli_fetch_array($result0);
	if ($tab == 'opis') {
		echo htmlspecialchars_decode($myrow0[anons]);
	}
	if ($tab == 'har') {
		if ($myrow0[price] != '' ) { $price = '<div><span>Цена:</span>'.$myrow0[price].' руб.</div>';  }
		if ($myrow0[artikul] != '' ) { $artikul = '<div><span>Артикул:</span>'.$myrow0[artikul].'</div>';  }
		if ($myrow0[ves] != '' ) { $ves = '<div><span>Вес:</span>'.$myrow0[ves].'</div>';  }
		if ($myrow0[razmer] != '' ) { $razmer = '<div><span>Размер:</span>'.$myrow0[razmer].'</div>';  }
		echo $price.$artikul.$ves.$razmer;
	}

}
?>
