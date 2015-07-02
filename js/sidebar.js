/*! jQuery sidebar.js
  Adds toggle icon for mobile sidebar toggle and slide animations for sidebar
  Author: Thomas W (themezee.com)
*/

(function($) {
	
	/**--------------------------------------------------------------
	# Setup Sidebar Menu
	--------------------------------------------------------------*/
	$( document ).ready( function() {
		
		/* Show sidebar and fade content area */
		function showSidebar() {
			
			sidebar.show();
			sidebar.animate({ 'max-width' : '400px' }, 400 );
					
			content.fadeTo('400', 0.5); 
		}
		
		/* Hide sidebar and show full content area */
		function hideSidebar() {
			
			sidebar.animate({ 'max-width': '0' },  400, function(){
				sidebar.hide();
			});
					
			content.fadeTo('400', 1);
		}
		
		/* Reset sidebar on desktop screen sizes */
		function resetSidebar() {
			
			console.log("reset");
			sidebar.show();
			sidebar.css({ 'max-width' : '100%' });
					
			content.fadeTo('0', 1); 
		}
		
		/* Only do something if sidebar exists */
		if ( $( '.sidebar' ).length > 0 ) {
		
			/* Add sidebar toggle */
			$('.main-navigation-menu').after('<button id=\"sidebar-toggle\" class=\"sidebar-navigation-toggle\"></button>');
			
			/* Setup Selectors */
			var button = $('#sidebar-toggle'),
				sidebar = $('.sidebar'),
				content = $('.content-area, .post-slider-container');
			
			/* Add sidebare toggle effect */
			button.on('click', function(){
				if( sidebar.is(':visible') ) {
					hideSidebar();
				}
				else {
					showSidebar();
				}
			});
					
		}
		
		/* Rest sidebar menu on desktop screens */
		if(typeof matchMedia == 'function') {
			var mq = window.matchMedia('(max-width: 55em)');
			mq.addListener(widthChange);
			widthChange(mq);
		}
		function widthChange(mq) {
			
			if (mq.matches) {
		
				sidebar.hide();
				
				/* Hide Sidebar when Content Area is clicked */
				content.on('click', function(){
					hideSidebar();
				});

			}
			else {
				
				/* Reset Sidebar Menu */
				resetSidebar();
				content.unbind( 'click' );
				
			}
			
		}

	} );

}(jQuery));