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

	// Add Settings and Controls for post content
	$wp_customize->add_setting( 'merlin_theme_options[post_content]', array(
        'default'           => 'excerpt',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_post_content'
		)
	);
    $wp_customize->add_control( 'merlin_control_post_content', array(
        'label'    => __( 'Post Length on archives', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[post_content]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'index' => __( 'Show full posts', 'merlin' ),
            'excerpt' => __( 'Show post summaries (excerpt)', 'merlin' )
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
        'label'    => __( 'Excerpt Length', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[excerpt_length]',
        'type'     => 'text',
		'active_callback' => 'merlin_control_post_content_callback',
		'priority' => 2
		)
	);
	
	// Add Postmeta Settings
	$wp_customize->add_setting( 'merlin_theme_options[postmeta_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_control_postmeta_headline', array(
            'label' => __( 'Post Meta', 'merlin' ),
            'section' => 'merlin_section_post',
            'settings' => 'merlin_theme_options[postmeta_headline]',
            'priority' => 3
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[meta_date]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_meta_date', array(
        'label'    => __( 'Display date on posts.', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[meta_date]',
        'type'     => 'checkbox',
		'priority' => 4
		)
	);
	$wp_customize->add_setting( 'merlin_theme_options[meta_author]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_meta_author', array(
        'label'    => __( 'Display author on posts.', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[meta_author]',
        'type'     => 'checkbox',
		'priority' => 5
		)
	);
	
	// Add Footer Meta Settings
	$wp_customize->add_setting( 'merlin_theme_options[footermeta_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_control_footermeta_headline', array(
            'label' => __( 'Post Footer', 'merlin' ),
            'section' => 'merlin_section_post',
            'settings' => 'merlin_theme_options[footermeta_headline]',
            'priority' => 6
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[footer_meta_archives]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_footer_meta_archives', array(
        'label'    => __( 'Display footer meta on archives.', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[footer_meta_archives]',
        'type'     => 'checkbox',
		'priority' => 7
		)
	);
	$wp_customize->add_setting( 'merlin_theme_options[footer_meta_single]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_footer_meta_single', array(
        'label'    => __( 'Display footer meta on single posts.', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[footer_meta_single]',
        'type'     => 'checkbox',
		'priority' => 8
		)
	);
	$wp_customize->add_setting( 'merlin_theme_options[meta_tags]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_meta_tags', array(
        'label'    => __( 'Display tags on single posts.', 'merlin' ),
        'section'  => 'merlin_section_post',
        'settings' => 'merlin_theme_options[meta_tags]',
        'type'     => 'checkbox',
		'priority' => 9
		)
	);

}