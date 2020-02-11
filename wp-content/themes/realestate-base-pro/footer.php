<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Realestate_Base
 */

	/**
	 * Hook - realestate_base_action_after_content.
	 *
	 * @hooked realestate_base_content_end - 10
	 */
	do_action( 'realestate_base_action_after_content' );
?>

	<?php
	/**
	 * Hook - realestate_base_action_before_footer.
	 *
	 * @hooked realestate_base_footer_start - 10
	 */
	do_action( 'realestate_base_action_before_footer' );
	?>
    <?php
	  /**
	   * Hook - realestate_base_action_footer.
	   *
	   * @hooked realestate_base_footer_copyright - 10
	   */
	  do_action( 'realestate_base_action_footer' );
	?>
	<?php
	/**
	 * Hook - realestate_base_action_after_footer.
	 *
	 * @hooked realestate_base_footer_end - 10
	 */
	do_action( 'realestate_base_action_after_footer' );
	?>

<?php
	/**
	 * Hook - realestate_base_action_after.
	 *
	 * @hooked realestate_base_page_end - 10
	 * @hooked realestate_base_footer_goto_top - 20
	 */
	do_action( 'realestate_base_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
