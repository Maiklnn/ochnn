<?php
define('web-nn', TRUE);
session_start(); 
$g_u = '06dd1b9cd7d1012722611b4d3d4edfd3';
/* Хост */ $host='localhost';
/* Пользователь */ $user='ochnn_dbuser';
/*Пароль пользователя*/ $pass='IOhp6ZnRcb';
/* База данных */ $db_name='ochnn_dbase';
$db = mysqli_connect ($host,$user,$pass,$db_name);
mysqli_query($db,'SET CHARACTER SET utf8');  
function str_s ($var) {
	$str = htmlspecialchars(trim(addslashes($var)));
	return($str);
}
$http = 'http://'.$_SERVER['HTTP_HOST'];
$add = $_SERVER['DOCUMENT_ROOT'].'/';
$const = mysqli_query($db,"SELECT * FROM  settings");
$const_r = mysqli_fetch_array($const);
?>