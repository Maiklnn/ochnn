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
			<div id = "form_send">
				<div class="clous">X</div>
				<form>
				<h3>Отправить письмо</h3>
				<label>
					<span id = "text">Имя:</span>
					<span id = "pole">
							<input type="text" name="first_name" >
					</span>
				</label>
				<label>
					<span id = "text">Телефон:</span>
					<span id = "pole">
							<input type="text" name="phone" >
					</span>
				</label>
				<label>
					<span id = "text">Email:</span>
					<span id = "pole">
							<input type="text" name="email" >
					</span>
				</label>				
				<label>
					<span id = "text">Сообщение:</span>
					<span id = "pole">
							<textarea name="text" >Ваше сообщение</textarea>
					</span>
				</label>
				<div href = "'.$href.'" id = "submit">Отправить</div>
				</form>
			</div>	
		';
	} else {
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$text = $_POST['text'];
		date_default_timezone_set("Europe/Moscow");
		$date = date("d-y-m, время отправки G-i");
		$email_send = $const_r['mail'];
		$name_comp = $const_r['name'];
		$mes = '
		<html>
		<body>
		  <table cellspacing="15" width="600" >
			<tr>
			  <td>Имя отправителя:</td><td>'.$name.'</td>
			</tr>
			<tr>
			  <td>Телефон отправителя</td><td>'.$phone.'</td>
			</tr>
			 <tr>
			  <td>Email отправителя</td><td>'.$email.'</td>
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
		
		$mail->Subject = 'Сообщение с сайта';
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



		// $header = "Content-type:text/html; Charset=utf-8\r\n";
		// $header.="From: ".$email_send;
		// mail($email_send, $title, $mes, $header);

		
	}	
}
?>
