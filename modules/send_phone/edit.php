<? 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
 	include ( "../../admin/bloks/bd.php");
	session_start();
	if (isset($_POST["modal"])) {
	$href = $_POST["modal"];
		echo '
			<script type="text/javascript" src="/admin/func/js/mask.js"></script>
			<script src="/admin/func/js/valid.js" type="text/javascript"></script>
			<script src="'.$href.'js.js" type="text/javascript"></script>
			<div id = "edit_form">
				<div class="clous">X</div>
				<form>
				<h3>Заказать обратный звонок</h3>
				<label>
					<span id = "text">Представьтесь:</span>
					<span id = "pole">
							<input type="text" name="name" >
					</span>
				</label>
				<br>
				<p>Введите городской либо сотовый телефон по которому Вам перезвонить</p>
				<br>
				<label>
					<span id = "text">Гордской:</span>
					<span id = "pole">
							<input type="text" name="phone" >
					</span>
				</label>
				<label>
					<span id = "text">Сотовый:</span>
					<span id = "pole">
							<input type="text" name="phone1" >
					</span>
				</label>
				<label>
					<span id = "text">Коментарий:</span>
					<span id = "pole">
							<textarea name="text" >Коментарий</textarea>
					</span>
				</label>
				<div href = "'.$href.'" id="submit">Отправить</div>
				</form>
			</div>	
		';
	} else {
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$phone1 = $_POST['phone1'];
		$text = $_POST['text'];
		$email_send = $const_r['mail'];
		date_default_timezone_set("Europe/Moscow");
		$date = date("d-y-m, время отправки G-i");
		$name_comp = $const_r['name'];
$mes = '
<html>
<body>
  <table cellspacing="15" width="600" >
    <tr>
      <td>Звонок заказал:</td><td>'.$name.'</td>
    </tr>
    <tr>
      <td>Городской телефон отправителя</td><td>'.$phone.'</td>
    </tr>
	 <tr>
      <td>Сотовый телефон отправителя</td><td>'.$phone1.'</td>
    </tr>
	 <tr>
      <td>Сообщение</td><td>'.$text.'</td>
    </tr>
	<tr>
      <td colspan="2">Время отправки: '.$date.'</td>
    </tr>
</table>
</body>
</html>
';



require '../phpmailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->isSMTP();

		$mail->Host = 'smtp.mail.ru';
		$mail->SMTPAuth = true;
		$mail->Username = 'och-nn@mail.ru'; // логин от вашей почты
		$mail->Password = 'prosp222'; // пароль от почтового ящика
		$mail->SMTPSecure = 'ssl';
		$mail->Port = '465';
		
		$mail->CharSet = 'UTF-8';
		$mail->From = 'och-nn@mail.ru'; // адрес почты, с которой идет отправка
		$mail->FromName = 'Сообщение с сайта '.$http; // имя отправителя
		$mail->addAddress($email_send, $http);
		// $mail->addAddress('email2@email.com', 'Имя 2');
		// $mail->addCC('email3@email.com');
		
		$mail->isHTML(true);
		
		$mail->Subject = 'Заказ звонка с сайта';
		$mail->Body = $mes;
		$mail->AltBody = $mes;
		// $mail->addAttachment('img/Lighthouse.jpg', 'Картинка Маяк.jpg');
		// $mail->SMTPDebug = 1;
		
		if( $mail->send() ){
			echo 1;
		}else{
			echo 'Письмо не может быть отправлено. ';
			echo 'Ошибка: ' . $mail->ErrorInfo;
		}



	}
}
?>
