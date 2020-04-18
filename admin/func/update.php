 <?
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {		 
	include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/bd.php");
	include ($add."admin/func/func.php");
	$table = str_s($_SESSION[table]);
	print_r($_POST['arr']);
	foreach ($_POST[arr] as $key => $val){
			$pos = strpos($val,':');
			$id = substr($val,0,$pos);
			$str = str_replace($id.":","",$val);
			$del = strpos($str, 'delete');
			if ($del === false) {
				$query = "UPDATE ".$table." SET ".$str." WHERE id=".$id;
				mysqli_query($db,$query);			
			} else {
				$del_str = $del_str.','.$id;
				$path = $add.'img/files/'.$table.'/'.$id.'/';
				rdir($path);				
			}
	}
	if(isset($del_str)) {
		$del_str = substr($del_str,1);
		mysqli_query($db,"DELETE FROM $table WHERE id IN ($del_str)");
	}
} ?>