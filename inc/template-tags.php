<?php
/***
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Merlin
 */
	
/**
 * Displays the site title in the header area
 */
function merlin_site_title() { ?>

	<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<h1 class="site-title"><?php bloginfo('name'); ?></h1>
	</a>

<?php
}
add_action( 'merlin_site_title', 'merlin_site_title' );


if ( ! function_exists( 'merlin_header_image' ) ):
/**
 * Displays the custom header image below the navigation menu
 */
function merlin_header_image() {
		
	// Don't display header image on template-magazine.php
	if( is_page_template('template-magazine.php') )
		return;
		
	// Check if page is displayed and featured header image is used
	if( is_page() && has_post_thumbnail() ) :
	?>
		<div id="headimg" class="header-image featured-image-header">
			<?php the_post_thumbnail('merlin-header-image'); ?>
		</div>
<?php
	// Check if there is a custom header image
	elseif( get_header_image() ) :
	?>
		<div id="headimg" class="header-image">
			<img src="<?php echo get_header_image(); ?>" />
		</div>
<?php 
	endif;

}
	
endif;


/**
 * Displays the featured image below on archive pages
 */
function merlin_thumbnail_index() {
	
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Display Post Thumbnail if activated
	if ( isset($theme_options['post_thumbnails_index']) and $theme_options['post_thumbnails_index'] == true ) : ?>

		<a href="<?php esc_url(the_permalink()) ?>" rel="bookmark">
			<?php the_post_thumbnail('post-thumbnail'); ?>
		</a>

<?php
	endif;

}


/**
 * Displays the featured image below on single posts
 */
function merlin_thumbnail_single() {
	
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Display Post Thumbnail if activated
	if ( isset($theme_options['post_thumbnails_single']) and $theme_options['post_thumbnails_single'] == true ) :

		the_post_thumbnail('post-thumbnail');

	endif;

}


if ( ! function_exists( 'merlin_entry_meta' ) ):	
/**
 * Displays the date and author of posts
 */
function merlin_entry_meta() { ?>

	<span class="meta-date">
	<?php printf(__('Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>', 'merlin'), 
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	?>
	</span>
	
	<span class="meta-author">
	<?php printf(__('by <a href="%1$s" title="%2$s" rel="author">%3$s</a>', 'merlin'), 
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'merlin' ), get_the_author() ) ),
			get_the_author()
		);
	?>
	</span>
<?php

}
endif;


if ( ! function_exists( 'merlin_entry_tags' ) ):
/**
 * Displays the post tags on single post view
 */
function merlin_entry_tags() {
	
	$tag_list = get_the_tag_list('', '');
	if ( $tag_list ) : ?>
		<span class="meta-tags">
			<?php echo $tag_list; ?>
		</span>
<?php 
	endif;

}
endif;


if ( ! function_exists( 'merlin_entry_footer' ) ):
/**
 * Displays the category on comments on posts
 */	
function merlin_entry_footer() { ?>
	
	<span class="meta-category">
		<?php echo get_the_category_list(' / '); ?>
	</span>
	
<?php if ( comments_open() ) : ?>
		
	<span class="meta-comments">
		<?php comments_popup_link( __('Leave a comment', 'merlin'),__('One comment', 'merlin'),__('% comments', 'merlin') ); ?>
	</span>
	
<?php endif; 
	
}
endif;


if ( ! function_exists( 'merlin_entry_meta_slider' ) ):
/**
 * Displays date and author on slideshow posts
 */	
function merlin_entry_meta_slider() { ?>

	<span class="meta-date">
	<?php printf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>', 
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	?>
	</span>
	
	<span class="meta-author">
	<?php printf('<a href="%1$s" title="%2$s" rel="author">%3$s</a>', 
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'merlin' ), get_the_author() ) ),
			get_the_author()
		);
	?>
	</span>
<?php

}
endif;


if ( ! function_exists( 'merlin_pagination' ) ):
/**
 * Displays pagination on archive pages
 */	
function merlin_pagination() { 
	
	global $wp_query;

	$big = 999999999; // need an unlikely integer
	
	 $paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',				
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query->max_num_pages,
			'next_text' => '&raquo;',
			'prev_text' => '&laquo',
			'add_args' => false
		) );

	// Display the pagination if more than one page is found
	if ( $paginate_links ) : ?>
			
		<div class="post-pagination clearfix">
			<?php echo $paginate_links; ?>
		</div>
	
	<?php
	endif;
	
}
endif;


/**
 * Displays credit link on footer line
 */	
function merlin_footer_text() { ?>

	<span class="credit-link">
		<?php printf(__( 'Powered by %1$s and %2$s.', 'merlin' ), 
			sprintf( '<a href="http://wordpress.org" title="WordPress">%s</a>', __( 'WordPress', 'merlin' ) ),
			sprintf( '<a href="http://themezee.com/themes/merlin/" title="Merlin WordPress Theme">%s</a>', __( 'Merlin', 'merlin' ) )
		); ?>
	</span>

<?php
}
add_action( 'merlin_footer_text', 'merlin_footer_text' );


?>