<?php
/**
 * Register General section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'merlin_customize_register_general_settings' );

function merlin_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options
	$wp_customize->add_section( 'merlin_section_general', array(
        'title'    => __( 'General Settings', 'merlin' ),
        'priority' => 10,
		'panel' => 'merlin_options_panel' 
		)
	);
	
	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'merlin_theme_options[layout]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_layout'
		)
	);
    $wp_customize->add_control( 'merlin_control_layout', array(
        'label'    => __( 'Theme Layout', 'merlin' ),
        'section'  => 'merlin_section_general',
        'settings' => 'merlin_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'left-sidebar' => __( 'Left Sidebar', 'merlin' ),
            'right-sidebar' => __( 'Right Sidebar', 'merlin')
			)
		)
	);
	
	// Add Sticky Navigation Setting
	$wp_customize->add_setting( 'merlin_theme_options[sticky_nav_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_control_sticky_nav_headline', array(
            'label' => __( 'Sticky Navigation', 'merlin' ),
            'section' => 'merlin_section_general',
            'settings' => 'merlin_theme_options[sticky_nav_headline]',
            'priority' => 2
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[sticky_nav]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_sticky_nav', array(
        'label'    => __( 'Enable sticky menu on desktop view.', 'merlin' ),
        'section'  => 'merlin_section_general',
        'settings' => 'merlin_theme_options[sticky_nav]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);

	
}

?>