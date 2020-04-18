$(document).ready(function() {
	$('input[name=url]').live('change click keyup',{col:'links',name:'Url'},valid);
	submit = $('.submit_seo');
	hver_c(submit);
	//Добовление изменение	
	submit.click( function(e) {
		 var erorr = $(this).attr('err_s');
		 if (erorr == 0) {
			$("#cerror").remove();
			var send = {};
			send.update = 1;
			send.table = $.cookie('table');
			send.id = $.cookie('ids');		
			send.meta_d = $('textarea[name=meta_d]').val();
			send.meta_k = $('textarea[name=meta_k]').val();
			send.url_update = $('input[name=url]').val();
			send.url2 = $('input[name=url]').attr('param');
			send.title = $('input[name=title]').val();
			$('#edit_form').prepend(load_css);
			//Отправка
			$.post ( '/admin/modules/pages/seo/edit.php', send,function (data) {
				switc(data);
			});
		}
	});
});