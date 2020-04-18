$(document).ready(function() {
	submit = $('.submit_admin');
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
			send.head = $('textarea[name=head]').val();
			send.sis = $('*[name=sis]').attr('chek');
			send.incl = $('*[name=incl]').val();
			$('#edit_form').prepend(load_css);
			form = $('#cerror');
			//Отправка
			link = '/admin/modules/pages/top_admin/edit.php';
			$.post ( link, send,function (data) {
				switc(data);
			});
		}
	});
});