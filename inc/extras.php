<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package Merlin
 */

 
if ( ! function_exists( 'merlin_default_menu' ) ) :
/**
 * Display default site navigation if no menu was selected
 *
 */
function merlin_default_menu() {
	
	if ( ! current_user_can('edit_theme_options') ) :
		$link = '<a href="'. esc_url(home_url('/')) . '" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ) .'" rel="home">' . __('Home', 'merlin') . '</a>';
	else:
		$link = '<a href="'. admin_url( 'nav-menus.php' ) . '" title="'. __('Add a menu', 'merlin') .'">' . __('Add a menu', 'merlin') . '</a>';
	endif;
	
	// Display Link as default menu
	echo '<ul id="menu-main-navigation" class="main-navigation-menu"><li id="menu-item-836" class="menu-item">'. $link . '</li></ul>';

}
endif;