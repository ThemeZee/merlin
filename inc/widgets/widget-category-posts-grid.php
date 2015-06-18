<?php

// Add Category Posts Grid Widget
class Merlin_Category_Posts_Grid_Widget extends WP_Widget {

	function __construct() {
		
		// Setup Widget
		$widget_ops = array(
			'classname' => 'merlin_category_posts_grid', 
			'description' => __('Display latest posts from category in a grid layout. Please use this widget ONLY in Magazine Homepage widget area.', 'merlin')
		);
		$this->WP_Widget('merlin_category_posts_grid', __('Merlin: Category Posts Grid', 'merlin'), $widget_ops);
		
		// Delete Widget Cache on certain actions
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		
	}

	public function delete_widget_cache() {
		
		wp_cache_delete('widget_merlin_category_posts_grid', 'widget');
		
	}
	
	private function default_settings() {
	
		$defaults = array(
			'title'				=> '',
			'category'			=> 0,
			'layout'			=> 'three-columns',
			'number'			=> 6,
			'category_link'		=> false
		);
		
		return $defaults;
		
	}
	
	// Display Widget
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
			$this->display_widget_title($args, $instance); ?>
			
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
		
	}
	
	// Render Widget Content
	function render($instance) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) ); 
		
		if( $layout == 'three-columns' ) :
		
			$this->display_category_posts_three_column_grid($instance);
		
		else: 
			
			$this->display_category_posts_two_column_grid($instance);
		
		endif;

	}
	
	// Display Category Posts Grid Two Column
	function display_category_posts_two_column_grid($instance) {

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
			add_filter('excerpt_length', 'merlin_category_posts_medium_excerpt');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				// Open new Row on the Grid
				if ( $i % 2 == 0) : $row_open = true; ?>
					<div class="category-posts-grid-row large-post-row clearfix">
				<?php endif; ?>
				
						<article id="post-<?php the_ID(); ?>" <?php post_class('large-post'); ?>>

							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-large'); ?></a>

							<h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

							<div class="postmeta"><?php $this->display_postmeta($instance); ?></div>

							<div class="entry">
								<?php the_excerpt(); ?>
							</div>

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
			remove_filter('excerpt_length', 'merlin_category_posts_medium_excerpt');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();
		
	}
	
	// Display Category Posts Grid Three Column
	function display_category_posts_three_column_grid($instance) {

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
			add_filter('excerpt_length', 'merlin_category_posts_medium_excerpt');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				 // Open new Row on the Grid
				 if ( $i % 3 == 0 ) : $row_open = true; ?>
					<div class="category-posts-grid-row medium-post-row clearfix">
				<?php endif; ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('medium-post clearfix'); ?>>

							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-medium'); ?></a>

							<div class="medium-post-content">
								<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								<div class="postmeta-small"><?php $this->display_postmeta($instance); ?></div>
							</div>

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
			remove_filter('excerpt_length', 'merlin_category_posts_medium_excerpt');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();
		
	}
	
	// Display Postmeta
	function display_postmeta($instance) { ?>

		<span class="meta-date">
		<?php printf('<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
		?>
		</span>

	<?php if ( comments_open() ) : ?>
		<span class="meta-comments sep">
			<?php comments_popup_link( __('Leave a comment', 'merlin'),__('One comment','merlin'),__('% comments','merlin') ); ?>
		</span>
	<?php endif;

	}
	
	// Display Widget Title
	function display_widget_title($args, $instance) {
		
		// Get Sidebar Arguments
		extract($args);
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Add Widget Title Filter
		$widget_title = apply_filters('widget_title', $title, $instance, $this->id_base);
		
		if( !empty( $widget_title ) ) :
		
			echo $before_title;
			
			// Link Category Title
			if( $category_link == true ) : 
			
				$link_title = sprintf( __('View all posts from category %s', 'merlin'), get_cat_name( $category ) );
				$link_url = esc_url( get_category_link( $category ) );
				
				echo '<a href="'. $link_url .'" title="'. $link_title . '">'. $widget_title . '</a>';
			
			else:
			
				echo $widget_title;
			
			endif;
			
			echo $after_title; 
			
		endif;

	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['category'] = (int)$new_instance['category'];
		$instance['layout'] = esc_attr($new_instance['layout']);
		$instance['number'] = (int)$new_instance['number'];
		$instance['category_link'] = !empty($new_instance['category_link']);
		
		$this->delete_widget_cache();
		
		return $instance;
	}

	function form( $instance ) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );

?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'merlin'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'merlin'); ?></label><br/>
			<?php // Display Category Select
				$args = array(
					'show_option_all'    => __('All Categories', 'merlin'),
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
			<label for="<?php echo $this->get_field_id('layout'); ?>"><?php _e('Grid Layout:', 'merlin'); ?></label><br/>
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
				<option <?php selected( $layout, 'two-columns' ); ?> value="two-columns" ><?php _e('Two Columns Grid', 'merlin'); ?></option>
				<option <?php selected( $layout, 'three-columns' ); ?> value="three-columns" ><?php _e('Three Columns Grid', 'merlin'); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'merlin'); ?>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('category_link'); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $category_link ) ; ?> id="<?php echo $this->get_field_id('category_link'); ?>" name="<?php echo $this->get_field_name('category_link'); ?>" />
				<?php _e('Link Widget Title to Category Archive page', 'merlin'); ?>
			</label>
		</p>
<?php
	}
}
register_widget('Merlin_Category_Posts_Grid_Widget');
?>