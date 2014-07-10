$(document).ready(function()
{	

	$('a[href*=#]:not([href=#]):not(.accordion-toggle):not(.accordion-tabs-nav-toggle)').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top - 125
					}, 1000);
					return false;
				}
			}
		});


	$('#header .has-sub').hover(function() {
		$('body').addClass('flyout-toggled');
	}, function() {
		$('body').removeClass('flyout-toggled');
	});
	
	
	/*
	$('#nav').menuAim({
		activate: activateSubmenu,
		deactivate: deactivateSubmenu,
		submenuDirection: 'below',
		rowSelector: "> li.has-sub",
	});
	
	function activateSubmenu(row) {
		$(row).find('.nav-flyout').show();
		$('body').addClass('flyout-toggled');
	}
	
	function deactivateSubmenu(row) {
		$(row).find('.nav-flyout').hide();
		$('body').removeClass('flyout-toggled');
	}*/
	
	$('.image-gallery-slider').flexslider({
		selector: 'ul > li',
		animation: 'slide',
		directionNav: false,
		controlNav: false,
		pausePlay: false,
		slideshow: false,
		sync: '.image-gallery-carousel'
	});
	
	$('.image-gallery-carousel').flexslider({
		selector: 'ul > li',
		animation: 'slide',
		directionNav: true,
		pausePlay: false,
		slideshow: false,
		asNavFor: '.image-gallery-slider',
		itemWidth: 125,
		itemMargin: 5,
	});
	
	$('#hero-slides').flexslider({
		selector: '.hero-slide',
		directionNav: true,
		pausePlay: true
	});
	
	$('#nav-toggle').bind('click', function(event) {
		event.preventDefault();
		$('#nav').toggleClass('toggled');
	});
	
	/*
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
	*/
	
	
	$('.assistant-tabs-nav a').bind('click', function(event) {
		event.preventDefault();
		var pane = $(this).attr('href');
		$(this).parents('ul').find('a').removeClass('active');
		$(this).addClass('active');
		$(this).parents('.assistant-tabs').find('.assistant-tab-pane').removeClass('assistant-tab-pane-active');
		$(pane).addClass('assistant-tab-pane-active');
	});
	
	$('.accordion-toggle').bind('click', function(event) {
		event.preventDefault();
		var accordion = $(this).attr('href');
		$(this).parents('.accordion').find('.accordion-toggle').not($(this)).removeClass('active');
		$(this).parents('.accordion').find('.accordion-body').not(accordion).slideUp();
		$(this).toggleClass('active');
		$(accordion).slideToggle();
	});
	
	$('#studienangebot *').change(function() {
		$('#studienangebot-result').fadeTo(300, 0.3);
		$.get($(this).parents('form').attr('action'), $(this).parents('form').serialize(), function(data) {
			$('#studienangebot-result').replaceWith($(data).find('#studienangebot-result'));
		});
	});
	
	
	var windowWidth = window.screen.width < window.outerWidth ? window.screen.width : window.outerWidth;
	var isMobile = windowWidth < 767;
	var isTouch = (('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0));

	if( ! isMobile )
	{
		$('.logos-menu').carouFredSel({
			responsive: true,
			width: '100%',
			height: 110,
			scroll: 1,
			padding: 20,
			items: {
				width: 140,
				height: 110,
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
			},
			auto: {
				button: '#logos-menu-playpause'
			}
		});
	}
	else
	{
		$('.logos-menu').carouFredSel({
			responsive: true,
			width: '100%',
			height: 110,
			scroll: 1,
			padding: 20,
			items: {
				width: 140,
				height: 110,
			//	height: '30%',	//	optionally resize item-height
				visible: 2
			}
		});
		
		var sidebar = $('.sidebar-inline').html();
		$('.sidebar-inline').remove();
		$('#content .container').append(sidebar);
	}
	
	
	if(isTouch)
	{
		$('#nav > li > a').click(function() {		
			if($(this).hasClass('clicked-once'))
			{
				return true;
			}
			else
			{
				$('#nav > li > a').removeClass('clicked-once');
				$(this).addClass('clicked-once');
				return false;
			}

		});
	}
	

	
	
	/* responsive tables */
	
	$("#content table").wrap('<div class="table-wrapper" />').wrap('<div class="scrollable" />');
	
	
	
	if( ! isMobile )
	{
		$(window).scroll(function () {
			if ($(window).scrollTop() > 30) {
				$('body').addClass('nav-scrolled');
			} else {
				$('body').removeClass('nav-scrolled');
			}

			if ($(window).scrollTop() > 50) {
				$('body').addClass('nav-fixed');
			} else {
				$('body').removeClass('nav-fixed');
			}
		});
	}
	
	

}
);