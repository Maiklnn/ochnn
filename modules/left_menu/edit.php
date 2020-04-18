<? 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
 	include ( "../../admin/bloks/bd.php");
	$id = (int)$_POST[id];
	$result_s = mysqli_query($db,"SELECT  id,name FROM cat WHERE enabled=1 and parent = '".$id."' ORDER BY namber ");
	$myrow_s = mysqli_fetch_array($result_s);
	if ($myrow_s > 0 ){
	  do {					
		$str = $str."<li> - <a href = 'http://".$_SERVER['SERVER_NAME']."/catalog/view_cat.php?id=".$myrow_s['id']."'>".$myrow_s['name']."</a></li>";    
	  } while ($myrow_s = mysqli_fetch_array($result_s));
	}
	echo $str;
}
?>
