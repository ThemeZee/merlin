<?php
/**
 * Pro Version Upgrade Section
 *
 * Registers Upgrade Section for the Pro Version of the theme
 *
 * @package Merlin
 */


/**
 * Adds pro version description and CTA button
 *
 * @param object $wp_customize / Customizer Object
 */
function merlin_customize_register_upgrade_settings( $wp_customize ) {

	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
	// Add Sections for Post Settings
	$wp_customize->add_section( 'merlin_section_upgrade', array(
        'title'    => esc_html__( 'Pro Version', 'merlin' ),
        'priority' => 70,
		'panel' => 'merlin_options_panel' 
		)
	);

	// Add PRO Version Section
	$wp_customize->add_setting( 'merlin_theme_options[pro_version_label]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_control_pro_version_label', array(
            'label' => esc_html__( 'You need more features?', 'merlin' ),
            'section' => 'merlin_section_upgrade',
            'settings' => 'merlin_theme_options[pro_version_label]',
            'priority' => 	1
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[pro_version]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Text_Control(
        $wp_customize, 'merlin_control_pro_version', array(
            'label' =>  esc_html__( 'Purchase the Pro Version to get additional features and advanced customization options.', 'merlin' ),
            'section' => 'merlin_section_upgrade',
            'settings' => 'merlin_theme_options[pro_version]',
            'priority' => 	2
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[pro_version_button]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Button_Control(
        $wp_customize, 'merlin_control_pro_version_button', array(
            'label' => sprintf( esc_html__( 'Learn more about %s Pro', 'merlin' ), $theme->get( 'Name' ) ),
			'section' => 'merlin_section_upgrade',
            'settings' => 'merlin_theme_options[pro_version_button]',
            'priority' => 	3
            )
        )
    );

}
add_action( 'customize_register', 'merlin_customize_register_upgrade_settings' );