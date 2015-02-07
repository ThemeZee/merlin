<?php get_header(); ?>

<?php // Get Theme Options from Database
	$theme_options = future_theme_options();
?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">

			<h2 id="tag-title" class="archive-title">
				<span><?php printf(__('Tag Archives: %s', 'future'), single_cat_title( '', false )); ?></span>
			</h2>

			<div id="post-wrapper" class="clearfix">
		 
			<?php if (have_posts()) : while (have_posts()) : the_post();
		
				get_template_part( 'content', $theme_options['post_layout'] );
		
				endwhile; ?>
			
			</div>
			
			<?php // Display Pagination	
				future_display_pagination();

			endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	