<?php
/**
 * Theme widgets.
 *
 * @package Realestate_Base
 */

// Load widget base.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

if ( ! function_exists( 'realestate_base_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_load_widgets() {

		// Social widget.
		register_widget( 'Realestate_Base_Social_Widget' );

		// Featured Page widget.
		register_widget( 'Realestate_Base_Featured_Page_Widget' );

		// Latest News widget.
		register_widget( 'Realestate_Base_Latest_News_Widget' );

		// Call To Action widget.
		register_widget( 'Realestate_Base_Call_To_Action_Widget' );

		// Services widget.
		register_widget( 'Realestate_Base_Services_Widget' );

		// Testimonial widget.
		register_widget( 'Realestate_Base_Testimonial_Carousel_Widget' );

		// Recent Posts widget.
		register_widget( 'Realestate_Base_Recent_Posts_Widget' );

		// Featured Pages Grid widget.
		register_widget( 'Realestate_Base_Featured_Pages_Grid_Widget' );

		// Features widget.
		register_widget( 'Realestate_Base_Features_Widget' );

		// Latest Partners widget.
		register_widget( 'Realestate_Base_Partners_Widget' );

		// Quick Contact widget.
		register_widget( 'Realestate_Base_Quick_Contact_Widget' );

		// Stats.
		register_widget( 'Realestate_Base_Stats_Widget' );

		if ( class_exists( 'WooCommerce' ) ) {

			// Products Grid widget.
			register_widget( 'Realestate_Base_Products_Grid_Widget' );

			// Products Carousel widget.
			register_widget( 'Realestate_Base_Products_Carousel_Widget' );
		}

		if ( class_exists( 'Projects' ) ) {

			// Portfolio widget.
			register_widget( 'Realestate_Base_Portfolio_Widget' );

			// Showcase.
			register_widget( 'Realestate_Base_Showcase_Widget' );
		}
	}

endif;

add_action( 'widgets_init', 'realestate_base_load_widgets' );

if ( ! class_exists( 'Realestate_Base_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Social_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_social',
				'description'                 => __( 'Displays social icons.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => __( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'realestate-base-pro' ),
					'type'  => 'message',
					'class' => 'widefat',
					);
			}

			parent::__construct( 'realestate-base-social', __( 'RB: Social', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Featured_Page_Widget' ) ) :

	/**
	 * Featured page widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Featured_Page_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_featured_page',
				'description'                 => __( 'Displays single featured Page or Post.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'use_page_title' => array(
					'label'   => __( 'Use Page/Post Title as Widget Title', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'featured_page' => array(
					'label'            => __( 'Select Page:', 'realestate-base-pro' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => __( '&mdash; Select &mdash;', 'realestate-base-pro' ),
					),
				'id_message' => array(
					'label'            => '<strong>' . _x( 'OR', 'Featured Page Widget', 'realestate-base-pro' ) . '</strong>',
					'type'             => 'message',
					),
				'featured_post' => array(
					'label'             => __( 'Post ID:', 'realestate-base-pro' ),
					'placeholder'       => __( 'Eg: 1234', 'realestate-base-pro' ),
					'type'              => 'text',
					'sanitize_callback' => 'realestate_base_widget_sanitize_post_id',
					),
				'content_type' => array(
					'label'   => __( 'Show Content:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 'full',
					'options' => array(
						'excerpt' => __( 'Excerpt', 'realestate-base-pro' ),
						'full'    => __( 'Full', 'realestate-base-pro' ),
						),
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'realestate-base-pro' ),
					'description' => __( 'Applies when Excerpt is selected in Content option.', 'realestate-base-pro' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 100,
					'min'         => 1,
					'max'         => 400,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'realestate-base-pro' ),
					'type'    => 'select',
					'options' => realestate_base_get_image_sizes_options(),
					),
				'featured_image_alignment' => array(
					'label'   => __( 'Image Alignment:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 'center',
					'options' => realestate_base_get_image_alignment_options(),
					),
				);

			parent::__construct( 'realestate-base-featured-page', __( 'RB: Featured Page', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			$our_id = '';

			if ( absint( $params['featured_post'] ) > 0 ) {
				$our_id = absint( $params['featured_post'] );
			}

			if ( absint( $params['featured_page'] ) > 0 ) {
				$our_id = absint( $params['featured_page'] );
			}

			if ( absint( $our_id ) > 0 ) {
				$qargs = array(
					'p'             => absint( $our_id ),
					'post_type'     => 'any',
					'no_found_rows' => true,
					);

				$the_query = new WP_Query( $qargs );
				if ( $the_query->have_posts() ) {

					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						echo '<div class="featured-page-widget image-align' . esc_attr( $params['featured_image_alignment'] ) . ' entry-content">';

						if ( 'disable' != $params['featured_image'] && has_post_thumbnail() ) {
							the_post_thumbnail( esc_attr( $params['featured_image'] ) );
						}

						echo '<div class="featured-page-content">';

						if ( true === $params['use_page_title'] ) {
							the_title( $args['before_title'], $args['after_title'] );
						} else {
							if ( $params['title'] ) {
								echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
							}
						}

						if ( ! empty( $params['subtitle'] ) ) {
							echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
						}

						if ( 'excerpt' === $params['content_type'] && absint( $params['excerpt_length'] ) > 0 ) {
							$excerpt = realestate_base_the_excerpt( absint( $params['excerpt_length'] ) );
							echo wp_kses_post( wpautop( $excerpt ) );
							echo '<a href="'  . esc_url( get_permalink() ) . '" class="more-link">' . esc_html__( 'Know More', 'realestate-base-pro' ) . '</a>';
						} else {
							the_content();
						}

						echo '</div><!-- .featured-page-content -->';
						echo '</div><!-- .featured-page-widget -->';
					}

					wp_reset_postdata();
				}

			}

			echo $args['after_widget'];
		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Latest_News_Widget' ) ) :

	/**
	 * Latest news widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Latest_News_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'realestate_base_widget_latest_news',
				'description'                 => __( 'Displays latest posts in grid.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'realestate-base-pro' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'realestate-base-pro' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'realestate-base-pro' ),
					'type'    => 'number',
					'default' => 3,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'post_column' => array(
					'label'   => __( 'Number of Columns:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 3,
					'options' => realestate_base_get_numbers_dropdown_options( 3, 4 ),
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 'realestate-base-thumb',
					'options' => realestate_base_get_image_sizes_options(),
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'realestate-base-pro' ),
					'description' => __( 'in words', 'realestate-base-pro' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 15,
					'min'         => 1,
					'max'         => 400,
					'adjacent'    => true,
					),
				'more_text' => array(
					'label'   => __( 'More Text:', 'realestate-base-pro' ),
					'type'    => 'text',
					'default' => __( 'Know More', 'realestate-base-pro' ),
					),
				'disable_date' => array(
					'label'   => __( 'Disable Date', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'disable_cat' => array(
					'label'   => __( 'Disable Category', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'disable_excerpt' => array(
					'label'   => __( 'Disable Excerpt', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'disable_more_text' => array(
					'label'   => __( 'Disable More Text', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'realestate-base-latest-news', __( 'RB: Latest News', 'realestate-base-pro' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				);
			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $params['post_category'] );
			}
			$all_posts = get_posts( $qargs );
			?>
			<?php if ( ! empty( $all_posts ) ) : ?>

				<?php global $post; ?>

				<div class="latest-news-widget latest-news-col-<?php echo esc_attr( $params['post_column'] ); ?>">

					<div class="inner-wrapper">

						<?php foreach ( $all_posts as $key => $post ) : ?>
							<?php setup_postdata( $post ); ?>

							<div class="latest-news-item">
								<div class="latest-news-inner">
										<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
											<div class="latest-news-thumb">
												<a href="<?php the_permalink(); ?>">
													<?php
													$img_attributes = array( 'class' => 'aligncenter' );
													the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
													?>
												</a>
											</div><!-- .latest-news-thumb -->
										<?php endif; ?>
										<div class="latest-news-text-wrap">

											<div class="latest-news-text-content">
												<h3 class="latest-news-title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3><!-- .latest-news-title -->
												<div class="entry-meta latest-news-meta">
													<?php if ( false === $params['disable_date'] ) : ?>
														<span class="posted-on">
															<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a>
														</span>
													<?php endif; ?>

													<?php if ( false === $params['disable_cat'] ) : ?>
														<?php $category = realestate_base_get_single_post_category(); ?>
														<?php if ( ! empty( $category ) ) : ?>
															<span class="cat-links"><a href="<?php echo esc_url( $category['url'] ); ?>"><?php echo esc_html( $category['name'] ); ?></a></span>
														<?php endif; ?>
													<?php endif; ?>

												</div><!-- .latest-news-meta -->
												<?php if ( false === $params['disable_excerpt'] ) : ?>
													<div class="latest-news-summary">
													<?php
													$summary = realestate_base_the_excerpt( esc_attr( $params['excerpt_length'] ), $post );
													echo wp_kses_post( wpautop( $summary ) );
													?>
													</div><!-- .latest-news-summary -->
												<?php endif; ?>
											</div><!-- .latest-news-text-content -->

											<?php if ( false === $params['disable_more_text'] ) : ?>
												<a class="know-more" href="<?php the_permalink(); ?>" class="learn-more"><?php echo esc_html( $params['more_text'] ); ?><span class="screen-reader-text">"<?php the_title(); ?>"</span>
												</a>
											<?php endif; ?>

										</div><!-- .latest-news-text-wrap -->
									</div><!-- .latest-news-inner -->
							</div><!-- .latest-news-item -->

						<?php endforeach; ?>
					</div><!-- .row -->

				</div><!-- .latest-news-widget -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Call_To_Action_Widget' ) ) :

	/**
	 * Call to action widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Call_To_Action_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_call_to_action',
				'description'                 => __( 'Call To Action Widget.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'description' => array(
					'label' => __( 'Description:', 'realestate-base-pro' ),
					'type'  => 'textarea',
					'class' => 'widefat',
					),
				'primary_button_text' => array(
					'label'   => __( 'Primary Button Text:', 'realestate-base-pro' ),
					'default' => __( 'Learn more', 'realestate-base-pro' ),
					'type'    => 'text',
					'class'   => 'widefat',
					),
				'primary_button_url' => array(
					'label' => __( 'Primary Button URL:', 'realestate-base-pro' ),
					'type'  => 'url',
					'class' => 'widefat',
					),
				'secondary_button_text' => array(
					'label'   => __( 'Secondary Button Text:', 'realestate-base-pro' ),
					'default' => '',
					'type'    => 'text',
					'class'   => 'widefat',
					),
				'secondary_button_url' => array(
					'label' => __( 'Secondary Button URL:', 'realestate-base-pro' ),
					'type'  => 'url',
					'class' => 'widefat',
					),
				'layout' => array(
					'label'   => esc_html__( 'Select Layout:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 1,
					'options' => realestate_base_get_numbers_dropdown_options( 1, 2, esc_html__( 'Layout', 'realestate-base-pro' ) . ' ' ),
					),
				'background_image' => array(
					'label'   => __( 'Background Image:', 'realestate-base-pro' ),
					'type'    => 'image',
					'default' => '',
					),
				'background_image_message' => array(
					'label'   => __( 'Background Image applies to Layout 2 only.', 'realestate-base-pro' ) . ' ' . sprintf( __( 'Recommended image size: %1$dpx X %2$dpx', 'realestate-base-pro' ) , 1920, 390 ),
					'type'    => 'message',
					),
				'enable_background_overlay' => array(
					'label'   => __( 'Enable Background Overlay', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				);

			parent::__construct( 'realestate-base-call-to-action', __( 'RB: Call To Action', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			// Add background image for layout 2.
			if ( 2 === absint( $params['layout'] ) && ! empty( $params['background_image'] ) ) {
				$background_style = '';
				$background_style .= ' style="background-image:url(' . esc_url( $params['background_image'] ) . ');" ';
				$args['before_widget'] = implode( $background_style . ' ' . 'class="', explode( 'class="', $args['before_widget'], 2 ) );
			}

			// Add overlay class.
			$overlay_class = ( true === $params['enable_background_overlay'] ) ? 'overlay-enabled' : 'overlay-disabled';
			$overlay_class .= ' cta-layout-' . absint( $params['layout'] ) . ' ';
			$args['before_widget'] = implode( 'class="' . $overlay_class . ' ', explode( 'class="', $args['before_widget'], 2 ) );

			echo $args['before_widget'];
			echo '<div class="call-to-action-main-wrap">';
			echo '<div class="call-to-action-content-wrap">';
			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}
			?>
			<div class="call-to-action-content">
				<?php if ( ! empty( $params['description'] ) ) : ?>
					<div class="call-to-action-description">
						<?php echo wp_kses_post( wpautop( $params['description'] ) ); ?>
					</div><!-- .call-to-action-description -->
				<?php endif; ?>
			</div><!-- .call-to-action-content -->
			<?php echo '</div>'; ?>
			<?php if ( ( ! empty( $params['primary_button_text'] ) && ! empty( $params['primary_button_url'] ) ) || ( ! empty( $params['secondary_button_text'] ) && ! empty( $params['secondary_button_url'] ) )  ) : ?>
				<div class="call-to-action-buttons">
					<?php if ( ! empty( $params['primary_button_url'] ) && ! empty( $params['primary_button_text'] ) ) : ?>
						<a href="<?php echo esc_url( $params['primary_button_url'] ); ?>" class="custom-button btn-call-to-action button-primary"><?php echo esc_html( $params['primary_button_text'] ); ?></a>
					<?php endif; ?>
					<?php if ( ! empty( $params['secondary_button_url'] ) && ! empty( $params['secondary_button_text'] ) ) : ?>
						<a href="<?php echo esc_url( $params['secondary_button_url'] ); ?>" class="custom-button btn-call-to-action button-secondary"><?php echo esc_html( $params['secondary_button_text'] ); ?></a>
					<?php endif; ?>
				</div><!-- .call-to-action-buttons -->
			<?php endif; ?>
			<?php echo '</div>'; ?>
			<?php

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Services_Widget' ) ) :

	/**
	 * Services widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Services_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_services',
				'description'                 => __( 'Show your services with icon and read more link.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'realestate-base-pro' ),
					'description' => __( 'in words', 'realestate-base-pro' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 15,
					'min'         => 1,
					'max'         => 400,
					'adjacent'    => true,
					),
				'disable_excerpt' => array(
					'label'   => __( 'Disable Excerpt', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'more_text' => array(
					'label'   => __( 'Read More Text:', 'realestate-base-pro' ),
					'type'    => 'text',
					'default' => __( 'Know More', 'realestate-base-pro' ),
					),
				'disable_more_text' => array(
					'label'   => __( 'Disable Read More', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'enable_image' => array(
					'label'   => __( 'Show featured image instead of icon.', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			for( $i = 1; $i <= 6; $i++ ) {
				$fields[ 'block_heading_' . $i ] = array(
					'label' => __( 'Block', 'realestate-base-pro' ) . ' #' . $i,
					'type'  => 'heading',
					'class' => 'widefat',
					);
				$fields[ 'block_page_' . $i ] = array(
					'label'            => __( 'Select Page:', 'realestate-base-pro' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => __( '&mdash; Select &mdash;', 'realestate-base-pro' ),
					);
				$fields[ 'block_icon_' . $i ] = array(
					'label'       => __( 'Icon:', 'realestate-base-pro' ),
					'description' => __( 'Eg: fa-cogs', 'realestate-base-pro' ),
					'type'        => 'text',
					'default'     => 'fa-cogs',
					'adjacent'    => true,
					);

				if ( 1 === $i ) {
					$fields[ 'block_icon_message_' . $i ] = array(
						'label' => sprintf( __( 'Reference: %s', 'realestate-base-pro' ), '<a href="https://fontawesome.com/cheatsheet/">' . __( 'View Icons', 'realestate-base-pro' ) . '</a>' ),
						'type'  => 'message',
						);
				}
			}

			parent::__construct( 'realestate-base-services', __( 'RB: Services', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}
			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$service_arr = array();
			for ( $i = 0; $i < 6 ; $i++ ) {
				$block = ( $i + 1 );
				$service_arr[ $i ] = array(
					'page' => $params[ 'block_page_' . $block ],
					'icon' => $params[ 'block_icon_' . $block ],
					);
			}
			$refined_arr = array();
			if ( ! empty( $service_arr ) ) {
				foreach ( $service_arr as $item ) {
					if ( ! empty( $item['page'] ) ) {
						$refined_arr[ $item['page'] ] = $item;
					}
				}
			}

			if ( ! empty( $refined_arr ) ) {
				$this->render_widget_content( $refined_arr, $params );
			}

			echo $args['after_widget'];

		}

		/**
		 * Render services content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $service_arr Services array.
		 * @param array $params      Parameters array.
		 */
		function render_widget_content( $service_arr, $params ) {

			$column = count( $service_arr );

			$page_ids = array_keys( $service_arr );

			$qargs = array(
				'posts_per_page' => count( $page_ids ),
				'post__in'       => $page_ids,
				'post_type'      => 'page',
				'orderby'        => 'post__in',
				'no_found_rows'  => true,
			);

			$all_posts = get_posts( $qargs );
			?>
			<?php if ( ! empty( $all_posts ) ) : ?>

				<?php global $post; ?>

				<div class="service-block-list service-col-<?php echo esc_attr( $column ); ?>">
					<div class="inner-wrapper">

						<?php foreach ( $all_posts as $post ) : ?>
							<?php setup_postdata( $post ); ?>
							<div class="service-block-item">
								<div class="service-block-inner">
									<?php if ( true === $params['enable_image'] ) : ?>

										<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
											<a class="service-icon" href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										<?php endif; ?>

									<?php else : ?>

										<?php if ( isset( $service_arr[ $post->ID ]['icon'] ) && ! empty( $service_arr[ $post->ID ]['icon'] ) ) : ?>
											<a class="service-icon" href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><i class="<?php echo 'fa ' . esc_attr( $service_arr[ $post->ID ]['icon'] ); ?>"></i></a>
										<?php endif; ?>

									<?php endif; ?>
									<div class="service-block-inner-content">
										<h3 class="service-item-title">
											<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
												<?php echo get_the_title( $post->ID ); ?>
											</a>
										</h3>
										<?php if ( true !== $params['disable_excerpt'] ) :  ?>
											<div class="service-block-item-excerpt">
												<?php
												$excerpt = realestate_base_the_excerpt( $params['excerpt_length'], $post );
												echo wp_kses_post( wpautop( $excerpt ) );
												?>
											</div><!-- .service-block-item-excerpt -->
										<?php endif; ?>

										<?php if ( true !== $params['disable_more_text'] ) :  ?>
											<a class="know-more" href="<?php echo esc_url( get_permalink( $post -> ID ) ); ?>" ><?php echo esc_html( $params['more_text'] ); ?></a>
										<?php endif; ?>
									</div><!-- .service-block-inner-content -->
								</div><!-- .service-block-inner -->
							</div><!-- .service-block-item -->
						<?php endforeach; ?>

					</div><!-- .inner-wrapper -->

				</div><!-- .service-block-list -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php
		}

	}
endif;

if ( ! class_exists( 'Realestate_Base_Testimonial_Carousel_Widget' ) ) :

	/**
	 * Testimonial Carousel widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Testimonial_Carousel_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'   => 'realestate_base_widget_testimonial_carousel',
				'description' => __( 'Displays Testimonials as a Carousel.', 'realestate-base-pro' ),
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'realestate-base-pro' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'realestate-base-pro' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'realestate-base-pro' ),
					'type'    => 'number',
					'default' => 5,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'realestate-base-pro' ),
					'description' => __( 'in words', 'realestate-base-pro' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 30,
					'min'         => 1,
					'max'         => 400,
					'adjacent'    => true,
					),
				'background_image' => array(
					'label'   => __( 'Background Image:', 'realestate-base-pro' ),
					'type'    => 'image',
					'default' => '',
					),
				'enable_background_overlay' => array(
					'label'   => __( 'Enable Background Overlay', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				'carousel_heading' => array(
					'label'   => __( 'CAROUSEL OPTIONS', 'realestate-base-pro' ),
					'type'    => 'heading',
					),
				'transition_delay' => array(
					'label'       => __( 'Transition Delay:', 'realestate-base-pro' ),
					'description' => __( 'in seconds', 'realestate-base-pro' ),
					'type'        => 'number',
					'default'     => 3,
					'css'         => 'max-width:50px;',
					'min'         => 1,
					'max'         => 10,
					'adjacent'    => true,
					),
				'enable_autoplay' => array(
					'label'   => __( 'Enable Autoplay', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'realestate-base-testimonial-carousel', __( 'RB: Testimonial Carousel', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			// Add background image.
			if ( ! empty( $params['background_image'] ) ) {
				$background_style = '';
				$background_style .= ' style="background-image:url(' . esc_url( $params['background_image'] ) . ');" ';
				$args['before_widget'] = implode( $background_style . ' ' . 'class="', explode( 'class="', $args['before_widget'], 2 ) );
			}

			// Add overlay class.
			$overlay_class = ( true === $params['enable_background_overlay'] ) ? 'overlay-enabled' : 'overlay-disabled';
			$args['before_widget'] = implode( 'class="' . $overlay_class . ' ', explode( 'class="', $args['before_widget'], 2 ) );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$testimonial_posts = $this->get_testimonials( $params );

			if ( ! empty( $testimonial_posts ) ) {
				$this->render_testimonials( $testimonial_posts, $params );
			}

			echo $args['after_widget'];

		}

		/**
		 * Return testimonial posts detail.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return array Posts details.
		 */
		function get_testimonials( $params ) {

			$output = array();

			$qargs = array(
				'posts_per_page' => absint( $params['post_number'] ),
				'no_found_rows'  => true,
				);

			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $params['post_category'] );
			}

			$all_posts = get_posts( $qargs );

			if ( ! empty( $all_posts ) ) {
				$cnt = 0;
				global $post;
				foreach ( $all_posts as $key => $post ) {

					setup_postdata( $post );

					$item = array();
					$item['title']   = get_the_title( $post->ID );
					$item['excerpt'] = realestate_base_the_excerpt( absint( $params['excerpt_length'] ), $post );
					$item['image']   = null;
					if ( has_post_thumbnail( $post->ID ) ) {
						$image_detail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
						if ( ! empty( $image_detail ) ) {
							$item['image'] = $image_detail;
						}
					}

					$output[ $cnt ] = $item;
					$cnt++;

				}

				wp_reset_postdata();
			}

			return $output;

		}

		/**
		 * Render testimonial slider.
		 *
		 * @since 1.0.0
		 *
		 * @param array $testimonials Testimonials.
		 * @param array $params Parameters.
		 * @return void
		 */
		function render_testimonials( $testimonials, $params ) {

			$carousel_args = array(
				'slidesToShow'   => 3,
				'slidesToScroll' => 1,
				'dots'           => false,
				'prevArrow'      => '<span data-role="none" class="slick-prev" tabindex="0"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
				'nextArrow'      => '<span data-role="none" class="slick-next" tabindex="0"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
				'responsive'     => array(
					array(
						'breakpoint' => 1024,
						'settings'   => array(
							'slidesToShow' => 1,
							),
						),
					),
				);

			if ( true === $params['enable_autoplay'] ) {
				$carousel_args['autoplay']      = true;
				$carousel_args['autoplaySpeed'] = 1000 * absint( $params['transition_delay'] );
			}

			$carousel_args_encoded = wp_json_encode( $carousel_args );
			?>
			<div class="testimonial-carousel-wrapper" data-slick='<?php echo $carousel_args_encoded; ?>'>

				<?php foreach ( $testimonials as $testimonial ) : ?>

					<article>
						<div class="testimonial-content-area">
						<?php if ( ! empty( $testimonial['image'] ) ) : ?>
							<div class="testimonial-thumb"><img src="<?php echo esc_url( $testimonial['image'][0] ); ?>" /></div> <!-- .testimonial-thumb -->
						<?php endif; ?>
						<?php if ( ! empty( $testimonial['excerpt'] ) ) : ?>
							<div class="testimonial-excerpt">
								<?php echo wp_kses_post( wpautop( $testimonial['excerpt'] ) ); ?>
							</div><!-- .testimonial-excerpt -->
						<?php endif; ?>
						<h4><?php echo esc_html( $testimonial['title'] ); ?></h4>
						<div class="star-review">
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
							<i class="fa fa-star" aria-hidden="true"></i>
						</div>
						</div> <!-- .testimonial-content-area -->
					</article>

				<?php endforeach; ?>
			</div><!-- .testimonial-carousel-wrapper -->

			<?php

		}

	}
