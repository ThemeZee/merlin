<?php
/**
 * Template Name: Full-width Page
 *
 * Description: A custom page template for displaying a fullwidth page with no sidebar.
 *
 * @package Merlin
 */

get_header(); ?>

	<div id="content" class="site-content container clearfix">
	
		<section id="primary" class="content-area content-area-full-width">
			<main id="main" class="site-main" role="main">
			
				<?php while (have_posts()) : the_post();

					get_template_part( 'template-parts/content', 'page' );
					
					comments_template();

				endwhile; ?>
			
			</main><!-- #main -->
		</section><!-- #primary -->
	
	</div>
	
<?php get_footer(); ?>