<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package Realestate_Base
 */

// Includes the files needed for the theme updater
if ( ! class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://themepalace.com', // Site where EDD is hosted
		'item_name'      => 'Realestate Base Pro', // Name of theme
		'theme_slug'     => 'realestate-base-pro', // Theme slug
		'version'        => '2.1', // The current version of this theme
		'author'         => 'WEN Themes', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => 'https://themepalace.com/my-account' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'realestate-base-pro' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'realestate-base-pro' ),
		'license-key'               => __( 'License Key', 'realestate-base-pro' ),
		'license-action'            => __( 'License Action', 'realestate-base-pro' ),
		'deactivate-license'        => __( 'Deactivate License', 'realestate-base-pro' ),
		'activate-license'          => __( 'Activate License', 'realestate-base-pro' ),
		'status-unknown'            => __( 'License status is unknown.', 'realestate-base-pro' ),
		'renew'                     => __( 'Renew?', 'realestate-base-pro' ),
		'unlimited'                 => __( 'unlimited', 'realestate-base-pro' ),
		'license-key-is-active'     => __( 'License key is active.', 'realestate-base-pro' ),
		'expires%s'                 => __( 'Expires %s.', 'realestate-base-pro' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'realestate-base-pro' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'realestate-base-pro' ),
		'license-key-expired'       => __( 'License key has expired.', 'realestate-base-pro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'realestate-base-pro' ),
		'license-is-inactive'       => __( 'License is inactive.', 'realestate-base-pro' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'realestate-base-pro' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'realestate-base-pro' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'realestate-base-pro' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'realestate-base-pro' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'realestate-base-pro' ),
		'key-not-activated'         => __( '%1$s License Key has not been activated, so the theme is inactive. %2$sClick here%3$s to activate the license key and the theme.', 'realestate-base-pro' ),
		'get-license-key'           => __( 'Get API key from %s.', 'realestate-base-pro' ),
		'theme-palace'              => __( 'Theme Palace', 'realestate-base-pro' ),
	)

);
