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
	$('#topnav-icon-tablet').on('click', function(){
		$('#topnav').slideToggle();
		$(this).toggleClass('active');
	});
	
	/** Mobile Social Icons */
	/* Add toggle effect */
	$('#social-menu-icon').on('click', function(){
		if($('#topnav').is(':visible')) {
			$('#topnav').slideToggle();
			$('#navi-social-icons #social-icons-menu').delay(400).slideToggle();
		} else {
			$('#navi-social-icons #social-icons-menu').slideToggle();
		}
		$(this).toggleClass('active');
	});
	
	/** Mobile Top Navigation */
	/* Add toggle effect */
	$('#topnav-icon-phone').on('click', function(){
		if($('#navi-social-icons #social-icons-menu').is(':visible')) {
			$('#navi-social-icons #social-icons-menu').slideToggle();
			$('#topnav').delay(400).slideToggle();
		} else {
			$('#topnav').slideToggle();
		}
		$(this).toggleClass('active');
	});
	
	
	/** Mobile Main Navigation */
	/* Add toggle effect */
	$('#mainnav-icon').on('click', function(){
		$('#mainnav-menu').slideToggle();
		$(this).toggleClass('active');
	});

	/** Widescreen Dropdown Navigation */
	/* Get Screen Size with Listener */ 
	if(typeof matchMedia == 'function') {
		var mq = window.matchMedia('(max-width: 60em)');
		mq.addListener(futureWidthChange);
		futureWidthChange(mq);
	}
	function futureWidthChange(mq) {
		if (mq.matches) {
	
			/* Reset dropdown animations for top navigation */
			$('#topnav-menu ul').css({display: 'block'}); // Opera Fix
			$('#topnav-menu li ul').css({visibility: 'visible', display: 'block'});
			$('#topnav-menu li').unbind('mouseenter mouseleave');
			
			/* Reset dropdown animations for main navigation */
			$('#mainnav-menu ul').css({display: 'block'}); // Opera Fix
			$('#mainnav-menu li ul').css({visibility: 'visible', display: 'block'});
			$('#mainnav-menu li').unbind('mouseenter mouseleave');
		
		} else {
			
			/* Add dropdown animations for top navigation */
			$('#topnav-menu ul').css({display: 'none'}); // Opera Fix
			$('#topnav-menu li').hover(function(){
				$(this).find('ul:first').css({visibility: 'visible',display: 'none'}).slideDown(300);
			},function(){
				$(this).find('ul:first').css({visibility: 'hidden'});
			});
			
			/* Add dropdown animations for main navigation */
			$('#mainnav-menu ul').css({display: 'none'}); // Opera Fix
			$('#mainnav-menu li').hover(function(){
				$(this).find('ul:first').css({visibility: 'visible',display: 'none'}).slideDown(300);
			},function(){
				$(this).find('ul:first').css({visibility: 'hidden'});
			});
			
		}
	}
	
});
	