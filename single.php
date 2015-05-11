<?php
/**
 * The template for displaying all single posts.
 *
 * @package Merlin
 */

get_header(); ?>

	<div id="content" class="site-content container clearfix">
	
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			
			<?php while (have_posts()) : the_post();

				get_template_part( 'template-parts/content', 'single' );
				
				comments_template();

			endwhile; ?>
			
			</main><!-- #main -->
		</section><!-- #primary -->
		
		<?php get_sidebar(); ?>
	
	</div>
	
<?php get_footer(); ?>