endif;

if ( ! class_exists( 'Realestate_Base_Recent_Posts_Widget' ) ) :

	/**
	 * Recent posts widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Recent_Posts_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_recent_posts',
				'description'                 => __( 'Displays recent posts.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'realestate-base-pro' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'realestate-base-pro' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'realestate-base-pro' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 'thumbnail',
					'options' => realestate_base_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
					),
				'image_width' => array(
					'label'       => __( 'Image Width:', 'realestate-base-pro' ),
					'type'        => 'number',
					'description' => __( 'px', 'realestate-base-pro' ),
					'css'         => 'max-width:60px;',
					'adjacent'    => true,
					'default'     => 70,
					'min'         => 1,
					'max'         => 150,
					),
				'disable_date' => array(
					'label'   => __( 'Disable Date', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'realestate-base-recent-posts', __( 'RB: Recent Posts', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}
			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}
			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				);
			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = $params['post_category'];
			}
			$all_posts = get_posts( $qargs );

			?>
			<?php if ( ! empty( $all_posts ) ) :  ?>

				<?php global $post; ?>

				<div class="recent-posts-wrapper">

					<?php foreach ( $all_posts as $key => $post ) :  ?>
						<?php setup_postdata( $post ); ?>

						<div class="recent-posts-item">

							<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) :  ?>
								<div class="recent-posts-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . esc_attr( $params['image_width'] ). 'px;',
											);
										the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
										?>
									</a>
								</div><!-- .recent-posts-thumb -->
							<?php endif ?>
							<div class="recent-posts-text-wrap">
								<h3 class="recent-posts-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3><!-- .recent-posts-title -->

								<?php if ( false === $params['disable_date'] ) :  ?>
									<div class="recent-posts-meta">

										<?php if ( false === $params['disable_date'] ) :  ?>
											<span class="recent-posts-date"><?php the_time( get_option( 'date_format' ) ); ?></span><!-- .recent-posts-date -->
										<?php endif; ?>

									</div><!-- .recent-posts-meta -->
								<?php endif; ?>

							</div><!-- .recent-posts-text-wrap -->

						</div><!-- .recent-posts-item -->

					<?php endforeach; ?>

				</div><!-- .recent-posts-wrapper -->

				<?php wp_reset_postdata(); // Reset. ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Featured_Pages_Grid_Widget' ) ) :

	/**
	 * Featured pages grid widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Featured_Pages_Grid_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_featured_pages_grid',
				'description'                 => __( 'Displays featured pages in grid.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'layout' => array(
					'label'   => __( 'Select Layout:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 1,
					'options' => realestate_base_get_numbers_dropdown_options( 1, 2, esc_html__( 'Layout', 'realestate-base-pro' ) . ' ' ),
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 'realestate-base-thumb',
					'options' => realestate_base_get_image_sizes_options( false ),
					),
				'post_column' => array(
					'label'   => __( 'Number of Columns:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 3,
					'options' => realestate_base_get_numbers_dropdown_options( 3, 4 ),
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'realestate-base-pro' ),
					'description' => __( 'in words', 'realestate-base-pro' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 15,
					'min'         => 1,
					'max'         => 400,
					'adjacent'    => true,
					),
				'disable_excerpt' => array(
					'label'   => __( 'Disable Excerpt', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'more_text' => array(
					'label'   => __( 'Read More Text:', 'realestate-base-pro' ),
					'type'    => 'text',
					'default' => __( 'Know More', 'realestate-base-pro' ),
					),
				);

			for( $i = 1; $i <= 8; $i++ ) {
				$fields[ 'block_page_' . $i ] = array(
					'label'            => sprintf( __( 'Page #%d:', 'realestate-base-pro' ), $i ),
					'type'             => 'dropdown-pages',
					'show_option_none' => __( '&mdash; Select &mdash;', 'realestate-base-pro' ),
					);
			}

			parent::__construct( 'realestate-base-featured-pages-grid', __( 'RB: Featured Pages Grid', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$pages_arr = array();
			for ( $i = 0; $i < 8; $i++ ) {
				$block = ( $i + 1 );
				if ( absint( $params[ 'block_page_' . $block ] ) > 0 ) {
					$pages_arr[] = absint( $params[ 'block_page_' . $block ] );
				}
			}

			if ( ! empty( $pages_arr ) ) {
				$qargs = array(
					'no_found_rows'  => true,
					'orderby'        => 'post__in',
					'post__in'       => $pages_arr,
					'post_type'      => 'page',
					'posts_per_page' => count( $pages_arr ),
				);

				$the_query = new WP_Query( $qargs );

				if ( $the_query->have_posts() ) {

					echo '<div class="featured-pages-grid featured-pages-layout-' . absint( $params['layout'] ) . ' grid-column-' . absint( $params['post_column'] ) . '">';
					echo '<div class="inner-wrapper">';

					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
						<div class="grid-item">
							<div class="grid-item-inner">
								<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
									<div class="grid-item-thumb">
										<a href="<?php the_permalink(); ?>">
											<?php
											$img_attributes = array( 'class' => 'aligncenter' );
											the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
											?>
										</a>
									</div><!-- .grid-item-thumb -->
								<?php else : ?>
									<div class="grid-item-thumb">
										<a href="<?php the_permalink(); ?>">
											<img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image-thumb.png' ); ?>" alt="" class="aligncenter" />
										</a>
									</div><!-- .grid-item-thumb -->
								<?php endif; ?>
								<div class="grid-text-content">

									<h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php if ( false === $params['disable_excerpt'] ) : ?>
										<div class="grid-summary">
										<?php
										$excerpt = realestate_base_the_excerpt( esc_attr( $params['excerpt_length'] ) );
										echo wp_kses_post( wpautop( $excerpt ) );
										?>
										</div><!-- .grid-summary -->
									<?php endif; ?>

									<?php if ( ! empty( $params['more_text'] ) ) : ?>
										<a href="<?php the_permalink(); ?>" class="custom-button"><?php echo esc_html( $params['more_text'] ); ?><span class="screen-reader-text">"<?php the_title(); ?>"</span>
										</a>
									<?php endif; ?>

								</div><!-- .grid-text-content -->
							</div><!-- .grid-item-inner -->
						</div><!-- .grid-item -->
						<?php
					}

					echo '</div><!-- .inner-wrapper -->';
					echo '</div><!-- .featured-pages-grid -->';

					wp_reset_postdata();
				}

			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Features_Widget' ) ) :

	/**
	 * Features widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Features_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'realestate_base_widget_features',
				'description'                 => __( 'Displays features.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'main_image' => array(
					'label'       => __( 'Main Image:', 'realestate-base-pro' ),
					'description' => __( 'Square image is recommended.', 'realestate-base-pro' ),
					'type'        => 'image',
					),
				);

			for( $i = 1; $i <= 6; $i++ ) {
				$fields[ 'block_heading_' . $i ] = array(
					'label' => __( 'Block', 'realestate-base-pro' ) . ' #' . $i,
					'type'  => 'heading',
					'class' => 'widefat',
					);
				$fields[ 'block_page_' . $i ] = array(
					'label'            => __( 'Select Page:', 'realestate-base-pro' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => __( '&mdash; Select &mdash;', 'realestate-base-pro' ),
					);
				$fields[ 'block_icon_' . $i ] = array(
					'label'       => __( 'Icon:', 'realestate-base-pro' ),
					'description' => __( 'Eg: fa-cogs', 'realestate-base-pro' ),
					'type'        => 'text',
					'default'     => '',
					'adjacent'    => true,
					);

				if ( 1 === $i ) {
					$fields[ 'block_icon_message_' . $i ] = array(
						'label' => sprintf( __( 'Reference: %s', 'realestate-base-pro' ), '<a href="https://fontawesome.com/cheatsheet/">' . __( 'View Icons', 'realestate-base-pro' ) . '</a>' ),
						'type'  => 'message',
						);
				}
			}

			parent::__construct( 'realestate-base-features', __( 'RB: Features', 'realestate-base-pro' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$feature_arr = array();
			for ( $i = 0; $i < 6 ; $i++ ) {
				$block = ( $i + 1 );
				$feature_arr[ $i ] = array(
					'page' => $params[ 'block_page_' . $block ],
					'icon' => $params[ 'block_icon_' . $block ],
					);
			}
			$refined_arr = array();
			if ( ! empty( $feature_arr ) ) {
				foreach ( $feature_arr as $item ) {
					if ( ! empty( $item['page'] ) ) {
						$refined_arr[] = $item;
					}
				}
			}

			if ( ! empty( $refined_arr ) ) {
				$this->render_widget_content( $refined_arr, $params );
			}

			echo $args['after_widget'];

		}

		function get_details( $items ) {
			$output = array();

			$page_ids = wp_list_pluck( $items, 'page' );
			$qargs = array(
				'post__in'       => $page_ids,
				'post_type'      => 'page',
				'orderby'        => 'post__in',
				'no_found_rows'  => true,
				'posts_per_page' => absint( count( $page_ids ) ),
			);
			$all_posts = get_posts( $qargs );
			if ( ! empty( $all_posts ) ) {
				$cnt = 0;
				foreach ( $all_posts as $post ) {
					$item = array();
					$item['title']   = get_the_title( $post->ID );
					$item['url']     = get_permalink( $post->ID );
					$item['excerpt'] = realestate_base_the_excerpt( 10, $post );
					$item['icon']    = '';
					if ( isset( $items[ $cnt ]['icon'] ) ) {
						$item['icon'] = $items[ $cnt ]['icon'];
					}
					$output[] = $item;
					$cnt++;
				}

			}

			return $output;
		}

		/**
		 * Render feature content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $feature_arr Features array.
		 * @param array $params      Parameters array.
		 */
		function render_widget_content( $feature_arr, $params ) {

			$item_details = $this->get_details( $feature_arr );

			if ( empty( $item_details ) ) {
				return;
			}

			$image_status_class = ( ! empty( $params['main_image'] ) ) ? 'main-image-enabled' : 'main-image-disabled';
			?>
			<div class="features-widget <?php echo esc_attr( $image_status_class ); ?>">
				<div class="inner-wrapper">
					<?php if ( ! empty( $params['main_image'] ) ) : ?>
						<div class="features-column features-thumb-main">
							<img src="<?php echo esc_url( $params['main_image'] ); ?>" alt="" />
						</div><!-- .features-thumb-main -->
					<?php endif; ?>
					<?php if ( ! empty( $item_details ) ) : ?>
						<div class="features-column features-main-content">
							<div class="features-page">
								<div class="features-block-list">
									<div class="inner-wrapper">
										<?php foreach ( $item_details as $item ) : ?>
											<div class="features-block-item">
												<div class="features-block-inner">
													<?php if ( ! empty( $item['icon'] ) ) : ?>
														<a class="features-block-icon" href="<?php echo esc_url( $item['url'] ); ?>"><i class="fa <?php echo esc_attr( $item['icon'] ); ?>"></i></a>
													<?php endif; ?>
													<div class="features-block-inner-content">
														<h3 class="features-item-title">
															<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
														</h3>
														<?php if ( ! empty( $item['excerpt'] ) ) : ?>
															<div class="features-item-excerpt">
																<?php echo wp_kses_post( wpautop( $item['excerpt'] ) ); ?>
															</div><!-- .features-item-excerpt -->
														<?php endif; ?>
													</div><!-- .features-block-inner-content -->
												</div><!-- .features-block-inner -->
											</div><!-- .features-block-item -->
										<?php endforeach; ?>
									</div><!-- .inner-wrapper -->
								</div><!-- .features-block-list -->
							</div><!-- .features-page -->
						</div><!-- .features-main-content -->
					<?php endif; ?>
				</div><!-- .inner-wrapper -->
			</div><!-- .features-widget -->

			<?php
		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Showcase_Widget' ) ) :

	/**
	 * Featured pages grid widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Showcase_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_showcase',
				'description'                 => __( 'Displays projects.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'realestate-base-pro' ),
					'description' => __( 'in words', 'realestate-base-pro' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 45,
					'min'         => 1,
					'max'         => 400,
					'adjacent'    => true,
					),
				'more_text' => array(
					'label'   => __( 'Read More Text:', 'realestate-base-pro' ),
					'type'    => 'text',
					'default' => __( 'Know More', 'realestate-base-pro' ),
					),
				);

			for( $i = 1; $i <= 8; $i++ ) {
				$fields[ 'block_post_' . $i ] = array(
					'label'   => sprintf( __( 'Project #%d:', 'realestate-base-pro' ), $i ),
					'type'    => 'select',
					'options' => $this->get_projects_options(),
					);
			}

			parent::__construct( 'realestate-base-showcase', __( 'RB: Showcase', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Return projects options.
		 *
		 * @since 1.0.0
		 *
		 * @return array Project options.
		 */
		private function get_projects_options() {
			$output = array();
			$output[] = __( '&mdash; Select &mdash;', 'realestate-base-pro' );

			$args = array(
				'post_type'           => 'project',
				'posts_per_page'      => 1000,
				'order'               => 'ASC',
				'orderby'             => 'name',
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				);

			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$id = get_the_ID();
					$output[ $id ] = get_the_title();
				}

				wp_reset_postdata();
			}

			return $output;
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$posts_arr = array();
			for ( $i = 0; $i < 8; $i++ ) {
				$block = ( $i + 1 );
				if ( absint( $params[ 'block_post_' . $block ] ) > 0 ) {
					$posts_arr[] = absint( $params[ 'block_post_' . $block ] );
				}
			}

			if ( ! empty( $posts_arr ) ) {
				$qargs = array(
					'no_found_rows'  => true,
					'orderby'        => 'post__in',
					'post__in'       => $posts_arr,
					'post_type'      => 'project',
					'posts_per_page' => count( $posts_arr ),
				);

				$the_query = new WP_Query( $qargs );

				if ( $the_query->have_posts() ) {

					echo '<div class="showcase">';

					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						$oddeven = ( 0 === $the_query->current_post % 2 ) ? 'even' : 'odd';
						?>
						<div class="showcase-item showcase-item-<?php echo esc_attr( $oddeven ); ?>">
							<div class="showcase-item-inner">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="showcase-item-thumb">
										<a href="<?php the_permalink(); ?>">
											<?php
											$img_attributes = array( 'class' => 'aligncenter' );
											the_post_thumbnail( 'large', $img_attributes );
											?>
										</a>
									</div><!-- .showcase-item-thumb -->
								<?php else : ?>
									<div class="showcase-item-thumb">
										<a href="<?php the_permalink(); ?>">
											<img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image-thumb.png' ); ?>" alt="" class="aligncenter" />
										</a>
									</div><!-- .showcase-item-thumb -->
								<?php endif; ?>
								<div class="showcase-grid-text-content">

									<h3 class="showcase-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="showcase-grid-summary">
									<?php
									$excerpt = realestate_base_the_excerpt( esc_attr( $params['excerpt_length'] ) );
									echo wp_kses_post( wpautop( $excerpt ) );
									?>
									</div><!-- .grid-summary -->

									<?php if ( ! empty( $params['more_text'] ) ) : ?>
										<a href="<?php the_permalink(); ?>" class="custom-button"><?php echo esc_html( $params['more_text'] ); ?><span class="screen-reader-text">"<?php the_title(); ?>"</span>
										</a>
									<?php endif; ?>

								</div><!-- .grid-text-content -->
							</div><!-- .showcase-item-inner -->
						</div><!-- .showcase-item -->
						<?php
					}
					echo '</div><!-- .showcase -->';

					wp_reset_postdata();
				}

			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Stats_Widget' ) ) :

	/**
	 * Stats grid widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Stats_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_stats',
				'description'                 => __( 'Displays Stats.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'background_image' => array(
					'label'   => __( 'Background Image:', 'realestate-base-pro' ),
					'type'    => 'image',
					'default' => '',
					),
				'enable_background_overlay' => array(
					'label'   => __( 'Enable Background Overlay', 'realestate-base-pro' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				);

			for( $i = 1; $i <= 5; $i++ ) {
				$fields[ 'block_heading_' . $i ] = array(
					'label' => __( 'Block', 'realestate-base-pro' ) . ' #' . $i,
					'type'  => 'heading',
					'class' => 'widefat',
					);
				$fields[ 'block_icon_' . $i ] = array(
					'label'       => __( 'Icon:', 'realestate-base-pro' ),
					'description' => __( 'Eg: fa-cogs', 'realestate-base-pro' ),
					'type'        => 'text',
					'default'     => 'fa-cogs',
					'adjacent'    => true,
					);
				if ( 1 === $i ) {
					$fields[ 'block_icon_message_' . $i ] = array(
						'label' => sprintf( __( 'Reference: %s', 'realestate-base-pro' ), '<a href="https://fontawesome.com/cheatsheet/">' . __( 'View Icons', 'realestate-base-pro' ) . '</a>' ),
						'type'  => 'message',
						);
				}
				$fields[ 'block_number_' . $i ] = array(
					'label' => __( 'Enter Number:', 'realestate-base-pro' ),
					'type'  => 'text',
					);
				$fields[ 'block_title_' . $i ] = array(
					'label' => __( 'Enter Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					);
			}

			parent::__construct( 'realestate-base-stats', __( 'RB: Stats', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			// Add background image.
			if ( ! empty( $params['background_image'] ) ) {
				$background_style = '';
				$background_style .= ' style="background-image:url(' . esc_url( $params['background_image'] ) . ');" ';
				$args['before_widget'] = implode( $background_style . ' ' . 'class="', explode( 'class="', $args['before_widget'], 2 ) );
			}

			// Add overlay class.
			$overlay_class = ( true === $params['enable_background_overlay'] ) ? 'overlay-enabled' : 'overlay-disabled';
			$args['before_widget'] = implode( 'class="' . $overlay_class . ' ', explode( 'class="', $args['before_widget'], 2 ) );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$blocks_arr = array();
			for ( $i = 0; $i < 5; $i++ ) {
				$block = ( $i + 1 );
				if ( ! empty( $params[ 'block_number_' . $block ] ) ) {
					$item = array();

					$item['number'] = $params[ 'block_number_' . $block ];
					$item['title']  = $params[ 'block_title_' . $block ];
					$item['icon']   = $params[ 'block_icon_' . $block ];

					$blocks_arr[] = $item;
				}
			}

			if ( ! empty( $blocks_arr ) ) {
				$column_count = count( $blocks_arr );
				?>
				<div class="counter-section counter-col-<?php echo absint( $column_count); ?>">
					<div class="inner-wrapper">
						<?php foreach ( $blocks_arr as $block_item ) : ?>
							<div class="counter-item">
								<div class="counter-text-wrap">
									<?php if ( ! empty( $block_item['icon'] ) ) : ?>
										<div class="counter-icon">
											<i class="fa <?php echo esc_attr( $block_item['icon'] ); ?>"></i>
										</div>
									<?php endif; ?>
									<?php if ( ! empty( $block_item['number'] ) ) : ?>
										<p class="counter-nos"><?php echo esc_html( $block_item['number'] ); ?></p>
									<?php endif; ?>
									<?php if ( ! empty( $block_item['title'] ) ) : ?>
										<h3 class="counter-title"><?php echo esc_html( $block_item['title'] ); ?></h3>
									<?php endif; ?>
								</div><!-- .counter-text-wrap -->
							</div><!-- .counter-item -->
						<?php endforeach; ?>
					</div><!-- .inner-wrapper -->
				</div><!-- .counter-section -->
				<?php
			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Products_Grid_Widget' ) ) :

	/**
	 * Products Grid Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Products_Grid_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_products_grid',
				'description'                 => esc_html__( 'Displays products in grid.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => esc_html__( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'product_category' => array(
					'label'           => esc_html__( 'Select Product Category:', 'realestate-base-pro' ),
					'type'            => 'dropdown-taxonomies',
					'taxonomy'        => 'product_cat',
					'show_option_all' => esc_html__( 'All Product Categories', 'realestate-base-pro' ),
					),
				'post_number' => array(
					'label'   => esc_html__( 'Number of Products:', 'realestate-base-pro' ),
					'type'    => 'number',
					'default' => 6,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'post_column' => array(
					'label'   => esc_html__( 'Number of Columns:', 'realestate-base-pro' ),
					'type'    => 'select',
					'default' => 4,
					'options' => realestate_base_get_numbers_dropdown_options( 3, 4 ),
					),
				);

			parent::__construct( 'realestate-base-products-grid', esc_html__( 'RB: Products Grid', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			// Render now.
			$this->render_products( $params );

			echo $args['after_widget'];

		}

		/**
		 * Render products.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return void
		 */
		function render_products( $params ) {

			$query_args = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => esc_attr( $params['post_number'] ),
				'no_found_rows'       => true,
			);
			if ( absint( $params['product_category'] ) > 0 ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => absint( $params['product_category'] ),
						),
					);
			}

			global $woocommerce_loop;
			$products = new WP_Query( $query_args );

			if ( $products->have_posts() ) {
				?>
				<div class="inner-wrapper">
					<div class="realestate-base-woocommerce realestate-base-woocommerce-product-grid-<?php echo absint( $params['post_column'] ); ?>">

						<ul class="products">

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; ?>

						</ul><!-- .products -->

					</div><!-- .woocommerce -->
				</div> <!-- .inner-wrapper -->
				<?php
			}
			woocommerce_reset_loop();
			wp_reset_postdata();

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Products_Carousel_Widget' ) ) :

	/**
	 * Products Carousel Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Products_Carousel_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'   => 'realestate_base_widget_products_carousel',
				'description' => esc_html__( 'Displays products as carousel.', 'realestate-base-pro' ),
				);
			$fields = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => esc_html__( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'product_category' => array(
					'label'           => esc_html__( 'Select Product Category:', 'realestate-base-pro' ),
					'type'            => 'dropdown-taxonomies',
					'taxonomy'        => 'product_cat',
					'show_option_all' => esc_html__( 'All Product Categories', 'realestate-base-pro' ),
					),
				'post_number' => array(
					'label'   => esc_html__( 'Number of Products:', 'realestate-base-pro' ),
					'type'    => 'number',
					'default' => 6,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				);

			parent::__construct( 'realestate-base-products-carousel', esc_html__( 'RB: Products Carousel', 'realestate-base-pro' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			// Render now.
			$this->render_products( $params );

			echo $args['after_widget'];

		}

		/**
		 * Render products.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return void
		 */
		function render_products( $params ) {

			$carousel_args = array(
				'slidesToShow' => 4,
				'dots'         => false,
				'prevArrow'    => '<span data-role="none" class="slick-prev" tabindex="0"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
				'nextArrow'    => '<span data-role="none" class="slick-next" tabindex="0"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
				'responsive'   => array(
					array(
						'breakpoint' => 1024,
						'settings'   => array(
							'slidesToShow' => 4,
							),
						),
					array(
						'breakpoint' => 800,
						'settings'   => array(
							'slidesToShow' => 2,
							),
						),
					array(
						'breakpoint' => 659,
						'settings'   => array(
							'slidesToShow' => 2,
							),
						),
					array(
						'breakpoint' => 479,
						'settings'   => array(
							'slidesToShow' => 1,
							),
						),
					),
				);

			$carousel_args_encoded = wp_json_encode( $carousel_args );

			$meta_query = WC()->query->get_meta_query();
			$tax_query  = WC()->query->get_tax_query();

			if ( absint( $params['product_category'] ) > 0 ) {
				$tax_query[] = array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => absint( $params['product_category'] ),
				);
			}

			$query_args = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => absint( $params['post_number'] ),
				'meta_query'          => $meta_query,
				'tax_query'           => $tax_query,
				'no_found_rows'       => true,
			);

			global $woocommerce_loop;
			$products = new WP_Query( $query_args );

			if ( $products->have_posts() ) {
				?>
				<div class="realestate-base-woocommerce">
				<div class="realestate-base-woocommmerce-wrapper">
				<ul class="products realestate-base-products-carousel" data-slick='<?php echo $carousel_args_encoded; ?>'>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; ?>
				</ul><!-- .products -->
				</div>
				</div><!-- .woocommerce -->
				<?php
			}
			woocommerce_reset_loop();
			wp_reset_postdata();

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Partners_Widget' ) ) :

	/**
	 * Partners widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Partners_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_partners',
				'description'                 => __( 'Show your partners.', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			for( $i = 1; $i <= 6; $i++ ) {
				$fields[ 'block_heading_' . $i ] = array(
					'label' => __( 'Block', 'realestate-base-pro' ) . ' #' . $i,
					'type'  => 'heading',
					'class' => 'widefat',
					);
				$fields[ 'block_image_' . $i ] = array(
					'label' => __( 'Select Image:', 'realestate-base-pro' ),
					'type'  => 'image',
					);
				$fields[ 'block_link_' . $i ] = array(
					'label'    => __( 'Partner Link', 'realestate-base-pro' ),
					'type'     => 'text',
					'adjacent' => true,
					);
			}

			parent::__construct( 'realestate-base-partners', __( 'RB: Partners', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}
			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$partner_arr = array();
			for ( $i = 0; $i < 6 ; $i++ ) {
				$block = ( $i + 1 );
				$partner_arr[ $i ] = array(
					'image' => $params[ 'block_image_' . $block ],
					'link' => $params[ 'block_link_' . $block ],
					);
			}

			$refined_arr = array();
			if ( ! empty( $partner_arr ) ) {
				foreach ( $partner_arr as $item ) {
					if ( ! empty( $item['image'] ) ) {
						$refined_arr[] = $item;
					}
				}
			}

			if ( ! empty( $refined_arr ) ) {
				$this->render_widget_content( $refined_arr, $params );
			}

			echo $args['after_widget'];

		}

		/**
		 * Render partner content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $partner_arr Partners array.
		 * @param array $params      Parameters array.
		 */
		function render_widget_content( $partner_arr, $params ) {

			$column = count( $partner_arr );

			if ( 0 === $column ) {
				return;
			}
			?>
			<?php if ( ! empty( $partner_arr ) ) : ?>

				<div class="partners-list partner-col-<?php echo esc_attr( $column ); ?>">
					<div class="inner-wrapper">

						<?php foreach ( $partner_arr as $partner ) : ?>

							<div class="partner-item">
								<?php if ( ! empty( $partner['link'] ) ) : ?>
									<a href="<?php echo esc_url( $partner['link'] ); ?>">
								<?php endif; ?>
								<?php if ( ! empty( $partner['image'] ) ) : ?>
									<img src="<?php echo esc_url( $partner['image'] ); ?>" alt="" />
								<?php endif; ?>
								<?php if ( ! empty( $partner['link'] ) ) : ?>
									</a>
								<?php endif; ?>
							</div><!-- .partner-item -->
						<?php endforeach; ?>

					</div><!-- .inner-wrapper -->

				</div><!-- .partners-list -->

			<?php endif; ?>

			<?php
		}

	}
