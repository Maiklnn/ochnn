<?php 
/* ���� */ $host='localhost';
/* ���� ������ */ $db_name='stat_bd';
/* ������������ */ $db_user='stat_user';
/*������ ������������*/ $db_pass='stat_user';
$db = mysqli_connect ($host,$db_user,$db_pass,$db_name);
mysqli_query($db,'SET CHARACTER SET utf8'); 

		$fields = mysqli_list_fields($db_name, 'pages');
		$columns = mysqli_num_fields($fields); 111111111111111111
	
?>