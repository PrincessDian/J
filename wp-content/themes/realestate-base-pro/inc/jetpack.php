<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Realestate_Base
 */

/**
 * Add theme support for Jetpack.
 *
 * @since 1.0.0
 */
function realestate_base_jetpack_setup() {
	$pagination_type = realestate_base_get_option( 'pagination_type' );
	if ( in_array( $pagination_type, array( 'infinite-scroll-click', 'infinite-scroll' ) ) ) {
		$type = ( 'infinite-scroll-click' === $pagination_type ) ? 'click' : 'scroll' ;
		add_theme_support( 'infinite-scroll', array(
			'type'           => $type,
			'container'      => 'main',
			'footer'         => 'page',
			'wrapper'        => false,
			'render'         => 'realestate_base_infinite_scroll_render',
			'footer_widgets' => array( 'footer-1', 'footer-2', 'footer-3', 'footer-4' )
		) );
	}

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'realestate_base_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 *
 * @since 1.0.0
 */
function realestate_base_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content' );
		endif;
	}
}

if ( ! function_exists( 'realestate_base_custom_supported_infinite_scroll' ) ) :

	/**
	 * Custom supported infinite scroll.
	 *
	 * @since 1.0.0
	 *
	 * @param string $input Active status.
	 * @return string Modified active status.
	 */
	function realestate_base_custom_supported_infinite_scroll( $input ) {

		$val = false;
		if ( is_home() || is_category() || is_tag() || is_author() || is_date() ) {
			$val = true;
		}
		return $val;

	}
endif;

add_filter( 'infinite_scroll_archive_supported', 'realestate_base_custom_supported_infinite_scroll' );