endif;

if ( ! class_exists( 'Realestate_Base_Quick_Contact_Widget' ) ) :

	/**
	 * Quick contact widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Quick_Contact_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'realestate_base_widget_quick_contact',
				'description'                 => __( 'Displays quick contact', 'realestate-base-pro' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'contact_address' => array(
					'label' => __( 'Address:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'contact_email' => array(
					'label' => __( 'Email:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'contact_phone' => array(
					'label' => __( 'Phone:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'contact_fax' => array(
					'label' => __( 'Fax:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			parent::__construct( 'realestate-base-quick-contact', __( 'RB: Quick Contact', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}
			?>
			<div class="contact-main-wrapper">
				<div class="contact-main-details">
					<?php if ( ! empty( $params['contact_phone'] ) ) : ?>
						<div class="contact-info-wrapper info-phone">
							<strong class="contact-type"><?php esc_html_e( 'Phone:', 'realestate-base-pro' ); ?></strong>
							<span class="contact-detail"><a href="<?php echo esc_url( 'tel:' . preg_replace( '/\D+/', '', $params['contact_phone'] ) ); ?>"><?php echo esc_html( $params['contact_phone'] ); ?></a>	</span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $params['contact_fax'] ) ) : ?>
						<div class="contact-info-wrapper info-fax">
							<strong class="contact-type"><?php esc_html_e( 'Fax:', 'realestate-base-pro' ); ?></strong>
							<span class="contact-detail"><?php echo esc_html( $params['contact_fax'] ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $params['contact_address'] ) ) : ?>
						<div class="contact-info-wrapper info-address">
							<strong class="contact-type"><?php esc_html_e( 'Address:', 'realestate-base-pro' ); ?></strong>
							<span class="contact-detail"><?php echo esc_html( $params['contact_address'] ); ?></span>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $params['contact_email'] ) ) : ?>
						<div class="contact-info-wrapper info-contact">
							<strong class="contact-type"><?php esc_html_e( 'Email:', 'realestate-base-pro' ); ?></strong>
							<span class="contact-detail"><a href="<?php echo esc_url( 'mailto:' . $params['contact_email'] ); ?>"><?php echo esc_html( antispambot( $params['contact_email'] ) ); ?></a> </span>
						</div>
					<?php endif; ?>
				</div><!-- .contact-main-details -->
			</div><!-- .contact-main-wrapper -->
			<?php

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Realestate_Base_Portfolio_Widget' ) ) :

	/**
	 * Portfolio widget Class.
	 *
	 * @since 1.0.0
	 */
	class Realestate_Base_Portfolio_Widget extends Realestate_Base_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'   => 'realestate_base_widget_portfolio',
				'description' => __( 'Displays portfolio.', 'realestate-base-pro' ),
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'realestate-base-pro' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_number' => array(
					'label'   => __( 'No. of Projects:', 'realestate-base-pro' ),
					'type'    => 'number',
					'default' => 6,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'post_column' => array(
					'label'   => __( 'No. of Columns:', 'realestate-base-pro' ),
					'type'    => 'number',
					'default' => 3,
					'css'     => 'max-width:60px;',
					'min'     => 3,
					'max'     => 4,
					),
				);

			parent::__construct( 'realestate-base-portfolio', __( 'RB: Portfolio', 'realestate-base-pro' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			// Load assets.
			wp_enqueue_script( 'realestate-base-portfolio' );

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$this->render_projects( $params );

			echo $args['after_widget'];

		}

		/**
		 * Render projects.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return void
		 */
		function render_projects( $params ) {

			$portfolio_details = array();
			$portfolio_category_details = array();
			?>
			<?php
			$portfolio_args = array(
				'post_type'      => 'project',
				'post_status'    => 'publish',
				'posts_per_page' => absint( $params['post_number'] ),
			);

			// The Query.
			$the_query = new WP_Query( $portfolio_args );
			global $post;

			// The Loop.
			if ( $the_query->have_posts() ) {
				$i = 0;
				while ( $the_query->have_posts() ) {
					$the_query->the_post();

					$portfolio_item = array();
					$portfolio_item['title'] = get_the_title();
					$portfolio_item['url']   = get_permalink();
					$portfolio_item['image'] = array();
					$portfolio_item['categories'] = array();
					$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'realestate-base-thumb' );
					if ( ! empty( $image_array ) ) {
						$portfolio_item['image'] = $image_array;
					}

					$terms = get_the_terms( $post->ID, 'project-category' );
					if ( ! empty( $terms ) && is_array( $terms ) ) {
						$portfolio_item['categories'] = $terms;
						// Push categories to main array.
						foreach ( $terms as $term ) {
							$portfolio_category_details[ $term->slug ] = $term->name;
						}
					}

					$portfolio_details[ $i ] = $portfolio_item;

					$i++;
				} // End while loop.

				// Reset post data.
				wp_reset_postdata();
			}
			?>
			<div class="portfolio-main-wrapper portfolio-wrapper-col-<?php echo absint( $params['post_column'] );?>">

				<?php
				if ( ! empty( $portfolio_category_details ) ) : ?>

					<div class="portfolio-filter">
						<a href="#"  data-filter="*" class="current"><?php _e( 'All', 'realestate-base-pro' ); ?></a>
						<?php foreach ( $portfolio_category_details as $key => $category ) { ?>
							<a data-filter=".<?php echo esc_attr( $key ); ?>" href="#"><?php echo esc_html( $category ); ?></a>
						<?php } ?>
					</div>

				<?php endif; ?>

				<div class="portfolio-container">
					<?php if ( ! empty( $portfolio_details ) ) : ?>
						<?php foreach ( $portfolio_details as $key => $portfolio ) : ?>
							<?php
								$filter_classes = '';
								if ( ! empty( $portfolio['categories'] ) ) {
									foreach ( $portfolio['categories'] as $key => $cat ) {
										$filter_classes .= ' ' . $cat->slug;
									}
								}

							 ?>

							<div class="portfolio-item <?php echo esc_attr( $filter_classes ); ?> ">
								<div class="item-wrapper">
									<h3 class="portfolio-item-title"><a href="<?php echo esc_url( $portfolio['url'] ); ?>"><?php echo esc_html( $portfolio['title'] ); ?></a></h3>
									<?php if ( ! empty( $portfolio['image'] ) ) : ?>
										<a class="portfolio-thumb" href="<?php echo esc_url( $portfolio['url'] ); ?>"><img src="<?php echo esc_url( $portfolio['image'][0] ); ?>" alt="<?php echo esc_attr( $portfolio['title'] ); ?>" /></a>
									<?php endif ?>
								</div><!-- .item-wrapper -->
							</div><!-- .portfolio-item -->

						<?php endforeach ?>
					<?php endif ?>

				</div> <!-- .portfolio-container -->
			</div>
			<?php

		}

	}
endif;
