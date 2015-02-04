		
	<article id="post-<?php the_ID(); ?>" <?php post_class('one-column-post'); ?>>
		
		<?php future_display_thumbnail_index(); ?>

		<h2 class="post-title"><a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		
		<div class="postmeta clearfix"><?php future_display_postmeta(); ?></div>
		
		<div class="entry clearfix">
			<?php the_excerpt(); ?>
			<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php _e('Read More', 'future'); ?></a>
		</div>
		
		<div class="postinfo clearfix"><?php future_display_postinfo_index(); ?></div>

	</article>