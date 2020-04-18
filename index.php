<?php 
include ("admin/bloks/bd.php");
$url = str_s($_GET['page']);
if (empty($url)) { $url = 'index.php'; }
$result0 = mysqli_query($db,"SELECT * FROM pages WHERE links = '".$url."'");
$myrow0 = mysqli_fetch_array($result0);
$text = $myrow0["text"];
$text = str_replace("name_const",$const_r[name],$text);
$text = str_replace("phone_const",$const_r[phone],$text);
$text = str_replace("phone2_const",$const_r[phone2],$text);
$text = str_replace("adress_const",$const_r[adress],$text);
$text = str_replace("email_const",$const_r[mail],$text);
$text = str_replace("email_orders_const",$const_r[email_orders ],$text);
$incl = $myrow0['include'];
if ($incl != '') {   
$head = '<link href="'.$incl.'/css.css" rel="stylesheet" type="text/css">
	     <script src="'.$incl.'/js.js" type="text/javascript"></script>';
}
include ("bloks/header.php");
	if ($incl) {
		$_SESSION['text'] = $text;
		include ($incl.'/index.php');
	} else {
		echo $text;
	}
include ("bloks/footer.php");
?>