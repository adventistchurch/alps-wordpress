// Scripts for functionality

function thirds() {
	var maxHeight = -1;

	$('.thirds').each(function() {
		maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
	});

	$('.third').each(function() {
		$(this).height(maxHeight-80);
	});

}

$(function(){

	// Main Navigation Dropdown Menus
	$('.nav').hover(function() {
		if($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(this).addClass('was-active');
		}
		$(this).addClass('hover');
	}, function() {
		$(this).removeClass('hover');
		if($(this).hasClass('was-active')) {
			$(this).removeClass('was-active');
			$(this).addClass('active');
		}
	});

	$('#mobile-menu').on('click', function(e){
		e.preventDefault();
		$('nav').toggle();
	});

	thirds();

	$('ul#side-nav li').on('click', function(e) {
		e.preventDefault();
		$('.side-nav-sub').hide();
		$(this).children('ul').toggle();
	});

});


