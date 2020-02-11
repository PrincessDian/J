<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package Realestate_Base
 */

if ( ! function_exists( 'realestate_base_trigger_custom_css_action' ) ) :

	/**
	 * Do action theme custom CSS.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_trigger_custom_css_action() {

		/**
		 * Hook - realestate_base_action_theme_custom_css.
		 */
		do_action( 'realestate_base_action_theme_custom_css' );

	}

endif;

add_action( 'wp_head', 'realestate_base_trigger_custom_css_action', 99 );

if ( ! function_exists( 'realestate_base_add_theme_custom_font_css' ) ) :

	/**
	 * Add theme custom font CSS.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_add_theme_custom_font_css() {

		$custom_css = '';

		$font_settings = realestate_base_get_font_family_theme_settings_options();

		$required_fonts = array();

		if ( ! empty( $font_settings ) ) {
			foreach ( $font_settings as $key => $val ) {
				$option_value = realestate_base_get_option( $key );
				if ( ! empty( $option_value ) && $val['default'] !== $option_value ) {
					$required_fonts[ $key ] = $option_value;
				}
			}
		}
		if ( empty( $required_fonts ) ) {
			// We do not need extra CSS.
			return;
		}

		foreach ( $required_fonts as $key => $font ) {

			$family = realestate_base_get_font_family_from_key( $font );

			if ( ! empty( $family ) ) {

				switch ( $key ) {
					case 'font_site_default':
						$custom_css .= 'body{font-family:' . $family . '}' . "\n";
					break;

					case 'font_site_title':
						$custom_css .= '.site-title{font-family:' . $family . '}' . "\n";
					break;

					case 'font_site_tagline':
						$custom_css .= '.site-description{font-family:' . $family . '}' . "\n";
					break;

					case 'font_heading_tags':
						$custom_css .= 'h1,h2,h3,h4,h5,h6{font-family:' . $family . '}' . "\n";
					break;

					case 'font_content_title':
						$custom_css .= '.entry-header .entry-title{font-family:' . $family . '}' . "\n";
					break;

					case 'font_content_body':
						$custom_css .= '#content{font-family:' . $family . '}' . "\n";
					break;

					case 'font_navigation':
						$custom_css .= '.main-navigation ul li a{font-family:' . $family . '}' . "\n";
					break;

					default:
					break;
				}
			}
		}

		// Render style.
		if ( ! empty( $custom_css ) ) {
			echo '<style type="text/css">';
			echo $custom_css;
			echo '</style>';
		}

	}

endif;

add_action( 'realestate_base_action_theme_custom_css', 'realestate_base_add_theme_custom_font_css' );


if ( ! function_exists( 'realestate_base_add_theme_custom_color_css' ) ) :

	/**
	 * Add theme custom color CSS.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_add_theme_custom_color_css() {

		$custom_css = '';

		$color_settings = realestate_base_get_color_theme_settings_options();

		$default = realestate_base_get_default_colors();

		$required_colors = array();

		if ( ! empty( $color_settings ) ) {
		  foreach ($color_settings as $key => $val ) {
		    $option_value = realestate_base_get_option( $key );
		    if ( ! empty( $option_value ) && $default[$key] != $option_value ) {
		      $required_colors[ $key ] = $option_value;
		    }
		  }
		}
		if ( empty( $required_colors ) ) {
		  // We do not need extra CSS.
		  return;
		}

		foreach ( $required_colors as $key => $color ) {

			switch ( $key ) {

				// Basic.
				case 'color_basic_text':
				  $custom_css .= 'body{color:' . $color . '}' . "\n";
				  break;
				case 'color_basic_link':
				  $custom_css .= 'a,a:visited{color:' . $color . '}' . "\n";
				  $custom_css .= '#mobile-trigger i{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_basic_link_hover':
				  $custom_css .= 'a:hover{color:' . $color . '}' . "\n";
				  break;
				case 'color_basic_heading':
				  $custom_css .= 'h1,h2,h3,h4,h5,h6{color:' . $color . '}' . "\n";
				  break;

				case 'color_basic_button_text':
 				$custom_css .= '.custom-button, .custom-button:visited, .button, .button:visited, a.more-link, a.more-link:visited,a.custom-button.button-secondary:hover, a.custom-button.button-secondary:active, a.custom-button.button-secondary:focus,a.custom-button.btn-call-to-action.button-primary,.realestate-base-woocommerce ul.products li.product .button,.woocommerce #primary .button, .woocommerce #review_form #respond .form-submit input, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.header-search-box > a:hover {color:' . $color . '}' . "\n";
				 break;

				case 'color_basic_button_background':
				$custom_css .= '.custom-button, .custom-button:visited, .button, .button:visited, a.more-link, a.more-link:visited,a.custom-button.button-secondary:hover, a.custom-button.button-secondary:active, a.custom-button.button-secondary:focus,a.custom-button.btn-call-to-action.button-primary,.realestate-base-woocommerce ul.products li.product .button,.woocommerce #primary .button, .woocommerce #review_form #respond .form-submit input, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.header-search-box > a:hover{background-color:' . $color . '}' . "\n";
				  break;

				case 'color_basic_button_text_hover':
				$custom_css .= '.custom-button:hover, .custom-button:focus, .custom-button:active, a.more-link:hover, a.more-link:focus, a.more-link:active, .button:hover, .button:focus, .button:active,.custom-button.button-secondary:visited,.custom-button.button-secondary,a.custom-button.btn-call-to-action.button-primary:hover, a.custom-button.btn-call-to-action.button-primary:active, a.custom-button.btn-call-to-action.button-primary:focus,.realestate-base-woocommerce ul.products li.product .button:hover,.realestate_base_widget_portfolio .portfolio-filter a:hover, .realestate_base_widget_portfolio .portfolio-filter a.current,.woocommerce #primary .button:hover, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.header-search-box > a{color:' . $color . '}' . "\n";
				  break;


				case 'color_basic_button_background_hover':
				$custom_css .= '.custom-button:hover, .custom-button:focus, .custom-button:active, a.more-link:hover, a.more-link:focus, a.more-link:active, .button:hover, .button:focus, .button:active,.custom-button.button-secondary:visited,.custom-button.button-secondary,a.custom-button.btn-call-to-action.button-primary:hover, a.custom-button.btn-call-to-action.button-primary:active, a.custom-button.btn-call-to-action.button-primary:focus,.realestate-base-woocommerce ul.products li.product .button:hover,.realestate_base_widget_portfolio .portfolio-filter a:hover, .realestate_base_widget_portfolio .portfolio-filter a.current,.woocommerce #primary .button:hover, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.header-search-box > a{background-color:' . $color . '}' . "\n";
				  break;

				// Top Header.
				case 'color_top_header_background':
				  $custom_css .= '#tophead {background-color:' . $color . '}' . "\n";
				  break;
				case 'color_top_header_icon':
				  $custom_css .= '.header-social-wrapper .realestate_base_widget_social li a::before,#quick-contact li::before{color:' . $color . '}' . "\n";
				  break;
				case 'color_top_header_text':
				  $custom_css .= '#tophead,#quick-contact li{color:' . $color . '}' . "\n";
				break;
				case 'color_top_header_link':
				  $custom_css .= '#tophead a{color:' . $color . '}' . "\n";
				break;
				  case 'color_top_header_link_hover':
				$custom_css .= '#tophead a:hover{color:' . $color . '}' . "\n";
				break;

				// Header.
				case 'color_header_background':
				  $custom_css .= '#masthead {background-color:' . $color . '}' . "\n";
				  break;
				case 'color_header_title':
				  $custom_css .= '#site-identity .site-title > a{color:' . $color . '}' . "\n";
		        break;
				case 'color_header_title_hover':
				  $custom_css .= '#site-identity .site-title > a:hover{color:' . $color . '}' . "\n";
				  break;
				case 'color_header_tagline':
				  $custom_css .= '.site-description,.home.header-overlap-on .site-header .site-description{color:' . $color . '}' . "\n";
				  break;

			   // Primary Menu.
				case 'color_primary_menu_link':
				  $custom_css .= '#main-nav ul li a,.dropdown-toggle::after,.header-search-box > a, .home.header-overlap-on .site-header .header-search-box > a{color:' . $color . '}' . "\n";
				  break;
				case 'color_primary_menu_link_hover':
				  $custom_css .= '#main-nav ul li a:hover,#main-nav li.current-menu-item > a,
				  #main-nav li.current_page_item > a,#main-nav ul li:hover > a,.header-search-box > a:hover,.home.header-overlap-on .site-header .header-search-box > a:hover{color:' . $color . '}' . "\n";
				  $custom_css .= '.main-navigation li > a:hover, .main-navigation li.current-menu-item > a, .main-navigation li.current_page_item > a, .main-navigation li:hover > a{border-color:' . $color . '}' . "\n";
				  break;
				case 'color_primary_submenu_background':
				    $custom_css .= '.main-navigation ul ul{background-color:' . $color . '}' . "\n";
				    break;

				// Top Header.
				case 'color_top_header_background':
				  $custom_css .= '#tophead {background-color:' . $color . '}' . "\n";
				  break;
				case 'color_top_header_icon':
				  $custom_css .= '.header-social-wrapper .realestate_base_widget_social li a::before,#quick-contact li::before{color:' . $color . '}' . "\n";
				  break;
				case 'color_top_header_text':
				  $custom_css .= '#tophead,#quick-contact li{color:' . $color . '}' . "\n";
				break;
				case 'color_top_header_link':
				  $custom_css .= '#tophead a{color:' . $color . '}' . "\n";
				break;
				  case 'color_top_header_link_hover':
				$custom_css .= '#tophead a:hover{color:' . $color . '}' . "\n";
				break;

				// Custom Header
				case 'color_page_header_background':
				  $custom_css .= '#custom-header{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_page_header_title':
				  $custom_css .= '#custom-header .page-title{color:' . $color . '}' . "\n";
				  break;

				// Slider.
				case 'color_slider_overlay':
				  $custom_css .= '#featured-slider .overlay-enabled .cycle-slide::after,#custom-header::after,#featured-slider .overlay-disabled .cycle-caption::after{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_slider_caption_text':
				  $custom_css .= '#main-slider p{color:' . $color . '}' . "\n";
				  break;
				case 'color_slider_caption_link':
				  $custom_css .= '#main-slider h3 a{color:' . $color . '}' . "\n";
				  break;
				case 'color_slider_caption_link_hover':
				  $custom_css .= '#main-slider  h3 a:hover{color:' . $color . '}' . "\n";
				  break;

				case 'color_slider_icon':
				  $custom_css .= '#main-slider .cycle-prev, #main-slider .cycle-next{color:' . $color . '}' . "\n";
				  break;

				case 'color_slider_icon_hover':
				  $custom_css .= '#main-slider .cycle-prev:hover, #main-slider .cycle-next:hover{color:' . $color . '}' . "\n";
				  break;

				case 'color_slider_icon_background':
				  $custom_css .= '#main-slider .cycle-prev, #main-slider .cycle-next{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_slider_icon_background_hover':
				  $custom_css .= '#main-slider .cycle-prev:hover, #main-slider .cycle-next:hover{background-color:' . $color . '}' . "\n";
				   $custom_css .= '#main-slider .cycle-prev:hover, #main-slider .cycle-next:hover{border-color:' . $color . '}' . "\n";
				  break;

				  // Slider pager
				case 'color_slider_pager':
				  $custom_css .= '#main-slider .pager-box{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_slider_pager_active':
				  $custom_css .= '#main-slider .pager-box:hover,#main-slider .pager-box.cycle-pager-active{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_slider_button':
				  $custom_css .= '#main-slider .slider-buttons a,
				  #main-slider a.custom-button.slider-button.button-secondary:hover{color:' . $color . '}' . "\n";
				  break;
				case 'color_slider_button_hover':
				  $custom_css .= '#main-slider .slider-buttons a:hover,#main-slider .slider-buttons a.custom-button.button-secondary{color:' . $color . '}' . "\n";
				  break;
				case 'color_slider_button_background':
				  $custom_css .= '#main-slider .slider-buttons a,#main-slider .slider-buttons a.custom-button.button-secondary:hover{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_slider_button_background_hover':
				  $custom_css .= '#main-slider .slider-buttons a:hover,#main-slider .slider-buttons a.custom-button.button-secondary{background-color:' . $color . '}' . "\n";

				  break;

				// Content.
				case 'color_content_background':
				  $custom_css .= '#content{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_content_title':
				  $custom_css .= '#primary .entry-title,#primary .entry-title a{color:' . $color . '}' . "\n";
				  break;
				case 'color_content_title_link_hover':
				  $custom_css .= '#primary .entry-title a:hover{color:' . $color . '}' . "\n";
				  break;

				case 'color_content_text':
				  $custom_css .= '#primary {color:' . $color . '}' . "\n";
				  break;
				case 'color_content_link':
				  $custom_css .= '#primary a,.comment-author.vcard{color:' . $color . '}' . "\n";
				  break;
				case 'color_content_link_hover':
				  $custom_css .= '#primary  a:hover{color:' . $color . '}' . "\n";
				  break;
				case 'color_content_meta_link':
				  $custom_css .= '#primary .entry-meta > span a,#primary .entry-footer > span a{color:' . $color . '}' . "\n";
				  break;
				case 'color_content_meta_link_hover':
				  $custom_css .= '#primary .entry-meta > span a:hover,#primary  .entry-footer > span a:hover{color:' . $color . '}' . "\n";
				  break;
				case 'color_content_meta_icon':
				  $custom_css .= '#primary .entry-meta > span::before,#content  .entry-footer > span::before{color:' . $color . '}' . "\n";
				  break;

				// Sidebar.
				case 'color_sidebar_title_background':
				  $custom_css .= '.sidebar .widget-title{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_sidebar_title':
				  $custom_css .= '.sidebar .widget-title,.widget_calendar caption{color:' . $color . '}' . "\n";
				  break;
				case 'color_sidebar_text':
				  $custom_css .= '.sidebar, .sidebar p{color:' . $color . '}' . "\n";
				  break;
				case 'color_sidebar_link':
				  $custom_css .= '.sidebar .widget a{color:' . $color . '}' . "\n";
				  $custom_css .= '.realestate_base_widget_quick_contact .contact-info-wrapper::before{background-color:' . $color . '}' . "\n";

				  break;
				case 'color_sidebar_link_hover':
				  $custom_css .= '.sidebar .widget a:hover{color:' . $color . '}' . "\n";
				  break;
				case 'color_sidebar_list_icon':
				  $custom_css .= '.sidebar ul li::after{color:' . $color . '}' . "\n";
				  break;

				// Breadcrumb.
				case 'color_breadcrumb_link':
				  $custom_css .= '#crumbs a,#breadcrumb a{color:' . $color . '}' . "\n";
				  break;
				case 'color_breadcrumb_link_hover':
				  $custom_css .= '#crumbs a:hover,#breadcrumb a:hover{color:' . $color . '}' . "\n";
				  break;
				case 'color_breadcrumb_text':
				  $custom_css .= '#breadcrumb,#breadcrumb .breadcrumb-trail li::after, #crumbs li::after{color:' . $color . '}' . "\n";
				  break;

				// Footer area.
				case 'color_footer_area_background':
				  $custom_css .= '#colophon{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_footer_area_text':
				  $custom_css .= '#colophon{color:' . $color . '}' . "\n";
				  break;
				case 'color_footer_area_link':
				  $custom_css .= '#colophon a{color:' . $color . '}' . "\n";
				  break;
				case 'color_footer_area_link_hover':
				  $custom_css .= '#colophon a:hover{color:' . $color . '}' . "\n";
				  break;

				// Go To Top.
			    case 'color_goto_top_icon':
				  $custom_css .= '#btn-scrollup i.fa{color:' . $color . '}' . "\n";
				  break;
				case 'color_goto_top_icon_hover':
				  $custom_css .= '#btn-scrollup i.fa:hover{color:' . $color . '}' . "\n";
				  break;
				case 'color_goto_top_background':
				  $custom_css .= '#btn-scrollup{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_goto_top_background_hover':
				  $custom_css .= '#btn-scrollup:hover{background-color:' . $color . '}' . "\n";
				  break;


				// Pagination.
				case 'color_pagination_link':
				  $custom_css .= '#primary .navigation.pagination .nav-links .page-numbers,
					#primary .navigation.pagination .nav-links a.page-numbers,#primary .post-navigation a, .posts-navigation a{color:' . $color . '}' . "\n";
				  break;
				case 'color_pagination_link_hover':
				  $custom_css .= '#primary .navigation.pagination .nav-links .page-numbers.current,
					#primary .navigation.pagination .nav-links a.page-numbers:hover,#primary .post-navigation a:hover,#primary  .posts-navigation a:hover {color:' . $color . '}' . "\n";
				  break;
				case 'color_pagination_link_background':
				  $custom_css .= '#primary .navigation.pagination .nav-links .page-numbers,
					.navigation.pagination .nav-links a.page-numbers,#primary .post-navigation a, #primary .posts-navigation a{background-color:' . $color . '}' . "\n";
					$custom_css .= '#primary .post-navigation a,#primary  .posts-navigation a{border-color:' . $color . '}' . "\n";
				  break;
				case 'color_pagination_link_background_hover':
				  $custom_css .= '#primary .navigation.pagination .nav-links .page-numbers.current,
					#primary .navigation.pagination .nav-links a.page-numbers:hover,#primary .post-navigation a:hover,#primary  .posts-navigation a:hover {background-color:' . $color . '}' . "\n";
					$custom_css .= '#primary .post-navigation a:hover,#primary  .posts-navigation a:hover{border-color:' . $color . '}' . "\n";
				  break;



				// Footer Widgets.
				case 'color_footer_widgets_background':
				  $custom_css .= '#footer-widgets{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_footer_widgets_title':
				  $custom_css .= '#footer-widgets .widget-title{color:' . $color . '}' . "\n";
				  break;
				case 'color_footer_widgets_separator':
				  $custom_css .= '#footer-widgets .widget-title::after{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_footer_widgets_text':
				  $custom_css .= '#footer-widgets {color:' . $color . '}' . "\n";
				  break;
				case 'color_footer_widgets_link':
				  $custom_css .= '#footer-widgets a{color:' . $color . '}' . "\n";
				  $custom_css .= '#footer-widgets h3.widget-title::after,.realestate_base_widget_quick_contact .contact-info-wrapper::before{background-color:' . $color . '}' . "\n";
				break;

				case 'color_footer_widgets_link_hover':
				  $custom_css .= '#footer-widgets a:hover{color:' . $color . '}' . "\n";
				  break;

				// Home Page Widgets.
				case 'color_home_widgets_background':
				  $custom_css .= '#sidebar-front-page-widget-area .widget{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_home_widgets_title':
				  $custom_css .= '#sidebar-front-page-widget-area .widget-title{color:' . $color . '}' . "\n";
				  break;
				case 'color_home_widgets_subtitle':
				  $custom_css .= '#sidebar-front-page-widget-area .widget-subtitle{color:' . $color . '}' . "\n";
				  break;
				case 'color_home_widgets_separator':
				  $custom_css .= '#sidebar-front-page-widget-area .widget-title::after,#sidebar-front-page-widget-area .widget-title::before{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_home_widgets_text':
				  $custom_css .= '#sidebar-front-page-widget-area,#sidebar-front-page-widget-area p{color:' . $color . '}' . "\n";
				  break;
				case 'color_home_widgets_link':
				  $custom_css .= '#sidebar-front-page-widget-area a{color:' . $color . '}' . "\n";
				  $custom_css .= '#sidebar-front-page-widget-area .realestate_base_widget_services .service-block-item a.service-icon:hover,#sidebar-front-page-widget-area,.realestate_base_widget_latest_news .latest-news-date{background-color:' . $color . '}' . "\n";

				   $custom_css .= '#sidebar-front-page-widget-area .realestate_base_widget_call_to_action{background-color:' . $color . '}' . "\n";
				  break;
				case 'color_home_widgets_link_hover':
				  $custom_css .= '#sidebar-front-page-widget-area a:hover{color:' . $color . '}' . "\n";
				  break;

			  default:
			    break;

			}

		}

		// Render style.
		if ( ! empty( $custom_css ) ) {
		  echo '<style type="text/css">';
		  echo $custom_css;
		  echo '</style>';
		}

	}

endif;

add_action( 'realestate_base_action_theme_custom_css', 'realestate_base_add_theme_custom_color_css', 25 );
