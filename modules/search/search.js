$(document).ready(function() {

// Слайдера 
	$("#slider-rang").slider({
				range: true,
				min: 0,
				max: 18,
				values: [0, 18],
				
				stop: function(event, ui) {
					$("#amount").val(ui.values[0]);
					$("#amount2").val(ui.values[1]);
				},
				slide: function(event, ui) {
					$("#amount").val(ui.values[0]);
					$("#amount2").val(ui.values[1]);
				}

	});
	$("#amount").val($("#slider-rang").slider("values", 0));
	$("#amount2").val($("#slider-rang").slider("values", 1));
	
// Слайдер цены
	$("#slider-price").slider({
				range: true,
				min: 50,
				max: 8000,
				values: [50, 8000],
				
				stop: function(event, ui) {
					$("#price").val(ui.values[0]);
					$("#price2").val(ui.values[1]);
				},
				slide: function(event, ui) {
					$("#price").val(ui.values[0]);
					$("#price2").val(ui.values[1]);
				}

	});
	$("#price").val($("#slider-price").slider("values", 0));
	$("#price2").val($("#slider-price").slider("values", 1));
	
// Поиск	
	$("div[id=submit], .nav a").click(function(e) {
	e.preventDefault();
	send = {};
	send.for1 = $("select").val();
	send.age_min = $("#amount").val();
	send.age_max = $("#amount2").val();
	send.price_min = $("#price").val();
	send.price_max = $("#price2").val();
	
	page = $(this).attr('page');
	num = $(this).attr('num');
	send.page = page;
	send.num = num;
	var cont = $('#content');
	cont.load('/modules/search/edit.php', send);
	empty(send);
	});

});










