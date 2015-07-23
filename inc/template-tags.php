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


if ( ! function_exists( 'merlin_post_image_archives' ) ):
/**
 * Displays the featured image on archive pages
 */
function merlin_post_image_archives() {
	
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Return early if no featured image should be displayed
	if ( isset($theme_options['post_layout_archives']) and $theme_options['post_layout_archives'] == 'none' ) :
		return;
	endif;
	
	// Display Featured Image beside post content
	if ( isset($theme_options['post_layout_archives']) and $theme_options['post_layout_archives'] == 'left' ) : ?>

		<a class="post-thumbnail-small" href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">
			<?php the_post_thumbnail( 'merlin-thumbnail-small' ); ?>
		</a>

<?php
	// Display Featured Image above post content
	else: ?>

		<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">
			<?php the_post_thumbnail(); ?>
		</a>

<?php
	endif;

} // merlin_post_image_archives()
endif;


if ( ! function_exists( 'merlin_post_image_single' ) ):
/**
 * Displays the featured image on single posts
 */
function merlin_post_image_single() {
	
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Display Post Thumbnail if activated
	if ( isset($theme_options['post_image_single']) and $theme_options['post_image_single'] == true ) :

		the_post_thumbnail();

	endif;

} // merlin_post_image_single()
endif;

if ( ! function_exists( 'merlin_entry_meta' ) ):	
/**
 * Displays the date and author of posts
 */
function merlin_entry_meta() {

	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Display Postmeta
	if ( true == $theme_options['meta_date'] or true == $theme_options['meta_author'] ) : ?>
	
		<div class="entry-meta">
		
		<?php // Display Date unless user has deactivated it via settings
		if ( true == $theme_options['meta_date'] ) : ?>
		
			<span class="meta-date">
			<?php printf(__('Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>', 'merlin'), 
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
			?>
			</span>
		
		<?php endif; 

		// Display Author unless user has deactivated it via settings
		if ( true == $theme_options['meta_author'] ) : ?>
		
			<span class="meta-author">
			<?php printf(__('by <a href="%1$s" title="%2$s" rel="author">%3$s</a>', 'merlin'), 
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'merlin' ), get_the_author() ) ),
					get_the_author()
				);
			?>
			</span>
		
		<?php endif; ?>
		
		</div>
		
	<?php endif;

} // merlin_entry_meta()
endif;


if ( ! function_exists( 'merlin_entry_tags' ) ):
/**
 * Displays the post tags on single post view
 */
function merlin_entry_tags() {
	
	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Get Tags
	$tag_list = get_the_tag_list('', '');
	
	// Display Tags
	if ( $tag_list && $theme_options['meta_tags'] ) : ?>
	
		<div class="entry-tags clearfix">
			<span class="meta-tags">
				<?php echo $tag_list; ?>
			</span>
		</div><!-- .entry-tags -->
<?php 
	endif;

} // merlin_entry_tags()
endif;


if ( ! function_exists( 'merlin_entry_footer' ) ):
/**
 * Displays the category on comments on posts
 */	
function merlin_entry_footer() { 

	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Display Postmeta
	if ( ( is_single() && $theme_options['footer_meta_single'] ) or ( ! is_single() && $theme_options['footer_meta_archives'] ) ) : ?>
	
		<div class="entry-footer-meta">
		
			<span class="meta-category">
				<?php echo get_the_category_list(' / '); ?>
			</span>

		<?php // Display comments
		if ( comments_open() ) : ?>
		
			<span class="meta-comments">
				<?php comments_popup_link( __('Leave a comment', 'merlin'),__('One comment', 'merlin'),__('% comments', 'merlin') ); ?>
			</span>
	
		<?php endif; ?>
		
		</div>
		
	<?php endif;
	
} // merlin_entry_footer()
endif;


if ( ! function_exists( 'merlin_entry_meta_slider' ) ):
/**
 * Displays date and author on slideshow posts
 */	
function merlin_entry_meta_slider() { 

	// Get Theme Options from Database
	$theme_options = merlin_theme_options();
	
	// Display Postmeta
	if ( true == $theme_options['meta_date'] or true == $theme_options['meta_author'] ) : ?>
	
		<div class="entry-meta">
		
		<?php // Display Date unless user has deactivated it via settings
		if ( true == $theme_options['meta_date'] ) : ?>
		
			<span class="meta-date">
				<?php printf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>', 
						esc_url( get_permalink() ),
						esc_attr( get_the_time() ),
						esc_attr( get_the_date( 'c' ) ),
						esc_html( get_the_date() )
					);
				?>
			</span>
		
		<?php endif; 

		// Display Author unless user has deactivated it via settings
		if ( true == $theme_options['meta_author'] ) : ?>
		
			<span class="meta-author">
				<?php printf('<a href="%1$s" title="%2$s" rel="author">%3$s</a>', 
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_attr( sprintf( __( 'View all posts by %s', 'merlin' ), get_the_author() ) ),
						get_the_author()
					);
				?>
			</span>
		
		<?php endif; ?>
		
		</div>
		
	<?php endif; 

} // merlin_entry_meta_slider()
endif;


if ( ! function_exists( 'merlin_more_link' ) ):
/**
 * Displays the more link on posts
 */
function merlin_more_link() { ?>

	<a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link"><?php _e('Read more', 'merlin'); ?></a>

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
	
} // merlin_pagination()
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