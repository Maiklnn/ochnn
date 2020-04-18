<?php
include ($_SERVER['DOCUMENT_ROOT']."/admin/bloks/access_admin.php");	
include ("translation.php");
$id = $_SESSION[id];
$table = $_SESSION[table];
$uploaddir = $add.'/img/files/'.$table.'/';
if(!is_dir($uploaddir)) { $dir = mkdir($uploaddir); } 
$uploaddir = $add.'/img/files/'.$table.'/'.$id.'/';
if(!is_dir($uploaddir)) { $dir = mkdir($uploaddir); }
// CKEeditor
if ($_GET['CKEditorFuncNum']) {
		$file = time().'_'.basename($_FILES['upload']['name']);
		$file = translation($file);
		$str_upload = "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(".$_GET['CKEditorFuncNum'].",\"/img/files/".$table.'/'.$id.'/'.$file."\",\"".$error."\" );</script>"; 
		if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploaddir.$file)) { 
			echo $str_upload;
		}
		exit();
}
// загрузка картинок галереи
if($_POST['td']){
		$td = $_POST['td'];
		$w = $_POST['w'];
		$h = $_POST['h'];
		$sm_h = $_POST['sm_h'];
		$sm_w = $_POST['sm_w'];
		$date = $_POST['date'];
		$file = $_FILES['upload']['name'];
		$ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $file));
		if ($td != 'img_slide') {
					$newimg = time().'_'."{$id}.{$ext}"; 
					$uploadfile = $uploaddir.$newimg;
					if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadfile)) { 
						if ($sm_w > 0) {
							$sm_newimg = 'sm_'.$newimg;
							resize($uploadfile, "$uploaddir/$sm_newimg", $sm_w, $sm_h, $ext);
						}
						resize($uploadfile, "$uploaddir/$newimg", $w, $h, $ext);
						mysqli_query($db,"UPDATE $table SET $td = '$newimg' WHERE id = $id");
						$res = array("answer" => "OK", "file" => $http.'/img/files/'.$table.'/'.$id.'/'.$newimg, "name" => $newimg);
						exit(json_encode($res));
					}			
		} else {
					$query = "SELECT $td FROM $table WHERE id = $id";
					$res = mysqli_query($db,$query);
					$row = mysqli_fetch_assoc($res);
					$img_g = $row['img_slide'];	
					if(!empty($img_g)){
						$images = explode("|", $img_g);
						$lastimg = end($images);
						$lastnum = preg_replace("#\d+_(\d+)\.\w+#", "$1", $lastimg); 
						$lastnum += 1;
						$newimg = "{$id}_{$lastnum}.{$ext}";
						$sm_newimg = "sm_{$id}_{$lastnum}.{$ext}";
						$sql = "{$img_g}|{$newimg}";
					}else{
						$newimg = "{$id}_0.{$ext}"; 
						$sm_newimg = "sm_{$id}_0.{$ext}";
						$sql = $newimg;
					}
					$uploadfile = $uploaddir.$newimg;
					if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadfile)) { 
						resize($uploadfile, "$uploaddir/$newimg", $w, $h, $ext);
						resize($uploadfile, "$uploaddir/$sm_newimg", $sm_w, $sm_h, $ext);
						mysqli_query($db,"UPDATE $table SET $td = '$sql' WHERE id = $id");
						$res = array("answer" => "OK", "file" => $http.'/img/files/'.$table.'/'.$sm_newimg, "name" => $newimg);
						exit(json_encode($res));
					} 
		}
};	
// Удаление картинок
if($_POST['td_del']){
		$img = $_POST['img'];
		$td = $_POST['td_del'];
		$small = $_POST['small'];
	    if ($td != 'img_slide') {
			mysqli_query($db,"UPDATE $table SET $td = '' WHERE id = $id");
			if(mysqli_affected_rows($db) > 0){
				unlink($uploaddir.'/'.$img);
				if ($small > 0) {
					$file2 = $uploaddir.'/sm_'.$img;
					unlink($file2);
				}
			}
			exit('ok');
		}	
}	

// функция	resize
function resize($target, $dest, $wmax, $hmax, $ext){
    list($w_orig, $h_orig) = getimagesize($target);
    $ratio = $w_orig / $h_orig;
    if(($wmax / $hmax) > $ratio){
        $wmax = $hmax * $ratio;
    }else{
        $hmax = $wmax / $ratio;
    }
    $img = "";
    switch($ext){
        case("gif"):
            $img = imagecreatefromgif($target);
            break;
        case("png"):
            $img = imagecreatefrompng($target);
            break;
        default:
            $img = imagecreatefromjpeg($target);    
    }
    $newImg = imagecreatetruecolor($wmax, $hmax);
    if($ext == "png"){
        imagesavealpha($newImg, true);
        $transPng = imagecolorallocatealpha($newImg,0,0,0,127);
        imagefill($newImg, 0, 0, $transPng); 
    }
    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); 
    switch($ext){
        case("gif"):
            imagegif($newImg, $dest);
            break;
        case("png"):
            imagepng($newImg, $dest);
            break;
        default:
            imagejpeg($newImg, $dest);    
    }
    imagedestroy($newImg);
}



	
?>