<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Realestate_Base
 */

?><?php
	/**
	 * Hook - realestate_base_action_doctype.
	 *
	 * @hooked realestate_base_doctype -  10
	 */
	do_action( 'realestate_base_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - realestate_base_action_head.
	 *
	 * @hooked realestate_base_head -  10
	 */
	do_action( 'realestate_base_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	/**
	 * Hook - realestate_base_action_before.
	 *
	 * @hooked realestate_base_page_start - 10
	 * @hooked realestate_base_skip_to_content - 15
	 */
	do_action( 'realestate_base_action_before' );
	?>

    <?php
	  /**
	   * Hook - realestate_base_action_before_header.
	   *
	   * @hooked realestate_base_header_top_content - 5
	   * @hooked realestate_base_header_start - 10
	   */
	  do_action( 'realestate_base_action_before_header' );
	?>
		<?php
		/**
		 * Hook - realestate_base_action_header.
		 *
		 * @hooked realestate_base_site_branding - 10
		 */
		do_action( 'realestate_base_action_header' );
		?>
	<?php
	  /**
	   * Hook - realestate_base_action_after_header.
	   *
	   * @hooked realestate_base_header_end - 10
	   */
	  do_action( 'realestate_base_action_after_header' );
	?>

	<?php
	/**
	 * Hook - realestate_base_action_before_content.
	 *
	 * @hooked realestate_base_content_start - 10
	 */
	do_action( 'realestate_base_action_before_content' );
	?>
    <?php
	  /**
	   * Hook - realestate_base_action_content.
	   */
	  do_action( 'realestate_base_action_content' );
	?>
