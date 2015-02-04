<?php
/***
 * Header Content
 *
 * This template displays the content in the right-hand header area based on theme options.
 *
 */
 
 
	// Get Theme Options from Database
	$theme_options = future_theme_options();

	
	// Display Social Icons
	if ( isset($theme_options['header_icons']) and $theme_options['header_icons'] == true ) : ?>

		<div id="header-social-icons" class="social-icons-wrap clearfix">
			<?php future_display_social_icons(); ?>
		</div>

<?php
	endif;
	
	
	// Display Search Form
	if ( isset($theme_options['header_search']) and $theme_options['header_search'] == true ) : ?>

		<div id="header-search">
			<?php get_search_form(true); ?>
		</div>

<?php
	endif;

?>