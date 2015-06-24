<?php
/**
 * Custom functions that are not template related
 *
 * @package Merlin
 */

 
if ( ! function_exists( 'merlin_default_menu' ) ) :
/**
 * Display default page as navigation if no custom menu was set
 *
 */
function merlin_default_menu() {
	
	echo '<ul id="menu-main-navigation" class="main-navigation-menu menu">'. wp_list_pages('title_li=&echo=0') .'</ul>';
	
}
endif;


/**
 * Adds custom theme layout class to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function merlin_theme_layout( $classes ) {
	
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
		
	// Switch Sidebar Layout to left
	if ( isset($theme_options['layout']) and $theme_options['layout'] == 'left-sidebar' ) :
		$classes[] = 'sidebar-left';
	endif;

	return $classes;
}
add_filter( 'body_class', 'merlin_theme_layout' );


/**
 * Change excerpt length for default posts
 */
function merlin_excerpt_length($length) {
	
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();

	// Return Excerpt Text
	if ( isset($theme_options['excerpt_length']) and $theme_options['excerpt_length'] >= 0 ) :
		return absint( $theme_options['excerpt_length'] );
	else :
		return 30; // number of words
	endif;
}
add_filter('excerpt_length', 'merlin_excerpt_length');


/**
 * Function to change excerpt length for large posts in category posts widgets
 */
function merlin_category_posts_large_excerpt($length) {
    return 32;
}


/**
 * Function to change excerpt length for medium posts in category posts widgets
 */
function merlin_category_posts_medium_excerpt($length) {
    return 20;
}


/**
 * Change excerpt length for small posts in category posts widgets
 */
function merlin_category_posts_small_excerpt($length) {
    return 8;
}