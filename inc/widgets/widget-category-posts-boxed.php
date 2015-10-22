<?php
/***
 * Category Posts Boxed Widget
 *
 * Display the latest posts from a selected category in a boxed layout. 
 * Intented to be used in the Magazine Homepage widget area to built a magazine layouted page.
 *
 * @package Merlin
 */

class Merlin_Category_Posts_Boxed_Widget extends WP_Widget {

	/**
	 * Widget Constructor
	 */
	function __construct() {
		
		// Setup Widget
		$widget_ops = array(
			'classname' => 'merlin_category_posts_boxed', 
			'description' => esc_html__( 'Displays your posts from a selected category in a boxed layout. Please use this widget ONLY in the Magazine Homepage widget area.', 'merlin' )
		);
		parent::__construct('merlin_category_posts_boxed', sprintf( esc_html__( 'Category Posts: Boxed (%s)', 'merlin' ), wp_get_theme()->Name ), $widget_ops);
		
		// Delete Widget Cache on certain actions
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		
	}
	
	
	/**
	 * Set default settings of the widget
	 */
	private function default_settings() {
	
		$defaults = array(
			'title'				=> '',
			'category'			=> 0,
			'layout'			=> 'horizontal',
			'category_link'		=> false,
			'postmeta'			=> true
		);
		
		return $defaults;
		
	}

	
	/**
	 * Main Function to display the widget
	 * 
	 * @uses this->render()
	 * 
	 * @param array $args / Parameters from widget area created with register_sidebar()
	 * @param array $instance / Settings for this widget instance
	 */
	function widget($args, $instance) {

		$cache = array();
				
		// Get Widget Object Cache
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_merlin_category_posts_boxed', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		// Display Widget from Cache if exists
		if ( isset( $cache[ $this->id ] ) ) {
			echo $cache[ $this->id ];
			return;
		}
		
		// Start Output Buffering
		ob_start();
			
		// Extract Sidebar Arguments
		extract($args);
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Output
		echo $before_widget;
	?>
		<div class="widget-category-posts-boxed widget-category-posts clearfix">

			<?php // Display Title
			$this->widget_title($args, $instance); ?>
			
			<div class="widget-category-posts-content">
			
				<?php $this->render($instance); ?>
				
			</div>
			
		</div>
	<?php
		echo $after_widget;
		
		// Set Cache
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'widget_merlin_category_posts_boxed', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	
	}
	
	
	/**
	 * Renders the Widget Content
	 *
	 * Switches between horizontal and vertical layout style based on widget settings
	 * 
	 * @uses this->category_posts_horizontal() or this->category_posts_vertical()
	 * @used-by this->widget()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function render($instance) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) ); 
		
		if( $layout == 'horizontal' ) : ?>
		
			<div class="category-posts-boxed-horizontal clearfix">
			
				<?php $this->category_posts_horizontal($instance); ?>

			</div>
		
		<?php else: ?>
			
			<div class="category-posts-boxed-vertical clearfix">
			
				<?php $this->category_posts_vertical($instance); ?>

			</div>
		
		<?php 
		endif;

	}
	
	
	/**
	 * Display Category Posts in Horizontal Layout
	 *
	 * @used-by this->render()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function category_posts_horizontal($instance) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => 4,
			'ignore_sticky_posts' => true,
			'cat' => (int)$category
		);
		$posts_query = new WP_Query($query_arguments);
		$i = 0;

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter('excerpt_length', 'merlin_category_posts_excerpt_length');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				if(isset($i) and $i == 0) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('large-post clearfix'); ?>>

						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-large'); ?></a>
						
						<div class="post-content">

							<header class="entry-header">
			
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							
								<div class="entry-meta">
									<?php $this->entry_meta($instance); ?>
								</div><!-- .entry-meta -->
						
							</header><!-- .entry-header -->
							
							<div class="entry-content">
								<?php the_excerpt(); ?>
								<?php merlin_more_link(); ?>
							</div><!-- .entry-content -->
							
						</div>

					</article>

				<div class="medium-posts clearfix">

				<?php else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('medium-post clearfix'); ?>>

						<?php if ( '' != get_the_post_thumbnail() ) : ?>
							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-medium'); ?></a>
						<?php endif; ?>

						<div class="medium-post-content">
							
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>						
							
							<div class="entry-meta">
								<?php $this->entry_date($instance); ?>
							</div><!-- .entry-meta -->
						
						</div>

					</article>

				<?php
				endif; $i++;
				
			endwhile; ?>
			
				</div><!-- end .medium-posts -->
				
			<?php
			// Remove excerpt filter
			remove_filter('excerpt_length', 'merlin_category_posts_excerpt_length');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	} // category_posts_horizontal()
	
	
	/**
	 * Displays Category Posts in Vertical Layout
	 *
	 * @used-by this->render()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function category_posts_vertical($instance) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => 6,
			'ignore_sticky_posts' => true,
			'cat' => (int)$category
		);
		$posts_query = new WP_Query($query_arguments);
		$i = 0;

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter('excerpt_length', 'merlin_category_posts_excerpt_length');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				if(isset($i) and $i == 0) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('large-post clearfix'); ?>>

						<header class="entry-header">
			
							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-large'); ?></a>

							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						
							<div class="entry-meta">
								<?php $this->entry_meta($instance); ?>
							</div><!-- .entry-meta -->
					
						</header><!-- .entry-header -->
						
						<div class="entry-content">
							<?php the_excerpt(); ?>
							<?php merlin_more_link(); ?>
						</div><!-- .entry-content -->

					</article>

				<div class="small-posts clearfix">

				<?php else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('small-post clearfix'); ?>>

						<?php if ( '' != get_the_post_thumbnail() ) : ?>
							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-small'); ?></a>
						<?php endif; ?>

						<div class="small-post-content">
							
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>						
							
							<div class="entry-meta">
								<?php $this->entry_date($instance); ?>
							</div><!-- .entry-meta -->
							
						</div>

					</article>

				<?php
				endif; $i++;
				
			endwhile; ?>
			
				</div><!-- end .medium-posts -->
				
			<?php
			// Remove excerpt filter
			remove_filter('excerpt_length', 'merlin_category_posts_excerpt_length');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	} // category_posts_vertical()
	
	
	/**
	 * Displays Entry Meta of Posts
	 */
	function entry_meta($instance) { 

		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		if( true == $postmeta ) :
		
			$this->entry_date( $instance ); ?>
			
			<span class="meta-author">
			<?php printf('<a href="%1$s" title="%2$s" rel="author">%3$s</a>', 
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( esc_html__( 'View all posts by %s', 'merlin' ), get_the_author() ) ),
					get_the_author()
				);
			?>
			</span>
			
