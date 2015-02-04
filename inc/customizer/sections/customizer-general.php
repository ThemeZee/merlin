<?php
/**
 * Register General section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'future_customize_register_general_settings' );

function future_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options
	$wp_customize->add_section( 'future_section_general', array(
        'title'    => __( 'General Settings', 'future' ),
        'priority' => 10,
		'panel' => 'future_options_panel' 
		)
	);
	
	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'future_theme_options[layout]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'future_sanitize_layout'
		)
	);
    $wp_customize->add_control( 'future_control_layout', array(
        'label'    => __( 'Theme Layout', 'future' ),
        'section'  => 'future_section_general',
        'settings' => 'future_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'left-sidebar' => __( 'Left Sidebar', 'future' ),
            'right-sidebar' => __( 'Right Sidebar', 'future')
			)
		)
	);
	
	// Add Title for latest posts setting
	$wp_customize->add_setting( 'future_theme_options[latest_posts_title]', array(
        'default'           => __( 'Latest Posts', 'future' ),
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_html'
		)
	);
    $wp_customize->add_control( 'future_control_latest_posts_title', array(
        'label'    => __( 'Title above Latest Posts', 'future' ),
        'section'  => 'future_section_general',
        'settings' => 'future_theme_options[latest_posts_title]',
        'type'     => 'text',
		'priority' => 2
		)
	);
	
}

?>