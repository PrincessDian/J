<?php
/**
 * Color Options.
 *
 * @package Realestate_Base
 */

// Get panels.
$color_panels = realestate_base_get_color_panels_options();
if ( empty( $color_panels ) ) {
	return;
}

// Get sections.
$color_sections = realestate_base_get_color_sections_options();
if ( empty( $color_sections ) ) {
	return;
}

// Get fields.
$color_fields = realestate_base_get_color_theme_settings_options();
if ( empty( $color_fields ) ) {
	return;
}

// Default values.
 $default = realestate_base_get_default_theme_options();

// Add Color Options Panels.
foreach ( $color_panels as $panel_id => $panel ) {
	$wp_customize->add_panel( $panel_id,
		array(
			'title'      => $panel['label'],
			'priority'   => 100,
			'capability' => 'edit_theme_options',
		)
	);
}

// Add sections.
$pr = 16;
foreach ($color_sections as $section_id => $section ) {

  $wp_customize->add_section( $section_id,
  	array(
  		'title'      => $section['label'],
  		'priority'   => $pr,
  		'capability' => 'edit_theme_options',
  		'panel'      => $section['panel'],
  	)
  );
  $pr += 16;

}

// Add color fields.
foreach ( $color_fields as $field_id => $field ) {
  $wp_customize->add_setting( 'theme_options[' . $field_id . ']',
  	array(
  		'default'           => $default[ $field_id ],
  		'capability'        => 'edit_theme_options',
  		'sanitize_callback' => 'esc_attr',
  	)
  );
  $wp_customize->add_control(
  	new WP_Customize_Color_Control( $wp_customize, 'theme_options[' . $field_id . ']',
  		array(
  			'label'    => $field['label'],
  			'section'  => $field['section'],
  			'settings' => 'theme_options[' . $field_id . ']',
  		)
  	)
  );

}
