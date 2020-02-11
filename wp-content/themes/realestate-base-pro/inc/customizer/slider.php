<?php
/**
 * Theme Options related to slider.
 *
 * @package Realestate_Base
 */

$default = realestate_base_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_slider_panel',
	array(
	'title'      => __( 'Featured Slider', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

// Slider Type Section.
$wp_customize->add_section( 'section_theme_slider_type',
	array(
	'title'      => __( 'Slider Type', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_slider_panel',
	)
);

// Setting featured_slider_status.
$wp_customize->add_setting( 'theme_options[featured_slider_status]',
	array(
	'default'           => $default['featured_slider_status'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_status]',
	array(
	'label'    => __( 'Enable Slider On', 'realestate-base-pro' ),
	'section'  => 'section_theme_slider_type',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => realestate_base_get_featured_slider_content_options(),
	)
);
// Setting featured_slider_type.
$wp_customize->add_setting( 'theme_options[featured_slider_type]',
	array(
	'default'           => $default['featured_slider_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_type]',
	array(
	'label'           => __( 'Select Slider Type', 'realestate-base-pro' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'select',
	'priority'        => 100,
	'choices'         => realestate_base_get_featured_slider_type(),
	'active_callback' => 'realestate_base_is_featured_slider_active',
	)
);

// Setting featured_slider_number.
$wp_customize->add_setting( 'theme_options[featured_slider_number]',
	array(
	'default'           => $default['featured_slider_number'],
	'capability'        => 'edit_theme_options',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'realestate_base_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_number]',
	array(
	'label'           => __( 'No of Slides', 'realestate-base-pro' ),
	'description'     => __( 'Enter number between 1 and 20. Save and refresh the page if No of Slides is changed.', 'realestate-base-pro' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'number',
	'priority'        => 100,
	'active_callback' => 'realestate_base_is_featured_slider_active_non_demo',
	'input_attrs'     => array( 'min' => 1, 'max' => 20, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);

$featured_slider_number = absint( realestate_base_get_option( 'featured_slider_number' ) );

if ( $featured_slider_number > 0 ) {
	for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
		$wp_customize->add_setting( "theme_options[featured_slider_page_heading_$i]",
			array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			new Realestate_Base_Heading_Control( $wp_customize, "theme_options[featured_slider_page_heading_$i]",
				array(
					'label'           => __( 'Slide', 'realestate-base-pro' ) . ' #' . $i,
					'section'         => 'section_theme_slider_type',
					'settings'        => "theme_options[featured_slider_page_heading_$i]",
					'priority'        => 100,
					'active_callback' => 'realestate_base_is_featured_page_slider_active',
				)
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_page_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_page_' . $i ] ) ? $default[ 'featured_slider_page_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'realestate_base_sanitize_dropdown_pages',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_page_$i]",
			array(
			'label'           => __( 'Select Page', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'dropdown-pages',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_page_slider_active',
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_page_caption_alignment_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_page_caption_alignment_' .$i ] ) ? $default[ 'featured_slider_page_caption_alignment_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'realestate_base_sanitize_select',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_page_caption_alignment_$i]",
			array(
			'label'           => __( 'Caption Alignment', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'select',
			'priority'        => 100,
			'choices'         => realestate_base_get_slider_caption_alignment_options(),
			'active_callback' => 'realestate_base_is_featured_page_slider_active',
			)
		);
	} // End for loop.
}

// For multiple posts.
if ( $featured_slider_number > 0 ) {
	for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
		$wp_customize->add_setting( "theme_options[featured_slider_post_heading_$i]",
			array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			new Realestate_Base_Heading_Control( $wp_customize, "theme_options[featured_slider_post_heading_$i]",
				array(
					'label'           => __( 'Slide', 'realestate-base-pro' ) . ' #' . $i,
					'section'         => 'section_theme_slider_type',
					'settings'        => "theme_options[featured_slider_post_heading_$i]",
					'priority'        => 100,
					'active_callback' => 'realestate_base_is_featured_post_slider_active',
				)
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_post_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_post_' .$i ] ) ? $default[ 'featured_slider_post_' .$i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'realestate_base_sanitize_post_id',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_post_$i]",
			array(
			'label'           => __( 'Featured Post', 'realestate-base-pro' ),
			'description'     => __( 'Enter Post ID', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'text',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_post_slider_active',
			'input_attrs'     => array( 'style' => 'width: 80px;' ),
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_post_caption_alignment_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_post_caption_alignment_' .$i ] ) ? $default[ 'featured_slider_post_caption_alignment_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'realestate_base_sanitize_select',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_post_caption_alignment_$i]",
			array(
			'label'           => __( 'Caption Alignment', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'select',
			'priority'        => 100,
			'choices'         => realestate_base_get_slider_caption_alignment_options(),
			'active_callback' => 'realestate_base_is_featured_post_slider_active',
			)
		);

	} // End for loop.
}

// For multiple images.
if ( $featured_slider_number > 0 ) {
	for ( $i = 1; $i <= $featured_slider_number; $i++ ) {

		$wp_customize->add_setting( "theme_options[featured_slider_image_heading_$i]",
			array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			new Realestate_Base_Heading_Control( $wp_customize, "theme_options[featured_slider_image_heading_$i]",
				array(
					'label'           => __( 'Slide', 'realestate-base-pro' ) . ' #' . $i,
					'section'         => 'section_theme_slider_type',
					'settings'        => "theme_options[featured_slider_image_heading_$i]",
					'priority'        => 100,
					'active_callback' => 'realestate_base_is_featured_image_slider_active',
				)
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_image_photo_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_image_photo_' . $i ] ) ? $default[ 'featured_slider_image_photo_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, "theme_options[featured_slider_image_photo_$i]",
				array(
					'label'           => __( 'Image', 'realestate-base-pro' ),
					'section'         => 'section_theme_slider_type',
					'settings'        => "theme_options[featured_slider_image_photo_$i]",
					'priority'        => 100,
					'active_callback' => 'realestate_base_is_featured_image_slider_active',
				)
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_image_title_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_image_title_' . $i ] ) ? $default[ 'featured_slider_image_title_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'realestate_base_sanitize_textarea_content',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_image_title_$i]",
			array(
			'label'           => __( 'Title', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'text',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_image_slider_active',
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_image_caption_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_image_caption_' . $i ] ) ? $default[ 'featured_slider_image_caption_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_image_caption_$i]",
			array(
			'label'           => __( 'Caption', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'textarea',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_image_slider_active',
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_image_url_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_image_url_' . $i ] ) ? $default[ 'featured_slider_image_url_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_image_url_$i]",
			array(
			'label'           => __( 'Link', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'url',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_image_slider_active',
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_image_primary_button_text_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_image_primary_button_text_' . $i ] ) ? $default[ 'featured_slider_image_primary_button_text_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_image_primary_button_text_$i]",
			array(
			'label'           => __( 'Primary Button Text', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'text',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_image_slider_active',
			)
		);
		$wp_customize->add_setting( "theme_options[featured_slider_image_primary_button_url_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_image_primary_button_url_' . $i ] ) ? $default[ 'featured_slider_image_primary_button_url_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_image_primary_button_url_$i]",
			array(
			'label'           => __( 'Primary Button URL', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'url',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_image_slider_active',
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_image_secondary_button_text_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_image_secondary_button_text_' . $i ] ) ? $default[ 'featured_slider_image_secondary_button_text_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_image_secondary_button_text_$i]",
			array(
			'label'           => __( 'Secondary Button Text', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'text',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_image_slider_active',
			)
		);
		$wp_customize->add_setting( "theme_options[featured_slider_image_secondary_button_url_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_image_secondary_button_url_' . $i ] ) ? $default[ 'featured_slider_image_secondary_button_url_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_image_secondary_button_url_$i]",
			array(
			'label'           => __( 'Secondary Button URL', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'url',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_image_slider_active',
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_image_caption_alignment_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_image_caption_alignment_' .$i ] ) ? $default[ 'featured_slider_image_caption_alignment_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'realestate_base_sanitize_select',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_image_caption_alignment_$i]",
			array(
			'label'           => __( 'Caption Alignment', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'select',
			'priority'        => 100,
			'choices'         => realestate_base_get_slider_caption_alignment_options(),
			'active_callback' => 'realestate_base_is_featured_image_slider_active',
			)
		);

	} // End for loop.
}

// Setting featured_slider_category.
$wp_customize->add_setting( 'theme_options[featured_slider_category]',
	array(
		'default'           => $default['featured_slider_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Realestate_Base_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[featured_slider_category]',
		array(
			'label'           => __( 'Select Category', 'realestate-base-pro' ),
			'section'         => 'section_theme_slider_type',
			'settings'        => 'theme_options[featured_slider_category]',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_category_slider_active',
		)
	)
);

// Setting featured_slider_tag.
$wp_customize->add_setting( 'theme_options[featured_slider_tag]',
	array(
	'default'           => $default['featured_slider_tag'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Realestate_Base_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[featured_slider_tag]',
		array(
			'label'           => __( 'Select Tag', 'realestate-base-pro' ),
			'taxonomy'        => 'post_tag',
			'section'         => 'section_theme_slider_type',
			'settings'        => 'theme_options[featured_slider_tag]',
			'priority'        => 100,
			'active_callback' => 'realestate_base_is_featured_tag_slider_active',
		)
	)
);

// Setting featured_slider_read_more_text.
$wp_customize->add_setting( 'theme_options[featured_slider_read_more_text]',
	array(
	'default'           => $default['featured_slider_read_more_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_read_more_text]',
	array(
	'label'           => __( 'Read More Text', 'realestate-base-pro' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'text',
	'priority'        => 100,
	'active_callback' => 'realestate_base_is_featured_slider_active_non_demo_non_image',
	)
);


// Slider Options Section.
$wp_customize->add_section( 'section_theme_slider_options',
	array(
	'title'      => __( 'Slider Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_slider_panel',
	)
);

// Setting featured_slider_transition_effect.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_effect]',
	array(
	'default'           => $default['featured_slider_transition_effect'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select_liberal',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_effect]',
	array(
	'label'    => __( 'Transition Effect', 'realestate-base-pro' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => realestate_base_get_featured_slider_transition_effects(),
	)
);

// Setting featured_slider_transition_delay.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_delay]',
	array(
	'default'           => $default['featured_slider_transition_delay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_delay]',
	array(
	'label'       => __( 'Transition Delay', 'realestate-base-pro' ),
	'description' => __( 'in seconds', 'realestate-base-pro' ),
	'section'     => 'section_theme_slider_options',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);
// Setting featured_slider_transition_duration.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_duration]',
	array(
	'default'           => $default['featured_slider_transition_duration'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_duration]',
	array(
	'label'       => __( 'Transition Duration', 'realestate-base-pro' ),
	'description' => __( 'in seconds', 'realestate-base-pro' ),
	'section'     => 'section_theme_slider_options',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);
// Setting featured_slider_enable_caption.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_caption]',
	array(
	'default'           => $default['featured_slider_enable_caption'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_caption]',
	array(
	'label'    => __( 'Enable Caption', 'realestate-base-pro' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting featured_slider_caption_alignment.
$wp_customize->add_setting( 'theme_options[featured_slider_caption_alignment]',
	array(
	'default'           => $default['featured_slider_caption_alignment'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_caption_alignment]',
	array(
	'label'           => __( 'Caption Alignment', 'realestate-base-pro' ),
	'section'         => 'section_theme_slider_options',
	'type'            => 'select',
	'priority'        => 100,
	'choices'         => realestate_base_get_slider_caption_alignment_options(),
	'active_callback' => 'realestate_base_is_featured_slider_caption_active',
	)
);

// Setting featured_slider_enable_arrow.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_arrow]',
	array(
	'default'           => $default['featured_slider_enable_arrow'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_arrow]',
	array(
	'label'    => __( 'Enable Arrow', 'realestate-base-pro' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_pager.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_pager]',
	array(
	'default'           => $default['featured_slider_enable_pager'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_pager]',
	array(
	'label'    => __( 'Enable Pager', 'realestate-base-pro' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_autoplay.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_autoplay]',
	array(
	'default'           => $default['featured_slider_enable_autoplay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_autoplay]',
	array(
	'label'    => __( 'Enable Autoplay', 'realestate-base-pro' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting featured_slider_enable_overlay.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_overlay]',
	array(
	'default'           => $default['featured_slider_enable_overlay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_overlay]',
	array(
	'label'    => __( 'Enable Overlay', 'realestate-base-pro' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
