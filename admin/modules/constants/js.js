$(document).ready(function() {
	$('input[name=email]').bind('change click keyup',{zn:'email',name:'Email'},valid);
	submit = $('.submit');
	hver_c(submit);
	//Добовление изменение	

	submit.click(function(e) {
		 var erorr = $(this).attr('err_s');
		 if (erorr == 0) {
			$("#cerror").remove();
			var send = {};
			send.name = $('input[name=name]').val();
			send.phone = $('input[name=phone]').val();
			send.phone2 = $('input[name=phone2]').val();
			send.adress = $('input[name=adress]').val();
			send.email = $('input[name=email]').val();
			send.str = $('input[name=str]').val();
			$('#edit_form').prepend(load_css);
			form = $('#cerror');
			//Отправка
			link = '/admin/modules/constants/index.php';
			$.post (link, send,function (data) {
				form.remove();
				if (data != 'error') {
					alert('Изменения успешно внесены');
				}
			});
		}
	});
});