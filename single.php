<?php
/**
 * The template for displaying all single posts.
 *
 * @package Merlin
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		<?php if ( function_exists( 'themezee_breadcrumbs' ) ) themezee_breadcrumbs(); ?>
			
		<?php while (have_posts()) : the_post();

			get_template_part( 'template-parts/content', 'single' );
			
			merlin_related_posts();
		
			comments_template();

		endwhile; ?>
		
		</main><!-- #main -->
	</section><!-- #primary -->
	
	<?php get_sidebar(); ?>
	
<?php get_footer(); ?>