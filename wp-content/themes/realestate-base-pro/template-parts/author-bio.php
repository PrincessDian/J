<?php
/**
 * Template part for displaying Author Bio.
 *
 * @package Realestate_Base
 */

?>
<div class="authorbox <?php echo ( get_option( 'show_avatars' ) ) ? '' : 'no-author-avatar'; ?>">
	<?php if ( get_option( 'show_avatars' ) ) : ?>
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), '60', '' ); ?>
		</div>
	<?php endif ?>
	<div class="author-info">
		<h4 class="author-header">
			<?php esc_html_e( 'Written by', 'realestate-base-pro' ); ?>&nbsp;<?php  the_author_posts_link(); ?>
		</h4>
		<div class="author-content"><p><?php the_author_meta( 'description' ); ?></p></div>
		<?php $user_url = get_the_author_meta( 'user_url' ); ?>
		<?php if ( ! empty( $user_url ) ) :  ?>
			<div class="author-footer"><a href="<?php echo esc_url( $user_url ); ?>" target="_blank"><?php esc_html_e( 'Visit Website', 'realestate-base-pro' ); ?></a></div>
		<?php endif; ?>

	</div> <!-- .author-info -->
	<?php
		$author_bio_show_recent_posts   = realestate_base_get_option( 'author_bio_show_recent_posts' );
		$author_bio_recent_posts_number = realestate_base_get_option( 'author_bio_recent_posts_number' );
	?>
	<?php if ( true === $author_bio_show_recent_posts && absint( $author_bio_recent_posts_number ) > 0 ) : ?>

		<?php
		$custom_args = array(
			'author'         => get_the_author_meta( 'ID' ),
			'posts_per_page' => absint( $author_bio_recent_posts_number ),
			);
		$all_posts = get_posts( $custom_args );
		?>

		<?php if ( ! empty( $all_posts ) ) : ?>

			<div class="author-bio-posts-content">
				<p><strong><?php esc_html_e( 'Other posts by author', 'realestate-base-pro' ); ?></strong></p>

				<ul class="author-bio-posts-list">
					<?php foreach ( $all_posts as $key => $p ) : ?>
						<li><a href="<?php echo esc_url( get_permalink( $p->ID ) ); ?>"><?php echo apply_filters( 'the_title', $p->post_title ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div><!-- .author-bio-posts-content -->

		<?php endif; ?>

	<?php endif; ?>
</div>
