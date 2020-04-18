<?php
 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
include ( "../../admin/bloks/bd.php");
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$text = $_POST['text'];

$date = date("d-y-m, время отправки G-i");
$name_comp = $const_r['name'];
$address_saits = $const_r['mail'];
$header = "Content-type:text/plain; Charset=utf-8\r\n";
$title ='=?UTF-8?B?'.base64_encode("Сообщение с сайта ").'?='.$name_comp;
									
	$mes = '  
---------------
Информация об отправителе: 
---------------
 Имя:                                                                                   ' .$name. ' 
 Телефон:                                                                            ' .$phone.'
 Электронный адрес:                                                         ' .$email.'
 				
Сообщение:
---------------
				
		' .$text. '
			  
---------------
Дата отправки        '.$date.'';

mail($address_saits, $title, $mes, $header);
echo 1;

} 
?>