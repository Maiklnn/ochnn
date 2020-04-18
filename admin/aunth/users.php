<?php
include ("../aunth/access_admin.php");
include ("../bloks/bd.php");
$head =  '
		<link type="text/css" href="/admin/css/aunth.css" rel="stylesheet" />
		<script type="text/javascript" src="/admin/modules/js/users.js"></script>
		';
include ("../bloks/top.php");


if ($_POST['submit'] == 'Сохранить изменения') {
   
$page = $_POST['page'];
$table = 'user';
 
    
	
	foreach ($page as $key => $val){
  
	  if (strstr($key, "delete_")) {
	  $key = str_replace("delete_","",$key);
	   mysqli_query($db,"DELETE FROM $table WHERE id='$key'") ;
	  }
   }
}
$where = 'WHERE password != '.$g_u;
$link = '<a href = "/admin/aunth/abb_user.php">Добавить пользователя</a>';
include ("../bloks/left.php");
?>












<!--center -->
<div id="content" >


<?php 
$user_admin = mysqli_query($db,"SELECT * FROM user ");
$myrow_ua = mysqli_fetch_array($user_admin); 
 
if ($myrow_ua > 0 ){





			  echo "<table><tr>
			<th class = 'checbox' >Удал.</th>
			<th class = 'str25' >Логин:</th>
			<th class = 'str25' >e-mail.</th>
			<th class = 'data'>Дата добавления.</th>
			<th class = 'data'>Авторизация.</th>
			</tr>
			<FORM METHOD='POST'>
			";
			
			
do {
if ($myrow_ua['is_confirmed'] == 0) { $is_confirmed = 'Нет'; } else { $is_confirmed = 'Да'; }
 $id = $myrow_ua['id'];

 


			echo "
			<tr>
				<td><input name='page[delete_".$id."]' value='".$id."' type='checkbox' ></td>
				<td><a id = '".$id."' href = 'edit'>".$myrow_ua['user_name']."</a></td>
				<td  >".$myrow_ua['email']."</td>
				<td>".$myrow_ua['date_created']."</td>
				<td>".$is_confirmed."</td>
			</tr>
			"; 


} while ($myrow_ua = mysqli_fetch_array($user_admin));
}

			echo "</table>
			<INPUT class='submit' TYPE='SUBMIT' NAME='submit' VALUE='Сохранить изменения'> 
			</FORM>";


?>

</div>
<!--End center -->


 


<!--bottom -->
<?php include ("../bloks/down.php"); ?>
