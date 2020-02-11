<?php
/**
 * Admin functions.
 *
 * @package Realestate_Base
 */

add_action( 'admin_menu', 'realestate_base_admin_menu_page' );

/**
 * Register admin page.
 *
 * @since 1.0.0
 */
function realestate_base_admin_menu_page() {

	$theme = wp_get_theme( get_template() );

	add_theme_page(
		$theme->display( 'Name' ),
		$theme->display( 'Name' ),
		'manage_options',
		'realestate-base-pro',
		'realestate_base_do_admin_page'
	);

}

/**
 * Render admin page.
 *
 * @since 1.0.0
 */
function realestate_base_do_admin_page() {

	$theme = wp_get_theme( get_template() );
	?>
	<div class="wrap about-wrap">
		<h1><?php echo esc_html( $theme->display( 'Name' ) ); ?></h1>
		<div class="two-col">

			<div class="col about-text">
				<?php
					$description_raw = $theme->display( 'Description' );
					$main_description = explode( 'Official', $description_raw );
					?>
				<?php echo wp_kses_post( $main_description[0] ); ?>
				<p><?php esc_html_e( 'Version', 'realestate-base-pro' ); ?>:&nbsp;<?php echo esc_html( $theme->display( 'Version' ) ); ?></p>
			</div><!-- .col -->

			<div class="col">
				<a href="<?php echo esc_url( $theme->display( 'ThemeURI' ) ); ?>" target="_blank"><img src="<?php echo trailingslashit( get_template_directory_uri() ); ?>screenshot.png" alt="<?php echo esc_attr( $theme->display( 'Name' ) ); ?>" /></a>
			</div><!-- .col -->

		</div><!-- .two-col -->
		<div class="four-col">

			<div class="col">

				<h3><i class="dashicons dashicons-admin-customizer"></i><?php esc_html_e( 'Theme Options', 'realestate-base-pro' ); ?></h3>

				<p>
					<?php esc_html_e( 'We have used Customizer API for theme options which will help you preview your changes live and fast.', 'realestate-base-pro' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo wp_customize_url(); ?>" ><?php esc_html_e( 'Customize', 'realestate-base-pro' ); ?></a>
				</p>

			</div><!-- .col -->

			<div class="col">

				<h3><i class="dashicons dashicons-book-alt"></i><?php esc_html_e( 'Theme Instructions', 'realestate-base-pro' ); ?></h3>
				<p>
					<?php esc_html_e( 'We have prepared detailed theme instructions which will help you to customize theme as you prefer.', 'realestate-base-pro' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( 'https://themepalace.com/theme-instructions/realestate-base-pro/' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'realestate-base-pro' ); ?></a>
				</p>

			</div><!-- .col -->


			<div class="col">

				<h3><i class="dashicons dashicons-sos"></i><?php esc_html_e( 'Help &amp; Support', 'realestate-base-pro' ); ?></h3>

				<p>
					<?php esc_html_e( 'If you have any question/feedback regarding theme, please post in our official support forum.', 'realestate-base-pro' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( 'https://themepalace.com/forum/realestate-base-pro/' ); ?>" target="_blank"><?php esc_html_e( 'Get Support', 'realestate-base-pro' ); ?></a>
				</p>

			</div><!-- .col -->


			<div class="col">

				<h3><i class="dashicons dashicons-admin-network"></i><?php esc_html_e( 'Theme License', 'realestate-base-pro' ); ?></h3>
				<p>
					<?php esc_html_e( 'Want regular updates of theme? Please activate theme using valid license which you get from purchase order.', 'realestate-base-pro' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=realestate-base-pro-license' ) ); ?>" ><?php esc_html_e( 'License', 'realestate-base-pro' ); ?></a>
				</p>

			</div><!-- .col -->

		</div><!-- .four-col -->


	</div><!-- .wrap -->
	<?php

}

/**
 * Load admin scripts.
 *
 * @since 1.0.0
 *
 * @param string $hook Current page hook.
 */
function realestate_base_load_admin_scripts( $hook ) {

	if ( 'appearance_page_realestate-base-pro' === $hook ) {

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_style( 'realestate-base-admin', get_template_directory_uri() . '/css/admin' . $min . '.css', false, '1.0.0' );

	}

}
add_action( 'admin_enqueue_scripts', 'realestate_base_load_admin_scripts' );
