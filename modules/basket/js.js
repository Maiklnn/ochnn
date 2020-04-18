	function clearInt(val,min){
		var newVal = val.replace(/[^\d]+/g, '');
		if( newVal == '' ) { return false; }else{ return newVal.substring(0,min); }
	}
$(document).ready(function() {
	// Количество товара
	$('.kolvo').bind('input', function(){
		var val = $(this).val(),
		min = 5;
		if( val == '' ) return;
		var newVal = clearInt(val,min);
		if(!newVal){
			$(this).val('');
			return;
		}
		$(this).val(newVal);
	});
	$(".kolvo").blur( function(e) {
		var send = {};
		send.kol = $(this).val();
		send.id = $(this).parent().parent().attr ('id');
		$.post ('/modules/basket/edit.php', send, function (data) {
			window.location.href = "";
		});
	});	






	$('input[name=fio]').bind('change click keyup',{zn:'text',min: 3,max: 25,name:'ФИО'},valid);
	$('input[name=phone]').bind('change click keyup ',{zn:'text',min: 6,max: 20,name:'Телефон'},valid);
	$('input[name=email]').bind('change click keyup',{zn:'email',name:'Email'},valid);
	$('input[name=address]').bind('change click keyup',{zn:'text',min: 3,max: 25,name:'Адресс'},valid);
	form_d = $("#form_send");
	submit = form_d.find("*[id=submit]");
	submit.hover(function (e) {
	$('textarea, *[type=text]').click();
		submit = $(this);
		submit.attr('err_s','0');
		li = form_d.find("*[err]");
			$(li).each(function() {
			err = $(this).attr('err');
			if (err != '') {
				submit.attr('err_s','1');
			}
		});
	});
	//Отправка
	submit.click( function(e) {
 		 var erorr = $(this).attr ('err_s');
		 if (erorr != 1) {
			var href = $(this).attr ('href')+'edit.php';
			var send = {};
			send.dei = 'zakaz';
			send.name = $('input[name=fio]').val();
			send.email = $('input[name=email]').val();
			send.phone = $('input[name=phone]').val();
			send.address = $('input[name=address]').val();
			send.prim = $('textarea[name=prim]').val();
			send.dost = $("input:radio:checked").val();
			
			form_d = $(this).parent();
			form_d.prepend(load_css);
			$.post (href, send, function (data) {
					$('#cerror').remove()
					alert(data)
					window.location.href = "/";
			});
			empty(send);
		}
	});	

	
});


