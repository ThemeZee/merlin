<?php
/***
 * Top Navigation
 *
 * This template displays the content in the right-hand header area based on theme options.
 *
 */
 
// Get Theme Options from Database
$theme_options = merlin_theme_options();

?>

	<div class="header-bar clearfix">
		
		<button id="top-navigation-toggle-tablet" class="top-navigation-toggle"></button>
		<button id="top-navigation-toggle-phone" class="top-navigation-toggle"></button>
		<button class="social-icons-navigation-toggle"></button>
		
		<?php // Display Social Icons in Navigation
			if ( isset($theme_options['header_icons']) and $theme_options['header_icons'] == true ) : ?>

			<div class="social-icons-navigation clearfix">
				<?php merlin_display_social_icons(); ?>
			</div>

		<?php endif;

		// Display Top Navigation Menu
		if ( has_nav_menu( 'secondary' ) ) : ?>		
		
		<nav class="top-navigation navigation clearfix" role="navigation">
			<?php // Display Top Navigation
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