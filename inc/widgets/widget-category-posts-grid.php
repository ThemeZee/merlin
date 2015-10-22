<?php
/***
 * Category Posts Grid Widget
 *
 * Display the latest posts from a selected category in a grid layout. 
 * Intented to be used in the Magazine Homepage widget area to built a magazine layouted page.
 *
 * @package Merlin
 */

class Merlin_Category_Posts_Grid_Widget extends WP_Widget {
	
	/**
	 * Widget Constructor
	 */
	function __construct() {
		
		// Setup Widget
		$widget_ops = array(
			'classname' => 'merlin_category_posts_grid', 
			'description' => esc_html__( 'Displays your posts from a selected category in a grid layout. Please use this widget ONLY in the Magazine Homepage widget area.', 'merlin' )
		);
		parent::__construct('merlin_category_posts_grid', sprintf( esc_html__( 'Category Posts: Grid (%s)', 'merlin' ), wp_get_theme()->Name ), $widget_ops);
		
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
			'layout'			=> 'three-columns',
			'number'			=> 6,
			'excerpt'			=> false,
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
			$cache = wp_cache_get( 'widget_merlin_category_posts_grid', 'widget' );
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
		
		// Get Sidebar Arguments
		extract($args);
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Output
		echo $before_widget;
	?>
		<div class="widget-category-posts-grid widget-category-posts clearfix">
		
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
			wp_cache_set( 'widget_merlin_category_posts_grid', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
		
	} // widget()
	
	
	/**
	 * Renders the Widget Content
	 *
	 * Switches between two or three column layout style based on widget settings
	 * 
	 * @uses this->category_posts_two_column_grid() or this->category_posts_three_column_grid()
	 * @used-by this->widget()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function render($instance) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) ); 
		
		if( $layout == 'three-columns' ) :
		
			$this->category_posts_three_column_grid($instance);
		
		else: 
			
			$this->category_posts_two_column_grid($instance);
		
		endif;

	} // render()
	
	
	/**
	 * Displays category posts in two column grid
	 *
	 * @used-by this->render()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function category_posts_two_column_grid($instance) {

		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
	
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => (int)$number,
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
				
				// Open new Row on the Grid
				if ( $i % 2 == 0) : $row_open = true; ?>
					<div class="category-posts-grid-row large-post-row clearfix">
				<?php endif; ?>
				
						<article id="post-<?php the_ID(); ?>" <?php post_class('large-post'); ?>>
						
							<header class="entry-header">
			
								<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-large'); ?></a>

								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							
								<div class="entry-meta">
									<?php $this->entry_meta($instance); ?>
								</div><!-- .entry-meta -->
						
							</header><!-- .entry-header -->

						<?php if( $excerpt == true ) : ?>
							
							<div class="entry-content clearfix">
								<?php the_excerpt(); ?>
								<?php merlin_more_link(); ?>
							</div><!-- .entry-content -->
							
						<?php endif; ?>

						</article>
		
				<?php // Close Row on the Grid
				if ( $i % 2 == 1) : $row_open = false; ?>
					</div>
				<?php endif; 
				
				$i++;
			endwhile;
			
			// Close Row if still open
			if ( $row_open == true ) : ?>
				</div>
			<?php endif;
			
			// Remove excerpt filter
			remove_filter('excerpt_length', 'merlin_category_posts_excerpt_length');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();
		
	} // category_posts_two_column_grid()
	
	
	/**
	 * Displays category posts in three column grid
	 *
	 * @used-by this->render()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function category_posts_three_column_grid($instance) {

		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
	
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => (int)$number,
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
				
				 // Open new Row on the Grid
				 if ( $i % 3 == 0 ) : $row_open = true; ?>
					<div class="category-posts-grid-row medium-post-row clearfix">
				<?php endif; ?>
			
						<article id="post-<?php the_ID(); ?>" <?php post_class('medium-post clearfix'); ?>>
						
							<header class="entry-header">
			
								<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-medium'); ?></a>

								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							
								<div class="entry-meta">
									<?php $this->entry_date($instance); ?>
								</div><!-- .entry-meta -->
						
							</header><!-- .entry-header -->

						<?php if( $excerpt == true ) : ?>
							
							<div class="entry-content clearfix">
								<?php the_excerpt(); ?>
								<?php merlin_more_link(); ?>
							</div><!-- .entry-content -->
							
						<?php endif; ?>

						</article>
		
				<?php // Close Row on the Grid
				if ( $i % 3 == 2) : $row_open = false; ?>
					</div>
				<?php endif; 
				
				$i++;
			endwhile;
			
			// Close Row if still open
			if ( $row_open == true ) : ?>
				</div>
			<?php endif;
			
			// Remove excerpt filter
			remove_filter('excerpt_length', 'merlin_category_posts_excerpt_length');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();
		
	} // category_posts_three_column_grid()
	
	
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
		$instance['number'] = (int)$new_instance['number'];
		$instance['excerpt'] = !empty($new_instance['excerpt']);
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
			<label for="<?php echo $this->get_field_id('layout'); ?>"><?php esc_html_e( 'Grid Layout:', 'merlin' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
				<option <?php selected( $layout, 'two-columns' ); ?> value="two-columns" ><?php esc_html_e( 'Two Columns Grid', 'merlin' ); ?></option>
				<option <?php selected( $layout, 'three-columns' ); ?> value="three-columns" ><?php esc_html_e( 'Three Columns Grid', 'merlin' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of posts:', 'merlin' ); ?>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('excerpt'); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $excerpt ) ; ?> id="<?php echo $this->get_field_id('excerpt'); ?>" name="<?php echo $this->get_field_name('excerpt'); ?>" />
				<?php esc_html_e( 'Display post excerpt and read more button', 'merlin' ); ?>
			</label>
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
		
		wp_cache_delete('widget_merlin_category_posts_grid', 'widget');
		
	}
	
}

// Register Widget
add_action( 'widgets_init', 'merlin_register_category_posts_grid_widget' );

function merlin_register_category_posts_grid_widget() {

	register_widget('Merlin_Category_Posts_Grid_Widget');
	
}