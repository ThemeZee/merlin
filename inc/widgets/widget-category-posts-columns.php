<?php

// Add Category Posts Columns Widget
class Merlin_Category_Posts_Columns_Widget extends WP_Widget {

	function __construct() {
		
		// Setup Widget
		$widget_ops = array(
			'classname' => 'merlin_category_posts_columns', 
			'description' => __('Display latest posts from two specified categories. Please use this widget ONLY in Magazine Homepage widget area.', 'merlin')
		);
		$this->WP_Widget('merlin_category_posts_columns', __('Merlin: Category Posts Columns', 'merlin'), $widget_ops);
		
		// Delete Widget Cache on certain actions
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		
	}

	public function delete_widget_cache() {
		
		wp_cache_delete('widget_merlin_category_posts_columns', 'widget');
		
	}
	
	private function default_settings() {
	
		$defaults = array(
			'category_one'			=> 0,
			'category_two'			=> 0,
			'category_one_title'	=> '',
			'category_two_title'	=> '',
			'number'				=> 4,
			'highlight_post'		=> true,
			'category_link'		=> false
		);
		
		return $defaults;
		
	}
	
	// Display Widget
	function widget($args, $instance) {

		$cache = array();
				
		// Get Widget Object Cache
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_merlin_category_posts_columns', 'widget' );
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
		<div class="widget-category-posts-columns widget-category-posts clearfix">
			
			<div class="widget-category-posts-content clearfix">
			
				<?php echo $this->render($args, $instance); ?>
				
			</div>

		</div>
	<?php
		echo $after_widget;
		
		// Set Cache
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'widget_merlin_category_posts_columns', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	
	}
	
