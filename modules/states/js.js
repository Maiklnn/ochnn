$(document).ready(function() {
	$(".nav a").live('click', function(e) {
		e.preventDefault();
		send = {};
		send.page = $(this).text();
		$('#content').load('/modules/states/index.php', send);
		emty(send);
	});	
});