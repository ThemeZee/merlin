<?php
/***
 * Top Navigation
 *
 * This template displays the content in the right-hand header area based on theme options.
 *
 */

?>

	<div id="header-bar" class="header-bar clearfix">
		
		<?php 
		// Check if there is a social_icons menu
		if( has_nav_menu( 'social' ) ) :?>

			<div id="header-social-icons" class="social-icons-navigation clearfix">

				<?php
				// Display Social Icons Menu
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container' => false,
					'menu_class' => 'social-icons-menu',
					'echo' => true,
					'fallback_cb' => '',
					'link_before' => '<span class="screen-reader-text">',
					'link_after' => '</span>',
					'depth' => 1
					)
				); 
				?>
			
			</div>
		
		<?php endif;
		

		// Display Top Navigation Menu
		if ( has_nav_menu( 'secondary' ) ) : ?>		
		
			<nav id="top-navigation" class="secondary-navigation navigation clearfix" role="navigation">
				
				<?php 
				// Display Top Navigation
				wp_nav_menu( array(
					'theme_location' => 'secondary', 
					'container' => false, 
					'menu_class' => 'top-navigation-menu', 
					'echo' => true, 
					'fallback_cb' => '')
				);
				?>
			</nav>
		
		<?php endif; ?>
		
	</div>