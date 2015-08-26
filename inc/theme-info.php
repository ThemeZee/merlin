<?php
/***
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the WordPress Dashboard. 
 *
 * @package Merlin
 */


/**
 * Add Theme Info page to admin menu
 */
function merlin_theme_info_menu_link() {
	
	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
	add_theme_page( 
		sprintf( __( 'Welcome to %1s %2s', 'merlin' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ), 
		__('Theme Info', 'merlin'), 
		'edit_theme_options', 
		'merlin', 
		'merlin_theme_info_page'
	);
	
}
add_action('admin_menu', 'merlin_theme_info_menu_link');


/**
 * Display Theme Info page
 */
function merlin_theme_info_page() { 
	
	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
?>
			
	<div class="wrap theme-info-wrap">

		<h1><?php printf( __( 'Welcome to %1s %2s', 'merlin' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ); ?></h1>

		<div class="theme-description"><?php echo $theme->get( 'Description' ); ?></div>
		
		<hr>
		<div class="important-links clearfix">
			<p><strong><?php _e('Important Links:', 'merlin'); ?></strong>
				<a href="http://themezee.com/themes/merlin/" target="_blank"><?php _e('Theme Info Page', 'merlin'); ?></a>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php _e('Changelog', 'merlin'); ?></a>
				<a href="http://preview.themezee.com/merlin/" target="_blank"><?php _e('Theme Demo', 'merlin'); ?></a>
				<a href="http://themezee.com/docs/merlin-documentation/" target="_blank"><?php _e('Theme Documentation', 'merlin'); ?></a>
				<a href="http://wordpress.org/support/view/theme-reviews/merlin?filter=5" target="_blank"><?php _e('Rate this theme', 'merlin'); ?></a>
			</p>
		</div>
		<hr>
				
		<div id="getting-started">

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">
				
					<h3><?php printf( __( 'Getting Started with %s', 'merlin' ), $theme->get( 'Name' ) ); ?></h3>
						
					<div class="section">
						<h4><?php _e( 'Theme Documentation', 'merlin' ); ?></h4>
						
						<p class="about">
							<?php _e( 'You need help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.', 'merlin' ); ?>
						</p>
						<p>
							<a href="http://themezee.com/docs/merlin-documentation/" target="_blank" class="button button-secondary">
								<?php printf( __( 'View %s Documentation', 'merlin' ), $theme->get( 'Name' ) ); ?>
							</a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php _e( 'Theme Options', 'merlin' ); ?></h4>
						
						<p class="about">
							<?php printf( __( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'merlin' ), $theme->get( 'Name' ) ); ?>
						</p>
						<p>
							<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary"><?php _e('Customize Theme', 'merlin'); ?></a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php _e( 'Pro Version', 'merlin' ); ?></h4>
						
						<p class="about">
							<?php _e( 'You need more features? Purchase the Pro Version to get additional features and advanced customization options.', 'merlin' ); ?>
						</p>
						<p>
							<a href="http://themezee.com/themes/merlin/#PROVersion-1" target="_blank" class="button button-secondary">
								<?php printf( __( 'Learn more about %s Pro', 'merlin' ), $theme->get( 'Name' ) ); ?>
							</a>
						</p>
					</div>

				</div>
				
				<div class="column column-half clearfix">
					
					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.jpg" />
					
				</div>
				
			</div>
			
		</div>
		
		<hr>
		
		<div id="theme-author">
			
			<p><?php printf( __( '%1s is proudly brought to you by %2s. If you like this theme, %3s :) ', 'merlin' ), 
				$theme->get( 'Name' ),
				'<a target="_blank" href="http://themezee.com" title="ThemeZee">ThemeZee</a>',
				'<a target="_blank" href="http://wordpress.org/support/view/theme-reviews/merlin?filter=5" title="Merlin Review">' . __( 'rate it', 'merlin' ) . '</a>'); ?>
			</p>
		
		</div>
	
	</div>

<?php
}


/**
 * Enqueues CSS for Theme Info page
 */
function merlin_theme_info_page_css($hook) { 

	// Load styles and scripts only on theme info page
	if ( 'appearance_page_merlin' != $hook ) {
		return;
	}
	
	// Embed theme info css style
	wp_enqueue_style('merlin-theme-info-css', get_template_directory_uri() .'/css/theme-info.css');

}
add_action('admin_enqueue_scripts', 'merlin_theme_info_page_css');