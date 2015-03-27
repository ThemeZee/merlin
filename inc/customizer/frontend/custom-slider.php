<?php 
/***
 * Custom Javascript Options
 *
 * Passing Variables from custom Theme Options to the javascript files
 * of theme navigation and frontpage slider. 
 *
 */

// Passing Variables to Featured Post Slider Slider ( js/slider.js)
add_action('wp_enqueue_scripts', 'merlin_custom_slider_params');

if ( ! function_exists( 'merlin_custom_slider_params' ) ):

function merlin_custom_slider_params() { 
	
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Set Parameters array
	$params = array();
	
	// Define Slider Animation
	if( isset($theme_options['slider_animation']) ) :
		$params['animation'] = esc_attr($theme_options['slider_animation']);
	endif;
	
	// Passing Parameters to Javascript
	wp_localize_script( 'merlin-post-slider', 'merlin_slider_params', $params );
}

endif;


?>