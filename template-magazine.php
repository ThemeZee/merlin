<?php
/*
Template Name: Magazine Homepage
*/
?>
<?php get_header(); ?>
	
<?php // Get Theme Options from Database
	$theme_options = future_theme_options();
	
	// Display Featured Post Slideshow if activated
	if ( isset($theme_options['slider_active_magazine']) and $theme_options['slider_active_magazine'] == true ) :

		get_template_part( 'featured-content-slider' );

	endif; 
?>
	
	<div id="wrap" class="container clearfix template-magazine">
	
		<section id="content" class="primary" role="main">
		
		<?php // Display Magazine Homepage Widgets
		if( is_active_sidebar('magazine-homepage') ) : ?>

			<div id="magazine-homepage-widgets" class="clearfix">

				<?php dynamic_sidebar('magazine-homepage'); ?>

			</div>

		<?php // Display Description about Magazine Homepage Widgets when widget area is empty
		else : 
		
			// Display only to users with permission
			if ( current_user_can( 'edit_theme_options' ) ) : ?>

				<p class="magazine-homepage-no-widgets">
					<?php _e('There are no widgets to be displayed. Please go to Appearance -> Widgets and add at least one widget to the "Magazine Homepage" widget area. You can use the three Category Posts widgets to set up the theme like the demo website.', 'future'); ?>
				</p>
				
			<?php endif;

		endif; ?>

		</section>
		
		<?php get_sidebar(); ?>
	
	</div>
	
<?php get_footer(); ?>