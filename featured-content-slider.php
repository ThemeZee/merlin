<?php
/**
 * Featured Post Slider
 *
 */

// Get our Featured Content posts
$slider_posts = future_get_featured_content();

// Check if there is Featured Content
if ( empty( $slider_posts ) and current_user_can( 'edit_theme_options' ) ) : ?>

	<p class="post-slider-empty-posts">
		<?php _e('There is no featured content to be displayed in the slider. To set up the slider, go to Appearance -> Customize -> Theme Options, and add a tag under Tag Name in the Featured Content section. The slideshow will then display all posts which are tagged with that keyword.', 'future'); ?>
	</p>
	
<?php
	return;
endif;

// Limit the number of words in slideshow post excerpts
add_filter('excerpt_length', 'future_slideshow_excerpt_length');

// Display Slider
?>
	<div id="post-slider-container">
	
		<div id="post-slider-wrap" class="clearfix">
		
			<div id="post-slider" class="zeeflexslider">
				
				<ul class="zeeslides">

			<?php foreach ( $slider_posts as $post ) : setup_postdata( $post ); 
			
				// Get Thumbnail URL
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'future-slider-thumbnail');
				$thumbnail = $image[0];
				
				// set Default Thumbnail
				if( '' == $thumbnail ) :
					$thumbnail = get_template_directory_uri() . '/images/default-slider-thumbnail.png';
				endif;
			?>

				<li id="slide-<?php the_ID(); ?>" class="zeeslide" data-thumb="<?php echo $thumbnail; ?>">

					<?php // Display Post Thumbnail or default thumbnail
						if( '' != get_the_post_thumbnail() ) :

							the_post_thumbnail('post-thumbnail', array('class' => 'slide-image'));

						else: ?>

							<img src="<?php echo get_template_directory_uri(); ?>/images/default-slider-image.png" class="slide-image wp-post-image" alt="default-image" />

					<?php endif; ?>
				
					<div class="slide-content clearfix">

						<h2 class="post-title"><a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_title(); ?></a></h2>
														
						<div class="entry clearfix">
							<?php the_excerpt(); ?>
						</div>
									
					</div>

				</li>

			<?php endforeach; ?>

				</ul>
				
			</div>
			
			<div class="post-slider-controls"></div>
			
		</div>
		
	</div>

<?php
// Remove excerpt filter
remove_filter('excerpt_length', 'future_slideshow_excerpt_length');

// Reset Postdata
wp_reset_postdata();

?>