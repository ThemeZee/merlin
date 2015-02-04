<?php
/**
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'future_customize_register_post_settings' );

function future_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'future_section_post', array(
        'title'    => __( 'Post Settings', 'future' ),
        'priority' => 30,
		'panel' => 'future_options_panel' 
		)
	);

	// Add Settings and Controls for Post Layout
	$wp_customize->add_setting( 'future_theme_options[post_layout]', array(
        'default'           => 'index',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'future_sanitize_post_layout'
		)
	);
    $wp_customize->add_control( 'future_control_post_layout', array(
        'label'    => __( 'Post Layout', 'future' ),
        'section'  => 'future_section_post',
        'settings' => 'future_theme_options[post_layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'one-column' => __( 'One Column', 'future' ),
			'index' => __( 'Two Columns', 'future' )
			)
		)
	);
	
	// Add Settings and Controls for Posts
	$wp_customize->add_setting( 'future_theme_options[posts_length]', array(
        'default'           => 'excerpt',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'future_sanitize_post_length'
		)
	);
    $wp_customize->add_control( 'future_control_posts_length', array(
        'label'    => __( 'Post Length on archives', 'future' ),
        'section'  => 'future_section_post',
        'settings' => 'future_theme_options[posts_length]',
        'type'     => 'radio',
		'priority' => 2,
        'choices'  => array(
            'index' => __( 'Show full posts', 'future' ),
            'excerpt' => __( 'Show post summaries (excerpt)', 'future' )
			)
		)
	);
	
	// Add Post Images Headline
	$wp_customize->add_setting( 'future_theme_options[post_images]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Future_Customize_Header_Control(
        $wp_customize, 'future_control_post_images', array(
            'label' => __( 'Post Images', 'future' ),
            'section' => 'future_section_post',
            'settings' => 'future_theme_options[post_images]',
            'priority' => 3
            )
        )
    );
	$wp_customize->add_setting( 'future_theme_options[post_thumbnails_index]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'future_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'future_control_posts_thumbnails_index', array(
        'label'    => __( 'Display featured images on archive pages', 'future' ),
        'section'  => 'future_section_post',
        'settings' => 'future_theme_options[post_thumbnails_index]',
        'type'     => 'checkbox',
		'priority' => 4
		)
	);

	$wp_customize->add_setting( 'future_theme_options[post_thumbnails_single]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'future_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'future_control_posts_thumbnails_single', array(
        'label'    => __( 'Display featured images on single posts', 'future' ),
        'section'  => 'future_section_post',
        'settings' => 'future_theme_options[post_thumbnails_single]',
        'type'     => 'checkbox',
		'priority' => 5
		)
	);

}

?>