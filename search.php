<?php
/**
 * The template for displaying search results pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Merlin
 */
 
get_header(); 

// Get Theme Options from Database
$theme_options = merlin_theme_options();
?>

	<div id="content" class="site-content container clearfix">
	
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			
			<?php if (have_posts()) : ?>
				<h2 id="search-title" class="archive-title">
					<span><?php printf( __( 'Search Results for: %s', 'merlin'), get_search_query() ); ?></span>
				</h2>
			
				<div id="post-wrapper" class="clearfix">
			 
				<?php while (have_posts()) : the_post();
			
					get_template_part( 'template-parts/content', $theme_options['post_layout'] );
			
				endwhile; ?>
				
				</div>
				
				<?php // Display Pagination	
				merlin_pagination();

			else : ?>

				<h2 id="search-title" class="archive-title">
					<?php printf( __( 'Search Results for: %s', 'merlin'), '<span>' . get_search_query() . '</span>' ); ?>
				</h2>
				
				<div class="post">
					
					<div class="entry">
						<p><?php _e('No matches. Please try again, or use the navigation menus to find what you search for.', 'merlin'); ?></p>
					</div>
					
				</div>

			<?php endif; ?>
				
			</main><!-- #main -->
		</section><!-- #primary -->
		
		<?php get_sidebar(); ?>
	
	</div>
	
<?php get_footer(); ?>