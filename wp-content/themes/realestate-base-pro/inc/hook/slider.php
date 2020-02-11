<?php
/**
 * Implementation of slider feature.
 *
 * @package Realestate_Base
 */

// Check slider status.
add_filter( 'realestate_base_filter_slider_status', 'realestate_base_check_slider_status' );

// Add slider to the theme.
add_action( 'realestate_base_action_before_content', 'realestate_base_add_featured_slider', 5 );

// Slider details.
add_filter( 'realestate_base_filter_slider_details', 'realestate_base_get_slider_details' );


if ( ! function_exists( 'realestate_base_get_slider_details' ) ) :
	/**
	 * Slider details.
	 *
	 * @since 1.0.0
	 *
	 * @param array $input Slider details.
	 */
	function realestate_base_get_slider_details( $input ) {

		$featured_slider_type           = realestate_base_get_option( 'featured_slider_type' );
		$featured_slider_number         = realestate_base_get_option( 'featured_slider_number' );
		$featured_slider_read_more_text = realestate_base_get_option( 'featured_slider_read_more_text' );

		switch ( $featured_slider_type ) {

			case 'demo-slider':
				$slides = array();
				for( $i = 0; $i <= 1 ; $i++ ) {
					$img_arr = array(
						0 => get_template_directory_uri() . '/images/slide'. ( $i + 1 ) . '.jpg',
						1 => 1420,
						2 => 440,
						3 => 0,
					);
					$slides[ $i ]['images']  = $img_arr;
					$slides[ $i ]['title']   = __( 'Slide Title','realestate-base-pro' ) . ' ' . ( $i + 1 );
					$slides[ $i ]['url']     = esc_url( home_url( '/' ) );
					$slides[ $i ]['excerpt'] = __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis metus scelerisque, faucibus risus eu, luctus est.', 'realestate-base-pro' );

				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			case 'featured-page':

				$blocks = array();
				$ids = array();

				for ( $i = 1; $i <= $featured_slider_number ; $i++ ) {
					$id = realestate_base_get_option( 'featured_slider_page_' . $i );
					if ( ! empty( $id ) ) {
						$item['id'] = absint( $id );
						$item['caption_alignment'] = realestate_base_get_option( 'featured_slider_page_caption_alignment_' . $i );
						$blocks[ $item['id'] ] = $item;
					}
				}

				$ids = wp_list_pluck( $blocks, 'id' );

				// Bail if no valid options are selected.
				if ( empty( $ids ) ) {
					return $input;
				}

				$qargs = array(
					'posts_per_page' => absint( $featured_slider_number ),
					'no_found_rows'  => true,
					'orderby'        => 'post__in',
					'post_type'      => 'page',
					'post__in'       => $ids,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id' ),
					),
				);

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'realestate-base-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = esc_html( $post->post_title );
							$slides[ $cnt ]['url']     = esc_url( get_permalink( $post->ID ) );
							$slides[ $cnt ]['excerpt'] = realestate_base_the_excerpt( apply_filters( 'realestate_base_filter_slider_caption_length', 30 ), $post );
							$slides[ $cnt ]['caption_alignment'] = '';
							if ( isset( $blocks[ $post->ID ] ) && isset( $blocks[ $post->ID ]['caption_alignment'] ) ) {
								$slides[ $cnt ]['caption_alignment'] = $blocks[ $post->ID ]['caption_alignment'];
							}
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url'] = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			case 'featured-post':

				$blocks = array();
				$ids = array();

				for ( $i = 1; $i <= $featured_slider_number ; $i++ ) {
					$id = realestate_base_get_option( 'featured_slider_post_' . $i );
					if ( ! empty( $id ) ) {
						$item['id'] = absint( $id );
						$item['caption_alignment'] = realestate_base_get_option( 'featured_slider_post_caption_alignment_' . $i );
						$blocks[ $item['id'] ] = $item;
					}
				}

				$ids = wp_list_pluck( $blocks, 'id' );

				// Bail if no valid options are selected.
				if ( empty( $ids ) ) {
					return $input;
				}

				$qargs = array(
					'posts_per_page' => absint( $featured_slider_number ),
					'no_found_rows'  => true,
					'orderby'        => 'post__in',
					'post_type'      => 'post',
					'post__in'       => $ids,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id' ),
					),
				);

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'realestate-base-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = esc_html( $post->post_title );
							$slides[ $cnt ]['url']     = esc_url( get_permalink( $post->ID ) );
							$slides[ $cnt ]['excerpt'] = realestate_base_the_excerpt( apply_filters( 'realestate_base_filter_slider_caption_length', 30 ), $post );
							$slides[ $cnt ]['caption_alignment'] = '';
							if ( isset( $blocks[ $post->ID ] ) && isset( $blocks[ $post->ID ]['caption_alignment'] ) ) {
								$slides[ $cnt ]['caption_alignment'] = $blocks[ $post->ID ]['caption_alignment'];
							}
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url'] = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			case 'featured-category':

				$featured_slider_category = realestate_base_get_option( 'featured_slider_category' );

				$qargs = array(
					'posts_per_page' => absint( $featured_slider_number ),
					'no_found_rows'  => true,
					'post_type'      => 'post',
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id' ), // Show only posts with featured images.
					),
				);
				if ( absint( $featured_slider_category ) > 0 ) {
					$qargs['cat'] = absint( $featured_slider_category );
				}

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'realestate-base-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = esc_html( $post->post_title );
							$slides[ $cnt ]['url']     = esc_url( get_permalink( $post->ID ) );
							$slides[ $cnt ]['excerpt'] = realestate_base_the_excerpt( apply_filters( 'realestate_base_filter_slider_caption_length', 30 ), $post );
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url'] = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			case 'featured-tag':

				$featured_slider_tag = realestate_base_get_option( 'featured_slider_tag' );

				$qargs = array(
					'posts_per_page' => absint( $featured_slider_number ),
					'no_found_rows'  => true,
					'post_type'      => 'post',
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id' ), // Show only posts with featured images.
					),
				);
				if ( absint( $featured_slider_tag ) > 0 ) {
					$qargs['tag_id'] = absint( $featured_slider_tag );
				}

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'realestate-base-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = esc_html( $post->post_title );
							$slides[ $cnt ]['url']     = esc_url( get_permalink( $post->ID ) );
							$slides[ $cnt ]['excerpt'] = realestate_base_the_excerpt( apply_filters( 'realestate_base_filter_slider_caption_length', 30 ), $post );
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url'] = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			case 'featured-image':
				$slides = array();

				for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
					$photo = realestate_base_get_option( 'featured_slider_image_photo_' . $i );
					if ( ! empty( $photo  ) ) {
						$item = array();
						$item['images'][0] = esc_url( $photo );

						$title      = realestate_base_get_option( 'featured_slider_image_title_' . $i );
						$url        = realestate_base_get_option( 'featured_slider_image_url_' . $i );
						$caption    = realestate_base_get_option( 'featured_slider_image_caption_' . $i );
						$new_window = realestate_base_get_option( 'featured_slider_image_new_window_' . $i );

						$item['title']      = esc_html( $title );
						$item['url']        = esc_url( $url );
						$item['excerpt']    = esc_html( $caption );
						$item['new_window'] = esc_attr( $new_window );
						$item['primary_button_text'] = esc_attr( realestate_base_get_option( 'featured_slider_image_primary_button_text_' . $i ) );
						$item['primary_button_url'] = esc_attr( realestate_base_get_option( 'featured_slider_image_primary_button_url_' . $i ) );
						$item['secondary_button_text'] = esc_attr( realestate_base_get_option( 'featured_slider_image_secondary_button_text_' . $i ) );
						$item['secondary_button_url'] = esc_attr( realestate_base_get_option( 'featured_slider_image_secondary_button_url_' . $i ) );
						$item['caption_alignment'] = esc_attr( realestate_base_get_option( 'featured_slider_image_caption_alignment_' . $i ) );

						$slides[] = $item;
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			default:
			break;
		}
		return $input;

	}
