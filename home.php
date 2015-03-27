<?php get_header(); ?>

	<div id="wrap" class="container clearfix">
	
<?php 
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();

?>
		<section id="content" class="primary" role="main">
			
		<?php
		// Display Featured Post Slideshow if activated
		if ( isset($theme_options['slider_active_blog']) and $theme_options['slider_active_blog'] == true ) :

			get_template_part( 'featured-content-slider' );

		endif; 
		
		// Display Latest Posts Title
		if ( isset( $theme_options['latest_posts_title'] ) and $theme_options['latest_posts_title'] <> '' ) : ?>
					
			<h2 id="home-title" class="archive-title">
				<span><?php echo wp_kses_post($theme_options['latest_posts_title']); ?></span>
			</h2>
	
		<?php endif; ?>
			
			<div id="post-wrapper" class="clearfix">
		 
			<?php if (have_posts()) : while (have_posts()) : the_post();
		
				get_template_part( 'content', $theme_options['post_layout'] );
		
				endwhile; ?>
			
			</div>
			
			<?php // Display Pagination	
				merlin_display_pagination();

			endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
		
	</div>
	
<?php get_footer(); ?>	