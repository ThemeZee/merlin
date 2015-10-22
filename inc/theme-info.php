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
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'merlin' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ), 
		esc_html__( 'Theme Info', 'merlin' ), 
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

		<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'merlin' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ); ?></h1>

		<div class="theme-description"><?php echo $theme->get( 'Description' ); ?></div>
		
		<hr>
		<div class="important-links clearfix">
			<p><strong><?php esc_html_e( 'Important Links:', 'merlin' ); ?></strong>
				<a href="http://themezee.com/themes/merlin/" target="_blank"><?php esc_html_e( 'Theme Page', 'merlin' ); ?></a>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php esc_html_e( 'Changelog', 'merlin' ); ?></a>
				<a href="http://preview.themezee.com/merlin/" target="_blank"><?php esc_html_e( 'Theme Demo', 'merlin' ); ?></a>
				<a href="http://themezee.com/docs/merlin-documentation/" target="_blank"><?php esc_html_e( 'Theme Documentation', 'merlin' ); ?></a>
				<a href="http://wordpress.org/support/view/theme-reviews/merlin?filter=5" target="_blank"><?php esc_html_e( 'Rate this theme', 'merlin' ); ?></a>
			</p>
		</div>
		<hr>
				
		<div id="getting-started">

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">
				
					<h3><?php printf( esc_html__( 'Getting Started with %s', 'merlin' ), $theme->get( 'Name' ) ); ?></h3>
						
					<div class="section">
						<h4><?php esc_html_e( 'Theme Documentation', 'merlin' ); ?></h4>
						
						<p class="about">
							<?php esc_html_e( 'You need help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.', 'merlin' ); ?>
						</p>
						<p>
							<a href="http://themezee.com/docs/merlin-documentation/" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'View %s Documentation', 'merlin' ), $theme->get( 'Name' ) ); ?>
							</a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php esc_html_e( 'Theme Options', 'merlin' ); ?></h4>
						
						<p class="about">
							<?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'merlin' ), $theme->get( 'Name' ) ); ?>
						</p>
						<p>
							<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary"><?php esc_html_e( 'Customize Theme', 'merlin' ); ?></a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php esc_html_e( 'Pro Version', 'merlin' ); ?></h4>
						
						<p class="about">
							<?php esc_html_e( 'You need more features? Purchase the Pro Version to get additional features and advanced customization options.', 'merlin' ); ?>
						</p>
						<p>
							<a href="http://themezee.com/themes/merlin/#PROVersion-1" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'Learn more about %s Pro', 'merlin' ), $theme->get( 'Name' ) ); ?>
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
			
			<p><?php printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'merlin' ), 
				$theme->get( 'Name' ),
				'<a target="_blank" href="http://themezee.com" title="ThemeZee">ThemeZee</a>',
				'<a target="_blank" href="http://wordpress.org/support/view/theme-reviews/merlin?filter=5" title="Merlin Review">' . esc_html__( 'rate it', 'merlin' ) . '</a>'); ?>
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