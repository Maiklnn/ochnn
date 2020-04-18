$(document).ready(function() {
	$('input[name=user_name]').bind('change click keyup',{zn:'text', min: 3,max: 20,name:'Логин'},valid);
	$('input[name=password1]').bind('change click keyup ',{zn:'text', pass:1,min: 6,max: 13,name:'Пароль'},valid);
	form_d = $("#login_fo");
	submit = form_d.find("*[id=submit]");
	submit.hover(function (e) {
		$('#login_fo input').click();
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
			var href = 'admin/modules/users/login/edit.php';
			var send = {};
			send.star_user = $('input[name=user_name]').val();
			send.pass = $('input[name=password1]').val();
			$("#cerror").remove();
			$("h3").hide();
			form_d.prepend(load_css);
			cerror = $('#cerror');
			$.post (href, send, function (data) {
					if (data != 1 && data != 2 ) {
						cerror.css({'color' : 'red', 'background' : 'none', 'padding' : '10px 0'}).text(data);
					} else {
						window.location.href='/admin/';
					}
			});
			empty(send);
		}
	});	

	
});


