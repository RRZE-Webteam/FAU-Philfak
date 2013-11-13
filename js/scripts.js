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
	
	$('.portal-subpages-tabs').each(function() {
		var tabMenu = '';
		var $tabs = $(this).find('.portal-subpages-item-title');
		
		tabMenu += '<ul class="portal-subpages-tab-menu">';
		$tabs.each(function()
		{
			tabMenu += '<li><a href="'+$(this).attr('href')+'">'+$(this).html()+'</a></li>';
		});
		tabMenu += '</ul>';
		
		$(this).prepend(tabMenu);
		
		$(this).find('.portal-subpages-tab-menu a').bind('click', function(event) {
			event.preventDefault();
			$(this).parents('.portal-subpages-tabs').find('.portal-subpages-item').removeClass('portal-subpages-tabs-active').hide();
			$($(this).attr('href')).addClass('portal-subpages-tabs-active').show();
			$(this).parents('ul').find('li').removeClass('active');
			$(this).parents('li').addClass('active');
		});
		
		$(this).find('.portal-subpages-tab-menu li:first-child').addClass('active');
		$(this).find('.portal-subpages-item:first').addClass('portal-subpages-item-active');
	});
	
	
	$('#nav').touchMenuHover({

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
				width: 140,
			//	height: '30%',	//	optionally resize item-height
				visible: 6
			},
			prev: {
				button: '#logos-menu-prev',
				key: 'left'
			},
			next: {
				button: '#logos-menu-next',
				key: 'next'
			}
		});
	}
	
}
);