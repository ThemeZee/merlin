<?php
/**
 * The template for displaying articles in the loop with post excerpts
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
			<?php the_excerpt(); ?>
			<a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link"><?php _e('Read More', 'merlin'); ?></a>
		</div><!-- .entry-content -->
		
		<footer class="entry-footer">
			<?php merlin_entry_footer(); ?>
		</footer><!-- .entry-footer -->


	</article>