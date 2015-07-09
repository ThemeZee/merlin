<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Merlin
 */

?>
	<section id="secondary" class="sidebar widget-area clearfix" role="complementary">

		<?php
		if( is_active_sidebar('sidebar') ) : 
		
			dynamic_sidebar('sidebar');
		
		else : ?>

			<aside class="widget clearfix">
				<div class="widget-header"><h3 class="widget-title"><?php _e('Widget Area', 'merlin'); ?></h3></div>
				<div class="textwidget">
					<p><?php esc_html_e( 'Please go to Appearance &#8594; Widgets to set up your widgets in the sidebar.', 'merlin' ); ?></p>
				</div>
			</aside>
	
	<?php 
			// Set Widget Args
			$widget_args = array( 'before_title' => '<div class="widget-header"><h3 class="widget-title">', 'after_title' => '</h3></div>' );

			the_widget( 'WP_Widget_Recent_Posts', '', $widget_args );

			the_widget( 'WP_Widget_Archives', '', $widget_args );
						
			the_widget( 'WP_Widget_Categories', '', $widget_args );

			the_widget( 'WP_Widget_Tag_Cloud', '', $widget_args );
						
			the_widget( 'WP_Widget_Pages', '', $widget_args );
	
		endif; ?>

	</section><!-- #secondary -->