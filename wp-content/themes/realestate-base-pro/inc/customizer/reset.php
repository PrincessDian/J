<?php
/**
 * Reset theme options.
 *
 * @package Realestate_Base
 */

// Reset Section.
$wp_customize->add_section( 'section_reset_all_settings',
	array(
		'title'       => esc_html__( 'Reset Theme Settings', 'realestate-base-pro' ),
		'priority'    => 1000,
		'capability'  => 'edit_theme_options',
	)
);

$wp_customize->add_setting( 'theme_options[reset_all_settings]', array(
	'default'           => false,
	'capability'        => 'edit_theme_options',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
));
$wp_customize->add_control( 'reset_all_settings', array(
	'label'       => __( 'Reset all theme settings', 'realestate-base-pro' ),
	'description' => esc_html__( 'Caution: All theme settings along with custom header and custom background will be reset to default. Refresh the page after save to view full effects.', 'realestate-base-pro' ),
	'type'        => 'checkbox',
	'section'     => 'section_reset_all_settings',
	'settings'    => 'theme_options[reset_all_settings]',
	'priority'    => 100,
));

// Setting - reset_color_settings.
$wp_customize->add_setting( 'theme_options[reset_color_settings]',
	array(
		'default'           => false,
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[reset_color_settings]',
	array(
		'label'       => esc_html__( 'Reset Color Settings', 'realestate-base-pro' ),
		'description' => esc_html__( 'Caution: All color settings will be reset to default. Refresh the page after save to view full effects.', 'realestate-base-pro' ),
		'section'     => 'section_reset_all_settings',
		'type'        => 'checkbox',
		'priority'    => 90,
	)
);
