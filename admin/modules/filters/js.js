$(document).ready(function() {
	$('input[name=name]').live('change click keyup',{min: 1,max: 300,name:'Название'},valid);
	$('input[name=namber]').live('change click keyup',{min: 1,max: 5,zn:'num',name:'Номер'},valid);
	submit = $('.submit');
	hver_c(submit);
	
	//Добовление изменение
	submit.click(function(e) {
		 var erorr = $(this).attr('err_s');
		 if (erorr == 0) {
			var send = {};
			send.update = 1;
			send.name1 = $('#edit_form input[name=name]').val();
			send.prod_name = $('#edit_form input[name=prod_name]').val();
			send.zn = $('*[name=zn]').attr('chek');
			send.namber = $('#edit_form input[name=namber]').val();
			send.enabled = $('*[name=enabled]').attr('chek');
			send.system = $('*[name=pole]').attr('values');
			$('#edit_form').prepend('<div id = "cerro"><div id = "load">Идёт обработка...</div></div>');
			//Отправка
			$.post($.cookie('links')+'edit.php', send,function (data) {
				switc(data);	
			});
			send.remove();
		}
	});

});


	 
