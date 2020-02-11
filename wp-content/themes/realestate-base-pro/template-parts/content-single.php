<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Realestate_Base
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
	  /**
	   * Hook - realestate_base_single_image.
	   *
	   * @hooked realestate_base_add_image_in_single_display - 10
	   */
	  do_action( 'realestate_base_single_image' );
	?>


	<div class="entry-content-wrapper">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php realestate_base_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'realestate-base-pro' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php realestate_base_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-content-wrapper -->


</article><!-- #post-## -->

<?php
/**
 * Hook - realestate_base_author_bio.
 *
 * @hooked realestate_base_add_author_bio_in_single -  10
 */
do_action( 'realestate_base_author_bio' );
