<?php
/**
 * Basic theme functions.
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package Realestate_Base
 */

if ( ! function_exists( 'realestate_base_customize_search_form' ) ) :

	/**
	 * Customize search form.
	 *
	 * @since 1.0.0
	 *
	 * @return string The search form HTML output.
	 */
	function realestate_base_customize_search_form() {

		$search_placeholder = realestate_base_get_option( 'search_placeholder' );
		$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
		<label>
			<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'realestate-base-pro' ) . '</span>
			<input type="search" class="search-field" placeholder="' . esc_attr( $search_placeholder ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'realestate-base-pro' ) . '" />
		</label>
		<input type="submit" class="search-submit" value="&#xf002;" /></form>';

		return $form;

	}

endif;

add_filter( 'get_search_form', 'realestate_base_customize_search_form', 15 );

if ( ! function_exists( 'realestate_base_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function realestate_base_implement_excerpt_length( $length ) {

		$excerpt_length = realestate_base_get_option( 'excerpt_length' );
		if ( empty( $excerpt_length ) ) {
			$excerpt_length = $length;
		}
		return apply_filters( 'realestate_base_filter_excerpt_length', absint( $excerpt_length ) );

	}

endif;

if ( ! function_exists( 'realestate_base_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function realestate_base_implement_read_more( $more ) {

		$flag_apply_excerpt_read_more = apply_filters( 'realestate_base_filter_excerpt_read_more', true );
		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more;
		}

		$output = $more;
		$read_more_text = realestate_base_get_option( 'read_more_text' );
		if ( ! empty( $read_more_text ) ) {
			$output = ' <a href="'. esc_url( get_permalink() ) . '" class="more-link">' . esc_html( $read_more_text ) . '</a>';
			$output = apply_filters( 'realestate_base_filter_read_more_link' , $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'realestate_base_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function realestate_base_content_more_link( $more_link, $more_link_text ) {

		$flag_apply_excerpt_read_more = apply_filters( 'realestate_base_filter_excerpt_read_more', true );
		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more_link;
		}

		$read_more_text = realestate_base_get_option( 'read_more_text' );
		if ( ! empty( $read_more_text ) ) {
			$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
		}
		return $more_link;

	}

endif;

if ( ! function_exists( 'realestate_base_custom_body_class' ) ) :
	/**
	 * Custom body class
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $input One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function realestate_base_custom_body_class( $input ) {

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$input[] = 'group-blog';
		}

		$home_content_status =	realestate_base_get_option( 'home_content_status' );
		if( true !== $home_content_status ){
			$input[] = 'home-content-not-enabled';
		}

		// Global layout.
		global $post;
		$global_layout = realestate_base_get_option( 'global_layout' );
		$global_layout = apply_filters( 'realestate_base_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post  && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'realestate_base_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}

		$input[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
			case 'three-columns':
			case 'three-columns-pcs':
			case 'three-columns-cps':
			case 'three-columns-psc':
			case 'three-columns-pcs-equal':
			case 'three-columns-scp-equal':
			$input[] = 'three-columns-enabled';
			break;

			default:
			break;
		}

		// Sticky menu.
		$enable_sticky_primary_menu = realestate_base_get_option( 'enable_sticky_primary_menu' );

		if ( true === $enable_sticky_primary_menu) {
			$input[] = 'enabled-sticky-primary-menu';
		}

		return $input;

	}
endif;

add_filter( 'body_class', 'realestate_base_custom_body_class' );

if ( ! function_exists( 'realestate_base_featured_image_instruction' ) ) :

	/**
	 * Message to show in the Featured Image Meta box.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Admin post thumbnail HTML markup.
	 * @param int    $post_id Post ID.
	 * @return string HTML.
	 */
	function realestate_base_featured_image_instruction( $content, $post_id ) {

		$allowed = array( 'post', 'page' );

		if ( in_array( get_post_type( $post_id ), $allowed ) ) {
			$content .= '<strong>' . __( 'Recommended Image Sizes', 'realestate-base-pro' ) . ':</strong><br/>';
			$content .= __( 'Slider Image', 'realestate-base-pro' ) . ' : 1920px X 800px';
		}

		return $content;

	}

endif;

add_filter( 'admin_post_thumbnail_html', 'realestate_base_featured_image_instruction', 10, 2 );

if ( ! function_exists( 'realestate_base_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_custom_content_width() {

		global $post, $wp_query, $content_width;

		$global_layout = realestate_base_get_option( 'global_layout' );
		$global_layout = apply_filters( 'realestate_base_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post  && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'realestate_base_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = esc_attr( $post_options['post_layout'] );
			}
		}
		switch ( $global_layout ) {

			case 'no-sidebar':
				$content_width = 1220;
				break;

			case 'three-columns':
			case 'three-columns-pcs':
			case 'three-columns-cps':
			case 'three-columns-psc':
			case 'no-sidebar-centered':
				$content_width = 570;
				break;

			case 'three-columns-pcs-equal':
			case 'three-columns-scp-equal':
				$content_width = 363;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 895;
				break;

			default:
				break;
		}

	}
endif;

add_filter( 'template_redirect', 'realestate_base_custom_content_width' );

if ( ! function_exists( 'realestate_base_hook_read_more_filters' ) ) :

	/**
	 * Hook read more filters.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_hook_read_more_filters() {
		if ( is_home() || is_category() || is_tag() || is_author() || is_date() ) {

			add_filter( 'excerpt_length', 'realestate_base_implement_excerpt_length', 999 );
			add_filter( 'the_content_more_link', 'realestate_base_content_more_link', 10, 2 );
			add_filter( 'excerpt_more', 'realestate_base_implement_read_more' );

		}
	}
endif;

add_action( 'wp', 'realestate_base_hook_read_more_filters' );

/**
 * Load theme options from free theme.
 *
 * Checks if there are options already present from free version and adds it to the Pro theme options.
 *
 * @since 1.0.0
 */
function realestate_base_import_free_options() {

	// Perform action only if theme_mods_XXX[theme_options] does not exist.
	if( ! get_theme_mod( 'theme_options' ) ) {

		// Perform action only if theme_mods_XXX free version exists.
		if ( $free_options = get_option ( 'theme_mods_realestate-base' ) ) {
			if ( isset( $free_options['theme_options'] ) ) {
				$pro_default_options = realestate_base_get_default_theme_options();

				$pro_theme_options = $free_options;

				$pro_theme_options['theme_options'] = array_merge( $pro_default_options , $free_options['theme_options'] );

				// WP default fields.
				$fields = array(
					'custom_logo',
					'header_image',
					'header_image_data',
					'background_image',
					'background_repeat',
					'background_position_x',
					'background_attachment',
				);

				foreach ( $fields as $key ) {
					if ( isset( $free_options[ $key ] ) && ! empty( $free_options[ $key ] ) ) {
						$pro_theme_options[ $key ] = $free_options[ $key ];
					}
				}

				update_option( 'theme_mods_realestate-base-pro', $pro_theme_options );
			}
		}
	}
}

add_action( 'after_switch_theme', 'realestate_base_import_free_options' );

if ( ! function_exists( 'realestate_base_customizer_reset_callback' ) ) :

	/**
	 * Callback for reset in Customizer.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_customizer_reset_callback() {

		$reset_all_settings = realestate_base_get_option( 'reset_all_settings' );

		if ( true === $reset_all_settings ) {

			// Reset custom theme options.
			set_theme_mod( 'theme_options', array() );

			// Reset custom header, logo and backgrounds.
			remove_theme_mod( 'custom_logo' );
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
		}

		// Reset color options.
		$reset_color_settings = realestate_base_get_option( 'reset_color_settings' );
		if ( true === $reset_color_settings ) {
			$options = realestate_base_get_options();
			$options['reset_color_settings'] = false;
			$color_fields = realestate_base_get_color_theme_settings_options();
			$default = realestate_base_get_default_theme_options();
			if ( ! empty( $color_fields ) ) {
				foreach ( $color_fields as $key => $val ) {
					$options[ $key ] = $default[ $key ];
				}
			}
			set_theme_mod( 'theme_options', $options );
			remove_theme_mod( 'background_color' );
		}

		// Reset font options.
		$reset_font_settings = realestate_base_get_option( 'reset_font_settings' );
		if ( true === $reset_font_settings ) {
			$options = realestate_base_get_options();
			$options['reset_font_settings'] = false;
			$font_settings = realestate_base_get_font_family_theme_settings_options();
			if ( ! empty( $font_settings ) ) {
				foreach ( $font_settings as $key => $val ) {
					$options[ $key ] = $val['default'];
				}
			}
			set_theme_mod( 'theme_options', $options );
		}

		// Reset footer content.
		$reset_footer_content = realestate_base_get_option( 'reset_footer_content' );
		if ( true === $reset_footer_content ) {
			$options = realestate_base_get_options();
			$options['reset_footer_content'] = false;
			$default = realestate_base_get_default_theme_options();
			$footer_fields = array(
				'copyright_text',
				'powered_by_text',
			);
			foreach ( $footer_fields as $field ) {
				if ( isset( $default[ $field ] ) ) {
					$options[ $field ] = $default[ $field ];
				}
			}
			set_theme_mod( 'theme_options', $options );
		}

	}
endif;

add_action( 'customize_save_after', 'realestate_base_customizer_reset_callback' );

if ( ! function_exists( 'realestate_base_init_project_customization' ) ) :

	/**
	 * Project customization.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_init_project_customization() {
		if ( ! class_exists( 'Projects' ) ) {
			return;
		}
		global $projects;
		remove_action( 'admin_notices', array( $projects->admin, 'configuration_admin_notice' ) );
	}
endif;

add_action( 'admin_init', 'realestate_base_init_project_customization' );

