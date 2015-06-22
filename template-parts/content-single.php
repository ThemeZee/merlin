<?php
/**
 * The template for displaying single posts
 *
 * @package Merlin
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header class="entry-header">
			
			<?php merlin_thumbnail_single(); ?>

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			
			<div class="entry-meta">
				<?php merlin_entry_meta(); ?>
			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<!-- <?php trackback_rdf(); ?> -->
			<div class="page-links"><?php wp_link_pages(); ?></div>	
		</div><!-- .entry-content -->
		
		<footer class="entry-footer">
			
			<div class="entry-tags clearfix">
				<?php merlin_entry_tags(); ?>
			</div><!-- .entry-tags -->
			
			<div class="entry-footer-meta">
				<?php merlin_entry_footer(); ?>
			</div><!-- .entry-footer-meta -->
			
		</footer><!-- .entry-footer -->

	</article>