<?php
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Realestate_Base
 */

if ( ! function_exists( 'realestate_base_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function realestate_base_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'realestate-base-pro', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'realestate-base-thumb', 380, 360, true );


		// This theme uses wp_nav_menu() in four location.
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary Menu', 'realestate-base-pro' ),
			'footer'   => esc_html__( 'Footer Menu', 'realestate-base-pro' ),
			'social'   => esc_html__( 'Social Menu', 'realestate-base-pro' ),
			'notfound' => esc_html__( '404 Menu', 'realestate-base-pro' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'realestate_base_custom_background_args', array(
			'default-color' => 'FFFFFF',
			'default-image' => '',
		) ) );

		/*
		 * Enable support for selective refresh of widgets in Customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Editor style.
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		add_editor_style( 'css/editor-style' . $min . '.css' );

		/*
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Add WooCommerce Support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );

		// Load Supports.
		require get_template_directory() . '/inc/support.php';

	}
endif;

add_action( 'after_setup_theme', 'realestate_base_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function realestate_base_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'realestate_base_content_width', 640 );
}
add_action( 'after_setup_theme', 'realestate_base_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function realestate_base_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'realestate-base-pro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your Primary Sidebar.', 'realestate-base-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'realestate-base-pro' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your Secondary Sidebar.', 'realestate-base-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget Area', 'realestate-base-pro' ),
		'id'            => 'sidebar-front-page-widget-area',
		'description'   => esc_html__( 'Add widgets here to appear in your Front Page.', 'realestate-base-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="container">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( __( 'Extra Sidebar %d', 'realestate-base-pro' ), 1 ),
		'id'            => 'extra-sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( __( 'Extra Sidebar %d', 'realestate-base-pro' ), 2 ),
		'id'            => 'extra-sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( __( 'Extra Sidebar %d', 'realestate-base-pro' ), 3 ),
		'id'            => 'extra-sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( __( 'Extra Sidebar %d', 'realestate-base-pro' ), 4 ),
		'id'            => 'extra-sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'realestate_base_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function realestate_base_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/third-party/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );

	$fonts_url = realestate_base_fonts_url();

	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'realestate-base-google-fonts', $fonts_url, array(), null );
	}

	wp_enqueue_style( 'jquery-sidr', get_template_directory_uri() .'/third-party/sidr/css/jquery.sidr.dark' . $min . '.css', '', '2.2.1' );

	wp_enqueue_style( 'jquery-slick', get_template_directory_uri() . '/third-party/slick/slick' . $min . '.css', '', '1.5.9' );

	wp_enqueue_style( 'realestate-base-style', get_stylesheet_uri(), array(), '2.1.0' );

	wp_enqueue_script( 'realestate-base-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2' . $min . '.js', array( 'jquery' ), '2.1.6', true );

	$transition_effect = realestate_base_get_option( 'featured_slider_transition_effect' );

	if ( in_array( $transition_effect, array( 'tileBlind', 'tileSlide' ) ) ) {
		wp_enqueue_script( 'jquery-cycle2-tile', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2.tile' . $min . '.js', array( 'jquery' ), '2.1.6', true );
	}

	if ( in_array( $transition_effect, array( 'flipHorz', 'flipVert' ) ) ) {
		wp_enqueue_script( 'jquery-cycle2-flip', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2.flip' . $min . '.js', array( 'jquery' ), '2.1.6', true );
	}

	if ( in_array( $transition_effect, array( 'shuffle' ) ) ) {
		wp_enqueue_script( 'jquery-cycle2-shuffle', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2.shuffle' . $min . '.js', array( 'jquery' ), '2.1.6', true );
	}

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/third-party/slick/slick' . $min . '.js', array( 'jquery' ), '1.5.9', true );

	wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/third-party/sidr/js/jquery.sidr' . $min . '.js', array( 'jquery' ), '2.2.1', true );

	wp_register_script( 'jquery-isotope', get_template_directory_uri() . '/third-party/isotope/isotope.pkgd' . $min . '.js', array( 'jquery' ), '3.0.4', true );

	wp_register_script( 'realestate-base-portfolio', get_template_directory_uri() . '/js/portfolio' . $min . '.js', array( 'jquery', 'jquery-isotope', 'imagesloaded' ), '1.0.0', true );

	wp_enqueue_script( 'realestate-base-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery' ), '1.0.0', true );

	$custom_args = array(
		'go_to_top_status' => ( true === realestate_base_get_option( 'go_to_top' ) ) ? 1 : 0,
	);
	wp_localize_script( 'realestate-base-custom', 'Realestate_Base_Custom_Options', $custom_args );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'realestate_base_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function realestate_base_admin_scripts( $hook ) {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_style( 'realestate-base-metabox', get_template_directory_uri() . '/css/metabox' . $min . '.css', '', '1.0.0' );
		wp_enqueue_script( 'realestate-base-custom-admin', get_template_directory_uri() . '/js/admin' . $min . '.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ), '1.0.0', true );
	}

	if ( 'widgets.php' === $hook ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_media();
		wp_enqueue_style( 'realestate-base-custom-widgets-style', get_template_directory_uri() . '/css/widgets' . $min . '.css', array(), '1.0.0' );
		wp_enqueue_script( 'realestate-base-custom-widgets', get_template_directory_uri() . '/js/widgets' . $min . '.js', array( 'jquery' ), '1.0.0', true );
	}

}
add_action( 'admin_enqueue_scripts', 'realestate_base_admin_scripts' );

/**
 * Load init.
 */
require_once get_template_directory() . '/inc/init.php';

/**
 * Load theme updater functions.
 */
function realestate_base_theme_updater() {
	if ( is_admin() ) {
		require_once get_template_directory() . '/updater/theme-updater.php';
	}
}
add_action( 'after_setup_theme', 'realestate_base_theme_updater' );
