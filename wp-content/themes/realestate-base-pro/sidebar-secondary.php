<?php
/**
 * The Secondary Sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Realestate_Base
 */

?>
<?php
$default_sidebar = apply_filters( 'realestate_base_filter_default_sidebar_id', 'sidebar-2', 'secondary' );
if ( is_singular() ) {
	global $post;
	$post_options = get_post_meta( $post->ID, 'realestate_base_theme_settings', true );
	if ( isset( $post_options['sidebar_location_secondary'] ) && ! empty( $post_options['sidebar_location_secondary'] ) ) {
		$default_sidebar = esc_attr( $post_options['sidebar_location_secondary'] );
	}
}
?>
<div id="sidebar-secondary" class="widget-area sidebar" role="complementary">
	<?php if ( is_active_sidebar( $default_sidebar ) ) :  ?>
		<?php dynamic_sidebar( $default_sidebar ); ?>
	<?php else : ?>
		<?php
			/**
			 * Hook - realestate_base_action_default_sidebar.
			 */
			do_action( 'realestate_base_action_default_sidebar', $default_sidebar, 'secondary' );
		?>
	<?php endif ?>
</div><!-- #sidebar-secondary -->
