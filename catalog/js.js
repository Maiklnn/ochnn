$(document).ready(function() {
	$('.nav a').live('click', function (e) {
		e.preventDefault();
		page = $(this).attr('page'); if (page) { $.cookie('page', page); } else { $.cookie('page', $(this).text());  }
		send = {};
		send.page = $.cookie('page');
		send.val = $('.conteiner-prod-center').attr('inp');
		$('.conteiner-prod-center').load('/catalog/edit.php', send);
		emty(send);
	});

});

