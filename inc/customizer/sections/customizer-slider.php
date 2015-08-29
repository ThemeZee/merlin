<?php
/**
 * Slider Settings
 *
 * Register Post Slider section, settings and controls for Theme Customizer
 *
 * @package Merlin
 */


/**
 * Adds slider settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function merlin_customize_register_slider_settings( $wp_customize ) {

	// Add Sections for Slider Settings
	$wp_customize->add_section( 'merlin_section_slider', array(
        'title'    => __( 'Post Slider', 'merlin' ),
        'priority' => 60,
		'panel' => 'merlin_options_panel' 
		)
	);

	// Add settings and controls for Post Slider
	$wp_customize->add_setting( 'merlin_theme_options[slider_activate]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_control_slider_activate', array(
            'label' => __( 'Activate Post Slider', 'merlin' ),
            'section' => 'merlin_section_slider',
            'settings' => 'merlin_theme_options[slider_activate]',
            'priority' => 1
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[slider_magazine]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_slider_magazine', array(
        'label'    => __( 'Show Slider on Magazine Homepage', 'merlin' ),
        'section'  => 'merlin_section_slider',
        'settings' => 'merlin_theme_options[slider_magazine]',
        'type'     => 'checkbox',
		'priority' => 2
		)
	);
	$wp_customize->add_setting( 'merlin_theme_options[slider_blog]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_slider_blog', array(
        'label'    => __( 'Show Slider on posts page', 'merlin' ),
        'section'  => 'merlin_section_slider',
        'settings' => 'merlin_theme_options[slider_blog]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);
	
	// Add Setting and Control for Slider Category
	$wp_customize->add_setting( 'merlin_theme_options[slider_category]', array(
        'default'           => 0,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Category_Dropdown_Control(
        $wp_customize, 'merlin_control_slider_category', array(
            'label' => __( 'Slider Category', 'merlin' ),
            'section' => 'merlin_section_slider',
            'settings' => 'merlin_theme_options[slider_category]',
			'active_callback' => 'merlin_slider_activated_callback',
            'priority' => 4
            )
        )
    );
	
	// Add Setting and Control for Number of Posts
	$wp_customize->add_setting( 'merlin_theme_options[slider_limit]', array(
        'default'           => 8,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint'
		)
	);
    $wp_customize->add_control( 'merlin_control_slider_limit', array(
        'label'    => __( 'Number of Posts', 'merlin' ),
        'section'  => 'merlin_section_slider',
        'settings' => 'merlin_theme_options[slider_limit]',
        'type'     => 'text',
		'active_callback' => 'merlin_slider_activated_callback',
		'priority' => 5
		)
	);
	
	// Add Setting and Control for Slider Animation
	$wp_customize->add_setting( 'merlin_theme_options[slider_animation]', array(
        'default'           => 'slide',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_slider_animation'
		)
	);
    $wp_customize->add_control( 'merlin_control_slider_animation', array(
        'label'    => __( 'Slider Animation', 'merlin' ),
        'section'  => 'merlin_section_slider',
        'settings' => 'merlin_theme_options[slider_animation]',
        'type'     => 'radio',
		'priority' => 6,
		'active_callback' => 'merlin_slider_activated_callback',
        'choices'  => array(
            'slide' => __( 'Slide Effect', 'merlin' ),
            'fade' => __( 'Fade Effect', 'merlin' )
			)
		)
	);
	
}
add_action( 'customize_register', 'merlin_customize_register_slider_settings' );