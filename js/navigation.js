/*! jQuery navigation.js
  Adds toggle icon for mobile navigation and dropdown animations for widescreen navigation
  Author: Thomas W (themezee.com)
*/

(function($) {

	$.fn.responsiveNavigation = function( options ) {
	
		if (options === undefined) options = {};
		
		/* Set Defaults */
		var defaults = {
			menuClass: "menu",
			toggleClass: "menu-toggle",
			toggleText: "",
			maxWidth: "60em"
		};
		
		/* Set Variables */
		var vars = $.extend({}, defaults, options),
			menuClass = vars.menuClass,
			toggleID = (vars.toggleID) ? vars.toggleID : vars.toggleClass,
			toggleClass = vars.toggleClass,
			toggleText = vars.toggleText,
			maxWidth = vars.maxWidth,
			$this = $(this),
			$menu = $('.' + menuClass);
		
		
		/* Add Menu Toggle Button */
		$this.before('<button id=\"' + toggleID + '\" class=\"' + toggleClass + '\">' + toggleText + '</button>');
		
		/* Add dropdown slide animation for mobile devices */
		$('#' + toggleID).on('click', function(){
			$menu.slideToggle();
			$(this).toggleClass('active');
		});
		
		
		/* Add dropdown slide animation for large screens */
		if(typeof matchMedia == 'function') {
			var mq = window.matchMedia('(min-width: ' + maxWidth + ')');
			mq.addListener(widthChange);
			widthChange(mq);
		}
		/* Set slide animations based on screen size */
		function widthChange(mq) {
			if (mq.matches) {
		
				/* Add dropdown animation for desktop navigation menu */
				$menu.find('ul').css({display: 'none'}); // Opera Fix
				$menu.find('li').hover(function(){
					$(this).find('ul:first').css({visibility: 'visible',display: 'none'}).slideDown(300);
				},function(){
					$(this).find('ul:first').css({visibility: 'hidden'});
				});

			} else {
				/* Reset dropdown animation for smaller screens */
				$menu.find('ul').css({display: 'block'}); // Opera Fix
				$menu.find('li ul').css({visibility: 'visible', display: 'block'});
				$menu.find('li').unbind('mouseenter mouseleave');
				
			}
		}

	};
	
	$( document ).ready( function() {
		
		/* Main Navigation */
		$("#main-navigation").responsiveNavigation({
			menuClass: "main-navigation-menu",
			toggleClass: "main-navigation-toggle",
			maxWidth: "60em"
		});
		
		/* Top Navigation */
		$("#top-navigation").responsiveNavigation({
			menuClass: "top-navigation-menu",
			toggleID: "top-navigation-toggle-tablet",
			toggleClass: "top-navigation-toggle",
			maxWidth: "60em"
		});
		
		/** Combination of dropdown menus for Social Icons and Top Navigation */
		
		/* Add dropdown menu for social icons */
		$('#header-bar-social-icons').before('<button id=\"social-icons-navigation-toggle\" class=\"social-icons-navigation-toggle\"></button>');
		
		$('#social-icons-navigation-toggle').on('click', function(){
			if($('.top-navigation-menu').is(':visible')) {
				$('.top-navigation-menu').slideToggle();
				$('.header-bar .social-icons-menu').delay(400).slideToggle();
			} else {
				$('.header-bar .social-icons-menu').slideToggle();
			}
			$(this).toggleClass('active');
		});
		
		/* Add dropdown menu for top navigation */
		$('#top-navigation').before('<button id=\"top-navigation-toggle-phone\" class=\"top-navigation-toggle\"></button>');
		
		$('#top-navigation-toggle-phone').on('click', function(){
			if($('.header-bar .social-icons-menu').is(':visible')) {
				$('.header-bar .social-icons-menu').slideToggle();
				$('.top-navigation-menu').delay(400).slideToggle();
			} else {
				$('.top-navigation-menu').slideToggle();
			}
			$(this).toggleClass('active');
		});
		
	} );

}(jQuery));