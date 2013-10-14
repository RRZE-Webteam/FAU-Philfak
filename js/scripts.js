$(document).ready(function()
{	
	
	$('#header .has-sub').hover(function() {
		$('body').addClass('flyout-toggled');
	}, function() {
		$('body').removeClass('flyout-toggled');
	});
	
	$('#hero-slides').flexslider({
		'selector': '.hero-slide',
		directionNav: true,
		pausePlay: true
	});
	
	$('#nav-toggle').bind('click', function(event) {
		event.preventDefault();
		$('#nav').toggleClass('toggled');
	});
	
}
);