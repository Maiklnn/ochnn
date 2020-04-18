$(document).ready(function() {
	$('input[name=name]').live('change click keyup',{min: 1,max: 300,zn:'text',name:'Название'},valid);
	submit = $('.submit');
	hver_c(submit);
	//Добовление	
	submit.click(function(e) {
		 var erorr = $(this).attr('err_s');
		 if (erorr == 0) {
			$("#cerro").remove();
			var send = {};
			send.name = $('#edit_form input[name=name]').val();
			send.table = $.cookie('table');
			send.parent = $.cookie('parent');
			send.namber = $('input[name=namber]').val();
			$('#edit_form').prepend('<div id = "cerro"><div id = "load">Идёт обработка...</div></div>');
			form = $('#cerro');
			//Отправка
			$.post ('/admin/func/add/edit.php',send,function (data) {
				form.remove();
				if (data != 'error' ) {
					$.cookie('ids', data);
					send.parent = $.cookie('parent');
					send.id = data;
					send.links = $.cookie('links');
					$('#edit_form').load($.cookie('links')+'edit.php',send);
				} else {
					alert(data);
				}
			});
		}
	});
});
 