/**
 * jQuery Slider JS
 *
 * Adds the Flexslider Plugin for the Featured Post Slideshow
 *
 * @package Merlin
 */

jQuery(document).ready(function($) {

	/* Add flexslider to #post-slider div */ 
	$("#post-slider").flexslider({
		animation: merlin_slider_params.animation,
		namespace: "zeeflex-",
		selector: ".zeeslides > li",
		smoothHeight: true,
		pauseOnHover: true,
		controlsContainer: ".post-slider-controls"
	});
	
});