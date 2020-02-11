<?php
/**
 * Customizer partials.
 *
 * @package Realestate_Base
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function realestate_base_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function realestate_base_customize_partial_blogdescription() {

	bloginfo( 'description' );

}

/**
 * Partial for copyright text.
 *
 * @since 1.0.0
 *
 * @return void
 */
function realestate_base_render_partial_copyright_text() {

	$copyright_text = realestate_base_get_option( 'copyright_text' );
	$copyright_text = apply_filters( 'realestate_base_filter_copyright_text', $copyright_text );
	if ( ! empty( $copyright_text ) ) {
		$copyright_text = wp_kses_data( $copyright_text );
		$copyright_text = realestate_base_apply_theme_shortcode( $copyright_text );
	}
	echo $copyright_text;

}

/**
 * Partial for powered by text.
 *
 * @since 1.0.0
 *
 * @return void
 */
function realestate_base_render_partial_powered_by_text() {

	$powered_by_text = realestate_base_get_option( 'powered_by_text' );
	$powered_by_text = apply_filters( 'realestate_base_filter_powered_by_text', $powered_by_text );
	if ( ! empty( $powered_by_text ) ) {
		$allowed_tags = wp_kses_allowed_html( 'post' );
		$powered_by_text = wp_kses( $powered_by_text, $allowed_tags );
		$powered_by_text = realestate_base_apply_theme_shortcode( $powered_by_text );
	}
	echo $powered_by_text;

}
