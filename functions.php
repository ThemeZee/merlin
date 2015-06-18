<?php
/**
 * Merlin functions and definitions
 *
 * @package Merlin
 */

/**
 * Merlin only works in WordPress 4.2 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.2', '<' ) ) :
	require get_template_directory() . '/inc/back-compat.php';
endif;


if ( ! function_exists( 'merlin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function merlin_setup() {

	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 810; /* pixels */
	}

	// Make theme available for translation. Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'merlin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	
	// Set detfault Post Thumbnail size
	set_post_thumbnail_size( 810 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Main Navigation', 'merlin' ),
		'secondary' => esc_html__( 'Top Navigation', 'merlin' ),
		'footer' => esc_html__( 'Footer Navigation', 'merlin' ),
		'social' => esc_html__( 'Social Icons', 'merlin' )
	) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'merlin_custom_background_args', array('default-color' => 'e5e5e5') ) );
	
	// Set up the WordPress core custom header feature.
	add_theme_support('custom-header', array(
		'header-text' => false,
		'width'	=> 1190,
		'height' => 250,
		'flex-height' => true
	) );
	
	// Add Theme Support for Merlin Pro Plugin
	add_theme_support( 'merlin-pro' );
	
}
endif; // merlin_setup
add_action( 'after_setup_theme', 'merlin_setup' );


/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function merlin_widgets_init() {
	
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar', 'merlin' ),
		'id' => 'sidebar',
		'description' => esc_html__( 'Appears on posts and pages except front page and fullwidth template.', 'merlin' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
	register_sidebar( array(
		'name' => esc_html__( 'Magazine Homepage', 'merlin' ),
		'id' => 'magazine-homepage',
		'description' => esc_html__( 'Appears on Magazine Homepage template only. You can use the Category Posts widgets here.', 'merlin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
}
add_action( 'widgets_init', 'merlin_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function merlin_scripts() {
	global $wp_scripts;
	
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Register and Enqueue Stylesheet
	wp_enqueue_style('merlin-stylesheet', get_stylesheet_uri());
	
	// Register Genericons
	wp_enqueue_style('merlin-genericons', get_template_directory_uri() . '/css/genericons/genericons.css');
	
	// Register and Enqueue HTML5shiv to support HTML5 elements in older IE versions
	wp_enqueue_script( 'merlin-html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), '3.7.2', false );
	$wp_scripts->add_data( 'merlin-html5shiv', 'conditional', 'lt IE 9' );

	// Register and enqueue navigation.js
	wp_enqueue_script('merlin-jquery-navigation', get_template_directory_uri() .'/js/navigation.js', array('jquery'));
		
	// Register and Enqueue FlexSlider JS and CSS if necessary
	if ( ( isset($theme_options['slider_active_blog']) and $theme_options['slider_active_blog'] == true )
		|| ( isset($theme_options['slider_active_magazine']) and $theme_options['slider_active_magazine'] == true ) ) :

		// FlexSlider CSS
		wp_enqueue_style('merlin-flexslider', get_template_directory_uri() . '/css/flexslider.css');

		// FlexSlider JS
		wp_enqueue_script('merlin-flexslider', get_template_directory_uri() .'/js/jquery.flexslider-min.js', array('jquery'));

		// Register and enqueue slider.js
		wp_enqueue_script('merlin-post-slider', get_template_directory_uri() .'/js/slider.js', array('merlin-flexslider'));

	endif;
	
	// Register and Enqueue Google Fonts
	wp_enqueue_style('merlin-default-fonts', merlin_google_fonts_url(), array(), null );

	// Register Comment Reply Script for Threaded Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'merlin_scripts' );


/**
 * Retrieve Font URL to register default Google Fonts
 */
function merlin_google_fonts_url() {
    
	// Set default Fonts
	$font_families = array('Roboto:700,400', 'Hammersmith One');

	// Build Fonts URL
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return apply_filters( 'merlin_google_fonts_url', $fonts_url );
}


/**
 * Add custom sizes for featured images
 */
function merlin_add_image_sizes() {
	
	// Add Custom Header Image Size
	add_image_size( 'merlin-header-image', 1190, 250, true);
	
	// Add Slider Image Size
	add_image_size( 'merlin-slider-image', 720, 350, true);
	
	// Add Category Post Widget image sizes
	add_image_size( 'merlin-category-posts-widget-small', 125, 75, true);
	add_image_size( 'merlin-category-posts-widget-medium', 275, 165, true);
	add_image_size( 'merlin-category-posts-widget-large', 400, 240, true);
	add_image_size( 'merlin-category-posts-widget-extra-large', 450, 270, true);
	
}
add_action( 'after_setup_theme', 'merlin_add_image_sizes' );


/**
 * Change excerpt length for default posts
 */
function merlin_excerpt_length($length) {
    return 60; // number of words
}
add_filter('excerpt_length', 'merlin_excerpt_length');


/**
 * Function to change excerpt length for post slider
 */
function merlin_slideshow_excerpt_length($length) {
    return 32;
}


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

/*==================================== INCLUDE FILES ====================================*/

// include Theme Info page
require get_template_directory() . '/inc/theme-info.php';

// include Theme Customizer Options
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// include Customization Files
require get_template_directory() . '/inc/customizer/frontend/custom-layout.php';
require get_template_directory() . '/inc/customizer/frontend/custom-slider.php';

// include Template Functions
require get_template_directory() . '/inc/template-tags.php';

// Include Extra Functions
require get_template_directory() . '/inc/extras.php';

// include Widget Files
require get_template_directory() . '/inc/widgets/widget-category-posts-boxed.php';
require get_template_directory() . '/inc/widgets/widget-category-posts-columns.php';
require get_template_directory() . '/inc/widgets/widget-category-posts-grid.php';