endif;

if ( ! function_exists( 'realestate_base_add_featured_slider' ) ) :
	/**
	 * Add featured slider.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_add_featured_slider() {

		$flag_apply_slider = apply_filters( 'realestate_base_filter_slider_status', false );
		if ( true !== $flag_apply_slider ) {
			return false;
		}

		$slider_details = array();
		$slider_details = apply_filters( 'realestate_base_filter_slider_details', $slider_details );

		if ( empty( $slider_details ) ) {
			return;
		}

		// Render slider now.
		realestate_base_render_featured_slider( $slider_details );

	}
endif;

if ( ! function_exists( 'realestate_base_render_featured_slider' ) ) :
	/**
	 * Render featured slider.
	 *
	 * @since 1.0.0
	 *
	 * @param array $slider_details Details of slider content.
	 */
	function realestate_base_render_featured_slider( $slider_details = array() ) {

		if ( empty( $slider_details ) ) {
			return;
		}

		$featured_slider_transition_effect   = realestate_base_get_option( 'featured_slider_transition_effect' );
		$featured_slider_enable_caption      = realestate_base_get_option( 'featured_slider_enable_caption' );
		$featured_slider_caption_alignment   = realestate_base_get_option( 'featured_slider_caption_alignment' );
		$featured_slider_enable_arrow        = realestate_base_get_option( 'featured_slider_enable_arrow' );
		$featured_slider_enable_pager        = realestate_base_get_option( 'featured_slider_enable_pager' );
		$featured_slider_enable_autoplay     = realestate_base_get_option( 'featured_slider_enable_autoplay' );
		$featured_slider_enable_overlay      = realestate_base_get_option( 'featured_slider_enable_overlay' );
		$featured_slider_transition_duration = realestate_base_get_option( 'featured_slider_transition_duration' );
		$featured_slider_transition_delay    = realestate_base_get_option( 'featured_slider_transition_delay' );

		// Cycle data.
		$slide_data = array(
			'fx'             => esc_attr( $featured_slider_transition_effect ),
			'speed'          => esc_attr( $featured_slider_transition_duration ) * 1000,
			'pause-on-hover' => 'true',
			'loader'         => 'true',
			'log'            => 'false',
			'swipe'          => 'true',
			'auto-height'    => 'container',
		);

		if ( $featured_slider_enable_pager ) {
			$slide_data['pager-template'] = '<span class="pager-box"></span>';
		}
		if ( $featured_slider_enable_autoplay ) {
			$slide_data['timeout'] = absint( $featured_slider_transition_delay ) * 1000;
		} else {
			$slide_data['timeout'] = 0;
		}

		$slide_data['slides'] = 'article';

		$slide_attributes_text = '';
		foreach ( $slide_data as $key => $item ) {

			$slide_attributes_text .= ' ';
			$slide_attributes_text .= ' data-cycle-' . esc_attr( $key );
			$slide_attributes_text .= '="' . esc_attr( $item ) . '"';

		}
		$overlay_class = ( true === $featured_slider_enable_overlay ) ? 'overlay-enabled' : 'overlay-disabled' ;

	?>
    <div id="featured-slider">
	        <div class="cycle-slideshow <?php echo esc_attr( $overlay_class ); ?>" id="main-slider" <?php echo $slide_attributes_text; ?>>

	        	<?php if ( $featured_slider_enable_arrow ) : ?>
	        		<div class="cycle-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
	        		<div class="cycle-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
	        	<?php endif; ?>

	        	<?php $cnt = 1; ?>
	        	<?php foreach ( $slider_details as $key => $slide ) : ?>

					<?php $class_text = ( 1 === $cnt ) ? 'first' : ''; ?>
					<?php
					$target = '_self';
					if ( isset( $slide['new_window'] ) && 1 === $slide['new_window'] && ! empty( $slide['url'] ) ) {
						$target = '_blank';
					}
					$url = 'javascript:void(0);';
					if ( ! empty( $slide['url'] ) ) {
						$url = esc_url( $slide['url'] );
					}

					// Fixing title.
					$title = htmlspecialchars_decode( $slide['title'] );
					$exploded = explode( '<br>', $title );
					if ( ! empty( $exploded ) ) {
						$first_part = array_shift( $exploded );
						$exploded = array_filter( array_map( 'trim', $exploded ) );
						$second_part = implode( ' ', $exploded );
						$title = $first_part . '<span>' . $second_part . '</span>';
					}
					$title = htmlspecialchars( $title );

					// Buttons stuff.
					$buttons_markup = '';
					$primary_button_text = ! empty( $slide['primary_button_text'] ) ? $slide['primary_button_text'] : '' ;
					$primary_button_url = ! empty( $slide['primary_button_url'] ) ? $slide['primary_button_url'] : '' ;
					$secondary_button_text = ! empty( $slide['secondary_button_text'] ) ? $slide['secondary_button_text'] : '' ;
					$secondary_button_url = ! empty( $slide['secondary_button_url'] ) ? $slide['secondary_button_url'] : '' ;

					if ( ! empty( $primary_button_text ) || ! empty( $secondary_button_text ) ) {
						$buttons_markup .= '<div class="slider-buttons">';
						if ( ! empty( $primary_button_text ) ) {
							$buttons_markup .= '<a href="' . esc_url( $primary_button_url ) . '" class="custom-button slider-button button-primary">' . esc_html( $primary_button_text ) . '</a>';
						}
						if ( ! empty( $secondary_button_text ) ) {
							$buttons_markup .= '<a href="' . esc_url( $secondary_button_url ) . '" class="custom-button slider-button button-secondary">' . esc_html( $secondary_button_text ) . '</a>';
						}
						$buttons_markup .= '</div>';
					}
					?>
					<article class="<?php echo esc_attr( $class_text ); ?>" data-cycle-title="<?php echo esc_attr( $title ); ?>" data-cycle-url="<?php echo esc_url( $url ); ?>"  data-cycle-excerpt="<?php echo esc_attr( $slide['excerpt'] ); ?>" data-cycle-target="<?php echo esc_attr( $target ); ?>" data-cycle-buttons="<?php echo esc_attr( $buttons_markup ); ?>" >

						<?php if ( ! empty( $slide['url'] ) ) : ?>
							<a href="<?php echo esc_url( $slide['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>" >
							<?php endif; ?>

							<img src="<?php echo esc_url( $slide['images'][0]); ?>" alt="<?php echo esc_attr( $slide['title'] ); ?>"  />
							<?php if ( ! empty( $slide['url'] ) ) : ?>
							</a>
						<?php endif; ?>

						<?php if ( $featured_slider_enable_caption ) : ?>
							<?php
							if ( isset( $slide['caption_alignment'] ) && ! empty( $slide['caption_alignment'] ) ) {
								$caption_alignment_class = 'caption-alignment-' . esc_attr( $slide['caption_alignment'] );
							} else {
								$caption_alignment_class = 'caption-alignment-' . esc_attr( $featured_slider_caption_alignment );
							}
							?>
							<div class="cycle-caption <?php echo esc_attr( $caption_alignment_class ); ?>">
								<div class="caption-wrap">
									<h3><a href="<?php echo esc_url( $slide['url'] ); ?>"><?php echo esc_attr( $slide['title'] ); ?></a></h3>
									<p><?php echo esc_attr( $slide['excerpt'] ); ?></p>
									<?php echo wp_kses_post( $buttons_markup ); ?>
								</div><!-- .cycle-wrap -->
							</div><!-- .cycle-caption -->
						<?php endif; ?>

					</article>

					<?php $cnt++; ?>

	            <?php endforeach; ?>

	            <?php if ( $featured_slider_enable_pager ) : ?>
	            	<div class="cycle-pager"></div>
	            <?php endif; ?>
	        </div><!-- #main-slider -->
    </div><!-- #featured-slider -->

    <?php

	}

endif;

if( ! function_exists( 'realestate_base_check_slider_status' ) ) :

	/**
	 * Check status of slider.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_check_slider_status( $input ) {

		// Slider status.
		$featured_slider_status = realestate_base_get_option( 'featured_slider_status' );

		// Get Page ID outside Loop.
		$page_id = null;
		$queried_object = get_queried_object();
		if ( is_object( $queried_object ) && 'WP_Post' === get_class( $queried_object ) ) {
			$page_id = get_queried_object_id();
		}

		// Front page displays in Reading Settings.
		$page_on_front  = absint( get_option( 'page_on_front' ) );
		$page_for_posts = absint( get_option( 'page_for_posts' ) );

		switch ( $featured_slider_status ) {

			case 'disabled':
				$input = false;
				break;

			case 'home-page':
			    if ( $page_on_front === $page_id && $page_on_front > 0 ) {
					$input = true;
			    }
				break;

			default:
				break;
		}
		return $input;

	}

endif;
