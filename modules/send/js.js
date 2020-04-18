$(document).ready(function() {
	$('input[name=first_name]').bind('change click keyup',{zn:'text',min: 3,max: 25,name:'Имя'},valid);
	$('input[name=phone]').bind('change click keyup ',{zn:'text',name:'Телефон'},valid);
	jQuery(function($) { $.mask.definitions['~']='[+-]'; $('input[name=phone]').mask('+9(999)-999-99-99'); });
	$('input[name=email]').bind('change click keyup',{zn:'email',name:'Email'},valid);
	$('textarea[name=text]').bind('change click keyup',{zn:'text',min: 3,max: 500,name:'Сообщение'},valid);
	form_d = $("#form_send");
	submit = form_d.find("*[id=submit]");
	submit.hover(function (e) {
		$('#form_send input').click();
		submit = $(this);
		submit.attr('err_s','0');
		li = form_d.find("*[err]");
			$(li).each(function() {
			err = $(this).attr('err');
			if (err != '') {
				submit.attr('err_s','1');
			}
		});
	});
	//Отправка
	submit.click( function(e) {
 		 var erorr = $(this).attr ('err_s');
		 if (erorr != 1) {
			var send = {};
			var href = $(this).attr ('href')+'edit.php';
			var send = {};
			send.name = $('input[name=first_name]').val();
			send.email = $('input[name=email]').val();
			send.phone = $('input[name=phone]').val();
			send.text = $('textarea[name=text]').val();
			$("#cerror").remove();
			$("h3").hide();
			form_d.prepend(load_css);
			cerror = $('#cerror');
			$.post (href, send, function (data) {
					if (data != 1) {
						cerror.css({'color' : 'red', 'background' : 'none', 'padding' : '10px 0'}).text(data);
					} else {
						cerror.css({'background' : 'none', 'padding-top' : '10px'}).text('Ваше письмо успешно отправлено. Мы в ближайшее время свяжимся с вами.');
						$('form').hide();	
					}
			});
			empty(send);
		}
	});	

	
});


