<?php get_header(); ?>

<?php // Get Theme Options from Database
	$theme_options = future_theme_options();
?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">

			<h2 id="date-title" class="archive-title">
				<span>
				<?php // Display Archive Title
				if ( is_date() ) :
					printf( __( 'Monthly Archives: %s', 'future'), get_the_date( _x( 'F Y', 'date format of monthly archives', 'future') ) );
				else :
					_e( 'Archives', 'future');
				endif;
				?>
				</span>
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