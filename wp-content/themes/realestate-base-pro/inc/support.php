<?php
/**
 * Theme supports.
 *
 * @package Realestate_Base
 */

// Load Footer Widget Support.
require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/support/footer-widgets.php' );

// Load WooCommerce Support.
if ( class_exists( 'WooCommerce' ) ) :
	require_if_theme_supports( 'woocommerce', get_template_directory() . '/inc/support/woocommerce.php' );
endif;

// Load Projects Support.
if ( class_exists( 'Projects' ) ) :
	require_once get_template_directory() . '/inc/support/projects.php';
endif;
