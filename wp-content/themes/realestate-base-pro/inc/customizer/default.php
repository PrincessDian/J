<?php
/**
 * Default theme options.
 *
 * @package Realestate_Base
 */

if ( ! function_exists( 'realestate_base_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function realestate_base_get_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']                 = true;
		$defaults['show_tagline']               = true;
		$defaults['show_social_in_header']      = false;
		$defaults['contact_number']             = '9841123123';
		$defaults['contact_email']              = 'demo@example.com';
		$defaults['contact_address']            = esc_html__( 'Kathmandu, Nepal', 'realestate-base-pro' );
		$defaults['enable_sticky_primary_menu'] = false;
		$defaults['browse_button_text']         = esc_html__( 'Browse Properties', 'realestate-base-pro' );
		$defaults['browse_button_url']          = '#';
		$defaults['search_in_header']           = true;

		// Search.
		$defaults['search_placeholder'] = esc_html__( 'Search&hellip;', 'realestate-base-pro' );

		// Layout.
		$defaults['global_layout']           = 'right-sidebar';
		$defaults['archive_layout']          = 'excerpt';
		$defaults['archive_image']           = 'large';
		$defaults['archive_image_alignment'] = 'center';
		$defaults['single_image']            = 'large';
		$defaults['single_image_alignment']  = 'center';

		// Home Page.
		$defaults['home_content_status'] = true;

		// Pagination.
		$defaults['pagination_type'] = 'numeric';

		// Content Meta.
		$defaults['show_meta_date']       = true;
		$defaults['show_meta_author']     = true;
		$defaults['show_meta_categories'] = true;
		$defaults['show_meta_tags']       = true;
		$defaults['show_meta_comment']    = true;

		// Footer.
		$defaults['copyright_text']        = esc_html__( 'Copyright &copy; [the-year] [the-site-link]. All rights reserved.', 'realestate-base-pro' );
		$defaults['powered_by_text']       = esc_html__( 'Realestate Base Pro by ', 'realestate-base-pro' ) . '<a target="_blank" rel="designer" href="https://wenthemes.com/">WEN Themes</a>';
		$defaults['reset_footer_content']  = false;
		$defaults['show_social_in_footer'] = false;
		$defaults['go_to_top']             = true;

		// Blog.
		$defaults['blog_title']         = esc_html__( 'Blog', 'realestate-base-pro' );
		$defaults['excerpt_length']     = 40;
		$defaults['read_more_text']     = esc_html__( 'Read More', 'realestate-base-pro' );
		$defaults['exclude_categories'] = '';

		// Author Bio.
		$defaults['author_bio_in_single']           = true;
		$defaults['author_bio_show_recent_posts']   = false;
		$defaults['author_bio_recent_posts_number'] = 3;

		// Breadcrumb.
		$defaults['breadcrumb_type'] = 'simple';

		// Font.
		$font_keys = realestate_base_get_font_family_theme_settings_options();
		if ( ! empty( $font_keys ) ) {
			foreach ( $font_keys as $k => $v ) {
				$defaults[ $k ]  = $v['default'];
			}
		}
		$defaults['reset_font_settings'] = false;

		// Slider Options.
		$defaults['featured_slider_status']              = 'home-page';
		$defaults['featured_slider_transition_effect']   = 'fadeout';
		$defaults['featured_slider_transition_delay']    = 3;
		$defaults['featured_slider_transition_duration'] = 1;
		$defaults['featured_slider_enable_caption']      = true;
		$defaults['featured_slider_caption_alignment']   = 'left';
		$defaults['featured_slider_enable_arrow']        = true;
		$defaults['featured_slider_enable_pager']        = true;
		$defaults['featured_slider_enable_autoplay']     = true;
		$defaults['featured_slider_enable_overlay']      = true;
		$defaults['featured_slider_type']                = 'demo-slider';
		$defaults['featured_slider_number']              = 3;
		$defaults['featured_slider_category']            = '';
		$defaults['featured_slider_tag']                 = '';
		$defaults['featured_slider_read_more_text']      = esc_html__( 'Read More', 'realestate-base-pro' );

		// Color.
		$colors = realestate_base_get_default_colors();
		if ( ! empty( $colors ) ) {
			foreach ( $colors as $key => $val ) {
				$defaults[ $key ] = $val;
			}
		}

		// Pass through filter.
		$defaults = apply_filters( 'realestate_base_filter_default_theme_options', $defaults );
		return $defaults;
	}

endif;
