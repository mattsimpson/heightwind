<?php
/**
 * HeightWind functions
 * @package heightwind
 * @since 2.0.0
 */
/**
 * Setup Theme
 * Hooked into after_setup_theme()
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_setup' ) ) {
	function heightwind_setup() {
		apply_filters( 'heightwind_header_args', $header_args = array(
			'header-text'	=> false,
			'width'			=> 2500,
			'height'		=> 600,
		) );

		// Navigation
		register_nav_menu( 'main', __( 'Main menu', 'heightwind' ) );

		// Theme Support
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-header', $header_args );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		) );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'appearance-tools' );
		add_theme_support( 'custom-line-height' );
		add_theme_support( 'custom-spacing' );
		add_theme_support( 'custom-units' );

		// Editor Styles
		add_action( 'init', 'heightwind_add_editor_styles' );

		// Localisation
		load_theme_textdomain( 'heightwind', get_template_directory() . '/languages' );

		// Content width
		if ( ! isset( $content_width ) ) $content_width = 1089;
	}
}


/**
 * Enqueue scripts
 * Hooked into wp_enqueue_scripts()
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_add_scripts' ) ) {
	function heightwind_add_scripts() {
		// Register styles
		wp_register_style( 'open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700' );

		// Enqueue styles
		wp_enqueue_style( 'highwind-styles', get_stylesheet_uri(), array( 'open-sans' ), '1.2.4' );
		wp_enqueue_style( 'highwind-accessibility', get_template_directory_uri() . '/accessibility.css', array( 'highwind-styles' ), '1.2.8' );

		// Enqueue Scripts
		wp_enqueue_script( 'highwind-plugins', get_template_directory_uri() . '/framework/js/plugins.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'highwind-script', get_template_directory_uri() . '/framework/js/script.min.js', array( 'jquery' ), '', true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}


/**
 * Widget init
 * Hooked into widgets_init()
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_widgets_init' ) ) {
	function heightwind_widgets_init() {

		// The sidebar
	    register_sidebar( array(
	    	'name'          => __( 'Sidebar', 'heightwind' ),
			'id'            => 'primary-sidebar',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' 	=> '</aside>',
		    'before_title' 	=> '<h2>',
		    'after_title' 	=> '</h2>',
		) );

		// The footer
		register_sidebar( array(
	    	'name'          => __( 'Footer #1', 'heightwind' ),
			'id'            => 'footer-sidebar-1',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' 	=> '</aside>',
		    'before_title' 	=> '<h2>',
		    'after_title' 	=> '</h2>',
		) );
		register_sidebar( array(
	    	'name'          => __( 'Footer #2', 'heightwind' ),
			'id'            => 'footer-sidebar-2',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' 	=> '</aside>',
		    'before_title' 	=> '<h2>',
		    'after_title' 	=> '</h2>',
		) );
		register_sidebar( array(
	    	'name'          => __( 'Footer #3', 'heightwind' ),
			'id'            => 'footer-sidebar-3',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' 	=> '</aside>',
		    'before_title' 	=> '<h2>',
		    'after_title' 	=> '</h2>',
		) );
	}
}


/**
 * Move textarea above name / email / address in comment form
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_move_textarea' ) ) {
	function heightwind_move_textarea( $input = array () ) {
	    static $textarea = '';

	    if ( 'comment_form_defaults' === current_filter() ) {
	        $textarea = $input['comment_field']; 	// Copy the field to our internal variable …
	        $input['comment_field'] = ''; 			// … and remove it from the defaults array.
	        return $input;
	    }

	    if ( is_singular( 'post' ) || is_page() ) {
			echo $textarea;
		}
	}
}


/**
 * Get menu name
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_get_menu_name' ) ) {
	function heightwind_get_menu_name( $location ){
	    if ( ! has_nav_menu( $location ) ) return false;
	    $menus 		= get_nav_menu_locations();
	    $menu_title = wp_get_nav_menu_object( $menus[$location] ) -> name;
	    return $menu_title;
	}
}


/**
 * Add editor styles
 * @since 2.0.0
 */
if ( ! function_exists( 'heightwind_add_editor_styles' ) ) {
	function heightwind_add_editor_styles() {
		// Classic editor styles
		add_editor_style( 'framework/css/editor-styles.css' );
		// Block editor styles
		add_editor_style( 'block-editor-style.css' );
	}
}


/**
 * Checks if WooCommerce is activated
 * @since 2.0.0
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}