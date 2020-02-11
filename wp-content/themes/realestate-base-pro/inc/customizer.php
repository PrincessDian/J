<?php
/**
 * Theme Customizer.
 *
 * @package Realestate_Base
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function realestate_base_customize_register( $wp_customize ) {

	// Load custom controls.
	require get_template_directory() . '/inc/customizer/control.php';

	// Load customize helpers.
	require get_template_directory() . '/inc/helper/options.php';

	// Load customize sanitize.
	require get_template_directory() . '/inc/customizer/sanitize.php';

	// Load customize callback.
	require get_template_directory() . '/inc/customizer/callback.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Load customize option.
	require get_template_directory() . '/inc/customizer/option.php';

	// Load font family option.
	require get_template_directory() . '/inc/customizer/font.php';

	// Load slider customize option.
	require get_template_directory() . '/inc/customizer/slider.php';

	// Load color option.
	require get_template_directory() . '/inc/customizer/color.php';

	// Load reset option.
	require get_template_directory() . '/inc/customizer/reset.php';

	// Modify default customizer options.
	$wp_customize->get_control( 'background_color' )->description = __( 'Note: Background Color is applicable only if no image is set as Background Image.', 'realestate-base-pro' );
	$wp_customize->get_control( 'background_color' )->section = 'color_section_basic';

}

add_action( 'customize_register', 'realestate_base_customize_register' );

/**
 * Customizer partials.
 *
 * @since 1.0.0
 */
function realestate_base_customizer_partials( WP_Customize_Manager $wp_customize ) {

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->get_setting( 'blogname' )->transport                       = 'refresh';
		$wp_customize->get_setting( 'blogdescription' )->transport                = 'refresh';
		$wp_customize->get_setting( 'theme_options[copyright_text]' )->transport  = 'refresh';
		$wp_customize->get_setting( 'theme_options[powered_by_text]' )->transport = 'refresh';
		return;

	}

	// Load customizer partials callback.
	require get_template_directory() . '/inc/customizer/partials.php';

	// Partial blogname.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'            => '.site-title a',
		'container_inclusive' => false,
		'render_callback'     => 'realestate_base_customize_partial_blogname',
	) );

	// Partial blogdescription.
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'            => '.site-description',
		'container_inclusive' => false,
		'render_callback'     => 'realestate_base_customize_partial_blogdescription',
	) );

	// Partial copyright_text.
	$wp_customize->selective_refresh->add_partial( 'copyright_text', array(
		'selector'            => '#colophon .copyright',
		'container_inclusive' => false,
		'settings'            => array( 'theme_options[copyright_text]' ),
		'render_callback'     => 'realestate_base_render_partial_copyright_text',
	) );

	// Partial powered_by_text.
	$wp_customize->selective_refresh->add_partial( 'powered_by_text', array(
		'selector'            => '#colophon .site-info',
		'container_inclusive' => false,
		'settings'            => array( 'theme_options[powered_by_text]' ),
		'render_callback'     => 'realestate_base_render_partial_powered_by_text',
	) );

}

add_action( 'customize_register', 'realestate_base_customizer_partials', 99 );
