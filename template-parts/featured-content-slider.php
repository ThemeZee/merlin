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

			<?php while( $slider_query->have_posts() ) : $slider_query->the_post(); ?>

				<li id="slide-<?php the_ID(); ?>" class="zeeslide clearfix" data-thumb="<?php echo $thumbnail; ?>">

					<?php // Display Post Thumbnail or default thumbnail
					if( '' != get_the_post_thumbnail() ) :

						the_post_thumbnail('merlin-slider-image', array('class' => 'slide-image'));

					else: ?>

						<img src="<?php echo get_template_directory_uri(); ?>/images/default-slider-image.png" class="slide-image default-slide-image wp-post-image" alt="default-image" />

					<?php endif;?>
				
					<div class="slide-content clearfix">

						<h2 class="entry-title"><a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_title(); ?></a></h2>
														
						<div class="entry clearfix">
							<?php the_excerpt(); ?>
							<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php _e('Read more', 'merlin'); ?></a>
						</div>
									
					</div>

				</li>

			<?php endwhile; ?>

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