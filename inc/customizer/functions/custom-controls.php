<?php
/**
 * Theme Customizer Functions
 *
 */

/*========================== CUSTOMIZER CONTROLS FUNCTIONS ==========================*/

// Add simple heading option to the theme customizer
if ( class_exists( 'WP_Customize_Control' ) ) :

    class Merlin_Customize_Header_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<label>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			</label>
			
<?php
        }
    }
	
	class Merlin_Customize_Description_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<span class="description"><?php echo wp_kses_post( $this->label ); ?></span>
			
<?php
        }
    }
	
	class Merlin_Customize_Text_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<span class="textfield"><?php echo esc_html( $this->label ); ?></span>
			
<?php
        }
    }
	
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
	
	
endif;


?>