	// Render Widget Content
	function render($args, $instance) {
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) ); ?>
		
		<div class="category-posts-column-left category-posts-columns clearfix">
				
			<div class="category-posts-columns-content clearfix">
			
				<?php //Display Category Title
					$this->display_category_title($args, $instance, $category_one, $category_one_title); ?>
					
				<div class="category-posts-columns-post-list clearfix">
					<?php $this->display_category_posts($instance, $category_one); ?>
				</div>
				
			</div>
			
		</div>
		
		<div class="category-posts-column-right category-posts-columns clearfix">
		
			<div class="category-posts-columns-content clearfix">
			
				<?php //Display Category Title
					$this->display_category_title($args, $instance, $category_two, $category_two_title); ?>
					
				<div class="category-posts-columns-post-list clearfix">
					<?php $this->display_category_posts($instance, $category_two); ?>
				</div>
				
			</div>
			
		</div>
		
	<?php
	}
	
	// Display Category Posts
	function display_category_posts($instance, $category_id) {
	
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => (int)$number,
			'ignore_sticky_posts' => true,
			'cat' => (int)$category_id
		);
		$posts_query = new WP_Query($query_arguments);
		$i = 0;
		
		// Limit the number of words for the excerpt
		add_filter('excerpt_length', 'merlin_category_posts_small_excerpt');

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				if( $highlight_post == true and (isset($i) and $i == 0) ) : 
				
					// Limit the number of words for the excerpt
					add_filter('excerpt_length', 'merlin_category_posts_medium_excerpt');
				?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('large-post clearfix'); ?>>

						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-large'); ?></a>

						<h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

						<div class="postmeta"><?php $this->display_postmeta($instance); ?></div>

						<div class="entry">
							<?php the_excerpt(); ?>
							<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php _e('Read more', 'merlin'); ?></a>
						</div>

					</article>

				<?php 	
					// Remove excerpt filter
					remove_filter('excerpt_length', 'merlin_category_posts_medium_excerpt');
					
				else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('small-post clearfix'); ?>>

						<?php if ( '' != get_the_post_thumbnail() ) : ?>
							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('merlin-category-posts-widget-small'); ?></a>
						<?php endif; ?>
						
						<div class="small-post-content">
							
							<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>						
							<div class="postmeta-small"><?php $this->display_postmeta($instance); ?></div>
							
						</div>

					</article>

				<?php
				endif; $i++;
				
			endwhile; ?>
				
			<?php

		endif;
		
		// Remove excerpt filter
		remove_filter('excerpt_length', 'merlin_category_posts_small_excerpt');
		
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
	
	// Display Category Widget Title
	function display_category_title($args, $instance, $category_id, $category_title) {
		
		// Get Sidebar Arguments
		extract($args);
		
		// Get Widget Settings
		$defaults = $this->default_settings();
		extract( wp_parse_args( $instance, $defaults ) );
		
		// Add Widget Title Filter
		$widget_title = apply_filters('widget_title', $category_title, $instance, $this->id_base);
		
		if( !empty( $widget_title ) ) :
		
			echo $before_title;
			
			// Link Category Title
			if( $category_link == true ) : 
				
				$link_title = sprintf( __('View all posts from category %s', 'merlin'), get_cat_name( $category_id ) );
				$link_url = esc_url( get_category_link( $category_id ) );
				
				echo '<a href="'. esc_url( get_category_link( $category_id ) ) .'" title="'. $widget_title . '">'. $widget_title . '</a>';
				
			else:
			
				echo $widget_title;
			
			endif;
			
			echo $after_title; 
			
		endif;

	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['category_one_title'] = sanitize_text_field($new_instance['category_one_title']);
		$instance['category_one'] = (int)$new_instance['category_one'];
		$instance['category_two_title'] = sanitize_text_field($new_instance['category_two_title']);
		$instance['category_two'] = (int)$new_instance['category_two'];
		$instance['number'] = (int)$new_instance['number'];
		$instance['highlight_post'] = !empty($new_instance['highlight_post']);
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
			<label for="<?php echo $this->get_field_id('category_one_title'); ?>"><?php _e('Left Category Title:', 'merlin'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('category_one_title'); ?>" name="<?php echo $this->get_field_name('category_one_title'); ?>" type="text" value="<?php echo $category_one_title; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category_one'); ?>"><?php _e('Left Category:', 'merlin'); ?></label><br/>
			<?php // Display Category One Select
				$args = array(
					'show_option_all'    => __('All Categories', 'merlin'),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $category_one,
					'name'               => $this->get_field_name('category_one'),
					'id'                 => $this->get_field_id('category_one')
				);
				wp_dropdown_categories( $args ); 
			?>
		</p>
		
				<p>
			<label for="<?php echo $this->get_field_id('category_two_title'); ?>"><?php _e('Right Category Title:', 'merlin'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('category_two_title'); ?>" name="<?php echo $this->get_field_name('category_two_title'); ?>" type="text" value="<?php echo $category_two_title; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('category_two'); ?>"><?php _e('Right Category:', 'merlin'); ?></label><br/>
			<?php // Display Category One Select
				$args = array(
					'show_option_all'    => __('All Categories', 'merlin'),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $category_two,
					'name'               => $this->get_field_name('category_two'),
					'id'                 => $this->get_field_id('category_two')
				);
				wp_dropdown_categories( $args ); 
			?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'merlin'); ?>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo (int)$number; ?>" size="3" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('highlight_post'); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $highlight_post ) ; ?> id="<?php echo $this->get_field_id('highlight_post'); ?>" name="<?php echo $this->get_field_name('highlight_post'); ?>" />
				<?php _e('Highlight First Post (Big Image + Excerpt)', 'merlin'); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('category_link'); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $category_link ) ; ?> id="<?php echo $this->get_field_id('category_link'); ?>" name="<?php echo $this->get_field_name('category_link'); ?>" />
				<?php _e('Link Category Titles to Category Archive pages', 'merlin'); ?>
			</label>
		</p>
		
<?php
	}
}
register_widget('Merlin_Category_Posts_Columns_Widget');
?>