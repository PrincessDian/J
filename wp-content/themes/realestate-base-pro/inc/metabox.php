<?php
/**
 * Implement theme metabox.
 *
 * @package Realestate_Base
 */

if ( ! function_exists( 'realestate_base_add_theme_meta_box' ) ) :

	/**
	 * Add the Meta Box.
	 *
	 * @since 1.0.0
	 */
	function realestate_base_add_theme_meta_box() {

		$apply_metabox_post_types = array( 'post', 'page' );

		foreach ( $apply_metabox_post_types as $key => $type ) {
			add_meta_box(
				'realestate-base-theme-settings',
				esc_html__( 'Theme Settings', 'realestate-base-pro' ),
				'realestate_base_render_theme_settings_metabox',
				$type
			);
		}

	}

endif;

add_action( 'add_meta_boxes', 'realestate_base_add_theme_meta_box' );

if ( ! function_exists( 'realestate_base_render_theme_settings_metabox' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Post $post    The current post.
	 * @param array   $metabox Metabox arguments.
	 */
	function realestate_base_render_theme_settings_metabox( $post, $metabox ) {

		$post_id = $post->ID;

		// Meta box nonce for verification.
		wp_nonce_field( basename( __FILE__ ), 'realestate_base_theme_settings_meta_box_nonce' );

		// Fetch values of current post meta.
		$values = get_post_meta( $post_id, 'realestate_base_theme_settings', true );
		$realestate_base_theme_settings_post_layout = isset( $values['post_layout'] ) ? esc_attr( $values['post_layout'] ) : '';
		$realestate_base_theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';
		$realestate_base_theme_settings_single_image_alignment = isset( $values['single_image_alignment'] ) ? esc_attr( $values['single_image_alignment'] ) : '';
		$realestate_base_theme_settings_sidebar_location_primary = isset( $values['sidebar_location_primary'] ) ? esc_attr( $values['sidebar_location_primary'] ) : '';
		$realestate_base_theme_settings_sidebar_location_secondary = isset( $values['sidebar_location_secondary'] ) ? esc_attr( $values['sidebar_location_secondary'] ) : '';
	?>
	<div id="realestate-base-settings-metabox-container" class="realestate-base-settings-metabox-container">
	  <ul>
	    <li><a href="#realestate-base-settings-metabox-tab-layout"><?php echo __( 'Layout', 'realestate-base-pro' ); ?></a></li>
	    <li><a href="#realestate-base-settings-metabox-tab-image"><?php echo __( 'Image', 'realestate-base-pro' ); ?></a></li>
	    <li><a href="#realestate-base-settings-metabox-tab-sidebar"><?php echo __( 'Sidebar', 'realestate-base-pro' ); ?></a></li>
	  </ul>
	  <div id="realestate-base-settings-metabox-tab-layout">
	    <h4><?php echo __( 'Layout Settings', 'realestate-base-pro' ); ?></h4>
	    <div class="realestate-base-row-content">
	    	<label for="realestate_base_theme_settings_post_layout"><?php echo esc_html__( 'Single Layout', 'realestate-base-pro' ); ?></label>
	    	<?php
	    	$dropdown_args = array(
				'id'          => 'realestate_base_theme_settings_post_layout',
				'name'        => 'realestate_base_theme_settings[post_layout]',
				'selected'    => $realestate_base_theme_settings_post_layout,
				'add_default' => true,
	    		);
	    	realestate_base_render_select_dropdown( $dropdown_args, 'realestate_base_get_global_layout_options' );
	    	?>

	    </div><!-- .realestate-base-row-content -->

	  </div><!-- #realestate-base-settings-metabox-tab-layout -->

	  <div id="realestate-base-settings-metabox-tab-image">
		    <h4><?php echo __( 'Image Settings', 'realestate-base-pro' ); ?></h4>
		    <div class="realestate-base-row-content">
			    <label for="realestate_base_theme_settings_single_image"><?php echo esc_html__( 'Image in Single Post/Page', 'realestate-base-pro' ); ?></label>
	        	<?php
	        	$dropdown_args = array(
	    			'id'          => 'realestate_base_theme_settings_single_image',
	    			'name'        => 'realestate_base_theme_settings[single_image]',
	    			'selected'    => $realestate_base_theme_settings_single_image,
	    			'add_default' => true,
	        		);
	        	realestate_base_render_select_dropdown( $dropdown_args, 'realestate_base_get_image_sizes_options' );
	        	?>
		    </div><!-- .realestate-base-row-content -->
		    <div class="realestate-base-row-content">
		    	<label for="realestate_base_theme_settings_single_image_alignment"><?php echo esc_html__( 'Image Alignment in Single Post/Page', 'realestate-base-pro' ); ?></label>
    	    	<?php
    	    	$dropdown_args = array(
    				'id'          => 'realestate_base_theme_settings_single_image_alignment',
    				'name'        => 'realestate_base_theme_settings[single_image_alignment]',
    				'selected'    => $realestate_base_theme_settings_single_image_alignment,
    				'add_default' => true,
    	    		);
    	    	realestate_base_render_select_dropdown( $dropdown_args, 'realestate_base_get_image_alignment_options' );
    	    	?>
		    </div><!-- .realestate-base-row-content -->

	  </div><!-- #realestate-base-settings-metabox-tab-image -->

	  <div id="realestate-base-settings-metabox-tab-sidebar">
	    <h4><?php echo __( 'Sidebar Settings', 'realestate-base-pro' ); ?></h4>

	    <div class="realestate-base-row-content">
	    	<label for="realestate_base_theme_settings_sidebar_location_primary"><?php echo esc_html__( 'Primary Location', 'realestate-base-pro' ); ?></label>
	    	<?php
	    	$dropdown_args = array(
				'id'          => 'realestate_base_theme_settings_sidebar_location_primary',
				'name'        => 'realestate_base_theme_settings[sidebar_location_primary]',
				'selected'    => $realestate_base_theme_settings_sidebar_location_primary,
				'add_default' => true,
	    		);
	    	realestate_base_render_select_dropdown( $dropdown_args, 'realestate_base_get_sidebar_options' );
	    	?>
	    </div><!-- .realestate-base-row-content -->
	    <div class="realestate-base-row-content">
	    	<label for="realestate_base_theme_settings_sidebar_location_secondary"><?php echo esc_html__( 'Secondary Location', 'realestate-base-pro' ); ?></label>
	    	<?php
	    	$dropdown_args = array(
				'id'          => 'realestate_base_theme_settings_sidebar_location_secondary',
				'name'        => 'realestate_base_theme_settings[sidebar_location_secondary]',
				'selected'    => $realestate_base_theme_settings_sidebar_location_secondary,
				'add_default' => true,
	    		);
	    	realestate_base_render_select_dropdown( $dropdown_args, 'realestate_base_get_sidebar_options' );
	    	?>
	    </div><!-- .realestate-base-row-content -->

	  </div><!-- #realestate-base-settings-metabox-tab-sidebar -->

	</div><!-- #realestate-base-settings-metabox-container -->

    <?php
	}

endif;

if ( ! function_exists( 'realestate_base_save_theme_settings_meta' ) ) :

	/**
	 * Save theme settings meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	function realestate_base_save_theme_settings_meta( $post_id, $post ) {

		// Verify nonce.
		if (
			! ( isset( $_POST['realestate_base_theme_settings_meta_box_nonce'] )
			&& wp_verify_nonce( sanitize_key( $_POST['realestate_base_theme_settings_meta_box_nonce'] ), basename( __FILE__ ) ) )
		) {
			return;
		}

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || absint( $_POST['post_ID'] ) !== $post_id ) {
			return;
		}

		// Check permission.
		if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['realestate_base_theme_settings'] ) && is_array( $_POST['realestate_base_theme_settings'] ) ) {
			$raw_value = wp_unslash( $_POST['realestate_base_theme_settings'] );

			if ( ! array_filter( $raw_value ) ) {

				// No value.
				delete_post_meta( $post_id, 'realestate_base_theme_settings' );

			} else {

				$meta_fields = array(
					'post_layout' => array(
						'type' => 'select',
						),
					'single_image' => array(
						'type' => 'select',
						),
					'single_image_alignment' => array(
						'type' => 'select',
						),
					'sidebar_location_primary' => array(
						'type' => 'select',
						),
					'sidebar_location_secondary' => array(
						'type' => 'select',
						),
					);

				$sanitized_values = array();

				foreach ( $raw_value as $mk => $mv ) {

					if ( isset( $meta_fields[ $mk ]['type'] ) ) {
						switch ( $meta_fields[ $mk ]['type'] ) {
							case 'select':
								$sanitized_values[ $mk ] = sanitize_key( $mv );
								break;
							case 'checkbox':
								$sanitized_values[ $mk ] = absint( $mv ) > 0 ? 1 : 0;
								break;
							default:
								$sanitized_values[ $mk ] = sanitize_text_field( $mv );
								break;
						}
					} // End if.

				}

				update_post_meta( $post_id, 'realestate_base_theme_settings', $sanitized_values );
			}

		} // End if theme settings.

	}

endif;

add_action( 'save_post', 'realestate_base_save_theme_settings_meta', 10, 2 );
