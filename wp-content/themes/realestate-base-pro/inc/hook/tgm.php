<?php
/**
 * Recommended plugins.
 *
 * @package Realestate_Base
 */

if ( ! function_exists( 'realestate_base_recommended_plugins' ) ) :

	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_recommended_plugins() {

		$plugins = array(
			array(
				'name'     => esc_html__( 'Team View', 'realestate-base-pro' ),
				'slug'     => 'team-view',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Projects by WooThemes', 'realestate-base-pro' ),
				'slug'     => 'projects-by-woothemes',
				'required' => false,
			),
		);

		$config = array();

		tgmpa( $plugins, $config );

	}

endif;

add_filter( 'tgmpa_register', 'realestate_base_recommended_plugins' );
