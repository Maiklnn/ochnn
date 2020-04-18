$(document).ready(function () {
	$('.send').live('click',function (e) {
				e.preventDefault();
				href = '/'+$(this).attr('href')+'/';
				$('head').append('<link href="'+href+'css.css" rel="stylesheet" type="text/css">');
				if ($('#mask').attr('id')) {
					$('#modal').remove();
					$('#mask').after('<div id = "modal"></div>');
				} else {
					$('body').prepend('<div id = "mask"></div><div id = "modal"></div>');
				}
				form = $('#modal');
				var maskHeight = $(document).height();
				var maskWidth = $(window).width();
				var winHeight = $(window).height();
				$('#mask').css({'width':maskWidth,'height':maskHeight});
				$('#mask').fadeTo("slow",0.8);	
				send = {};
				send.modal = href;
				send.id = $('.tr').attr('id');
				form.load(''+href+'edit.php',send,function (e) { 
					$(form).hide();
					var winH = $(window).height();
					var winW = $(window).width();
					$(form).css('top',  winH/2-$(form).height()/2);
					$(form).css('left', winW/2-$(form).width()/2);
					$(form).fadeIn();
				});
				e.empty();
	});
});