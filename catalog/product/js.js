$(document).ready(function() {
	// tab
	$('.tabs ul li').live('click', function (e) {
		$('.tabs ul li').removeClass('active');
		$(this).addClass('active');
		send = {};
		send.id = $(this).parent().attr('ids');
		send.tab = $(this).attr('tab');
		$('.tabs_content').load('/catalog/product/edit.php', send);
		emty(send);
	});

});

