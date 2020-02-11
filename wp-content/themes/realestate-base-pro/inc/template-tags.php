<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Realestate_Base
 */

if ( ! function_exists( 'realestate_base_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function realestate_base_posted_on() {
		$show_meta_date   = realestate_base_get_option( 'show_meta_date' );
		$show_meta_author = realestate_base_get_option( 'show_meta_author' );

		$posted_on = '';
		if ( true === $show_meta_date ) {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$posted_on = sprintf(
				'%s',
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);
		}

		$byline = '';
		if ( true === $show_meta_author ) {
			$byline = sprintf(
				'%s',
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);
		}

		if ( ! empty( $posted_on ) ) {
			echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
		}
		if ( ! empty( $byline ) ) {
			echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			$show_meta_comment = realestate_base_get_option( 'show_meta_comment' );
			if ( true === $show_meta_comment ) {
				echo '<span class="comments-link">';
				comments_popup_link( esc_html__( 'Leave a comment', 'realestate-base-pro' ), esc_html__( '1 Comment', 'realestate-base-pro' ), esc_html__( '% Comments', 'realestate-base-pro' ) );
				echo '</span>';
			}
		}

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$show_meta_categories = realestate_base_get_option( 'show_meta_categories' );
			if ( true === $show_meta_categories ) {
				/* Translators: used between list items, there is a space after the comma. */
				$categories_list = get_the_category_list( esc_html__( ', ', 'realestate-base-pro' ) );
				if ( $categories_list && realestate_base_categorized_blog() ) {
					printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
				}
			}
			$show_meta_tags = realestate_base_get_option( 'show_meta_tags' );
			if ( true === $show_meta_tags ) {
				/* Translators: used between list items, there is a space after the comma. */
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'realestate-base-pro' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links">%1$s</span>', $tags_list ); // WPCS: XSS OK.
				}
			}
		}

	}
endif;

if ( ! function_exists( 'realestate_base_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function realestate_base_entry_footer() {

		edit_post_link( esc_html__( 'Edit', 'realestate-base-pro' ), '<span class="edit-link">', '</span>' );
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function realestate_base_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'realestate_base_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'realestate_base_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so realestate_base_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so realestate_base_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in realestate_base_categorized_blog.
 */
function realestate_base_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'realestate_base_categories' );
}
add_action( 'edit_category', 'realestate_base_category_transient_flusher' );
add_action( 'save_post',     'realestate_base_category_transient_flusher' );