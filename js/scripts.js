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
	
	
	var windowWidth = window.screen.width < window.outerWidth ? window.screen.width : window.outerWidth;
	var mobile = windowWidth < 767;

	if( ! mobile )
	{
		$('.logos-menu').carouFredSel({
			responsive: true,
			width: '100%',
			scroll: 1,
			padding: 20,
			items: {
				width: 220,
			//	height: '30%',	//	optionally resize item-height
				visible: 4
			}
		});
	}
	
}
);