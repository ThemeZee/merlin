<?php
/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 */


// Return theme options
function merlin_theme_options() {
    
	// Merge Theme Options Array from Database with Default Options Array
	$theme_options = wp_parse_args( 
		
		// Get saved theme options from WP database
		get_option( 'merlin_theme_options', array() ), 
		
		// Merge with Default Options if setting was not saved yet
		merlin_default_options() 
		
	);

	// Return theme options
	return $theme_options;
	
}


// Build default options array
function merlin_default_options() {

	$default_options = array(
		'layout' 							=> 'right-sidebar',
		'latest_posts_title'				=> __( 'Latest Posts', 'merlin' ),
		'header_tagline' 					=> false,
		'post_content' 						=> 'excerpt',
		'excerpt_length' 					=> 30,
		'meta_date'							=> true,
		'meta_author'						=> true,
		'footer_meta_archives'				=> true,
		'footer_meta_single'				=> true,
		'meta_tags'							=> true,
		'post_layout_archives'				=> 'left',
		'post_image_single' 				=> true,
		'slider_magazine' 					=> false,
		'slider_blog' 						=> false,
		'slider_category' 					=> 0,
		'slider_limit' 						=> 8,
		'slider_animation' 					=> 'slide'
	);
	
	return $default_options;
}


?>