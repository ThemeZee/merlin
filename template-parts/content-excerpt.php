<?php
/**
 * The template for displaying articles in the loop with post excerpts
 *
 * @package Merlin
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php merlin_post_image_archives(); ?>
		
		<header class="entry-header">

			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			
			<?php merlin_entry_meta(); ?>
		
		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
			<?php the_excerpt(); ?>
			<?php merlin_more_link(); ?>
		</div><!-- .entry-content -->
		
		<footer class="entry-footer">
			
			<?php merlin_entry_footer(); ?>
			
		</footer><!-- .entry-footer -->


	</article>