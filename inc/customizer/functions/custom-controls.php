<?php
/**
 * Custom Controls for the Customizer
 *
 * @package Merlin
 */


/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :


	/**
	 * Displays a bold label text. Used to create headlines for radio buttons and description sections.
	 *
	 */
	class Merlin_Customize_Header_Control extends WP_Customize_Control {

		public function render_content() {  ?>
			
			<label>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			</label>
			
			<?php
		}
	}


	/**
	 * Displays a description text in gray italic font
	 *
	 */
	class Merlin_Customize_Description_Control extends WP_Customize_Control {

		public function render_content() {  ?>
			
			<span class="description"><?php echo wp_kses_post( $this->label ); ?></span>
			
			<?php
		}
	}


	/**
	 * Displays normal text. Used in the Upgrade to Pro Version section.
	 *
	 */
	class Merlin_Customize_Text_Control extends WP_Customize_Control {

		public function render_content() {  ?>
			
			<span class="textfield"><?php echo esc_html( $this->label ); ?></span>
			
			<?php
		}
	}


	/**
	 * Displays a CTA button. Used in the Upgrade to Pro Version section.
	 *
	 */
	class Merlin_Customize_Button_Control extends WP_Customize_Control {

		public function render_content() {  ?>
			
			<p>
				<a href="http://themezee.com/themes/merlin/#PROVersion-1" target="_blank" class="button button-secondary">
					<?php echo esc_html( $this->label ); ?>
				</a>
			</p>
			
			<?php
		}
	}


	/**
	 * Creates a category dropdown control for the Customizer
	 *
	 */
	class Merlin_Customize_Category_Dropdown_Control extends WP_Customize_Control {
		
		public function render_content() {
				
			$categories = get_categories( array( 'hide_empty' => false ) );
			
			if( !empty( $categories ) ) : ?>
					
					<label>
					
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						
						<select <?php $this->link(); ?>>
							<option value="0"><?php esc_html_e( 'All Categories', 'merlin' ); ?></option>
						<?php
							foreach ( $categories as $category ) :
								
								printf(	'<option value="%s" %s>%s</option>', 
									$category->term_id, 
									selected( $this->value(), $category->term_id, false ), 
									$category->name . ' (' . $category->count . ')'
								);
								
							endforeach;
						?>
						</select>
					  
					</label>
					
				<?php
			endif;
		
		}
		
	}
	
	
endif;