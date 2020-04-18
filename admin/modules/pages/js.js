$(document).ready(function() {
	if (CKEDITOR.instances['editor1']) {
		CKEDITOR.instances['editor1'].destroy(true);
		CKEDITOR.replace( 'editor1');
	}
			
	$('input[name=name]').live('change click keyup',{min: 3,max: 30,name:'Название'},valid);
	$('input[name=namber]').live('change click keyup',{min: 1,max: 30,zn:'num',name:'Номер'},valid);
	submit = $('.submit');
	hver_c(submit);
	//Добовление изменение
	submit.click(function(e) {

			
		var erorr = $(this).attr('err_s');
		 if (erorr == 0) {
			var send = {};
			send.update = 1;
			names = '';
			$('*[names]').each(function() {
				parent = $(this).get(0).tagName;
				td = $(this).attr('names');
				val = $(this).attr('value');
				if (parent == 'TEXTAREA') { val = CKEDITOR.instances.editor1.getData(); }
				if (val != '' || parent == 'TEXTAREA') {
					names = names+",`"+td+"`=@"+val+"@";
				}
			});
			send.names = names.substring(1)+' WHERE id='+$.cookie('ids');
			$('#edit_form').prepend('<div id = "cerro"><div id = "load">Идёт обработка...</div></div>');
			//Отправка
			$.post($.cookie('links')+'edit.php', send,function (data) {
				switc(data);	
			});
		}
	});

});


	 
