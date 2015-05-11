<?php
/**
 * The template for displaying the blog index (latest posts)
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Merlin
 */
 
get_header(); 

	// Get Theme Options from Database
	$theme_options = merlin_theme_options();

	// Display Featured Post Slideshow if activated
	if ( isset($theme_options['slider_active_blog']) and $theme_options['slider_active_blog'] == true ) :

		get_template_part( 'featured-content-slider' );

	endif; 
?>

	<div id="content" class="site-content container clearfix">
	
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			
				<?php
				
				// Display Latest Posts Title
				if ( isset( $theme_options['latest_posts_title'] ) and $theme_options['latest_posts_title'] <> '' ) : ?>
							
					<header class="page-header">
						
						<h1 class="archive-title"><?php echo wp_kses_post($theme_options['latest_posts_title']); ?></h1>

					</header><!-- .page-header -->
			
				<?php endif; ?>
				
			 
				<?php if (have_posts()) : while (have_posts()) : the_post();
			
					get_template_part( 'template-parts/content', $theme_options['posts_length'] );
			
					endwhile;

					// Display Pagination	
					merlin_display_pagination();

				endif; ?>
				
			</main><!-- #main -->
		</section><!-- #primary -->
		
		<?php get_sidebar(); ?>
	
	</div>
	
<?php get_footer(); ?>