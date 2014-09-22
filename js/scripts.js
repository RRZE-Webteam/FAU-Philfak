$(document).ready(function()
{	

	$('a[href*=#]:not([href=#]):not(.accordion-toggle):not(.accordion-tabs-nav-toggle)').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top - 185
					}, 1000);
					return false;
				}
			}
		});


	$('a.lightbox').fancybox({ helpers: { title: { type: 'outside'}}});
	
	$('li > a').focus(function() {
		$(this).parents('li').addClass('focus');
	});
	
	$('li > a').blur(function() {
		$(this).parents('li').removeClass('focus');
	});

	
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
	
	
	$('.assistant-tabs-nav a').bind('click', function(event) {
		event.preventDefault();
		var pane = $(this).attr('href');
		$(this).parents('ul').find('a').removeClass('active');
		$(this).addClass('active');
		$(this).parents('.assistant-tabs').find('.assistant-tab-pane').removeClass('assistant-tab-pane-active');
		$(pane).addClass('assistant-tab-pane-active');
	});
	/*
	$('.assistant-tabs-nav a').focus(function(event) {
		event.preventDefault();
		var pane = $(this).attr('href');
		$(this).parents('ul').find('a').removeClass('active');
		$(this).addClass('active');
		$(this).parents('.assistant-tabs').find('.assistant-tab-pane').removeClass('assistant-tab-pane-active');
		$(pane).addClass('assistant-tab-pane-active');
	});
	*/
	$('.accordion-toggle').bind('click', function(event) {
		event.preventDefault();
		var accordion = $(this).attr('href');
		$(this).closest('.accordion').find('.accordion-toggle').not($(this)).removeClass('active');
		$(this).closest('.accordion').find('.accordion-body').not(accordion).slideUp();
		$(this).toggleClass('active');
		$(accordion).slideToggle();
	});
	/*
	$('.accordion-toggle').focus(function(event) {
		event.preventDefault();
		var accordion = $(this).attr('href');
		$(this).closest('.accordion').find('.accordion-toggle').not($(this)).removeClass('active');
		$(this).closest('.accordion').find('.accordion-body').not(accordion).slideUp();
		$(this).toggleClass('active');
		$(accordion).slideToggle();
	});
	*/

	$('#studienangebot *').change(function() {
		//$('#studienangebot-result').fadeTo(300, 0.3);
		$('#loading').fadeIn(300);
		$.get($(this).parents('form').attr('action'), $(this).parents('form').serialize(), function(data) {
			$('#studienangebot-result').replaceWith($(data).find('#studienangebot-result'));
			$('#loading').fadeOut(300);
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

			if ($(window).scrollTop() > 60) {
				$('body').addClass('nav-fixed');
			} else {
				$('body').removeClass('nav-fixed');
			}
		});
	}

}
);