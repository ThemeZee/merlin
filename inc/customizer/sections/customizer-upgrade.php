<?php
/**
 * Register PRO Version section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'merlin_customize_register_upgrade_settings' );

function merlin_customize_register_upgrade_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'merlin_section_upgrade', array(
        'title'    => __( 'Merlin Pro', 'merlin' ),
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
            'label' => __( 'Need more features?', 'merlin' ),
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
            'label' =>  __( 'Check out the PRO version which comes with additional features and advanced customization options.', 'merlin' ),
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
            'label' => __('Learn more about Merlin Pro', 'merlin'),
			'section' => 'merlin_section_upgrade',
            'settings' => 'merlin_theme_options[pro_version_button]',
            'priority' => 	3
            )
        )
    );

}

?>