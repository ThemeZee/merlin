
	<section id="secondary" class="sidebar clearfix" role="complementary">

		<?php
			// Check if Sidebar has widgets
			if( is_active_sidebar('sidebar') ) : 
			
				dynamic_sidebar('sidebar');
			
			// Show hint where to add widgets
			else : ?>

			<aside class="widget">
				<h3 class="widget-title"><span><?php _e('Widget Area', 'merlin'); ?></span></h3>
				<div class="textwidget">
					<p><?php _e('There are no active widgets to be displayed. Please go to Appearance -> Widgets to setup your sidebar.', 'merlin'); ?></p>
				</div>
			</aside>
		
		<?php endif; ?>

	</section>