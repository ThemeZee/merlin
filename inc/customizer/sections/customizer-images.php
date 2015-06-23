<?php
/**
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'merlin_customize_register_post_image_settings' );

function merlin_customize_register_post_image_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'merlin_section_images', array(
        'title'    => __( 'Post Images', 'merlin' ),
        'priority' => 30,
		'panel' => 'merlin_options_panel' 
		)
	);

	// Add Post Images Settings for archive posts
	$wp_customize->add_setting( 'merlin_theme_options[post_layout_archives]', array(
        'default'           => 'left',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_post_layout'
		)
	);
    $wp_customize->add_control( 'merlin_control_post_layout_archives', array(
        'label'    => __( 'Post Images (archive pages)', 'merlin' ),
        'section'  => 'merlin_section_images',
        'settings' => 'merlin_theme_options[post_layout_archives]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'left' => __( 'Show featured image beside content.', 'merlin' ),
            'top' => __( 'Show featured image above content.', 'merlin'),
			'none' => __( 'Show no featured image.', 'merlin')
			)
		)
	);
	
	// Add Post Images Settings for single posts
	$wp_customize->add_setting( 'merlin_theme_options[post_layout_single]', array(
        'default'           => 'top',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_post_layout'
		)
	);
    $wp_customize->add_control( 'merlin_control_post_layout_single', array(
        'label'    => __( 'Post Images (single post)', 'merlin' ),
        'section'  => 'merlin_section_images',
        'settings' => 'merlin_theme_options[post_layout_single]',
        'type'     => 'radio',
		'priority' => 2,
        'choices'  => array(
            'left' => __( 'Show featured image beside content.', 'merlin' ),
            'top' => __( 'Show featured image above content.', 'merlin'),
			'none' => __( 'Show no featured image.', 'merlin')
			)
		)
	);

}

?>