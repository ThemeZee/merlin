<?php
/**
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'merlin_customize_register_post_settings' );

function merlin_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'merlin_section_post', array(
        'title'    => __( 'Post Settings', 'merlin' ),
        'priority' => 20,
		'panel' => 'merlin_options_panel' 
		)
	);

	// Add Settings and Controls for Posts
	$wp_customize->add_setting( 'merlin_theme_options[posts_length]', array(
        'default'           => 'excerpt',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_post_length'
		)
	);
    $wp_customize->add_control( 'merlin_control_posts_length', array(
        'label'    => __( 'Post Length on archives', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[posts_length]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'index' => __( 'Show full posts', 'merlin' ),
            'excerpt' => __( 'Show post summaries (excerpt)', 'merlin' )
			)
		)
	);

}

?>