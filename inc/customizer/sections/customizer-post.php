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
        'priority' => 30,
		'panel' => 'merlin_options_panel' 
		)
	);

	// Add Settings and Controls for Post Layout
	$wp_customize->add_setting( 'merlin_theme_options[post_layout]', array(
        'default'           => 'index',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_post_layout'
		)
	);
    $wp_customize->add_control( 'merlin_control_post_layout', array(
        'label'    => __( 'Post Layout', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[post_layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'one-column' => __( 'One Column', 'merlin' ),
			'index' => __( 'Two Columns', 'merlin' )
			)
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
		'priority' => 2,
        'choices'  => array(
            'index' => __( 'Show full posts', 'merlin' ),
            'excerpt' => __( 'Show post summaries (excerpt)', 'merlin' )
			)
		)
	);
	
	// Add Post Images Headline
	$wp_customize->add_setting( 'merlin_theme_options[post_images]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_control_post_images', array(
            'label' => __( 'Post Images', 'merlin' ),
            'section' => 'merlin_section_post',
            'settings' => 'merlin_theme_options[post_images]',
            'priority' => 3
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[post_thumbnails_index]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_posts_thumbnails_index', array(
        'label'    => __( 'Display featured images on archive pages', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[post_thumbnails_index]',
        'type'     => 'checkbox',
		'priority' => 4
		)
	);

	$wp_customize->add_setting( 'merlin_theme_options[post_thumbnails_single]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_posts_thumbnails_single', array(
        'label'    => __( 'Display featured images on single posts', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[post_thumbnails_single]',
        'type'     => 'checkbox',
		'priority' => 5
		)
	);

}

?>