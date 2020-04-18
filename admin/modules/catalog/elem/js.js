$(document).ready(function() {
	if (CKEDITOR.instances['anons']) {
		CKEDITOR.instances['anons'].destroy(true);
		CKEDITOR.replace('anons');
	}
	// select
	$('.select').live('click', function (e) {
		$('.select_ul').remove();
		$(this).after('<ul class = "select_ul"></ul>');
		send = {};
		send.cat_id = $(this).attr('ids');
		$('.select_ul').load(location.href+'/filter.php',send,function (e) { });
		empty(send);
	});
	$('.select_ul div').live('click', function (e) {
		pole = $(this).parent().parent().find('.select');
		pole.text($(this).text());
		pole.attr('values', $(this).attr('val'));
		fil = pole.attr('filter');
		pole.removeAttr('filter').attr('names', fil);
		$('.select_ul').remove();
	});
	$('.select_ul span').live('click', function (e) {
		$('.select_ul').remove();
	});

	$('input[name=name]').live('change click keyup',{min: 3,max: 200,name:'Название'},valid);
	$('input[name=namber]').live('change click keyup',{min: 1,max: 30,zn:'num',name:'Номер'},valid);
	submit = $('.submit');
	hver_c(submit);
	//Добовление изменение
	submit.click(function(e) {
		 var erorr = $(this).attr('err_s');
		 if (erorr == 0) {
			var send = {};
			send.update = 1;
			send.table = $.cookie('table');
			names = '';
			$('*[names]').each(function() {
				td = $(this).attr('names');
				val = $(this).attr('value');
				if (val != '' || td == 'anons' ) {
					if (td == 'anons') { val = CKEDITOR.instances.anons.getData();}
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


	 
