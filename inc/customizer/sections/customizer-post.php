<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package Merlin
 */


/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function merlin_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'merlin_section_post', array(
        'title'    => esc_html__( 'Post Settings', 'merlin' ),
        'priority' => 30,
		'panel' => 'merlin_options_panel' 
		)
	);
	
	// Add Title for latest posts setting
	$wp_customize->add_setting( 'merlin_theme_options[latest_posts_title]', array(
        'default'           => esc_html__( 'Latest Posts', 'merlin' ),
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_html'
		)
	);
    $wp_customize->add_control( 'merlin_control_latest_posts_title', array(
        'label'    => esc_html__( 'Title above Latest Posts', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[latest_posts_title]',
        'type'     => 'text',
		'priority' => 1
		)
	);

	// Add Settings and Controls for post content
	$wp_customize->add_setting( 'merlin_theme_options[post_content]', array(
        'default'           => 'excerpt',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_post_content'
		)
	);
    $wp_customize->add_control( 'merlin_control_post_content', array(
        'label'    => esc_html__( 'Post length on archives', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[post_content]',
        'type'     => 'radio',
		'priority' => 2,
        'choices'  => array(
            'index' => esc_html__( 'Show full posts', 'merlin' ),
            'excerpt' => esc_html__( 'Show post excerpts', 'merlin' )
			)
		)
	);
	
	// Add Setting and Control for Excerpt Length
	$wp_customize->add_setting( 'merlin_theme_options[excerpt_length]', array(
        'default'           => 30,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint'
		)
	);
    $wp_customize->add_control( 'merlin_control_excerpt_length', array(
        'label'    => esc_html__( 'Excerpt Length', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[excerpt_length]',
        'type'     => 'text',
		'active_callback' => 'merlin_control_post_content_callback',
		'priority' => 3
		)
	);
	
}
add_action( 'customize_register', 'merlin_customize_register_post_settings' );