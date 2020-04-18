$(document).ready(function() {
	$('input[name=name]').bind('change click keyup',{zn:'text',min: 3,max: 25,name:'Имя'},valid);
	jQuery(function($) { $.mask.definitions['~']='[+-]'; $('input[name=phone]').mask('(831)999-99-99'); });
	jQuery(function($) { $.mask.definitions['~']='[+-]'; $('input[name=phone1]').mask('+7(999)999-99-99'); });
	submit = $("#submit");
	hver_c(submit);
	//Отправка
	submit.click( function(e) {
 		phone = $('input[name=phone]').val();
		phone1 = $('input[name=phone1]').val();
		if (phone == '' && phone1 == '') {
			alert("Не указан телефон по каторому с Вами связаться")
			submit.attr('err_s','1');
		} else {
			submit.attr('err_s','0');
		}
		 var erorr = $(this).attr ('err_s');
		 if (erorr != 1) {
			var send = {};
			var href = $(this).attr ('href')+'edit.php';
			var send = {};
			send.name = $('input[name=name]').val();
			send.phone = phone;
			send.phone1 = phone1;
			send.text = $('textarea[name=text]').val();
			$("#cerror").remove();
			$("h3").hide();
			$('#edit_form').prepend(load_css);
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


