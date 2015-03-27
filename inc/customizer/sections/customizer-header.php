<?php
/**
 * Register Header Content section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'merlin_customize_register_header_settings' );

function merlin_customize_register_header_settings( $wp_customize ) {

	// Add Sections for Header Content
	$wp_customize->add_section( 'merlin_section_header', array(
        'title'    => __( 'Header Settings', 'merlin' ),
        'priority' => 20,
		'panel' => 'merlin_options_panel' 
		)
	);

	// Add Header Content Header
	$wp_customize->add_setting( 'merlin_theme_options[header_content]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_control_header_content', array(
            'label' => __( 'Header Content', 'merlin' ),
            'section' => 'merlin_section_header',
            'settings' => 'merlin_theme_options[header_content]',
            'priority' => 2
            )
        )
    );

	// Add Settings and Controls for Header
	$wp_customize->add_setting( 'merlin_theme_options[header_icons]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_control_header_icons', array(
        'label'    => __( 'Display Social Icons on top navigation.', 'merlin' ),
        'section'  => 'merlin_section_header',
        'settings' => 'merlin_theme_options[header_icons]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);
	
}

?>