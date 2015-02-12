<?php
/***
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 */
	

// Display Site Title
add_action( 'future_site_title', 'future_display_site_title' );

function future_display_site_title() { ?>

	<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<h1 class="site-title"><?php bloginfo('name'); ?></h1>
	</a>

<?php
}


// Display Custom Header
if ( ! function_exists( 'future_display_custom_header' ) ):
	
	function future_display_custom_header() {
		
		// Don't display header image on template-magazine.php
		if( is_page_template('template-magazine.php') )
			return;
			
		// Check if page is displayed and featured header image is used
		if( is_page() && has_post_thumbnail() ) :
		?>
			<div id="custom-header" class="featured-image-header">
				<?php the_post_thumbnail('future-header-image'); ?>
			</div>
<?php
		// Check if there is a custom header image
		elseif( get_header_image() ) :
		?>
			<div id="custom-header">
				<img src="<?php echo get_header_image(); ?>" />
			</div>
<?php 
		endif;

	}
	
endif;


// Display Postmeta Data
if ( ! function_exists( 'future_display_postmeta' ) ):
	
	function future_display_postmeta() { ?>
		
		<span class="meta-date">
		<?php printf(__('Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>', 'future'), 
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
		?>
		</span>
		
		<span class="meta-author">
		<?php printf(__('by <a href="%1$s" title="%2$s" rel="author">%3$s</a>', 'future'), 
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'future' ), get_the_author() ) ),
				get_the_author()
			);
		?>
		</span>
		
<?php
	}
	
endif;


// Display Post Thumbnail on Archive Pages
function future_display_thumbnail_index() {
	
	// Get Theme Options from Database
	$theme_options = future_theme_options();
	
	// Display Post Thumbnail if activated
	if ( isset($theme_options['post_thumbnails_index']) and $theme_options['post_thumbnails_index'] == true ) : ?>

		<a href="<?php esc_url(the_permalink()) ?>" rel="bookmark">
			<?php the_post_thumbnail('post-thumbnail'); ?>
		</a>

<?php
	endif;

}


// Display Post Thumbnail on single posts
function future_display_thumbnail_single() {
	
	// Get Theme Options from Database
	$theme_options = future_theme_options();
	
	// Display Post Thumbnail if activated
	if ( isset($theme_options['post_thumbnails_single']) and $theme_options['post_thumbnails_single'] == true ) :

		the_post_thumbnail('post-thumbnail');

	endif;

}


// Display Postinfo Data
if ( ! function_exists( 'future_display_postinfo' ) ):
	
	function future_display_postinfo_index() { ?>

		<span class="meta-category">
			<?php echo get_the_category_list(', '); ?>
		</span>
			
	<?php if ( comments_open() ) : ?>
			
		<span class="meta-comments">
			<?php comments_popup_link( __('Leave a comment', 'future'),__('One comment', 'future'),__('% comments', 'future') ); ?>
		</span>
		
	<?php endif; 

	}
	
endif;

	
// Display Content Pagination
if ( ! function_exists( 'future_display_pagination' ) ):
	
	function future_display_pagination() { 
		
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


// Display Footer Text
add_action( 'future_footer_text', 'future_display_footer_text' );

function future_display_footer_text() { ?>

	<span class="credit-link">
		<?php printf(__( 'Powered by %1$s and %2$s.', 'future' ), 
			sprintf( '<a href="http://wordpress.org" title="WordPress">%s</a>', __( 'WordPress', 'future' ) ),
			sprintf( '<a href="http://themezee.com/themes/future/" title="Future WordPress Theme">%s</a>', __( 'Future', 'future' ) )
		); ?>
	</span>

<?php
}


// Display Social Icons
function future_display_social_icons() {

	// Check if there is a social_icons menu
	if( has_nav_menu( 'social' ) ) :

		// Display Social Icons Menu
		wp_nav_menu( array(
			'theme_location' => 'social',
			'container' => false,
			'menu_id' => 'social-icons-menu',
			'echo' => true,
			'fallback_cb' => '',
			'before' => '',
			'after' => '',
			'link_before' => '<span class="screen-reader-text">',
			'link_after' => '</span>',
			'depth' => 1
			)
		);

	else: // Display Hint how to configure Social Icons ?>

		<p class="social-icons-hint">
			<?php _e('Please go to WP-Admin-> Appearance-> Menus and create a new custom menu with custom links to all your social networks. Then click on "Manage Locations" tab and assign your created menu to the "Social Icons" theme location.', 'future'); ?>
		</p>
<?php
	endif;

}


?>