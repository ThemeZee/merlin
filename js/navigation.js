/*! jQuery navigation.js
  Add toggle icon for mobile navigation and dropdown animations for widescreen navigation
  Author: Thomas W (themezee.com)
*/
jQuery(document).ready(function($) {
						
	/** Mobile Footer Navigation */
	/* Add toggle effect */
	$('#footernav-icon').on('click', function(){
		$('#footernav-menu').slideToggle();
		$(this).toggleClass('active');
	});
	
	/** Tablet Top Navigation */
	/* Add toggle effect */
	$('#top-navigation-toggle-tablet').on('click', function(){
		$('.top-navigation').slideToggle();
		$(this).toggleClass('active');
	});
	
	/** Mobile Social Icons */
	/* Add toggle effect */
	$('.social-icons-navigation-toggle').on('click', function(){
		if($('.top-navigation').is(':visible')) {
			$('.top-navigation').slideToggle();
			$('#top-header .social-icons-menu').delay(400).slideToggle();
		} else {
			$('#top-header .social-icons-menu').slideToggle();
		}
		$(this).toggleClass('active');
	});
	
	/** Mobile Top Navigation */
	/* Add toggle effect */
	$('#top-navigation-toggle-phone').on('click', function(){
		if($('#top-header .social-icons-menu').is(':visible')) {
			$('#top-header .social-icons-menu').slideToggle();
			$('.top-navigation').delay(400).slideToggle();
		} else {
			$('.top-navigation').slideToggle();
		}
		$(this).toggleClass('active');
	});
	
	
	/** Mobile Main Navigation */
	/* Add toggle effect */
	$('.main-navigation-toggle').on('click', function(){
		$('.main-navigation-menu').slideToggle();
		$(this).toggleClass('active');
	});

	/** Widescreen Dropdown Navigation */
	/* Get Screen Size with Listener */ 
	if(typeof matchMedia == 'function') {
		var mq = window.matchMedia('(max-width: 60em)');
		mq.addListener(merlinWidthChange);
		merlinWidthChange(mq);
	}
	function merlinWidthChange(mq) {
		if (mq.matches) {
	
			/* Reset dropdown animations for top navigation */
			$('.top-navigation-menu ul').css({display: 'block'}); // Opera Fix
			$('.top-navigation-menu li ul').css({visibility: 'visible', display: 'block'});
			$('.top-navigation-menu li').unbind('mouseenter mouseleave');
			
			/* Reset dropdown animations for main navigation */
			$('.main-navigation-menu ul').css({display: 'block'}); // Opera Fix
			$('.main-navigation-menu li ul').css({visibility: 'visible', display: 'block'});
			$('.main-navigation-menu li').unbind('mouseenter mouseleave');
		
		} else {
			
			/* Add dropdown animations for top navigation */
			$('.top-navigation-menu ul').css({display: 'none'}); // Opera Fix
			$('.top-navigation-menu li').hover(function(){
				$(this).find('ul:first').css({visibility: 'visible',display: 'none'}).slideDown(300);
			},function(){
				$(this).find('ul:first').css({visibility: 'hidden'});
			});
			
			/* Add dropdown animations for main navigation */
			$('.main-navigation-menu ul').css({display: 'none'}); // Opera Fix
			$('.main-navigation-menu li').hover(function(){
				$(this).find('ul:first').css({visibility: 'visible',display: 'none'}).slideDown(300);
			},function(){
				$(this).find('ul:first').css({visibility: 'hidden'});
			});
			
		}
	}
	
});
	