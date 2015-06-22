<?php
/**
 * The template for displaying articles in the loop with full content
 *
 * @package Merlin
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header class="entry-header">
			
			<?php merlin_thumbnail_index(); ?>

			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			
			<div class="entry-meta">
				<?php merlin_entry_meta(); ?>
			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
			<?php the_content(__('Continue reading &raquo;', 'merlin')); ?>
		</div><!-- .entry-content -->
		
		<footer class="entry-footer">
			
			<div class="entry-footer-meta">
				<?php merlin_entry_footer(); ?>
			</div><!-- .entry-footer-meta -->
			
		</footer><!-- .entry-footer -->


	</article>