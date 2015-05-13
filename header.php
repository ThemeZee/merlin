<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Merlin
 */
 
// Get Theme Options from Database
$theme_options = merlin_theme_options();
	
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php /* Embeds HTML5shiv to support HTML5 elements in older IE versions plus CSS Backgrounds */ ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="hfeed site">
		
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'merlin' ); ?></a>
		
		<header id="masthead" class="site-header clearfix" role="banner">
			
			<div id="header-top" class="header-bar-wrap">
				
				<?php get_template_part( 'template-parts/header-bar' ); ?>
				
			</div>
			
			<div class="header-main clearfix">
						
				<div id="logo" class="site-branding clearfix">
				
					<?php do_action('merlin_site_title'); ?>

					<?php // Display Tagline on header if activated
					if ( isset($theme_options['header_tagline']) and $theme_options['header_tagline'] == true ) : ?>			
						<h2 class="site-description"><?php echo bloginfo('description'); ?></h2>
					<?php endif; ?>
				
				</div><!-- .site-branding -->
				
				<div class="header-content clearfix">
					
					<?php #get_template_part('inc/header-content'); ?>
					
				</div>
			
			</div><!-- .header-main -->
			
			<nav id="main-navigation" class="primary-navigation navigation clearfix" role="navigation">
				<?php 
					// Display Main Navigation
					wp_nav_menu( array(
						'theme_location' => 'primary', 
						'container' => false, 
						'menu_class' => 'main-navigation-menu', 
						'echo' => true, 
						'fallback_cb' => 'merlin_default_menu')
					);
				?>
			</nav><!-- #main-navigation -->
			
			<?php // Display Custom Header Image
			merlin_display_custom_header(); ?>
		
		</header><!-- #masthead -->