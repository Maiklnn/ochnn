$(document).ready(function () {

	
	
	
	$(".login_f").hide();
	$('input[name=login]').bind('change click keyup',{zn:'text',min: 6,max: 13,name:'Логин'},valid);
	$('input[name=first_name]').bind('change click keyup',{zn:'text',name:'Имя'},valid);
	$('input[name=email]').bind('change click keyup',{zn:'email',name:'Email'},valid);
	$('input[name=password1]').bind('change click keyup ',{zn:'text', pass:1,min: 6,max: 13,name:'Пароль'},valid);
	$('input[name=password2]').bind('change click keyup ',{zn:'text', pass2:1,min: 6,max: 13,name:'Полтверждение пароля'},valid);
	$('.clous').live('click', clous);
	$('#form_data>div[id=submit]').hover(function (e) {
		$('input').click();
		submit = $(this);
		submit.attr('err','0');
		li = $("#form_data").find("input[val]");
		$(li).each(function() {
			err = $(this).attr('val');
			if (err != '') {
				style = 'del = "1" style = "'+err_text+' margin: 5px 0 0 0;"';
				// submit.after ('<li '+style+'>'+err+'<br></li>');
				submit.attr('err','1');
			}
		});
	},function () {
		$('li[del=1]').remove();
	});
	
	//Отправка
	$('#form_data>div[id=submit]').click(function(e) {
	    e.preventDefault();
		var erorr = $(this).attr ('err');
		if (erorr == 0) {
				var send = {};
				send.data_reg = $('input[name=login]').val();
				send.name = $('input[name=first_name]').val();
				send.ref = $('input[name=ref]').val();
				send.email = $('input[name=email]').val();
				send.pass = $('input[name=password1]').val();
				form = $('#form_data');
				$("#cerror").remove();
				$("h3").hide();
				form.prepend(load_css);
				$.post ( "/admin/aunth/edit_users.php",send,function (data) {
						if (data != 1) {
							$("#cerror").css({'color' : 'red', 'background' : 'none', 'padding-top' : '10px'}).text(data);
						} else {
							form.before(load_css)
							$("#cerror").css({'background' : 'none', 'padding-top' : '10px'}).text('Регистрация прошла успешно! Для входа пройдите по ссылке, отправленной Вам на email '+send.email+'.');
							form.hide();
						}
				});
		}
	});
});
