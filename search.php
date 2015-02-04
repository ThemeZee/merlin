<?php get_header(); ?>

<?php // Get Theme Options from Database
	$theme_options = future_theme_options();
?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">
		
		<?php if (have_posts()) : ?>
			<h2 id="search-title" class="archive-title">
				<?php printf( __( 'Search Results for: %s', 'future'), '<span>' . get_search_query() . '</span>' ); ?>
			</h2>
		
			<div id="post-wrapper" class="clearfix">
		 
			<?php while (have_posts()) : the_post();
		
				get_template_part( 'content', $theme_options['post_layout'] );
		
			endwhile; ?>
			
			</div>
			
			<?php // Display Pagination	
			future_display_pagination();

		else : ?>

			<h2 id="search-title" class="archive-title">
				<?php printf( __( 'Search Results for: %s', 'future'), '<span>' . get_search_query() . '</span>' ); ?>
			</h2>
			
			<div class="post">
				
				<div class="entry">
					<p><?php _e('No matches. Please try again, or use the navigation menus to find what you search for.', 'future'); ?></p>
				</div>
				
			</div>

			<?php endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	