<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Realestate_Base
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php
			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'realestate-base-pro' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'realestate-base-pro' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'realestate-base-pro' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'realestate-base-pro' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
			?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	/**
	 * Hook - realestate_base_action_sidebar.
	 *
	 * @hooked: realestate_base_add_sidebar - 10
	 */
	do_action( 'realestate_base_action_sidebar' );
?>
<?php get_footer(); ?>
