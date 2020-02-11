<?php
/**
 * Projects support.
 *
 * @package Realestate_Base
 */

/**
 * Initial hooks customization.
 *
 * @since 1.0.0
 */
function realestate_base_projects_customization() {
	// Remove default wrapper.
	remove_action( 'projects_before_main_content', 'projects_output_content_wrapper', 10 );
	remove_action( 'projects_after_main_content', 'projects_output_content_wrapper_end', 10 );

	// Remove title in single.
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_title', 10 );

	// Remove archive title.
	add_filter( 'projects_show_page_title' , '__return_false' );

	// Rearrange gallery in single.
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_gallery', 40 );
	add_action( 'projects_after_single_project_summary', 'projects_template_single_gallery', 40 );
}

add_action( 'init', 'realestate_base_projects_customization' );

/**
 * Projects content wrapper start.
 *
 * @since 1.0.0
 */
function realestate_base_projects_output_content_wrapper() {
	echo '<div id="primary">';
	echo '<main role="main" class="site-main" id="main">';
}

add_action( 'projects_before_main_content', 'realestate_base_projects_output_content_wrapper', 10 );

/**
 * Projects content wrapper end.
 *
 * @since 1.0.0
 */
function realestate_base_projects_output_content_wrapper_end() {
	echo '</main><!-- #main -->';
	echo '</div><!-- #primary -->';
}

add_action( 'projects_after_main_content', 'realestate_base_projects_output_content_wrapper_end', 10 );

