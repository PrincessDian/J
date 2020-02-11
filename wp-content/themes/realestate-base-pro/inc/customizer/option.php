<?php
/**
 * Theme Options.
 *
 * @package Realestate_Base
 */

$default = realestate_base_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
	'title'      => __( 'Theme Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

// Header Section.
$wp_customize->add_section( 'section_header',
	array(
	'title'      => __( 'Header Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting show_title.
$wp_customize->add_setting( 'theme_options[show_title]',
	array(
	'default'           => $default['show_title'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_title]',
	array(
	'label'    => __( 'Show Site Title', 'realestate-base-pro' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting show_tagline.
$wp_customize->add_setting( 'theme_options[show_tagline]',
	array(
	'default'           => $default['show_tagline'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_tagline]',
	array(
	'label'    => __( 'Show Tagline', 'realestate-base-pro' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting show_social_in_header.
$wp_customize->add_setting( 'theme_options[show_social_in_header]',
	array(
	'default'           => $default['show_social_in_header'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_social_in_header]',
	array(
	'label'    => esc_html__( 'Show Social Icons', 'realestate-base-pro' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting contact_number.
$wp_customize->add_setting( 'theme_options[contact_number]',
	array(
	'default'           => $default['contact_number'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[contact_number]',
	array(
	'label'    => esc_html__( 'Contact Number', 'realestate-base-pro' ),
	'section'  => 'section_header',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting contact_email.
$wp_customize->add_setting( 'theme_options[contact_email]',
	array(
	'default'           => $default['contact_email'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_email',
	)
);
$wp_customize->add_control( 'theme_options[contact_email]',
	array(
	'label'    => esc_html__( 'Contact Email', 'realestate-base-pro' ),
	'section'  => 'section_header',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting contact_address.
$wp_customize->add_setting( 'theme_options[contact_address]',
	array(
	'default'           => $default['contact_address'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[contact_address]',
	array(
	'label'    => esc_html__( 'Contact Address', 'realestate-base-pro' ),
	'section'  => 'section_header',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting enable_sticky_primary_menu.
$wp_customize->add_setting( 'theme_options[enable_sticky_primary_menu]',
	array(
		'default'           => $default['enable_sticky_primary_menu'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_sticky_primary_menu]',
	array(
		'label'    => __( 'Make Primary Menu Sticky', 'realestate-base-pro' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting browse_button_text.
$wp_customize->add_setting( 'theme_options[browse_button_text]',
	array(
	'default'           => $default['browse_button_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[browse_button_text]',
	array(
	'label'    => esc_html__( 'Browse Button Text', 'realestate-base-pro' ),
	'section'  => 'section_header',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting browse_button_url.
$wp_customize->add_setting( 'theme_options[browse_button_url]',
	array(
	'default'           => $default['browse_button_url'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( 'theme_options[browse_button_url]',
	array(
	'label'    => esc_html__( 'Browse Button URL', 'realestate-base-pro' ),
	'section'  => 'section_header',
	'type'     => 'text',
	'priority' => 100,
	)
);

$wp_customize->add_setting( 'theme_options[search_in_header]',
	array(
		'default'           => $default['search_in_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[search_in_header]',
	array(
		'label'    => __( 'Enable Search Form', 'realestate-base-pro' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Search Section.
$wp_customize->add_section( 'section_search',
	array(
	'title'      => __( 'Search Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting search_placeholder.
$wp_customize->add_setting( 'theme_options[search_placeholder]',
	array(
	'default'           => $default['search_placeholder'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[search_placeholder]',
	array(
	'label'    => __( 'Search Placeholder', 'realestate-base-pro' ),
	'section'  => 'section_search',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Layout Section.
$wp_customize->add_section( 'section_layout',
	array(
	'title'      => __( 'Layout Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting( 'theme_options[global_layout]',
	array(
	'default'           => $default['global_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[global_layout]',
	array(
	'label'    => __( 'Global Layout', 'realestate-base-pro' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => realestate_base_get_global_layout_options(),
	'priority' => 100,
	)
);
// Setting archive_layout.
$wp_customize->add_setting( 'theme_options[archive_layout]',
	array(
	'default'           => $default['archive_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_layout]',
	array(
	'label'    => __( 'Archive Layout', 'realestate-base-pro' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => realestate_base_get_archive_layout_options(),
	'priority' => 100,
	)
);
// Setting archive_image.
$wp_customize->add_setting( 'theme_options[archive_image]',
	array(
	'default'           => $default['archive_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_image]',
	array(
	'label'    => __( 'Image in Archive', 'realestate-base-pro' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => realestate_base_get_image_sizes_options(),
	'priority' => 100,
	)
);
// Setting archive_image_alignment.
$wp_customize->add_setting( 'theme_options[archive_image_alignment]',
	array(
	'default'           => $default['archive_image_alignment'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_image_alignment]',
	array(
	'label'           => __( 'Image Alignment in Archive', 'realestate-base-pro' ),
	'section'         => 'section_layout',
	'type'            => 'select',
	'choices'         => realestate_base_get_image_alignment_options(),
	'priority'        => 100,
	'active_callback' => 'realestate_base_is_image_in_archive_active',
	)
);
// Setting single_image.
$wp_customize->add_setting( 'theme_options[single_image]',
	array(
	'default'           => $default['single_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[single_image]',
	array(
	'label'    => __( 'Image in Single Post/Page', 'realestate-base-pro' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => realestate_base_get_image_sizes_options(),
	'priority' => 100,
	)
);
// Setting single_image_alignment.
$wp_customize->add_setting( 'theme_options[single_image_alignment]',
	array(
	'default'           => $default['single_image_alignment'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[single_image_alignment]',
	array(
	'label'           => __( 'Image Alignment in Single Post/Page', 'realestate-base-pro' ),
	'section'         => 'section_layout',
	'type'            => 'select',
	'choices'         => realestate_base_get_image_alignment_options(),
	'priority'        => 100,
	'active_callback' => 'realestate_base_is_image_in_single_active',
	)
);

// Home Page Section.
$wp_customize->add_section( 'section_home_page',
	array(
	'title'      => __( 'Home Page Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting home_content_status.
$wp_customize->add_setting( 'theme_options[home_content_status]',
	array(
	'default'           => $default['home_content_status'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[home_content_status]',
	array(
	'label'       => __( 'Show Home Content', 'realestate-base-pro' ),
	'description' => __( 'Check this to show page content in Home page.', 'realestate-base-pro' ),
	'section'     => 'section_home_page',
	'type'        => 'checkbox',
	'priority'    => 100,
	)
);

// Pagination Section.
$wp_customize->add_section( 'section_pagination',
	array(
	'title'      => __( 'Pagination Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting( 'theme_options[pagination_type]',
	array(
	'default'           => $default['pagination_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[pagination_type]',
	array(
	'label'       => __( 'Pagination Type', 'realestate-base-pro' ),
	'description' => sprintf( __( 'Infinite Scroll: Requires %1$sJetPack - Infinite Scroll%2$s plugin', 'realestate-base-pro' ), '<a href="https://wordpress.org/plugins/jetpack/" target="_blank">', '</a>' ),
	'section'     => 'section_pagination',
	'type'        => 'select',
	'choices'     => realestate_base_get_pagination_type_options(),
	'priority'    => 100,
	)
);

// Content Meta Section.
$wp_customize->add_section( 'section_content_meta',
	array(
	'title'      => __( 'Content Meta Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting show_meta_date.
$wp_customize->add_setting( 'theme_options[show_meta_date]',
	array(
	'default'           => $default['show_meta_date'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_meta_date]',
	array(
		'label'           => __( 'Show Date', 'realestate-base-pro' ),
		'section'         => 'section_content_meta',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting show_meta_author.
$wp_customize->add_setting( 'theme_options[show_meta_author]',
	array(
	'default'           => $default['show_meta_author'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_meta_author]',
	array(
		'label'           => __( 'Show Author', 'realestate-base-pro' ),
		'section'         => 'section_content_meta',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting show_meta_categories.
$wp_customize->add_setting( 'theme_options[show_meta_categories]',
	array(
	'default'           => $default['show_meta_categories'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_meta_categories]',
	array(
		'label'           => __( 'Show Categories', 'realestate-base-pro' ),
		'section'         => 'section_content_meta',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting show_meta_tags.
$wp_customize->add_setting( 'theme_options[show_meta_tags]',
	array(
	'default'           => $default['show_meta_tags'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_meta_tags]',
	array(
		'label'           => __( 'Show Tags', 'realestate-base-pro' ),
		'section'         => 'section_content_meta',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting show_meta_comment.
$wp_customize->add_setting( 'theme_options[show_meta_comment]',
	array(
	'default'           => $default['show_meta_comment'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_meta_comment]',
	array(
		'label'           => __( 'Show Comment', 'realestate-base-pro' ),
		'section'         => 'section_content_meta',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Footer Section.
$wp_customize->add_section( 'section_footer',
	array(
	'title'      => __( 'Footer Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_textarea_content',
	'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
	'label'    => __( 'Copyright Text', 'realestate-base-pro' ),
	'section'  => 'section_footer',
	'type'     => 'textarea',
	'priority' => 100,
	)
);
// Setting - powered_by_text.
$wp_customize->add_setting( 'theme_options[powered_by_text]',
	array(
		'default'           => $default['powered_by_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'realestate_base_sanitize_textarea_content',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'theme_options[powered_by_text]',
	array(
		'label'    => esc_html__( 'Powered By Text', 'realestate-base-pro' ),
		'section'  => 'section_footer',
		'type'     => 'textarea',
		'priority' => 100,
	)
);
// Setting reset_footer_content.
$wp_customize->add_setting( 'theme_options[reset_footer_content]',
	array(
		'default'           => $default['reset_footer_content'],
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[reset_footer_content]',
	array(
		'label'       => __( 'Reset Footer Content', 'realestate-base-pro' ),
		'description' => __( 'Refresh the page after save to view full effects.', 'realestate-base-pro' ),
		'section'     => 'section_footer',
		'type'        => 'checkbox',
		'priority'    => 100,
	)
);

// Setting show_social_in_footer.
$wp_customize->add_setting( 'theme_options[show_social_in_footer]',
	array(
		'default'           => $default['show_social_in_footer'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_social_in_footer]',
	array(
		'label'    => __( 'Show Social Icons', 'realestate-base-pro' ),
		'section'  => 'section_footer',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting go_to_top.
$wp_customize->add_setting( 'theme_options[go_to_top]',
	array(
		'default'           => $default['go_to_top'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[go_to_top]',
	array(
		'label'    => __( 'Show Go To Top', 'realestate-base-pro' ),
		'section'  => 'section_footer',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);


// Blog Section.
$wp_customize->add_section( 'section_blog',
	array(
	'title'      => __( 'Blog Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting blog_title.
$wp_customize->add_setting( 'theme_options[blog_title]',
	array(
	'default'           => $default['blog_title'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[blog_title]',
	array(
	'label'    => __( 'Blog Title', 'realestate-base-pro' ),
	'section'  => 'section_blog',
	'type'     => 'text',
	'priority' => 100,
	)
);


// Setting excerpt_length.
$wp_customize->add_setting( 'theme_options[excerpt_length]',
	array(
	'default'           => $default['excerpt_length'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'theme_options[excerpt_length]',
	array(
	'label'       => __( 'Excerpt Length', 'realestate-base-pro' ),
	'description' => __( 'in words', 'realestate-base-pro' ),
	'section'     => 'section_blog',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 55px;' ),
	)
);

// Setting read_more_text.
$wp_customize->add_setting( 'theme_options[read_more_text]',
	array(
	'default'           => $default['read_more_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[read_more_text]',
	array(
	'label'    => __( 'Read More Text', 'realestate-base-pro' ),
	'section'  => 'section_blog',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting exclude_categories.
$wp_customize->add_setting( 'theme_options[exclude_categories]',
	array(
	'default'           => $default['exclude_categories'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[exclude_categories]',
	array(
	'label'       => __( 'Exclude Categories in Blog', 'realestate-base-pro' ),
	'description' => __( 'Enter category ID to exclude in Blog Page. Separate with comma if more than one', 'realestate-base-pro' ),
	'section'     => 'section_blog',
	'type'        => 'text',
	'priority'    => 100,
	)
);

// Author Bio Section.
$wp_customize->add_section( 'section_author_bio',
	array(
		'title'       => __( 'Author Bio Options', 'realestate-base-pro' ),
		'description' => __( 'Author Box will be displayed in the single post article.', 'realestate-base-pro' ),
		'priority'    => 100,
		'capability'  => 'edit_theme_options',
		'panel'       => 'theme_option_panel',
	)
);
// Setting author_bio_in_single.
$wp_customize->add_setting( 'theme_options[author_bio_in_single]',
	array(
		'default'           => $default['author_bio_in_single'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[author_bio_in_single]',
	array(
		'label'    => __( 'Show Author Bio', 'realestate-base-pro' ),
		'section'  => 'section_author_bio',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);
// Setting author_bio_show_recent_posts.
$wp_customize->add_setting( 'theme_options[author_bio_show_recent_posts]',
	array(
		'default'           => $default['author_bio_show_recent_posts'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'realestate_base_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[author_bio_show_recent_posts]',
	array(
		'label'    => __( 'Show Recent Posts by Author in Bio', 'realestate-base-pro' ),
		'section'  => 'section_author_bio',
		'type'     => 'checkbox',
		'priority' => 100,
		'active_callback' => 'realestate_base_is_author_bio_active',
	)
);

// Setting author_bio_recent_posts_number.
$wp_customize->add_setting( 'theme_options[author_bio_recent_posts_number]',
	array(
		'default'           => $default['author_bio_recent_posts_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'realestate_base_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'theme_options[author_bio_recent_posts_number]',
	array(
		'label'           => __( 'No of Recent Posts', 'realestate-base-pro' ),
		'section'         => 'section_author_bio',
		'type'            => 'number',
		'priority'        => 100,
		'active_callback' => 'realestate_base_is_author_bio_recent_posts_active',
		'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
	)
);


// Breadcrumb Section.
$wp_customize->add_section( 'section_breadcrumb',
	array(
	'title'      => __( 'Breadcrumb Options', 'realestate-base-pro' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting( 'theme_options[breadcrumb_type]',
	array(
	'default'           => $default['breadcrumb_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'realestate_base_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[breadcrumb_type]',
	array(
	'label'       => __( 'Breadcrumb Type', 'realestate-base-pro' ),
	'section'     => 'section_breadcrumb',
	'type'        => 'select',
	'choices'     => realestate_base_get_breadcrumb_type_options(),
	'priority'    => 100,
	)
);
