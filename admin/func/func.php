<?
function url($url) { 
		$rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
		$lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','s','sh','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','_');
		$url = str_replace($rus, $lat, $url);
		$table = $_SESSION[table];
		$result = mysqli_query($db,"SELECT id FROM $table WHERE links = '$url'");
		if ( mysqli_num_rows($result) == 1) { $url = time().'_'.$url; }
		return $url;	
}
function translation($string) { 
	$rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
	$lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','s','sh','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','_');
	$string = str_replace($rus, $lat, $string);
	return strtolower($string);	
}
// удаление папки
 function rdir($path) {
  if ( file_exists( $path ) AND is_dir( $path ) ) {
    $dir = opendir($path);
    while ( false !== ( $element = readdir( $dir ) ) ) {
      if ( $element != '.' AND $element != '..' )  {
        $tmp = $path . '/' . $element;
        chmod( $tmp, 0777 );
        if ( is_dir( $tmp ) ) {
         RDir( $tmp );
        } else {
          unlink( $tmp );
       }
     }
   }
    closedir($dir);
   if ( file_exists( $path ) ) {
     rmdir( $path );
   }
 }
}


?>