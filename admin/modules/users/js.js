$(document).ready(function() {
	$('input[name=login]').live('change click keyup',{min: 5,max: 13,col:'login',name:'Логин'},valid);
	$('input[name=name]').bind('change click keyup',{min:2,max: 13,name:'Имя'},valid);
	$('input[name=email]').live('change click keyup',{zn:'email',table:'user',col:'email',name:'Email'},valid);
	$('input[name=password1]').bind('change click keyup ',{zn:'pass', pass:1,min: 6,max: 13,name:'Пароль'},valid);
	$('input[name=password2]').bind('change click keyup ',{zn:'pass', pass2:1,min: 6,max: 13,name:'Подтверждение пароля'},valid);
	submit = $('.submit');
	hver_c(submit);
	//Отправка
	submit.click( function(e) {
		 var erorr = $(this).attr ('err_s');
		 if (erorr != 1) {
			$("#cerror").remove();
			text = $(this).text();
			var send = {};
			send.update = 1;
			send.login = $('input[name=login]').val();
			send.name = $('input[name=name]').val();
			send.ref = $('input[name=ref]').val();
			send.email = $('input[name=email]').val();
			send.pass = $('input[name=password1]').val();
			send.enabled = $('*[name=enabled]').attr('chek');
			send.add_date = $('*[name=add_date]').val();
			$('#edit_form').prepend(load_css);
			link = '/admin/modules/users/edit.php';
			$.post (link,send,function (data) {
				if (text === 'Добавить') {
					$('#edit_form').empty().prepend('<div id = "clous" href = "clous">X</div>').prepend(load_css);
				} 
				$('#cerror').css({'color' : 'green', 'background' : 'none', 'padding' : '10px 0'}).text(data);
			});
		}
	});	

	
});


