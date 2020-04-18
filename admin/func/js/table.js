$(document).ready(function () {
	// select
	$('.select').live('click', function (e) {
		$('.select_ul').remove();
		$(this).after('<ul class = "select_ul"></ul>');
		send = {};
		send.cat_id = $(this).attr('ids');
		$('.select_ul').load(location.href+'/filter.php',send,function (e) { });
		empty(send);
	});
	$('.select_ul div').live('click', function (e) {
		pole = $(this).parent().parent().find('.select');
		pole.text($(this).text());
		pole.attr('values', $(this).attr('val'));
		fil = pole.attr('filter');
		pole.removeAttr('filter').attr('names', fil);
		$('.select_ul').remove();
	});
	$('.select_ul span').live('click', function (e) {
		$('.select_ul').remove();
	});



	

	//Чекеды выделить все
	$('th').live('click', function() {
		ch = $(this).attr('td');
		if (ch) {
			$(this).attr('ch_dis', ch);
			$('*[td ='+ch+']').each(function() {
				count = $(this).parent().parent().find('span[id^=count]').text();
				if ((parseInt(count) < 1) || (count === '') || (ch != 'delete')) {
					$(this).addClass('add_chekced').attr('chek', 1);
				}
			});
		}
	});
	$('th[ch_dis]').live('click', function() {
		var ch = $(this).attr('ch_dis');
		$(this).removeAttr('ch_dis');
		$('*[td ='+ch+']').each(function() {
			$(this).removeClass('add_chekced').attr('chek', 0);
			if (ch == 'delete') { $(this).removeAttr('chek');}
		});
	});
	//Чекеды выделить снять 
	$('div[enab]').live('click', function(e) {
		var td = $(this).attr('td');
		if  (($(this).attr('class') != 'chekced')) {
			if (td === 'delete') {
				$(this).removeClass('add_chekced').removeAttr('chek');
			} else {
				$(this).removeClass('add_chekced').attr('chek', 0);
			}
		} else {
			ch = $(this).attr('td');
			var count = $(this).parent().parent().find('span[id^=count]').text();
			if ((parseInt(count) < 1) || (count === '') || (ch != 'delete')) {
				$(this).addClass('add_chekced').attr('chek', 1);
			} else {
				alert('Нельзя удалить из-за того что есть вложенные элесенты')
			}
		}
		e.empty();
	 });

	 
	// INPUT UPDATE
	$('input[td]').live('click', function (e) {
		val = $(this).attr('value');
		val = $(this).attr('chek', val);
		$(this).attr('value');
		e.empty();
	});
	$('input[td]').live('focusout', function (e) {
		val = $(this).attr('value');
		chek = $(this).attr('chek');
		if (val == chek) {
			$(this).removeAttr('chek');
		} else {
			$(this).attr('chek', val);
		}
		e.empty();
	});

		// UPDATE
	$('*[href=update]').live('click', function (e) {
		e.preventDefault();
		str = '';
		$.cookie('up_id', '')
		$('*[chek]:not(th)').each(function(){
						id = $(this).parent().parent().attr('id');
						td = $(this).attr('td');
						val = $(this).attr('chek');
						$(this).removeAttr('chek');	
						
							if ($.cookie('up_id') === id) { 		
								ids = ","+td+" = '"+val+"'";
							} else {
								$.cookie('up_id', id);
								ids = "|"+id+":"+","+td+" = '"+val+"'";
							}
							str = str+ids;
		});
		str = str.substr(1);
		str = str.replace(/:,/g, ':');
		str = str.split('|');
		send = {};
		send.arr = str;
		$.post ('/admin/func/update.php',send,function (data) {
			alert('Изменения внесены')
			$('#center').load($.cookie('links'),send);
		});
	e,empty();
	});
	
});
 
 


 
