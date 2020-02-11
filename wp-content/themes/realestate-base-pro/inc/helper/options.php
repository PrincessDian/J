<?php
/**
 * Helper functions related to customizer and options.
 *
 * @package Realestate_Base
 */

if ( ! function_exists( 'realestate_base_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_global_layout_options() {

		$choices = array(
			'left-sidebar'            => esc_html__( 'Primary Sidebar - Content', 'realestate-base-pro' ),
			'right-sidebar'           => esc_html__( 'Content - Primary Sidebar', 'realestate-base-pro' ),
			'three-columns'           => esc_html__( 'Three Columns ( Secondary - Content - Primary )', 'realestate-base-pro' ),
			'three-columns-pcs'       => esc_html__( 'Three Columns ( Primary - Content - Secondary )', 'realestate-base-pro' ),
			'three-columns-cps'       => esc_html__( 'Three Columns ( Content - Primary - Secondary )', 'realestate-base-pro' ),
			'three-columns-psc'       => esc_html__( 'Three Columns ( Primary - Secondary - Content )', 'realestate-base-pro' ),
			'three-columns-pcs-equal' => esc_html__( 'Three Columns ( Equal Primary - Content - Secondary )', 'realestate-base-pro' ),
			'three-columns-scp-equal' => esc_html__( 'Three Columns ( Equal Secondary - Content - Primary )', 'realestate-base-pro' ),
			'no-sidebar'              => esc_html__( 'No Sidebar', 'realestate-base-pro' ),
		);
		$output = apply_filters( 'realestate_base_filter_layout_options', $choices );
		return $output;

	}

endif;

if ( ! function_exists( 'realestate_base_get_pagination_type_options' ) ) :

	/**
	 * Returns pagination type options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_pagination_type_options() {

		$choices = array(
			'default'               => esc_html__( 'Default (Older / Newer Post)', 'realestate-base-pro' ),
			'numeric'               => esc_html__( 'Numeric', 'realestate-base-pro' ),
			'infinite-scroll'       => esc_html__( 'Infinite Scroll - Scroll', 'realestate-base-pro' ),
			'infinite-scroll-click' => esc_html__( 'Infinite Scroll - Click', 'realestate-base-pro' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'realestate_base_get_breadcrumb_type_options' ) ) :

	/**
	 * Returns breadcrumb type options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_breadcrumb_type_options() {

		$choices = array(
			'disabled' => esc_html__( 'Disabled', 'realestate-base-pro' ),
			'simple'   => esc_html__( 'Enabled', 'realestate-base-pro' ),
		);
		return $choices;

	}

endif;


if ( ! function_exists( 'realestate_base_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_archive_layout_options() {

		$choices = array(
			'full'    => esc_html__( 'Full Post', 'realestate-base-pro' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'realestate-base-pro' ),
		);
		$output = apply_filters( 'realestate_base_filter_archive_layout_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'realestate_base_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable True for adding No Image option.
	 * @param array $allowed Allowed image size options.
	 * @return array Image size options.
	 */
	function realestate_base_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;
		$get_intermediate_image_sizes = get_intermediate_image_sizes();
		$choices = array();
		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'realestate-base-pro' );
		}
		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'realestate-base-pro' );
		$choices['medium']    = esc_html__( 'Medium', 'realestate-base-pro' );
		$choices['large']     = esc_html__( 'Large', 'realestate-base-pro' );
		$choices['full']      = esc_html__( 'Full (original)', 'realestate-base-pro' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ) {
					$choices[ $key ] .= ' (' . $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;

if ( ! function_exists( 'realestate_base_get_image_alignment_options' ) ) :

	/**
	 * Returns image alignment options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_image_alignment_options() {

		$choices = array(
			'none'   => esc_html_x( 'None', 'alignment', 'realestate-base-pro' ),
			'left'   => esc_html_x( 'Left', 'alignment', 'realestate-base-pro' ),
			'center' => esc_html_x( 'Center', 'alignment', 'realestate-base-pro' ),
			'right'  => esc_html_x( 'Right', 'alignment', 'realestate-base-pro' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'realestate_base_get_slider_caption_alignment_options' ) ) :

	/**
	 * Returns slider caption alignment options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_slider_caption_alignment_options() {

		$choices = array(
			'left'   => esc_html_x( 'Left', 'alignment', 'realestate-base-pro' ),
			'center' => esc_html_x( 'Center', 'alignment', 'realestate-base-pro' ),
			'right'  => esc_html_x( 'Right', 'alignment', 'realestate-base-pro' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'realestate_base_get_featured_slider_transition_effects' ) ) :

	/**
	 * Returns the featured slider transition effects.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_featured_slider_transition_effects() {

		$choices = array(
			'fade'       => _x( 'fade', 'transition effect', 'realestate-base-pro' ),
			'fadeout'    => _x( 'fadeout', 'transition effect', 'realestate-base-pro' ),
			'none'       => _x( 'none', 'transition effect', 'realestate-base-pro' ),
			'scrollHorz' => _x( 'scrollHorz', 'transition effect', 'realestate-base-pro' ),
			'tileSlide'  => _x( 'tileSlide', 'transition effect', 'realestate-base-pro' ),
			'tileBlind'  => _x( 'tileBlind', 'transition effect', 'realestate-base-pro' ),
			'flipHorz'   => _x( 'flipHorz', 'transition effect', 'realestate-base-pro' ),
			'flipVert'   => _x( 'flipVert', 'transition effect', 'realestate-base-pro' ),
			'shuffle'    => _x( 'shuffle', 'transition effect', 'realestate-base-pro' ),
		);
		$output = apply_filters( 'realestate_base_filter_featured_slider_transition_effects', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'realestate_base_get_featured_slider_content_options' ) ) :

	/**
	 * Returns the featured slider content options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_featured_slider_content_options() {

		$choices = array(
			'home-page' => esc_html__( 'Static Front Page Only', 'realestate-base-pro' ),
			'disabled'  => esc_html__( 'Disabled', 'realestate-base-pro' ),
		);
		$output = apply_filters( 'realestate_base_filter_featured_slider_content_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'realestate_base_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_featured_slider_type() {

		$choices = array(
			'featured-page'     => __( 'Featured Pages', 'realestate-base-pro' ),
			'featured-category' => __( 'Featured Category', 'realestate-base-pro' ),
			'featured-post'     => __( 'Featured Posts', 'realestate-base-pro' ),
			'featured-image'    => __( 'Featured Images', 'realestate-base-pro' ),
			'featured-tag'      => __( 'Featured Tag', 'realestate-base-pro' ),
			'demo-slider'       => __( 'Demo Slider', 'realestate-base-pro' ),
		);
		$output = apply_filters( 'realestate_base_filter_featured_slider_type', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'realestate_base_get_featured_content_status_options' ) ) :

	/**
	 * Returns the featured content options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_featured_content_status_options() {

		$choices = array(
			'home-page' => esc_html__( 'Home Page Only', 'realestate-base-pro' ),
			'disabled'  => esc_html__( 'Disabled', 'realestate-base-pro' ),
		);
		$output = apply_filters( 'realestate_base_filter_featured_content_status_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'realestate_base_get_featured_content_type' ) ) :

	/**
	 * Returns the featured content type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_featured_content_type() {

		$choices = array(
			'featured-page' => esc_html__( 'Featured Pages', 'realestate-base-pro' ),
			'featured-post' => esc_html__( 'Featured Posts', 'realestate-base-pro' ),
			'demo-content'  => esc_html__( 'Demo Content', 'realestate-base-pro' ),
		);
		$output = apply_filters( 'realestate_base_filter_featured_content_type', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if( ! function_exists( 'realestate_base_get_customizer_font_options' ) ) :

	/**
	 * Returns customizer font options.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_get_customizer_font_options(){

		$web_fonts = realestate_base_get_web_fonts();
		$os_fonts  = realestate_base_get_os_fonts();

		$web_fonts = array_merge( $web_fonts, $os_fonts );

		if ( ! empty( $web_fonts ) ) {
			ksort( $web_fonts );
		}

		$choices = array();

		if ( ! empty( $web_fonts ) ) {
			foreach ( $web_fonts as $k => $v ) {
				$choices[$k] = esc_html( $v['label'] );
			}
		}
		return $choices;

	}

endif;

if( ! function_exists( 'realestate_base_get_web_fonts' ) ) :

	/**
	 * Returns web font options.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_get_web_fonts(){

		$choices = array(
			'philosopher' => array(
				'name'  => 'Philosopher',
				'label' => "'Philosopher', sans-serif",
				),
			'open-sans' => array(
				'name'  => 'Open Sans',
				'label' => "'Open Sans', sans-serif",
				),
			'pt-sans' => array(
				'name'  => 'PT Sans',
				'label' => "'PT Sans', sans-serif",
				),
			'merriweather-sans' => array(
				'name'  => 'Merriweather Sans',
				'label' => "'Merriweather Sans', sans-serif",
				),
			'montserrat' => array(
				'name'  => 'Montserrat',
				'label' => "'Montserrat', sans-serif",
				),
			'roboto' => array(
				'name'  => 'Roboto',
				'label' => "'Roboto', sans-serif",
				),
			'arizonia' => array(
				'name'  => 'Arizonia',
				'label' => "'Arizonia', cursive",
				),
			'raleway' => array(
				'name'  => 'Raleway',
				'label' => "'Raleway', sans-serif",
				),
			'droid-sans' => array(
				'name'  => 'Droid Sans',
				'label' => "'Droid Sans', sans-serif",
				),
			'poppins' => array(
				'name'  => 'Poppins',
				'label' => "'Poppins', sans-serif",
				),
			'lato' => array(
				'name'  => 'Lato',
				'label' => "'Lato', sans-serif",
				),
			'dosis' => array(
				'name'  => 'Dosis',
				'label' => "'Dosis', sans-serif",
				),
			'slabo-27px' => array(
				'name'  => 'Slabo 27px',
				'label' => "'Slabo 27px', serif",
				),
			'oswald' => array(
				'name'  => 'Oswald',
				'label' => "'Oswald', sans-serif",
				),
			'pt-sans-narrow' => array(
				'name'  => 'PT Sans Narrow',
				'label' => "'PT Sans Narrow', sans-serif",
				),
			'josefin-slab' => array(
				'name'  => 'Josefin Slab',
				'label' => "'Josefin Slab', serif",
				),
			'alegreya' => array(
				'name'  => 'Alegreya',
				'label' => "'Alegreya', serif",
				),
			'old-standard-tt' => array(
				'name'  => 'Old Standard TT',
				'label' => "'Old Standard TT', serif",
				),
			'exo' => array(
				'name'  => 'Exo',
				'label' => "'Exo', sans-serif",
				),
			'signika' => array(
				'name'  => 'Signika',
				'label' => "'Signika', sans-serif",
				),
			'lobster' => array(
				'name'  => 'Lobster',
				'label' => "'Lobster', cursive",
				),
			'indie-flower' => array(
				'name'  => 'Indie Flower',
				'label' => "'Indie Flower', cursive",
				),
			'shadows-into-light' => array(
				'name'  => 'Shadows Into Light',
				'label' => "'Shadows Into Light', cursive",
				),
			'kaushan-script' => array(
				'name'  => 'Kaushan Script',
				'label' => "'Kaushan Script', cursive",
				),
			'dancing-script' => array(
				'name'  => 'Dancing Script',
				'label' => "'Dancing Script', cursive",
				),
			'fredericka-the-great' => array(
				'name'  => 'Fredericka the Great',
				'label' => "'Fredericka the Great', cursive",
				),
			'covered-by-your-grace' => array(
				'name'  => 'Covered By Your Grace',
				'label' => "'Covered By Your Grace', cursive",
				),
			);
		$choices = apply_filters( 'realestate_base_filter_web_fonts', $choices );

		if ( ! empty( $choices ) ) {
			ksort( $choices );
		}

		return $choices;

	}

endif;

if( ! function_exists( 'realestate_base_get_os_fonts' ) ) :

	/**
	 * Returns OS font options.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_get_os_fonts(){

		$choices = array(
			'arial' => array(
				'name'  => 'Arial',
				'label' => "'Arial', sans-serif",
				),
			'georgia' => array(
				'name'  => 'Georgia',
				'label' => "'Georgia', serif",
				),
			'cambria' => array(
				'name'  => 'Cambria',
				'label' => "'Cambria', Georgia, serif",
				),
			'tahoma' => array(
				'name'  => 'Tahoma',
				'label' => "'Tahoma', Geneva, sans-serif",
				),
			'sans-serif' => array(
				'name'  => 'Sans Serif',
				'label' => "'Sans Serif', Arial",
				),
			'verdana' => array(
				'name'  => 'Verdana',
				'label' => "'Verdana', Geneva, sans-serif",
				),
			);
		$choices = apply_filters( 'realestate_base_filter_os_fonts', $choices );

		if ( ! empty( $choices ) ) {
			ksort( $choices );
		}
		return $choices;

	}

endif;

if( ! function_exists( 'realestate_base_get_font_family_from_key' ) ) :

	/**
	 * Return font family from font slug.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Font slug.
	 * @return string Font name.
	 */
	function realestate_base_get_font_family_from_key( $key ){

		$output = '';

		$web_fonts = realestate_base_get_web_fonts();
		$os_fonts  = realestate_base_get_os_fonts();

		$fonts = array_merge( $web_fonts, $os_fonts );

		if ( isset( $fonts[ $key ] ) ) {
			$output = $fonts[ $key ]['label'];
		}
		return $output;

	}

endif;

if( ! function_exists( 'realestate_base_get_font_family_theme_settings_options' ) ) :

	/**
	 * Returns font family theme settings options.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_get_font_family_theme_settings_options(){

		$choices = array(
			'font_site_title' => array(
				'label'   => __( 'Site Title', 'realestate-base-pro' ),
				'default' => 'old-standard-tt',
				),
			'font_site_tagline' => array(
				'label'   => __( 'Site Tagline', 'realestate-base-pro' ),
				'default' => 'poppins',
				),
			'font_site_default' => array(
				'label'   => __( 'Default', 'realestate-base-pro' ),
				'default' => 'poppins',
				),

			'font_content_title' => array(
				'label'   => __( 'Content Title', 'realestate-base-pro' ),
				'default' => 'old-standard-tt',
				),
			'font_content_body' => array(
				'label'   => __( 'Content Body', 'realestate-base-pro' ),
				'default' => 'poppins',
				),
			'font_heading_tags' => array(
				'label'   => __( 'Heading Tags', 'realestate-base-pro' ),
				'default' => 'old-standard-tt',
				),
			'font_navigation' => array(
				'label'   => __( 'Navigation', 'realestate-base-pro' ),
				'default' => 'poppins',
				),
			);
		return $choices;

	}

endif;

if( ! function_exists( 'realestate_base_get_default_colors' ) ) :

  /**
   * Returns default colors.
   *
   * @since 1.0.0
   *
   * @param string $scheme Color scheme.
   * @return array Color values based on scheme.
   */
	function realestate_base_get_default_colors( $scheme = 'default' ){

		$output = array();

		switch ( $scheme ) {

			case 'default':
			default:
			$output = array(
				// Basic.
				'color_basic_text'                    => '#888888',
				'color_basic_link'                    => '#232323',
				'color_basic_link_hover'              => '#bf9410',
				'color_basic_heading'                 => '#888888',
				'color_basic_button_background'       => '#32506d',
				'color_basic_button_text'             => '#ffffff',
				'color_basic_button_background_hover' => '#bf9410',
				'color_basic_button_text_hover'       => '#ffffff',

				// Top Header.
				'color_top_header_background'                    	 => '#f0f0f0',
				'color_top_header_icon'                        		 => '#bf9410',
				'color_top_header_text'                       		 => '#888888',
				'color_top_header_link'                       		 => '#232323',
				'color_top_header_link_hover'                        => '#bf9410',

				// Header.
				'color_header_background'                     => '#ffffff',
				'color_header_title'                          => '#232323',
				'color_header_title_hover'                    => '#bf9410',
				'color_header_tagline'                        => '#4d4d4d',

				// Primary Menu.
				'color_primary_menu_link'                => '#232323',
				'color_primary_menu_link_hover'          => '#bf9410',
				'color_primary_submenu_background'       => '#ffffff',

				// Slider.
				'color_slider_overlay'                 => '#000000',
				'color_slider_caption_text'            => '#ffffff',
				'color_slider_caption_link'            => '#ffffff',
				'color_slider_caption_link_hover'      => '#ffffff',
				'color_slider_icon'                    => '#ffffff',
				'color_slider_icon_hover'              => '#ffffff',
				'color_slider_icon_background'         => '#000000',
				'color_slider_icon_background_hover'   => '#bf9410',
				'color_slider_pager'                   => '#ffffff',
				'color_slider_pager_active'            => '#bf9410',
				'color_slider_button'                  => '#ffffff',
				'color_slider_button_hover'            => '#ffffff',
				'color_slider_button_background'       => '#32506d',
				'color_slider_button_background_hover' => '#bf9410',

				// Content.
				'color_content_background'     			    => '#ffffff',
				'color_content_title'                       => '#888888',
				'color_content_title_link_hover'            => '#888888',
				'color_content_text'            			=> '#888888',
				'color_content_link'            			=> '#232323',
				'color_content_link_hover'      			=> '#bf9410',
				'color_content_meta_link'       			=> '#49616b',
				'color_content_meta_link_hover' 			=> '#bf9410',
				'color_content_meta_icon'       			=> '#888888',

				// Breadcrumb.
				'color_breadcrumb_link'       => '#222222',
				'color_breadcrumb_link_hover' => '#ffffff',
				'color_breadcrumb_text'       => '#ffffff',

				// Sidebar.
				'color_sidebar_title'                 => '#232323',
				'color_sidebar_title_background'      => '#232323',
				'color_sidebar_link'                  => '#001837',
				'color_sidebar_link_hover'            => '#bf9410',
				'color_sidebar_list_icon'             => '#888888',

				// Home Page Widgets.
				'color_home_widgets_background' => '#ffffff',
				'color_home_widgets_title'      => '#232323',
				'color_home_widgets_subtitle'   => '#898989',
				'color_home_widgets_separator'  => '#bf9410',
				'color_home_widgets_text'       => '#888888',
				'color_home_widgets_link'       => '#232323',
				'color_home_widgets_link_hover' => '#bf9410',

				// Footer Widgets.
				'color_footer_widgets_background' => '#32506d',
				'color_footer_widgets_title'      => '#ffffff',
				'color_footer_widgets_separator'   => '#49616b',
				'color_footer_widgets_text'       => '#dddddd',
				'color_footer_widgets_link'       => '#dddddd',
				'color_footer_widgets_link_hover' => '#ffffff',


				// Footer area.
				'color_footer_area_background' => '#1d3c5a',
				'color_footer_area_text'       => '#ffffff',
				'color_footer_area_link'       => '#bf9410',
				'color_footer_area_link_hover' => '#ffffff',

				// Go To Top.
				'color_goto_top_icon'             => '#ffffff',
				'color_goto_top_icon_hover'       => '#ffffff',
				'color_goto_top_background'       => '#bf9410',
				'color_goto_top_background_hover' => '#bf9410',

				// Pagination.
				'color_pagination_link'                  => '#232323',
				'color_pagination_link_hover'            => '#ffffff',
				'color_pagination_link_background'       => '#f7f7f7',
				'color_pagination_link_background_hover' => '#bf9410',

				// page_header.
				'color_page_header_background' => '#32506d',
				'color_page_header_title'      => '#ffffff',



			);
			break;

		} // End switch.

	return $output;

	}

endif;


if( ! function_exists( 'realestate_base_get_color_theme_settings_options' ) ) :

  /**
   * Returns color theme settings options.
   *
   * @since 1.0.0
   */
  function realestate_base_get_color_theme_settings_options(){

  	$choices = array(

		// Basic.
  		'color_basic_text' => array(
  			'label'   => __( 'Text Color', 'realestate-base-pro' ),
  			'section' => 'color_section_basic',
  			),
  		'color_basic_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_basic',
  			),
  		'color_basic_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_basic',
  			),
  		'color_basic_heading' => array(
  			'label'   => __( 'Heading Color', 'realestate-base-pro' ),
  			'section' => 'color_section_basic',
  			),

  		'color_basic_button_text' => array(
  			'label'   => __( 'Button Text Color', 'realestate-base-pro' ),
  			'section' => 'color_section_basic',
  			),
  		'color_basic_button_background' => array(
  			'label'   => __( 'Button Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_basic',
  			),
  		'color_basic_button_text_hover' => array(
  			'label'   => __( 'Button Text Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_basic',
  			),
  		'color_basic_button_background_hover' => array(
  			'label'   => __( 'Button Background Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_basic',
  			),

  		// Top Header.
  		'color_top_header_background' => array(
  			'label'   => __( 'Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_top_header',
  			),

  		'color_top_header_icon' => array(
  			'label'   => __( 'Icon Color', 'realestate-base-pro' ),
  			'section' => 'color_section_top_header',
  		),
  		'color_top_header_text' => array(
  			'label'   => __( 'Text Color', 'realestate-base-pro' ),
  			'section' => 'color_section_top_header',
  		),
  		'color_top_header_link' => array(
  			'label'   => __( 'Links Color', 'realestate-base-pro' ),
  			'section' => 'color_section_top_header',
  		),
		'color_top_header_link_hover' => array(
  			'label'   => __( 'Links Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_top_header',
  		),

		// Header.
  		'color_header_background' => array(
  			'label'   => __( 'Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_header',
  			),
  		'color_header_title' => array(
  			'label'   => __( 'Site Title Color', 'realestate-base-pro' ),
  			'section' => 'color_section_header',
  			),
  		'color_header_title_hover' => array(
  			'label'   => __( 'Site Title Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_header',
  			),
  		'color_header_tagline' => array(
  			'label'   => __( 'Site Tagline Color', 'realestate-base-pro' ),
  			'section' => 'color_section_header',
  			),

		// Primary Menu.
  		'color_primary_menu_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_primary_menu',
  			),
  		'color_primary_menu_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_primary_menu',
  			),
  		'color_primary_submenu_background' => array(
  			'label'   => __( 'Submenu Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_primary_menu',
  			),


		// Content.
  		'color_content_background' => array(
  			'label'   => __( 'Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_content',
  			),
  		'color_content_title' => array(
  			'label'   => __( 'Title Color', 'realestate-base-pro' ),
  			'section' => 'color_section_content',
  			),
  		'color_content_title_link_hover' => array(
  			'label'   => __( 'Title Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_content',
  			),
  		'color_content_text' => array(
  			'label'   => __( 'Text Color', 'realestate-base-pro' ),
  			'section' => 'color_section_content',
  			),
  		'color_content_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_content',
  			),
  		'color_content_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_content',
  			),
  		'color_content_meta_link' => array(
  			'label'   => __( 'Meta Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_content',
  			),
  		'color_content_meta_link_hover' => array(
  			'label'   => __( 'Meta Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_content',
  			),
  		'color_content_meta_icon' => array(
  			'label'   => __( 'Meta Icon Color', 'realestate-base-pro' ),
  			'section' => 'color_section_content',
  			),
		// Breadcrumb.
  		'color_breadcrumb_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_breadcrumb',
  			),
  		'color_breadcrumb_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_breadcrumb',
  			),
  		'color_breadcrumb_text' => array(
  			'label'   => __( 'Text Color', 'realestate-base-pro' ),
  			'section' => 'color_section_breadcrumb',
  			),
		// Slider.
  		'color_slider_overlay' => array(
			'label'   => __( 'Overlay Color', 'realestate-base-pro' ),
			'section' => 'color_section_slider',
  			),
  		'color_slider_caption_text' => array(
  			'label'   => __( 'Caption Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_caption_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_caption_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_icon' => array(
  			'label'   => __( 'Icon Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_icon_hover' => array(
  			'label'   => __( 'Icon Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_icon_background' => array(
  			'label'   => __( 'Icon Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_icon_background_hover' => array(
  			'label'   => __( 'Icon Background Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_pager' => array(
  			'label'   => __( 'Pager Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_pager_active' => array(
  			'label'   => __( 'Pager Active Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_button' => array(
  			'label'   => __( 'Button Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_button_hover' => array(
  			'label'   => __( 'Button Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_button_background' => array(
  			'label'   => __( 'Button Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),
  		'color_slider_button_background_hover' => array(
  			'label'   => __( 'Button Background Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_slider',
  			),

		// Home Page Widgets.
  		'color_home_widgets_background' => array(
  			'label'   => __( 'Widget Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_home_widgets',
  			),
  		'color_home_widgets_title' => array(
  			'label'   => __( 'Widget Title Color', 'realestate-base-pro' ),
  			'section' => 'color_section_home_widgets',
  			),
  		'color_home_widgets_subtitle' => array(
  			'label'   => __( 'Widget Subtitle Color', 'realestate-base-pro' ),
  			'section' => 'color_section_home_widgets',
  			),
  		'color_home_widgets_separator' => array(
  			'label'   => __( 'Separator Color', 'realestate-base-pro' ),
  			'section' => 'color_section_home_widgets',
  			),
  		'color_home_widgets_text' => array(
  			'label'   => __( 'Text Color', 'realestate-base-pro' ),
  			'section' => 'color_section_home_widgets',
  			),
  		'color_home_widgets_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_home_widgets',
  			),
  		'color_home_widgets_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_home_widgets',
  			),

		// Sidebar.
  		'color_sidebar_title_background' => array(
  			'label'   => __( 'Title Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_sidebar',
		),
  		'color_sidebar_title' => array(
  			'label'   => __( 'Title Color', 'realestate-base-pro' ),
  			'section' => 'color_section_sidebar',
		),
  		'color_sidebar_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_sidebar',
		),
  		'color_sidebar_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_sidebar',
		),
  		'color_sidebar_list_icon' => array(
  			'label'   => __( 'List Icon Color', 'realestate-base-pro' ),
  			'section' => 'color_section_sidebar',
		),

		// Footer area.
  		'color_footer_area_background' => array(
  			'label'   => __( 'Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_area',
  			),
  		'color_footer_area_text' => array(
  			'label'   => __( 'Text Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_area',
  			),
  		'color_footer_area_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_area',
  			),
  		'color_footer_area_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_area',
  			),

		// Go To Top.
  		'color_goto_top_icon' => array(
  			'label'   => __( 'Icon Color', 'realestate-base-pro' ),
  			'section' => 'color_section_goto_top',
  			),
  		'color_goto_top_icon_hover' => array(
  			'label'   => __( 'Icon Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_goto_top',
  			),
  		'color_goto_top_background' => array(
  			'label'   => __( 'Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_goto_top',
  			),
  		'color_goto_top_background_hover' => array(
  			'label'   => __( 'Background Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_goto_top',
  			),

		// Pagination.
  		'color_pagination_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_pagination',
  			),
  		'color_pagination_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_pagination',
  			),
  		'color_pagination_link_background' => array(
  			'label'   => __( 'Link Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_pagination',
  			),
  		'color_pagination_link_background_hover' => array(
  			'label'   => __( 'Link Background Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_pagination',
  			),

		// page_header.
  		'color_page_header_background' => array(
  			'label'   => __( 'Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_page_header',
  			),
  		'color_page_header_title' => array(
  			'label'   => __( 'Page Title Color', 'realestate-base-pro' ),
  			'section' => 'color_section_page_header',
  			),



		// Footer widgets.
  		'color_footer_widgets_background' => array(
  			'label'   => __( 'Background Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_widgets',
  			),
  		'color_footer_widgets_title' => array(
  			'label'   => __( 'Title Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_widgets',
  			),
  		'color_footer_widgets_separator' => array(
  			'label'   => __( 'Separator Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_widgets',
  			),

  		'color_footer_widgets_text' => array(
  			'label'   => __( 'Text Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_widgets',
  			),
  		'color_footer_widgets_link' => array(
  			'label'   => __( 'Link Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_widgets',
  			),
  		'color_footer_widgets_link_hover' => array(
  			'label'   => __( 'Link Hover Color', 'realestate-base-pro' ),
  			'section' => 'color_section_footer_widgets',
  			),

  		);

    return $choices;

  }

endif;

if ( ! function_exists( 'realestate_base_get_color_panels_options' ) ) :

  /**
   * Returns color panels options.
   *
   * @since 1.0.0
   */
	function realestate_base_get_color_panels_options() {

		$choices = array(
			'color_panel_main' => array(
				'label' => __( 'Color Options', 'realestate-base-pro' ),
				),
			);

		return $choices;
	}

endif;
if ( ! function_exists( 'realestate_base_get_color_sections_options' ) ) :

  /**
   * Returns color sections options.
   *
   * @since 1.0.0
   */
	function realestate_base_get_color_sections_options() {

		$choices = array(
			'color_section_basic' => array(
				'label' => __( 'Basic Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_top_header' => array(
				'label' => __( 'Top Header Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_header' => array(
				'label' => __( 'Header Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_primary_menu' => array(
				'label' => __( 'Primary Menu Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_page_header' => array(
				'label' => __( 'Page Header Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_breadcrumb' => array(
				'label' => __( 'Breadcrumb Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),

			'color_section_slider' => array(
				'label' => __( 'Slider Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_home_widgets' => array(
				'label' => __( 'Home Widget Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_content' => array(
				'label' => __( 'Content Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_sidebar' => array(
				'label' => __( 'Sidebar Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_goto_top' => array(
				'label' => __( 'Go To Top Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_pagination' => array(
				'label' => __( 'Pagination Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_footer_widgets' => array(
				'label' => __( 'Footer Widgets Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_footer_contact' => array(
				'label' => __( 'Footer Contact Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			'color_section_footer_area' => array(
				'label' => __( 'Footer Area Color Options', 'realestate-base-pro' ),
				'panel' => 'color_panel_main',
				),
			);

		return $choices;
	}

endif;

if ( ! function_exists( 'realestate_base_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int $min Min.
	 * @param int $max Max.
	 *
	 * @return array Options array.
	 */
	function realestate_base_get_numbers_dropdown_options( $min = 1, $max = 4 ) {

		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$output[ $i ] = $i;
			}
		}

		return $output;

	}

endif;
