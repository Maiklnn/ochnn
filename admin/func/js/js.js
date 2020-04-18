$(document).ready(function () {
	// Вывод простой формы
	$('a[href=new]').live('click', function (e) {
		e.preventDefault();
		$('#edit_form, #mask, #modal').remove();
		$('#content').before('<div id = "edit_form" ret = "1" ></div>');
		$('#content, #left').css('display', 'none');
		send = {};
		send.url = $(this).attr('url');
		history.pushState('', '', '/admin/');
		send.ne = 1;
		$('#edit_form').load(send.url,send,function (e) { });
		e.empty();
	});
	
	


	$.cookie('page_url', '') 
	$('*[href=last_go]').live('click', function (e) {
		e.preventDefault();
		// alert($.cookie('page_url'))
		$("*[cl=1]").remove();
		// формируем новую строку
		var hello = $.cookie('page_url');
		var lastPos = hello.lastIndexOf('<');
		new_str = hello.substr(0, lastPos);
		$.cookie('page_url', new_str)
		
		// формируем ссылку по которой возвращаемся
		lastPos2 = new_str.lastIndexOf('<');
		href = new_str.substr(lastPos2)
		// добавляем ссылку
		$('body').append(href);	

		
		// alert(new_str);
		// alert(href)
		// alert($.cookie('page_url'))
		$("*[cl=1]").click();
		

	});


	
	
	 //Подгрузка
	 $('*[href=return], *[href=clous]').live('click', function (e) {
		e.preventDefault();
		$('#mask, #modal').remove();
		href = $(this).attr('href');
		send = {};
		if (href === 'return') { 
			url = $(this).attr('url'); if(url) { $.cookie('links', url); }
			table = $(this).attr('table'); if(table) { $.cookie('table', table); }
			order = $(this).attr('order'); if(order) { $.cookie('order', order); }
			parent = $(this).attr('parent');	if(parent) { $.cookie('parent', parent); }
			up_url = $(this).attr('up_url'); if(up_url) { $.cookie('up_url', up_url);} else { $.cookie('up_url', 'table.php'); }
			where = $(this).attr('where'); if(where) { $.cookie('where', where); }
			page = $(this).attr('page'); if (page) { $.cookie('page', page); } else { $.cookie('page',1) }
			cl = $(this).attr('cl');
			if (cl != 1) {
				history.pushState('', '', $.cookie('links'));
				$.cookie('page_url', $.cookie('page_url')+'<a href = "return" cl=1 url ="'+$.cookie('links')+'" table = "'+$.cookie('table')+'"  categ = "'+$.cookie('cat')+'"  where = "'+$.cookie('where')+'" order = "'+$.cookie('order')+'" page = "'+$.cookie('page')+'" >');
			}
		}
		send.table = $.cookie('table');
		send.parent = $.cookie('parent');
		send.page = $.cookie('page');		
		send.up_url = $.cookie('up_url');
		send.where = $.cookie('where');
		send.order = $.cookie('order');
		$('#center').load($.cookie('links'), send);
		emty(send);
	});


	
	
	
	//Вывод формочки добаление изменение
	$('*[href=new_el], *[href=edit_el]').live('click', function (e) {
		e.preventDefault();
		$('#mask, #modal').remove();
		$.getScript($.cookie('links')+'js.js');
		send = {};
		table = $(this).attr('table'); if (table) { $.cookie('table', table); send.table = $.cookie('table'); }
		url = $(this).attr('url'); if (url) { $.cookie('links', url); } 
		href = $(this).attr('href');
		if (href === 'new_el') { 
			send.url = '/admin/func/add/edit.php';
			send.namber = $(this).attr('namber');
			parent = $(this).attr('parent'); if (parent) { $.cookie('parent', parent); } else { $.cookie('parent', '');}
		} else { 
			send.url = $.cookie('links')+'edit.php';
			if ($.cookie('update') != 2) { 	id = $(this).attr('ids'); if(id) {$.cookie('ids', id);} }
			$.cookie('update', 0);
		}
		send.id = $.cookie('ids');	
		send.parent = $.cookie('parent');
		send.table = $.cookie('table'); 		
		send.links = $.cookie('links');
		$('#center').empty();
		$('#center').append('<div id = "edit_form"></div>');
		$('#edit_form').load(send.url,send,function (e) { });
		e.empty();
	});
	
	
	
	
	
	
	
	
	
	
	
	



	 
	
 });
 
 


 