		<?php endif;
	

	} // entry_meta()
	
	
	/**
	 * Displays Entry Date of Posts
	 */
	function entry_date($instance) { 

		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		if( true == $postmeta ) : ?>
		
			<span class="meta-date">
			<?php printf('<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>',
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
			?>
			</span>
		
		<?php endif;

	} // entry_date()
	
	
	/**
	 * Displays Widget Title
	 */
	function widget_title($args, $instance) {
		
		// Get Sidebar Arguments
		extract($args);
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Add Widget Title Filter
		$widget_title = apply_filters('widget_title', $title, $instance, $this->id_base);
		
		if( !empty( $widget_title ) ) :

			// Link Category Title
			if( true == $category_link and $category > 0 ) : 
			
				// Set Link URL and Title for Category
				$link_title = sprintf( esc_html__( 'View all posts from category %s', 'merlin' ), get_cat_name( $category ) );
				$link_url = esc_url( get_category_link( $category ) );
				
				// Display Widget Title with link to category archive
				echo '<div class="widget-header">';
				echo '<a class="category-archive-link" href="'. $link_url .'" title="'. $link_title . '"><h3 class="widget-title">'. $widget_title . '</h3></a>';
				echo '<a class="category-archive-link" href="'. $link_url .'" title="'. $link_title . '"><span class="category-archive-icon"></span></a>';
				echo '</div>';
			
			else:
				
				// Display default Widget Title without link
				echo $before_title . $widget_title . $after_title; 
			
			endif;
			
		endif;

	} // widget_title()
	
	
	/**
	 * Update Widget Settings
	 *
	 * @param array $new_instance / New Settings for this widget instance
	 * @param array $old_instance / Old Settings for this widget instance
	 * @return array $instance
	 */
	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['category'] = (int)$new_instance['category'];
		$instance['layout'] = esc_attr($new_instance['layout']);
		$instance['category_link'] = !empty($new_instance['category_link']);
		$instance['postmeta'] = !empty($new_instance['postmeta']);
		
		$this->delete_widget_cache();
		
		return $instance;
	}
	
	
	/**
	 * Displays Widget Settings Form in the Backend
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function form( $instance ) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );

?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'merlin' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Category:', 'merlin' ); ?></label><br/>
			<?php // Display Category Select
				$args = array(
					'show_option_all'    => esc_html__( 'All Categories', 'merlin' ),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $category,
					'name'               => $this->get_field_name('category'),
					'id'                 => $this->get_field_id('category')
				);
				wp_dropdown_categories( $args ); 
			?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('layout'); ?>"><?php esc_html_e( 'Post Layout:', 'merlin' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
				<option <?php selected( $layout, 'horizontal' ); ?> value="horizontal" ><?php esc_html_e( 'Horizontal Arrangement', 'merlin' ); ?></option>
				<option <?php selected( $layout, 'vertical' ); ?> value="vertical" ><?php esc_html_e( 'Vertical Arrangement', 'merlin' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('category_link'); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $category_link ) ; ?> id="<?php echo $this->get_field_id('category_link'); ?>" name="<?php echo $this->get_field_name('category_link'); ?>" />
				<?php esc_html_e( 'Link Widget Title to Category Archive page', 'merlin' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('postmeta'); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $postmeta ) ; ?> id="<?php echo $this->get_field_id('postmeta'); ?>" name="<?php echo $this->get_field_name('postmeta'); ?>" />
				<?php esc_html_e( 'Display post date and author', 'merlin' ); ?>
			</label>
		</p>
		
<?php
	} // form()
	
	
	/**
	 * Delete Widget Cache
	 */
	public function delete_widget_cache() {
		
		wp_cache_delete('widget_merlin_category_posts_boxed', 'widget');
		
	}
	
}

// Register Widget
add_action( 'widgets_init', 'merlin_register_category_posts_boxed_widget' );

function merlin_register_category_posts_boxed_widget() {

	register_widget('Merlin_Category_Posts_Boxed_Widget');
	
}