/*
	jStrap -> Joan
*/
$(function(){
	//slide Home
	var slideHome = $('#intro-fade');
	if(slideHome.size()>0){
		slideHome.cycle({ 
			fx:     'fade',
			speed:   500, 
			timeout: 5000,
			pause:   0							
		});
	}	
	//inner
	var slideMain = $('#slider-main');
	if(slideMain.size()>0){
		slideMain.cycle({ 
			fx:     'scrollHorz',
			speed:   500, 
			timeout: 5000,
			pause:   0,
			next: '#next', 
			prev: '#prev'							
		});
	}	
	//slider coleccion
	var slideMain = $('#slider-inter');
	if(slideMain.size()>0){
		slideMain.cycle({ 
			fx:     'scrollHorz',
			speed:   500, 
			timeout: 5000,
			pause:   0,
			next: '#links-col7', 
			prev: '#links-col9'
		});
	}	
	//efect load img
	var items = $('.load-img');
	if(items.size()>0){
		$.each(items, function(i,v){
			$(v).addClass('loading')
			$(v).find('img').load(function(){
				$(v).removeClass('loading');
			});
		});
	}
	//carousel
	if ( $.fn.tinycarousel ){
		$('#slider-carousel').tinycarousel({ 
			display: 1, 
			animation: true, 
			interval: true 
		}); 
		$('#carousel-promo').tinycarousel({ 
			display: 1, 
			animation: true, 
			interval: true 
		});
		$('#slider-express').tinycarousel({ 
			display: 1, 
			animation: true, 
			interval: true 
		});
	}	
	//placeholder			
	$('[placeholder]').focus(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
		  input.val('');
		  input.removeClass('placeholder');
		}
	  }).blur(function() {
		var input = $(this);
		if (input.val() == '' || input.val() == input.attr('placeholder')) {
		  input.addClass('placeholder');
		  input.val(input.attr('placeholder'));
		}
	  }).blur();
});