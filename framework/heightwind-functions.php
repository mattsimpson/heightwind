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

		// Custom Logo
		add_theme_support( 'custom-logo', array(
			'height'               => 256,
			'width'                => 256,
			'flex-height'          => true,
			'flex-width'           => true,
			'header-text'          => array( 'site-title', 'site-description' ),
			'unlink-homepage-logo' => false,
		) );

		// Editor Styles
		add_action( 'init', 'heightwind_add_editor_styles' );

		// Localisation
		load_theme_textdomain( 'heightwind', get_template_directory() . '/languages' );

		// Content width
		if ( ! isset( $content_width ) ) $content_width = 1089;
	}
}


/**
 * Register block styles
 * Hooked into init
 * @since 2.1.0
 */
if ( ! function_exists( 'heightwind_register_block_styles' ) ) {
	function heightwind_register_block_styles() {
		// Button: Outline style
		register_block_style( 'core/button', array(
			'name'  => 'outline',
			'label' => __( 'Outline', 'heightwind' ),
		) );

		// Image: Rounded style
		register_block_style( 'core/image', array(
			'name'  => 'rounded',
			'label' => __( 'Rounded', 'heightwind' ),
		) );

		// Image: Shadow style
		register_block_style( 'core/image', array(
			'name'  => 'shadow',
			'label' => __( 'Shadow', 'heightwind' ),
		) );

		// Quote: Large style
		register_block_style( 'core/quote', array(
			'name'  => 'large',
			'label' => __( 'Large', 'heightwind' ),
		) );

		// Separator: Thick style
		register_block_style( 'core/separator', array(
			'name'  => 'thick',
			'label' => __( 'Thick', 'heightwind' ),
		) );

		// Group: Card style
		register_block_style( 'core/group', array(
			'name'  => 'card',
			'label' => __( 'Card', 'heightwind' ),
		) );
	}
}
add_action( 'init', 'heightwind_register_block_styles' );


/**
 * Register block patterns
 * Hooked into init
 * @since 2.1.0
 */
if ( ! function_exists( 'heightwind_register_block_patterns' ) ) {
	function heightwind_register_block_patterns() {
		// Register pattern category
		register_block_pattern_category(
			'heightwind',
			array( 'label' => __( 'HeightWind', 'heightwind' ) )
		);

		// Hero Section
		register_block_pattern(
			'heightwind/hero-section',
			array(
				'title'       => __( 'Hero Section', 'heightwind' ),
				'description' => __( 'A cover block with heading, paragraph, and button.', 'heightwind' ),
				'categories'  => array( 'heightwind', 'featured' ),
				'content'     => '<!-- wp:cover {"overlayColor":"accent","minHeight":400,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:400px"><span aria-hidden="true" class="wp-block-cover__background has-accent-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"style":{"color":{"text":"#ffffff"}}} -->
<h1 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff">' . esc_html__( 'Welcome to Our Site', 'heightwind' ) . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff"}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff">' . esc_html__( 'Discover amazing content and explore what we have to offer. Start your journey with us today.', 'heightwind' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"background","textColor":"accent"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-accent-color has-background-background-color has-text-color has-background wp-element-button">' . esc_html__( 'Get Started', 'heightwind' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->',
			)
		);

		// Two Column Feature
		register_block_pattern(
			'heightwind/two-column-feature',
			array(
				'title'       => __( 'Two Column Feature', 'heightwind' ),
				'description' => __( 'Two columns with images and text.', 'heightwind' ),
				'categories'  => array( 'heightwind', 'columns' ),
				'content'     => '<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="' . esc_url( get_template_directory_uri() . '/framework/images/placeholder.svg' ) . '" alt="' . esc_attr__( 'Feature image', 'heightwind' ) . '"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . esc_html__( 'Feature One', 'heightwind' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'Add a description of your feature here. Explain the benefits and why visitors should care about this particular offering.', 'heightwind' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="' . esc_url( get_template_directory_uri() . '/framework/images/placeholder.svg' ) . '" alt="' . esc_attr__( 'Feature image', 'heightwind' ) . '"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . esc_html__( 'Feature Two', 'heightwind' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'Add a description of your feature here. Explain the benefits and why visitors should care about this particular offering.', 'heightwind' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
			)
		);

		// Call to Action
		register_block_pattern(
			'heightwind/call-to-action',
			array(
				'title'       => __( 'Call to Action', 'heightwind' ),
				'description' => __( 'A styled group with heading and button.', 'heightwind' ),
				'categories'  => array( 'heightwind', 'buttons' ),
				'content'     => '<!-- wp:group {"className":"is-style-card"} -->
<div class="wp-block-group is-style-card"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">' . esc_html__( 'Ready to Get Started?', 'heightwind' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">' . esc_html__( 'Join thousands of satisfied customers. Sign up today and see the difference for yourself.', 'heightwind' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">' . esc_html__( 'Sign Up Now', 'heightwind' ) . '</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">' . esc_html__( 'Learn More', 'heightwind' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
			)
		);

		// Testimonial
		register_block_pattern(
			'heightwind/testimonial',
			array(
				'title'       => __( 'Testimonial', 'heightwind' ),
				'description' => __( 'A quote block with author info styled nicely.', 'heightwind' ),
				'categories'  => array( 'heightwind', 'text' ),
				'content'     => '<!-- wp:quote {"className":"is-style-large"} -->
<blockquote class="wp-block-quote is-style-large"><!-- wp:paragraph -->
<p>' . esc_html__( 'This theme has transformed our website. The clean design and attention to typography makes our content shine. Highly recommended for anyone who values quality.', 'heightwind' ) . '</p>
<!-- /wp:paragraph --><cite>' . esc_html__( 'Jane Smith, Creative Director', 'heightwind' ) . '</cite></blockquote>
<!-- /wp:quote -->',
			)
		);
	}
}
add_action( 'init', 'heightwind_register_block_patterns' );


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
		wp_enqueue_style( 'highwind-styles', get_stylesheet_uri(), array( 'open-sans' ), '2.1.0' );
		wp_enqueue_style( 'highwind-accessibility', get_template_directory_uri() . '/accessibility.css', array( 'highwind-styles' ), '2.1.0' );

		// Enqueue Scripts
		wp_enqueue_script( 'highwind-plugins', get_template_directory_uri() . '/framework/js/plugins.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'highwind-script', get_template_directory_uri() . '/framework/js/script.min.js', array( 'jquery' ), '', true );

		// Color scheme script (no dependencies, loads in footer) - only if dark mode enabled
		if ( get_theme_mod( 'heightwind_dark_mode_enabled', true ) ) {
			wp_enqueue_script( 'heightwind-color-scheme', get_template_directory_uri() . '/framework/js/color-scheme.js', array(), '2.1.0', true );
		}

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