$(document).ready(function() {
	$("*[status]").click(function(){
        title = $(this).text();
		var res = confirm(title+" заказ");
        if(res) {
			$('#edit_form').prepend(load_css);
			var send = {};
			send.status = $(this).attr('status');
			send.ids = $.cookie('ids');
			$.post ($.cookie('links')+'edit.php',send,function (data) {
				send.id = $.cookie('ids');	
				$('#center').empty();
				$('#center').append('<div id = "edit_form"></div>');
				$('#edit_form').load($.cookie('links')+'edit.php',send,function (e) { });
				alert(data)
			});
		} 
    });
});


	 
