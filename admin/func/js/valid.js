$(document).ready(function() {
	// чекеды
	$('*[class=chekced]').live('click', function() {
			$(this).addClass('add_chekced').attr('value', 1);
	});
	$('*[class=chekced add_chekced]').live('click', function() {
	
			$(this).removeClass('add_chekced').attr('value', 0);
	});
	$('#mask, .clous').live('click', function() {
		window.location.reload();
	});
	//Модальное окно
	$('*[link]').live('click', function() {
		href = '/'+$(this).attr('link')+'/';
		$('body').prepend('<div id = "mask"></div><div id = "modal" ret = 1 ></div>');
		form = $('#modal');
		send = {};
		send.href = href;
		send.table = $.cookie('table');
		send.id = $.cookie('ids');		

			form.load(''+href+'edit.php',send,function (e) { 
					$(form).hide();
					var maskHeight = $(document).height();
					var maskWidth = $(window).width();
					$('#mask').css({'width':maskWidth,'height':maskHeight});
					$('#mask').fadeTo("slow",0.8);	
					scrTop = $(document).scrollTop();
					var winH = $(window).height();
					var winW = $(window).width();
					$(form).css('top',  winH/2-$(form).height()/2+scrTop);
					$(form).css('left', winW/2-$(form).width()/2);
					$(form).fadeIn();
				});
				e.empty();
	});
});	
add_text = 'color: green; font-weight: bold;';
err_text = 'color: red; font-weight: bold;';
load_css = '<div id = "cerror" style = "background: url(/admin/img/load.gif) no-repeat center 20px; position: relative; padding: 50px 0 20px 0; text-align: center; font-size: 12px; '+add_text+' ">Идёт обработка...</div>';
ind = '<div id = "cerror" style = "background: url(/admin/img/load.gif); float: right; width: 16px; height: 16px;"></div>';
function valid(e) {
	add_pole = 'border: 1px solid green;';
	err_pole = 'border: 1px solid red;';
	val = $(e.target).val();
	val = jQuery.trim(val);
	zn = e.data.zn;
	var valid = $(e.target).next("err");
	if (valid.attr('add') != 1) { $(e.target).after ('<err add = 1 ></err>'); } 
	var pole = $(e.target);
	var name = e.data.name;
	error = 0;
	// проверка на кол-во
	min = e.data.min;
	if (min) {
		if (val == '') {
			valid.text('Не заполнено!');
			pole.attr('err','Не заполнено поле '+name);
			error = 1;
		}
		if (val != '' && val.length < min) {
			valid.text('Менее '+min+' символов!');
			pole.attr('err','Поле '+name+' менее '+min+' символов!');
			error = 1;
		}
		if (val.length > e.data.max) {
			valid.text('Более '+e.data.max+' символов!');
			pole.attr('err','Поле '+name+' более '+e.data.max+' символов!');
			error = 1;
		}
	}
	// проверка email
	if (zn == 'email' && error != 1) {
		pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		if (!pattern.test(val)) {
			valid.text('Email указан не коректно!');
			pole.attr('err','Email указан не коректно!');
			error = 1;
		}
	}
	// проверка паролей
	if (zn == 'pass' && error != 1) {
		pass2 = $('input[name=password2]');
		li = pass2.next("err");
		if (val != pass2.val()) {
			pass2.attr('style', err_pole).attr('err','Пароли не совпадают!');
			li.attr('style', err_text).text('Пароли не совпадают!');
		} else {
			pass2.attr('style', add_pole).attr('err', '');
			li.attr('style', add_text).text('Пароли совпадают');
		}
		if (e.data.pass2 && error != 1 ) {
			pass = $('input[name=password1]');
			if (val != pass.val()) {
				valid.text('Пароли не совпадают!');
				pole.attr('err','Пароли не совпадают!');
				error = 1;
			}
		}
	}
	param = pole.attr('param');
	if (error == 1 || !param) {
		pr(error,valid,pole);
	}
	// проверка на наличие
	if ((param || param === '') && error != 1 && val != '' && param != val) {
		send.table = e.data.table;
		send.col = e.data.col;
		pole.after(ind);
		send = {};
		send.el = val;
		send.table = pole.attr('table');
		send.col = e.data.col;
		$.post ("/admin/func/protected.php", send, function (data) {
			if (data == 1) {
				valid.text('Этот '+name+' занят');
				pole.attr('err',name+' занят!');
				error = 1;
			}
			pr(error,valid,pole);
		});
		$('#cerror').remove();
	}
}
function pr(error,valid,pole) {
	if (error == 1) {
	   pole.attr('style', err_pole);
	   valid.attr('style', err_text);
    } else {
	  pole.attr('style', add_pole).removeAttr('err');
	  valid.empty();
	}
}
// наведение на кнопку
function hver_c(param1) {
	param1.hover(function (e) {
		$('label input,textarea').click();
		param1.attr('err_s','0');
		var forms = param1.closest('#edit_form');
		var li = forms.find("*[err]");
		var err = li.attr('err');
		if (err) {
			$('body').after('<div id = "spravka"></div>');
			info = $('#spravka');  
			param1.attr('err_s','1');
			$(li).each(function() {
				err = $(this).attr('err')+'<br>';
				if (err != '') {
					info.append(err);
				}
			});
			docH = $(document).scrollTop() + $(window).height();
			otH = e.pageY + info.height() + 30;
			if (docH < otH) { y = e.pageY - info.height() - 30; } else { y = e.pageY;}
			info.css('top',  y);
			info.css('left', e.pageX);
			info.fadeTo('fast',0.8); 
		}
	},function () {
		$('#spravka').detach();
		err.detach();
 	});
} 
function switc(data) {
	$("#cerro").remove();
	submit.remove();	
	if (data === 'err') {
		alert('Ошибка сервера')		
	} else {
		$('#mask, #modal').remove();
		$('body').prepend('<div id = "mask"></div><div id = "modal" ret = "1" ></div>');
		form = $('#modal');
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		var winHeight = $(window).height();
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		$('#mask').fadeTo("slow",0.8);
		send.url = $.cookie('links')+'edit.php';
		form.load('/admin/func/add/sw.php',send,function (e) { 
			modHeight = form.height();
			modWidth = form.width();
			scrollTop = $(document).scrollTop();
			left = (maskWidth - modWidth) / 2;
			top1 = (winHeight - modHeight) / 2;
			if (scrollTop >= 1) {
				top1 = top1 + scrollTop;
			}	
			$(form).css({'top':  top1, 'left': left, 'display': 'block' });
		});
		emty(send);
	}
}
