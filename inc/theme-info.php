<?php
/***
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the WordPress Dashboard. 
 *
 */


// Add Theme Info page to admin menu
add_action('admin_menu', 'future_add_theme_info_page');
function future_add_theme_info_page() {
	
	add_theme_page( 
		__('Welcome to Future', 'future'), 
		__('Theme Info', 'future'), 
		'edit_theme_options', 
		'future', 
		'future_display_theme_info_page'
	);
	
}


// Display Theme Info page
function future_display_theme_info_page() { 
	
	// Get Theme Details from style.css
	$theme_data = wp_get_theme(); 
	
?>
			
	<div class="wrap theme-info-wrap">

		<h1><?php printf( __( 'Welcome to %1s %2s', 'future' ), $theme_data->Name, $theme_data->Version ); ?></h1>

		<div class="theme-description"><?php echo $theme_data->Description; ?></div>
		
		<hr>
		<div class="important-links clearfix">
			<p><strong><?php _e('Important Links:', 'future'); ?></strong>
				<a href="http://themezee.com/themes/future/" target="_blank"><?php _e('Theme Info Page', 'future'); ?></a>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php _e('Changelog', 'future'); ?></a>
				<a href="http://preview.themezee.com/future/" target="_blank"><?php _e('Theme Demo', 'future'); ?></a>
				<a href="http://themezee.com/docs/future-documentation/" target="_blank"><?php _e('Theme Documentation', 'future'); ?></a>
				<a href="http://wordpress.org/support/view/theme-reviews/future?filter=5" target="_blank"><?php _e('Rate this theme', 'future'); ?></a>
				
				<span class="social-icons">
					<a href="http://themezee.com/newsletter/" target="_blank"><span class="genericon-mail"></span></a>
					<a href="https://www.facebook.com/ThemeZee" target="_blank"><span class="genericon-facebook"></span></a>
					<a href="https://twitter.com/ThemeZee" target="_blank"><span class="genericon-twitter"></a>
				</span>
			</p>
		</div>
		<hr>
				
		<div id="getting-started">

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">
				
					<h3><?php printf( __( 'Getting Started with %s', 'future' ), $theme_data->Name ); ?></h3>
						
					<div class="section">
						<h4><?php _e( 'Theme Documentation', 'future' ); ?></h4>
						
						<p class="about"><?php _e( 'Need any help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.', 'future' ); ?></p>
						<p>
							<a href="http://themezee.com/docs/future-documentation/" target="_blank" class="button button-secondary"><?php _e('Visit Future Documentation', 'future'); ?></a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php _e( 'Theme Options', 'future' ); ?></h4>
						
						<p class="about"><?php _e( 'Future supports the awesome Theme Customizer for all theme settings. Click "Customize Theme" to open the Customizer now.', 'future' ); ?></p>
						<p>
							<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary"><?php _e('Customize Theme', 'future'); ?></a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php _e( 'Pro Version', 'future' ); ?></h4>
						
						<p class="about"><?php _e( 'Need more features? Check out the PRO version which comes with additional features and advanced customization options.', 'future' ); ?></p>
						<p>
							<a href="http://themezee.com/themes/future/#PROVersion-1" target="_blank" class="button button-secondary"><?php _e('Learn more about Future Pro', 'future'); ?></a>
						</p>
					</div>

				</div>
				
				<div class="column column-half clearfix">
					
					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
					
				</div>
				
			</div>
			
		</div>
		
		<hr>
		
		<div id="theme-author">
			
			<p><?php printf( __( 'Future is proudly brought to you by %1s. If you like this theme, %2s :) ', 'future' ), 
				'<a target="_blank" href="http://themezee.com" title="ThemeZee">ThemeZee</a>',
				'<a target="_blank" href="http://wordpress.org/support/view/theme-reviews/future?filter=5" title="Future Review">' . __( 'rate it', 'future' ) . '</a>'); ?>
			</p>
		
		</div>
	
	</div>

<?php
}


// Add CSS for Theme Info Panel
add_action('admin_enqueue_scripts', 'future_theme_info_page_css');
function future_theme_info_page_css($hook) { 

	// Load styles and scripts only on theme info page
	if ( 'appearance_page_future' != $hook ) {
		return;
	}
	
	// Embed theme info css style
	wp_enqueue_style('future-theme-info-css', get_template_directory_uri() .'/css/theme-info.css');
	
	// Register Genericons
	wp_enqueue_style('future-genericons', get_template_directory_uri() . '/css/genericons.css');

}


?>