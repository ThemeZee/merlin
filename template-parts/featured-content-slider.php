<?php
/**
 * Featured Post Slider
 *
 */

	// Get latest posts from database
	$query_arguments = array(
		'posts_per_page' => 8,
		'ignore_sticky_posts' => true
	);
	$slider_query = new WP_Query($query_arguments);

	// Check if there are posts
	if( $slider_query->have_posts() ) :
		
	// Limit the number of words in slideshow post excerpts
	add_filter('excerpt_length', 'merlin_slideshow_excerpt_length');
	
?>
	
	<div id="post-slider-container" class="post-slider-container clearfix">
	
		<div id="post-slider-wrap" class="post-slider-wrap clearfix">
		
			<div id="post-slider" class="post-slider zeeflexslider">
				
				<ul class="zeeslides">

			<?php while( $slider_query->have_posts() ) : $slider_query->the_post();

				get_template_part( 'template-parts/content', 'slider' );

			endwhile; ?>

				</ul>
				
			</div>
			
			<div class="post-slider-controls"></div>
			
		</div>
		
	</div>

<?php
		// Remove excerpt filter
		remove_filter('excerpt_length', 'merlin_slideshow_excerpt_length');

	endif;
	
	// Reset Postdata
	wp_reset_postdata();

?>