$(document).ready(function () {
	$('*[zakaz]').live('click',function (e) {
		send = {};
		send.dei = 'add';
		send.id = $(this).attr('zakaz');
		send.count = $(this).parent().find('.kolvo').val()

		//Отправка
		$.post ('/modules/basket/edit.php', send,function (data) {
			var res = JSON.parse(data);
			$('#right .basket div').html(res.basket)
			alert('Товар успешно добавлен');
		});
	});

	$('.search_inp2').live('click',function (e) {
		send = {};
		send.input = 'search_inp2';
		val = $(this).parent().find('.inp1').val()
		send.val = $.trim(val)
		if (send.val == 'Поиск...') { 
			alert('Введите поисковый запрос') 
		} else {
			$('head').append('<link href="/catalog/css.css" rel="stylesheet" type="text/css">');
			$('#content').load('/catalog/edit.php',send,function (e) { });
		}
	});
	//Добавление в корзину
	$(".arr_plus, .arr_minus, .z_del img").live('change click keyup', function(e) {
		class_val = $(this).attr('class');
		var send = {};
		send.id = $(this).parent().parent().attr ('id');
		tr = $('*[id='+send.id+']')
		if (class_val === 'arr_plus' || class_val === 'arr_minus' || class_val === 'kolvo' ) {
			input = $(this).parent().parent().find('input');
			val = parseInt(input.val()) 
			if(class_val == 'arr_plus') { newVal = val + 1   } else { newVal = val - 1}
			if(newVal == 0) { 
				alert('Количество не может быть менее 1') 
				return;
			}
			send.kol = newVal;
			send.dei = 'arr';
		}
		if (class_val === '') { send.dei = 'delete'; }
		$.post ('/modules/basket/edit.php', send, function (data) {
				if (data == 'no') { window.location.href = "/";}
				var res = JSON.parse(data);
				$('#right .basket div').html(res.basket)
				$('*[tot_sum=1]').text(res.sum+' руб.');
				$('*[tot_col=1]').text(res.col+' шт.');

				if (send.dei === 'delete') { 
					alert('Товар успешно удалён.')
					tr.remove()
				}
				if (send.dei === 'arr') { 
					sum_z = $('*[id='+send.id+']').find('.z_price').text();
					sum_z = sum_z / val * newVal;
					$('*[id='+send.id+']').find('.z_price').text(sum_z);
				}
		});
		input.val(newVal)
	});
	
	
	
	//Левое меню
	 $('.nav-catalog ul li a').click(function (e) {
		$('#add_cat').remove();
		$.cookie('id', $(this).attr('href'));
	 });
	 if ($.cookie('id')) {	 
		send = {};
		send.id = $.cookie('id').replace(/\D+/g,"");
		$.post('/modules/left_menu/edit.php', send, function (data) {
			url = 'href='+ $.cookie('id');
			if (data) { $('a[href='+ $.cookie('id') +']').after('<ul id = "add_cat">'+data+'</ul>'); }
		});
	}

	

	
	
	
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
	// Подгрузка поиска
	$(".share-search select").change(function(e) {
		$('#search_extented').remove();
		$(this).after('<div id = "cerror"><div></div><p>Идёт обработка...</p></div><div id = "search_extented"></div>');
		send = {};
		send.slider = 1;
		$('#search_extented').load('/modules/search/edit.php', send);
		$('#cerror').remove();
		empty(send);
	});


	
});