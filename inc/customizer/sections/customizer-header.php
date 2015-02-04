<?php
/**
 * Register Header Content section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'future_customize_register_header_settings' );

function future_customize_register_header_settings( $wp_customize ) {

	// Add Sections for Header Content
	$wp_customize->add_section( 'future_section_header', array(
        'title'    => __( 'Header Settings', 'future' ),
        'priority' => 20,
		'panel' => 'future_options_panel' 
		)
	);

	// Add Header Content Header
	$wp_customize->add_setting( 'future_theme_options[header_content]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Future_Customize_Header_Control(
        $wp_customize, 'future_control_header_content', array(
            'label' => __( 'Header Content', 'future' ),
            'section' => 'future_section_header',
            'settings' => 'future_theme_options[header_content]',
            'priority' => 2
            )
        )
    );

	// Add Settings and Controls for Header
	$wp_customize->add_setting( 'future_theme_options[header_icons]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'future_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'future_control_header_icons', array(
        'label'    => __( 'Display Social Icons on top navigation.', 'future' ),
        'section'  => 'future_section_header',
        'settings' => 'future_theme_options[header_icons]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);
	
}

?>