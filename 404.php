<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Merlin
 */

get_header(); ?>

	<div id="content" class="site-content clearfix">
	
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<div class="error-404 not-found type-page">
				
					<header class="entry-header">
			
						<h1 class="page-title"><?php _e('404: That page can&rsquo;t be found.', 'merlin'); ?></h1>
						
					</header><!-- .entry-header -->
					
					<div class="entry-content clearfix">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'merlin' ); ?></p>
						
						<?php get_search_form(); ?>

						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

						<?php the_widget( 'WP_Widget_Archives', 'dropdown=1' ); ?>
						
						<?php the_widget( 'WP_Widget_Categories', 'dropdown=1' ); ?>

						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
						
						<?php the_widget( 'WP_Widget_Pages' ); ?>

					</div>
					
				</div>

			</main><!-- #main -->
		</section><!-- #primary -->
		
		<?php get_sidebar(); ?>
	
	</div>
	
<?php get_footer(); ?>